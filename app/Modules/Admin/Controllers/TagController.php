<?php

namespace App\Modules\Admin\Controllers;

use App\Entities\Category;
use App\Entities\Tag;
use App\Modules\Admin\Requests\Category\StoreCategoryRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use App\Repositories\TagRepository;
use App\Helpers\Constants;
use Illuminate\View\View;
use PHPUnit\Exception;
use Prettus\Validator\Exceptions\ValidatorException;
use Illuminate\Support\Str;
use App\Helpers\Common;

class TagController extends Controller
{
    protected $tagRepository;

    /**
     * CategoryController constructor.
     */
    public function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $tag = $this->tagRepository->orderBy('created_at', $direction = 'DESC')
            ->paginate(Constants::DEFAULT_PER_PAGE);
        return view('tag.index', ['tags' => $tag]);
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
        $tags = $this->tagRepository->find($id);
        return view('tag.detail', ['tags' => $tags]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('tag.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreCategoryRequest $request
     * @return RedirectResponse
     * @throws ValidatorException
     */
    public function store(StoreCategoryRequest $request)
    {
        try {
            $data = $request->except(['_token']);
            $slug = Str::slug($data['name']);
            $existingCount = Category::where('alias', 'like', $slug . '%')->count();
            $data['alias'] = Common::getUniqueUrl($slug, $existingCount);
            $this->tagRepository->create($data);
            Session::flash('success_msg', trans('alerts.general.success.created'));

            return redirect()
                ->route('tags.index');
        } catch (Exception $e) {
            Log::error('[ERROR_CATEGORY_CREATE]: '. $e->getMessage());

            return redirect()
                ->route('tags.index')
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
        $tags = $this->tagRepository->find($id);
        return view('tag.edit', ['tags' => $tags]);
    }

    /**
     * Update the category in storage
     * @param StoreCategoryRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(StoreCategoryRequest $request, int $id)
    {
        try {
            $data = $request->except(['_token']);
            $slug = Str::slug($data['name']);
            $existingCount = Category::where('alias', 'like', $slug . '%')->count();
            $data['alias'] = Common::getUniqueUrl($slug, $existingCount);
            $this->tagRepository->find($id)->update($data);
            Session::flash('success_msg', trans('alerts.general.success.updated'));
            return redirect()
                ->route('tags.index');
        } catch (Exception $e) {
            Log::error('[ERROR_CATEGORY_CREATE]: '. $e->getMessage());
            return redirect()
                ->route('tags.index')
                ->withErrors($e->getMessage());
        }//end try
    }

    /**
     * Remove the category from storage.
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id)
    {
        $result = $this->tagRepository->find($id);
        if ($result) {
            $result->delete();
            Session::flash('success_msg', trans('alerts.general.success.deleted'));
        }
        return redirect()->route('tags.index');
    }

    /**
     * Create a new controller instance.
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }
}
