<?php

namespace App\Modules\Admin\Controllers;

use App\Entities\Shipping;
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
use App\Repositories\PrefRepository;
use App\Repositories\ShippingRepository;

class ShippingController extends Controller
{
    protected $tagRepository;
    protected $productCommentRepository;
    protected $prefRepository;
    protected $shippingRepository;

    /**
     * CategoryController constructor.
     */
    public function __construct(
        TagRepository $tagRepository,
        ProductCommentRepository $productCommentRepository,
        PrefRepository $prefRepository,
        ShippingRepository $shippingRepository
    ) {
        $this->tagRepository = $tagRepository;
        $this->productCommentRepository = $productCommentRepository;
        $this->prefRepository = $prefRepository;
        $this->shippingRepository = $shippingRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $comments = $this->productCommentRepository->orderBy('created_at', $direction = 'DESC')
            ->paginate(Constants::DEFAULT_PER_PAGE);
        $prefs = $this->prefRepository->all();

        return view('shipping.index', ['comments' => $comments, 'prefs' => $prefs]);
    }


    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(Request $request)
    {
        $shipping = $this->shippingRepository->all();
        $data = $request->except(['_token']);
        if($shipping->count() == 0){
            foreach ($data as $value){
                $this->shippingRepository->create($value);
            }
        }else{
            foreach ($data as $value){
                Shipping::where(['pref_id'=>$value['pref_id']])->update($value);
            }
        }

        Session::flash('success_msg', trans('alerts.general.success.created'));

        return redirect()->route('shipping.index');
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
