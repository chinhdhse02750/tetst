<?php

namespace App\Modules\Api\Controllers;

use App\Modules\Admin\Controllers\Controller;
use App\Repositories\ProductRepository;
use App\Repositories\ProductCommentRepository;
use App\Repositories\UserRepository;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use PHPUnit\Exception;
use Prettus\Validator\Exceptions\ValidatorException;
use Darryldecode\Cart\Cart;

class CartController extends Controller
{
    use ResponseTrait;

    protected $userRepository;

    protected $productRepository;

    protected $productCommentRepository;

    const REVIEW_STATUS_COMMENT = 0;
    /**
     * MemberController constructor.
     * @param UserRepository $userRepository
     * @param ProductRepository $productRepository
     */
    public function __construct(
        UserRepository $userRepository,
        ProductRepository $productRepository,
        ProductCommentRepository $productCommentRepository
    ) {
        $this->userRepository = $userRepository;
        $this->productRepository = $productRepository;
        $this->productCommentRepository = $productCommentRepository;
    }


    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function productCart(Request $request)
    {
        $data = $request->all();
        $Product = \App\Entities\Product::find($data['id']);
        \Cart::add($data['id'],  $data['product_name'],  $data['product_discount_price'] !== null
            ? $data['product_discount_price'] : $data['product_price'], $data['quantity'], array())->associate($Product);
        $cartCollection = \Cart::getContent();
        $total = \Cart::getTotal();
        $count = $cartCollection->count();

        return response()->json([
            'status' => 'success',
            'data' => $cartCollection,
            'total' => $total,
            'count' => $count
        ], 200);
    }


    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function deleteProduct(Request $request)
    {
        $data = $request->all();
        if (\Cart::remove($data['id'])){
            $total = \Cart::getTotal();
            return response()->json([
                'status' => 'success',
                'total' => $total,
            ], 200);
        }

        return response()->json([
            'status' => 'fail',
        ], 400);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function updateQuantity(Request $request)
    {
        $data = $request->all();
        if (\Cart::update($data['id'], array(
            'quantity' => array(
                'relative' => false,
                'value' => $data['quantity']
            ))))
        {
            $total = \Cart::getTotal();
            $product  = \Cart::get($data['id']);
            return response()->json([
                'status' => 'success',
                'product' => $product,
                'total' =>  $total
            ], 200);
        }

        return response()->json([
            'status' => 'fail',
        ], 400);
    }
}
