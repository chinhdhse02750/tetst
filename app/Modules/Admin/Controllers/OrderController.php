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
use App\Repositories\OrderRepository;
use App\Repositories\OrderDetailRepository;
use App\Repositories\UnitRepository;

class OrderController extends Controller
{
    protected $tagRepository;
    protected $productCommentRepository;
    protected $prefRepository;
    protected $shippingRepository;
    protected $oderRepository;
    protected $oderDetailRepository;
    protected $unitRepository;

    /**
     * CategoryController constructor.
     */
    public function __construct(
        TagRepository $tagRepository,
        ProductCommentRepository $productCommentRepository,
        PrefRepository $prefRepository,
        ShippingRepository $shippingRepository,
        OrderRepository $oderRepository,
        OrderDetailRepository $oderDetailRepository,
        UnitRepository $unitRepository
    ) {
        $this->tagRepository = $tagRepository;
        $this->productCommentRepository = $productCommentRepository;
        $this->prefRepository = $prefRepository;
        $this->shippingRepository = $shippingRepository;
        $this->orderRepository = $oderRepository;
        $this->oderDetailRepository = $oderDetailRepository;
        $this->unitRepository = $unitRepository;
    }

    /**
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request)
    {
        $comments = $this->productCommentRepository->orderBy('created_at', $direction = 'DESC')
            ->paginate(Constants::DEFAULT_PER_PAGE);
        $orders = $this->orderRepository->all();

        return view('order.index', ['comments' => $comments, 'orders' => $orders]);
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
     * Display the unit.
     *
     * @param int $id
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(int $id)
    {
        $order = $this->orderRepository->find($id);
        $orderDetail = $this->oderDetailRepository->findByField(['order_id'=> $order->id]);

        return view('order.detail', ['order' => $order, 'orderDetail' => $orderDetail]);
    }

    /**
     * @param Request $request
     * @return $this|\Illuminate\Http\JsonResponse
     */
    public function updateStatus(Request $request)
    {
        try {
            $id = $request->id;
            $data = $request->except(['_token']);
            $this->orderRepository->find($id)->update($data);

            return response()->json([
                'status' => 'success',
                'key_status' => $data['status']
            ], 200);

        } catch (Exception $e) {
            Log::error('[ERROR_CATEGORY_CREATE]: '. $e->getMessage());
            return redirect()
                ->route('order.index')
                ->withErrors($e->getMessage());
        }//end try
    }

    /**
     * @param Request $request
     * @return $this|\Illuminate\Http\JsonResponse
     */
    public function updatePaymentStatus(Request $request)
    {
        try {
            $id = $request->id;
            $data = $request->except(['_token']);
            $this->orderRepository->find($id)->update($data);

            return response()->json([
                'status' => 'success',
                'key_status' => $data['payment_status']
            ], 200);

        } catch (Exception $e) {
            Log::error('[ERROR_CATEGORY_CREATE]: '. $e->getMessage());
            return redirect()
                ->route('order.index')
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
        $result = $this->orderRepository->find($id);
        if ($result) {
            $result->delete();
            Session::flash('success_msg', trans('alerts.general.success.deleted'));
        }
        return redirect()->route('order.index');
    }

    /**
     * Create a new controller instance.
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }
}
