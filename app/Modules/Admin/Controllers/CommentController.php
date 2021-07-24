<?php

namespace App\Modules\Admin\Controllers;

use App\Entities\Category;
use App\Entities\Tag;
use App\Modules\Admin\Requests\Category\StoreCategoryRequest;
use App\Repositories\ProductCommentRepository;
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

class CommentController extends Controller
{
    protected $tagRepository;
    protected $productCommentRepository;

    /**
     * CategoryController constructor.
     */
    public function __construct(
        TagRepository $tagRepository,
        ProductCommentRepository $productCommentRepository
    ) {
        $this->tagRepository = $tagRepository;
        $this->productCommentRepository = $productCommentRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $comments = $this->productCommentRepository->orderBy('created_at', $direction = 'DESC')
            ->paginate(Constants::DEFAULT_PER_PAGE);

        return view('comment.index', ['comments' => $comments]);
    }



    /**
     * Update the category in storage
     * @param StoreCategoryRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function updateStatus(Request $request)
    {
        try {
            $id = $request->id;
            $data = $request->except(['_token']);
            $this->productCommentRepository->find($id)->update($data);

            return response()->json([
                'status' => 'success',
                'key_status' => $data['status']
            ], 200);

        } catch (Exception $e) {
            Log::error('[ERROR_CATEGORY_CREATE]: '. $e->getMessage());
            return redirect()
                ->route('comments.index')
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
        $result = $this->productCommentRepository->find($id);
        if ($result) {
            $result->delete();
            Session::flash('success_msg', trans('alerts.general.success.deleted'));
        }
        return redirect()->route('comments.index');
    }

    /**
     * Create a new controller instance.
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }
}
