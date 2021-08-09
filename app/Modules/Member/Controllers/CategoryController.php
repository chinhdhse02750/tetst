<?php

namespace App\Modules\Member\Controllers;

use App\Helpers\Constants;
use App\Repositories\AreaRepository;
use App\Repositories\RankRepository;
use App\Repositories\UserPrefectureRepository;
use App\Repositories\UserProfileRepository;
use App\Repositories\UserRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use App\Repositories\UnitRepository;
use App\Repositories\TagRepository;
use App\Services\NewsService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CategoryController extends Controller
{

    protected $userPrefectureRepository;
    protected $userRepository;
    protected $userProfileRepository;
    protected $rankRepository;
    protected $areaRepository;
    protected $newsService;
    protected $categoryRepository;
    protected $productRepository;
    protected $unitRepository;
    protected $tagRepository;

    /**
     * HomeController constructor.
     * @param UserPrefectureRepository $userPrefectureRepository
     * @param UserRepository $userRepository
     * @param UserProfileRepository $userProfileRepository
     * @param RankRepository $rankRepository
     * @param AreaRepository $areaRepository
     * @param NewsService $newsService
     * @param CategoryRepository $categoryRepository
     * @param ProductRepository $productRepository
     * @param UnitRepository $unitRepository
     */
    public function __construct(
        UserPrefectureRepository $userPrefectureRepository,
        UserRepository $userRepository,
        UserProfileRepository $userProfileRepository,
        RankRepository $rankRepository,
        AreaRepository $areaRepository,
        NewsService $newsService,
        CategoryRepository $categoryRepository,
        ProductRepository $productRepository,
        UnitRepository $unitRepository,
        TagRepository $tagRepository

    ) {
//        $this->middleware('auth')->except('logout', 'test');
        $this->userPrefectureRepository = $userPrefectureRepository;
        $this->userRepository = $userRepository;
        $this->userProfileRepository = $userProfileRepository;
        $this->rankRepository = $rankRepository;
        $this->areaRepository = $areaRepository;
        $this->newsService = $newsService;
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
        $this->unitRepository = $unitRepository;
        $this->tagRepository = $tagRepository;
    }

    function array_values_recursive($arr)
    {
        foreach ($arr as $key => $value)
        {
            if (is_array($value))
            {
                $arr[$key] = $this->array_values_recursive($value);
            }
        }

        if (isset($arr['children']))
        {
            $arr['children'] = array_values($arr['children']);
        }

        return $arr;
    }

    public function index(Request $request, $alias)
    {
        $allCategories = $this->categoryRepository->findByField('parent', '1');
        $test = $this->array_values_recursive($allCategories->toArray());
        $categories = $this->categoryRepository->all()->pluck('alias')->toArray();
        $checkUrl = in_array($alias, $categories);
        $settingAlias = config('setting-alias');
        $requestSetting = $settingAlias['map_alias'];
        if ($checkUrl) {
            $cateData = $this->categoryRepository->findByField('alias', $alias)->first();
            $childId = $cateData->getAllChildren()->pluck('id')->toArray();
            $id = [$cateData->id];
            $allId = array_merge($id, $childId);
            $data = $request->all();
            $filter = $this->filter($data);
            $products = $this->productRepository->getListProductByCategory($filter, $allId);

            if ($alias === "tat-ca-san-pham") {
                $products = $this->productRepository->getListOrder($filter);
            }
            $maxPrice = $this->productRepository->all()->max('price');
            $minPrice =  $this->productRepository->all()->min('price');

            return view('shop.product', compact(
                'products',
                'data',
                'alias',
                'requestSetting',
                'cateData',
                'maxPrice',
                'minPrice',
                'allCategories'
            ));
        }//end if

        return abort(404);
    }

    public function productPromotion(Request $request)
    {
        $data = $request->all();
        $allCategories = $this->categoryRepository->findByField('parent', '1');
        $maxPrice = $this->productRepository->all()->max('price');
        $minPrice = $this->productRepository->all()->min('price');
        $filter = $this->filter($data);

        $products = $this->productRepository->filter($filter);

        return view('shop.search', compact(
            'products',
            'data',
            'maxPrice',
            'minPrice',
            'allCategories'
        ));
    }



    /**
     * @param Request $request
     * @return Application|Factory|JsonResponse|View
     */
    public function productReview(Request  $request)
    {
        $data = $request->all();
        $productId = $data['id'];
        $products = $this->productRepository->find($productId);
        $images = explode(',', $products->image);

        return view("shop.quick_view", ['products' => $products, 'images' => $images]);
    }

    /**
     * @param Request $request
     * @param $alias
     */
    public function productSpecial(Request $request, $alias)
    {
        $data = $request->all();
        $products = $this->productRepository->getListFeatured();

        return view('shop.product', compact(
            'products',
            'data'
        ));
    }



    public function testCart(Request $request)
    {
        $data = $request->all();

        \Cart::add(array(
            'id' => $data['id'],
            'name' => $data['product_name'],
            'price' => $data['product_discount_price'] !== null
                ? $data['product_discount_price'] : $data['product_price'],
            'quantity' => 1,
            'attributes' => array()));
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
     * @param $alias
     * @param $sub_alias
     * @return Factory|View
     */
    public function detail(Request $request, $alias, $sub_alias)
    {
        $data = $request->all();
        $products = $this->productRepository->getListFeatured();
        $cateData = $this->categoryRepository->findByField('alias', $alias)->first();
        $subData = $this->productRepository->findByField('alias', $sub_alias)->first();
        if(!$subData){
            return abort(404);
        }

        $tags = $subData->tag()->get();
        $images = explode(',', $subData->image);
        return view('shop.detail', compact(
            'products',
            'data',
            'cateData',
            'subData',
            'images',
            'tags'
        ));
    }

    /**
     * @param $data
     */
    public function filter($data)
    {
        $filter['sort'] = "created_at";
        $filter['condition'] = "DESC";
        $filter['min'] = 0;
        $filter['max'] = 0;
        $filter['page'] = Constants::MEMBER_LIST_PER_PAGE;
        if (isset($data['order_by']) && $data != null) {
            $filter['page'] = isset($data['per_page']) ? $data['per_page'] : Constants::MEMBER_LIST_PER_PAGE;
            if (strpos($data['order_by'], 'price') !== false) {
                $filter['condition'] = "DESC";
                $filter['sort'] = "discount_price";
                if ($data['order_by'] === 'price') {
                    $filter['condition'] = "ASC";
                }
            } elseif (strpos($data['order_by'], 'name') !== false) {
                $filter['condition'] = "DESC";
                $filter['sort'] = "name";
                if ($data['order_by'] === 'name') {
                    $filter['condition'] = "ASC";
                }
            }
        }
        if (isset($data['min-price']) &&  isset($data['max-price']) && $data != null) {
            $filter['min'] = $data['min-price'];
            $filter['max'] = $data['max-price'];
        }

        return $filter;
    }
}
