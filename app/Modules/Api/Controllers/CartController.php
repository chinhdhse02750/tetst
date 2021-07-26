<?php

namespace App\Modules\Api\Controllers;

use App\Modules\Admin\Controllers\Controller;
use App\Modules\Member\Mail\Admin\SendNotifyNewOrder;
use App\Repositories\ProductRepository;
use App\Repositories\ProductCommentRepository;
use App\Repositories\UserRepository;
use App\Modules\Member\Services\ActivityService;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Repositories\PrefRepository;
use App\Repositories\ShippingRepository;
use App\Repositories\OrderRepository;
use App\Repositories\OrderDetailRepository;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    use ResponseTrait;

    protected $userRepository;

    protected $productRepository;

    protected $productCommentRepository;

    protected $prefRepository;

    protected $shippingRepository;

    protected $oderRepository;

    protected $oderDetailRepository;

    protected $activityService;

    const REVIEW_STATUS_COMMENT = 0;

    const DAIBIKI_MIN           = 330;

    const DAIBIKI_MAX           = 440;

    const TOTAL_DAIBIKI         = 10000;

    const FREE_SHIP_TOTAL       = 10000;

    /**
     * MemberController constructor.
     *
     * @param UserRepository $userRepository
     * @param ProductRepository $productRepository
     */
    public function __construct(
        UserRepository $userRepository,
        ProductRepository $productRepository,
        ProductCommentRepository $productCommentRepository,
        PrefRepository $prefRepository,
        ShippingRepository $shippingRepository,
        OrderRepository $oderRepository,
        OrderDetailRepository $oderDetailRepository,
        ActivityService $activityService
    ){
        $this->userRepository           = $userRepository;
        $this->productRepository        = $productRepository;
        $this->productCommentRepository = $productCommentRepository;
        $this->prefRepository           = $prefRepository;
        $this->shippingRepository       = $shippingRepository;
        $this->orderRepository          = $oderRepository;
        $this->orderDetailRepository    = $oderDetailRepository;
        $this->activityService          = $activityService;
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function productCart(Request $request)
    {
        $data    = $request->all();
        $Product = \App\Entities\Product::find($data['id']);
        \Cart::add($data['id'], $data['product_name'], $data['product_discount_price'] !== null
            ? $data['product_discount_price'] : $data['product_price'], $data['quantity'], [])->associate($Product);
        $cartCollection        = \Cart::getContent();
        $total                 = \Cart::getTotal();
        $totalWithoutCondition = \Cart::getSubTotalWithoutConditions();
        $count                 = $cartCollection->count();

        return response()->json([
            'status'           => 'success',
            'data'             => $cartCollection,
            'total'            => $total,
            'totalWtCondition' => $totalWithoutCondition,
            'count'            => $count
        ], 200);
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function deleteProduct(Request $request)
    {
        $data           = $request->all();
        $cartCollection = \Cart::getContent();
        $countItem      = $cartCollection->count();
        if ($countItem === 1) {
            \Cart::clear();
            \Cart::clearCartConditions();

            return response()->json([
                'status'  => 'success',
                'message' => 'cart empty'
            ], 200);

        } elseif (\Cart::remove($data['id'])) {
            $this->updateNewShippingByTotal();
            $shipping              = \Cart::getCondition('Shipping');
            $total                 = \Cart::getTotal();
            $totalWithoutCondition = \Cart::getSubTotalWithoutConditions();
            $daiBiKyFee            = \Cart::getCondition('daiBiKi');

            return response()->json([
                'status'                => 'success',
                'total'                 => $total,
                'totalWithoutCondition' => $totalWithoutCondition,
                'daiBiKyFee'            => isset($shipping) ? $daiBiKyFee->getValue() : 0,
                'shipping'              => isset($shipping) ? $shipping->getValue() : 0,
            ], 200);
        }

        return response()->json([
            'status' => 'fail',
        ], 400);
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function updateQuantity(Request $request)
    {
        $data = $request->all();
        if (\Cart::update($data['id'], [
            'quantity' => [
                'relative' => false,
                'value'    => $data['quantity']
            ]
        ])
        ) {
            $product = \Cart::get($data['id']);
            $this->updateNewShippingByTotal();
            $shipping              = \Cart::getCondition('Shipping');
            $daiBiKyFee            = \Cart::getCondition('daiBiKi');
            $total                 = \Cart::getTotal();
            $totalWithoutCondition = \Cart::getSubTotalWithoutConditions();

            return response()->json([
                'status'                => 'success',
                'shipping'              => isset($shipping) ? $shipping->getValue() : 0,
                'product'               => $product,
                'total'                 => $total,
                'totalWithoutCondition' => $totalWithoutCondition,
                'daiBiKyFee'            => isset($daiBiKyFee) ? $daiBiKyFee->getValue() : 0,
            ], 200);
        }

        return response()->json([
            'status' => 'fail',
        ], 400);
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function order(Request $request)
    {
        try {
            $data       = $request->all();
            $dataInsert = [];
            parse_str($data['data'], $dataInsert);
            if (Auth::id()) {
                $dataInsert['customer_id'] = Auth::id();
            } else {
                $dataInsert['customer_id'] = 0;
            }
            $dataShipping           = \Cart::getCondition('Shipping');
            $daiBiKi                = \Cart::getCondition('daiBiKi');
            $dataInsert['subtotal'] = \Cart::getSubTotalWithoutConditions();
            $dataInsert['shipping'] = isset($dataShipping) ? $dataShipping->getValue() : 0;
            $dataInsert['daibiky']  = isset($daiBiKi) ? $daiBiKi->getValue() : 0;
            $dataInsert['total']    = \Cart::getTotal();

            $order       = $this->orderRepository->create($dataInsert);
            $cartContent = \Cart::getContent();

            foreach ($cartContent as $key => $value) {
                $orderDetail             = $this->getDataOrderDetail($value);
                $orderDetail['order_id'] = $order->id;
                $this->orderDetailRepository->create($orderDetail);
            }

            $this->activityService->send(new SendNotifyNewOrder($cartContent));

            return response()->json([
                'status'  => 'success',
                'message' => 'Đặt hàng thành công!'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status'  => 'fail',
                'message' => $e
            ], 400);
        }
    }

    /**
     * @param $value
     *
     * @return mixed
     */
    public function getDataOrderDetail($value)
    {
        $dataDetail['product_id']  = $value['id'];
        $dataDetail['name']        = $value['name'];
        $dataDetail['price']       = $value['price'];
        $dataDetail['qty']         = $value['quantity'];
        $dataDetail['total_price'] = $value['quantity'] * $value['price'];

        return $dataDetail;

    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function getFeeShipping(Request $request)
    {
        $data                  = $request->all();
        $shipping              = $this->shippingRepository->findWhere(['pref_id' => $data['id']])->first();
        $price                 = $shipping->price;
        $totalWithoutCondition = \Cart::getSubTotalWithoutConditions();
        if ($totalWithoutCondition >= self::FREE_SHIP_TOTAL) {
            $price = 0;
        }
        $itemCondition3 = new \Darryldecode\Cart\CartCondition([
            'name'       => 'Shipping',
            'type'       => 'shipping',
            'target'     => 'subtotal', // this condition will be applied to cart's subtotal when getSubTotal() is called.
            'value'      => $price,
            'attributes' => [ // attributes field is optional
                              'id'   => $data['id'],
                              'name' => $shipping->pref->name
            ]
        ]);
        \Cart::condition($itemCondition3);
        $dataShipping = \Cart::getCondition('Shipping');
        $cartTotal    = \Cart::getTotal(); // the total with the conditions targeted to "total" applied
        //$cartConditions = \Cart::getCondition('Shipping');
        if ($shipping) {
            return response()->json([
                'status'          => 'success',
                'price'           => $shipping->price,
                'name'            => $shipping->pref->name,
                'total'           => number_format($cartTotal),
                'totalNotFormat'  => $cartTotal,
                'cartNoCondition' => number_format($totalWithoutCondition),
                'shippingPrice'   => isset($dataShipping) ? $dataShipping->getValue() : 0,
            ], 200);
        }

        return response()->json([
            'status' => 'fail',
        ], 400);
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function getDaiBiKiShipping(Request $request)
    {
        $data                  = $request->all();
        $daiBiKiPrice          = self::DAIBIKI_MIN;
        $totalWithoutCondition = \Cart::getSubTotalWithoutConditions();
        if ($totalWithoutCondition > self::TOTAL_DAIBIKI) {
            $daiBiKiPrice = self::DAIBIKI_MAX;
        }
        if ($data['id'] === "bank") {
            \Cart::removeCartCondition("daiBiKi");
        } else {
            $daiBiKiCondition = new \Darryldecode\Cart\CartCondition([
                'name'   => 'daiBiKi',
                'type'   => 'shipping',
                'target' => 'subtotal', // this condition will be applied to cart's subtotal when getSubTotal() is called.
                'value'  => $daiBiKiPrice
            ]);
            \Cart::condition($daiBiKiCondition);
        }

        $cartTotal             = \Cart::getTotal(); // the total with the conditions targeted to "total" applied
        $totalWithoutCondition = \Cart::getSubTotalWithoutConditions();
        $daiBiKyFee            = \Cart::getCondition('daiBiKi');

        return response()->json([
            'status'          => 'success',
            'total'           => $cartTotal,
            'cartNoCondition' => $totalWithoutCondition,
            'daiBiKyFee'      => isset($daiBiKyFee) ? $daiBiKyFee->getValue() : 0
        ], 200);

    }

    public function updateNewShippingByTotal()
    {
        $totalWithoutCondition = \Cart::getSubTotalWithoutConditions();
        $shipping              = \Cart::getCondition('Shipping');
        $daiBiKyFee            = \Cart::getCondition('daiBiKi');
        if (isset($daiBiKyFee)) {
            $daiBiKiPrice = self::DAIBIKI_MIN;
            if ($totalWithoutCondition > self::TOTAL_DAIBIKI) {
                $daiBiKiPrice = self::DAIBIKI_MAX;
            }
            $daiBiKiCondition = new \Darryldecode\Cart\CartCondition([
                'name'   => 'daiBiKi',
                'type'   => 'shipping',
                'target' => 'subtotal', // this condition will be applied to cart's subtotal when getSubTotal() is called.
                'value'  => $daiBiKiPrice
            ]);
            \Cart::condition($daiBiKiCondition);
        }

        if (isset($shipping)) {
            if ($totalWithoutCondition >= self::FREE_SHIP_TOTAL) {
                $itemCondition3 = new \Darryldecode\Cart\CartCondition([
                    'name'       => 'Shipping',
                    'type'       => 'shipping',
                    'target'     => 'subtotal', // this condition will be applied to cart's subtotal when getSubTotal() is called.
                    'value'      => 0,
                    'attributes' => [ // attributes field is optional
                                      'id'   => $shipping->getAttributes()['id'],
                                      'name' => $shipping->getAttributes()['name']
                    ]
                ]);

                \Cart::condition($itemCondition3);
            } else {
                $dataShipping   = $this->shippingRepository->findWhere(['pref_id' => $shipping->getAttributes()['id']])->first();
                $price          = $dataShipping->price;
                $itemCondition3 = new \Darryldecode\Cart\CartCondition([
                    'name'       => 'Shipping',
                    'type'       => 'shipping',
                    'target'     => 'subtotal', // this condition will be applied to cart's subtotal when getSubTotal() is called.
                    'value'      => $price,
                    'attributes' => [ // attributes field is optional
                                      'id'   => $shipping->getAttributes()['id'],
                                      'name' => $shipping->getAttributes()['name']
                    ]
                ]);
                \Cart::condition($itemCondition3);
            }
        }
    }
}
