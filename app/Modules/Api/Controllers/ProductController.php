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

class ProductController extends Controller
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
     * Update user status.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     * @throws ValidatorException
     */
    public function updateStatus(Request $request, int $id)
    {
        try {
            $data['active'] = $request->get('active');
            $this->userRepository->update($data, $id);

            return $this->success($data, trans('alerts.general.success.updated'));
        } catch (Exception $e) {
            return $this->error('[ERROR_STORE_FAVORITE]: ' . $e->getMessage());
        }//end try
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
    public function productReview(Request  $request)
    {
        $data = $request->all();
        $productId = $data['id'];
        $products = $this->productRepository->find($productId);

        return response()->json([
            'status' => 'success',
            'products' => $products,
        ], 200);
    }


    /**
     * @param Request $request
     * @throws ValidatorException
     */
    public function productComment(Request $request)
    {
        $data = $request->all();
        $data['status'] = self::REVIEW_STATUS_COMMENT;
        $comment = $this->productCommentRepository->create($data);

        return response()->json([
            'status' => 'success',
            'comment' => $comment,
        ], 200);
    }
}
