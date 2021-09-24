<?php

namespace App\Modules\Admin\Controllers;

use App\Entities\Category;
use App\Entities\Product;
use App\Helpers\Common;
use App\Modules\Admin\Requests\Category\StoreCategoryRequest;
use App\Repositories\UnitRepository;
use App\Services\UserService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use App\Repositories\TagRepository;
use App\Helpers\Constants;
use Illuminate\View\View;
use PHPUnit\Exception;
use App\Services\ProductService;
use App\Modules\Admin\Requests\Product\UpdateProductRequest;
use App\Modules\Admin\Requests\Product\StoreProductRequest;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    protected $categoryRepository;
    protected $productRepository;
    protected $unitRepository;
    protected $productService;
    protected $tagRepository;

    /**
     * ProductController constructor.
     * @param CategoryRepository $categoryRepository
     * @param ProductRepository $productRepository
     * @param UnitRepository $unitRepository
     * @param ProductService $productService
     */
    public function __construct(
        CategoryRepository $categoryRepository,
        ProductRepository $productRepository,
        UnitRepository $unitRepository,
        ProductService $productService,
        TagRepository $tagRepository
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
        $this->unitRepository = $unitRepository;
        $this->productService = $productService;
        $this->tagRepository = $tagRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $products = $this->productRepository->orderBy('created_at', $direction = 'DESC')
            ->with('units')
            ->with('category')
            ->with('tag')
            ->paginate(Constants::DEFAULT_PER_PAGE);
        return view('product.index', ['products' => $products]);
    }

    /**
     * Display the category.
     *
     * @param int $id
     *
     * @return Application|Factory|View
     */
    public function show(int $id)
    {
        $categories = $this->categoryRepository->find($id);
        return view('product.detail', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $categories = $this->categoryRepository->findByField('parent', '1');
        $units = $this->unitRepository->all();
        $tags = $this->tagRepository->all();

        return view('product.create', ['categories' => $categories, 'units' => $units, 'tags' => $tags]);
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreCategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(StoreProductRequest $request)
    {
        try {
            $data = $request->except(['_token']);
            $data['image'] = implode(',', $data['image']);
            $slug = Str::slug($data['name']);
            $existingCount = Product::where('alias', 'like', $slug . '%')->count();
            $data['alias'] = Common::getUniqueUrl($slug, $existingCount);
            $listCategoryId = explode(',', $data['category_id']);
            $listTag = explode(',', $data['tag_id']);
            $product = $this->productRepository->create($data);
            $productId = $product->id;
            $newProduct = $this->productRepository->find($productId);
            $newProduct->category()->attach($listCategoryId);
            $newProduct->tag()->attach($listTag);
            Session::flash('success_msg', trans('alerts.general.success.created'));

            return redirect()->route('products.index');
        } catch (Exception $e) {
            Log::error('[ERROR_CATEGORY_CREATE]: ' . $e->getMessage());

            return redirect()
                ->route('products.index')
                ->withErrors($e->getMessage());
        }//end try
    }

    /**
     * Show the form for editing the category
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $products = $this->productRepository->find($id);
        $image = explode(',', $products['image']);
        $categories = $this->categoryRepository->findByField('parent', '1');
        $units = $this->unitRepository->all();
        $tags = $this->tagRepository->all();
        $categoryId = $products->category()->pluck('category_id');
        $tagId = $products->tag()->pluck('tag_id');
        $stringCategory = $categoryId->implode(',');
        $stringTag = $tagId->implode(',');
        return view(
            'product.edit',
            ['products' => $products,
                'categories' => $categories,
                'units' => $units,
                'categoryId' => $categoryId,
                'stringCategory' => $stringCategory,
                'tagId' => $tagId,
                'stringTag' => $stringTag,
                'images' => $image,
                'tags' => $tags
            ]
        );
    }

    /**
     * Update the category in storage
     * @param StoreCategoryRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(UpdateProductRequest $request, int $id)
    {
        try {
            $data = $request->except(['_token']);
            $data['image'] = implode(',', $data['image']);

            $this->productRepository->find($id)->update($data);
            $thisProduct = $this->productRepository->find($id);
            $oldListCategoryId = explode(',', $data['old_category_id']);
            $listCategoryId = explode(',', $data['category_id']);
            $oldListTag = explode(',', $data['old_tag_id']);
            $listTag = explode(',', $data['tag_id']);
            $thisProduct->category()->detach($oldListCategoryId);
            $thisProduct->category()->attach($listCategoryId);
            $thisProduct->tag()->detach($oldListTag);
            $thisProduct->tag()->attach($listTag);
            Session::flash('success_msg', trans('alerts.general.success.updated'));

            return redirect()->route('products.index');
        } catch (Exception $e) {
            Log::error('[ERROR_CATEGORY_CREATE]: ' . $e->getMessage());
            return redirect()
                ->route('products.index')
                ->withErrors($e->getMessage());
        }//end try
    }

    /**
     * Remove the category from storage.
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id)
    {
        $result = $this->productRepository->find($id);
        if ($result) {
            $result->delete();
            Session::flash('success_msg', trans('alerts.general.success.deleted'));
        }
        return redirect()->route('products.index');
    }

    /**
     * Search member.
     *
     * @param Request $request
     * @return array|string
     * @throws \Throwable
     */
    public function search(Request $request)
    {
        $products = $this->productRepository
            ->getFilterPaginated($request->name, Constants::DEFAULT_PER_PAGE, Constants::USER_ORDER_BY, Constants::USER_SORT);


        return view('product.result_search', ['products' => $products]);
    }

    /**
     * Create a new controller instance.
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }
}
