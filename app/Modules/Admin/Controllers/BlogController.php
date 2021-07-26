<?php

namespace App\Modules\Admin\Controllers;

use App\Entities\Product;
use App\Helpers\Common;
use App\Helpers\Constants;
use App\Modules\Admin\Requests\Blogs\StoreBlogsRequest;
use App\Modules\Admin\Requests\Category\StoreCategoryRequest;
use App\Repositories\BlogRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\View\View;
use PHPUnit\Exception;
use Prettus\Validator\Exceptions\ValidatorException;

class BlogController extends Controller
{
    /**
     * @var BlogRepository
     */
    protected $blogRepository;

    /**
     * ContactController constructor.
     * @param BlogRepository $contactRepository
     */
    public function __construct(
        BlogRepository $blogRepository
    )
    {
        $this->blogRepository = $blogRepository;
    }

    /**
     *
     * @return Response
     */
    public function index()
    {
        $blogs = $this->blogRepository
            ->getBlogsPaginated(Constants::DEFAULT_PER_PAGE, Constants::USER_ORDER_BY, Constants::USER_SORT);

        return response()->view('blogs.index', compact('blogs'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreBlogsRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(StoreBlogsRequest $request)
    {
        try {
            $data = $request->except(['_token']);
            $data['blog_title'] = $data['title'];
            $data['blog_content'] = $data['content'];
            $this->blogRepository->create($data);
            Session::flash('success_msg', trans('alerts.general.success.created'));

            return redirect()
                ->route('blogs.index');
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
        $blog = $this->blogRepository->find($id);

        return view('blogs.edit', ['blog' => $blog]);
    }

    /**
     * Update the category in storage
     * @param StoreCategoryRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(StoreBlogsRequest $request, int $id)
    {
        try {
            $data = $request->except(['_token']);
            $data['blog_title'] = $data['title'];
            $data['blog_content'] = $data['content'];
            $this->blogRepository->find($id)->update($data);

            Session::flash('success_msg', trans('alerts.general.success.updated'));
            return redirect()
                ->route('blogs.index');
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
        $result = $this->blogRepository->find($id);
        if ($result) {
            $result->delete();
            Session::flash('success_msg', trans('alerts.general.success.deleted'));
        }
        return redirect()->route('blogs.index');
    }

    /**
     * Create a new controller instance.
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }
}
