<?php

namespace App\Modules\Admin\Controllers;

use App\Entities\Category;
use App\Modules\Admin\Requests\Category\StoreCategoryRequest;
use App\Repositories\UnitRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use App\Helpers\Constants;
use Illuminate\View\View;
use PHPUnit\Exception;

class ProductController extends Controller
{
    protected $categoryRepository;
    protected $productRepository;
    protected $unitRepository;

    /**
     * ProductController constructor.
     * @param CategoryRepository $categoryRepository
     * @param ProductRepository $productRepository
     */
    public function __construct(
        CategoryRepository $categoryRepository,
        ProductRepository $productRepository,
        UnitRepository $unitRepository
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
        $this->unitRepository = $unitRepository;
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
        return view('product.create', ['categories' => $categories, 'units' => $units]);
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreCategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(StoreCategoryRequest $request)
    {
        try {
            $data = $request->except(['_token']);
            $data['image'] = implode(',', $data['image']);
            $listCategoryId = explode(',', $data['category_id']);
            $product = $this->productRepository->create($data);
            $productId = $product->id;
            $newProduct = $this->productRepository->find($productId);
            $newProduct->category()->attach($listCategoryId);
            Session::flash('success_msg', trans('alerts.general.success.created'));

            return redirect()
                ->route('products.index');
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
        $categoryId = $products->category()->pluck('category_id');
        $stringCategory = $categoryId->implode(',');
        return view(
            'product.edit',
            ['products' => $products,
                'categories' => $categories,
                'units' => $units,
                'categoryId' => $categoryId,
                'stringCategory' => $stringCategory,
                'images' => $image
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
    public function update(Request $request, int $id)
    {
        try {
            $data = $request->except(['_token']);
            $data['image'] = implode(',', $data['image']);
            $this->productRepository->find($id)->update($data);
            $thisProduct = $this->productRepository->find($id);
            $oldListCategoryId = explode(',', $data['old_category_id']);
            $listCategoryId = explode(',', $data['category_id']);
            $thisProduct->category()->detach($oldListCategoryId);
            $thisProduct->category()->attach($listCategoryId);
            Session::flash('success_msg', trans('alerts.general.success.updated'));
            return redirect()
                ->route('products.index');
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
     * Create a new controller instance.
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }
}
