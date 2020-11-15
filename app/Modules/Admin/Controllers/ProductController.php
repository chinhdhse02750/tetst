<?php

namespace App\Modules\Admin\Controllers;

use App\Entities\Category;
use App\Modules\Admin\Requests\Category\StoreCategoryRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use App\Repositories\CategoryRepository;
use App\Helpers\Constants;
use PHPUnit\Exception;

class ProductController extends Controller
{
    protected $categoryRepository;

    /**
     * CategoryController constructor.
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $categories = $this->categoryRepository->orderBy('created_at', $direction = 'DESC')
            ->paginate(Constants::DEFAULT_PER_PAGE);
        return view('product.index', ['categories' => $categories]);
    }

    /**
     * Display the category.
     *
     * @param int $id
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(int $id)
    {
        $categories = $this->categoryRepository->find($id);
        return view('product.detail', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $categories = $this->categoryRepository->findByField('parent','0');
        return view('product.create', ['categories' => $categories]);
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
            $this->categoryRepository->create($data);
            Session::flash('success_msg', trans('alerts.general.success.created'));

            return redirect()
                ->route('product.index');
        } catch (Exception $e) {
            Log::error('[ERROR_CATEGORY_CREATE]: '. $e->getMessage());

            return redirect()
                ->route('product.index')
                ->withErrors($e->getMessage());
        }//end try
    }

    /**
     * Show the form for editing the category
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(int $id)
    {
        $categories = $this->categoryRepository->find($id);
        $menus = $this->categoryRepository->findByField('parent','0');
        return view('product.edit', ['categories' => $categories, 'menus' => $menus]);
    }

    /**
     * Update the category in storage
     * @param StoreCategoryRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(StoreCategoryRequest $request, int $id)
    {
        try {
            $data = $request->except(['_token']);
            $this->categoryRepository->find($id)->update($data);
            Session::flash('success_msg', trans('alerts.general.success.updated'));
            return redirect()
                ->route('product.index');
        } catch (Exception $e) {
            Log::error('[ERROR_CATEGORY_CREATE]: '. $e->getMessage());
            return redirect()
                ->route('product.index')
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
        $result = $this->categoryRepository->find($id);
        if ($result) {
            $result->delete();
            Session::flash('success_msg', trans('alerts.general.success.deleted'));
        }
        return redirect()->route('product.index');
    }

    /**
     * Create a new controller instance.
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }
}
