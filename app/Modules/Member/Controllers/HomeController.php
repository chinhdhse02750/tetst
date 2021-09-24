<?php

namespace App\Modules\Member\Controllers;

use App\Helpers\Constants;
use App\Repositories\AreaRepository;
use App\Repositories\BannerRepository;
use App\Repositories\ListBannerRepository;
use App\Repositories\RankRepository;
use App\Repositories\UserPrefectureRepository;
use App\Repositories\UserProfileRepository;
use App\Repositories\UserRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use App\Repositories\UnitRepository;
use App\Services\NewsService;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class HomeController extends Controller
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
    protected $listBannerRepository;

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
     * @param ListBannerRepository $listBannerRepository
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
        ListBannerRepository $listBannerRepository

    )
    {
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
        $this->listBannerRepository = $listBannerRepository;
    }

    /**
     * @param Request $request
     * @return View
     */
//    public function index(Request $request)
//    {
//        $userPrefectures = $this->userPrefectureRepository->totalUserByPrefectures();
//        $filterData = $this->getFilterData($request);
//        $members = $this->userProfileRepository->filter($filterData, Auth::user()->type);
//        if ($request->get('search') != null) {
//            $members = $this->userProfileRepository
//                ->filter($filterData, Auth::user()->type, $request->get('search'));
//        }
//        $requests = $request->query();
//        $ranks = $this->rankRepository->get();
//        $areas = $this->areaRepository->with('prefectures')->get();
//        $selectOption = config('user-profile');
//        $news = $this->newsService->getNews();
//
//        return view('top', compact('userPrefectures', 'members', 'ranks', 'areas', 'selectOption', 'requests', 'news'));
//    }

    public function index(Request $request)
    {
        $cart = \Cart::getContent();
        $total = \Cart::getTotal();
        $count = $cart->count();

        $products = $this->productRepository->getListProduct();
        $saleProduct = $this->productRepository->getListSaleProduct();
        $featuredProduct = $this->productRepository->getListFeatured();
        $dealOfWeekProduct = $this->productRepository->getListDealOfWeek();
        $bestSeller = $this->productRepository->getListBestSeller(8);
        $banner = $this->listBannerRepository->findWhere(['active' => '1']);
        $news = $this->newsService->getNews();

        return view('top1', compact(
            'products',
            'saleProduct',
            'featuredProduct',
            'dealOfWeekProduct',
            'bestSeller',
            'cart',
            'total',
            'count',
            'news',
            'banner'
        ));
    }

    public function search(Request $request)
    {
        $data = $request->all();
        $allCategories = $this->categoryRepository->findByField('parent', '1');
        $maxPrice = $this->productRepository->all()->max('price');
        $minPrice = $this->productRepository->all()->min('price');
        $filter = $this->filter($data);
        $keyWord = $request->get('search');

        if ($request->get('search') === null) {
            $keyWord = '';
        }

        $products = $this->productRepository->filter($keyWord, $filter);

        return view('shop.search', compact(
            'products',
            'data',
            'maxPrice',
            'minPrice',
            'allCategories'
        ));
    }

    public function view(Request $request, $alias)
    {
        $categories = $this->categoryRepository->findByField('parent', '0')->pluck('alias')->toArray();
        $checkUrl = in_array($alias, $categories);
        if ($checkUrl) {
            $data = $request->all();
            $sort = "created_at";
            $condition = "DESC";
            $page = Constants::MEMBER_LIST_PER_PAGE;
            if (isset($data['order_by']) && $data != null) {
                $page = isset($data['per_page']) ? $data['per_page'] : Constants::MEMBER_LIST_PER_PAGE;
                if (strpos($data['order_by'], 'price') !== false) {
                    $condition = 'DESC';
                    $sort = "discount_price";
                    if ($data['order_by'] === 'price') {
                        $condition = 'ASC';
                    }
                } elseif (strpos($data['order_by'], 'name') !== false) {
                    $condition = 'DESC';
                    $sort = 'name';
                    if ($data['order_by'] === 'name') {
                        $condition = 'ASC';
                    }
                }
            }

            $products = $this->productRepository->getListOrder($sort, $condition, $page);

            return view('shop.shop', compact(
                'products',
                'data'
            ));
        }//end if

        return abort(404);
    }

    public function register(Request $request)
    {
        return view('register');
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
        if (isset($data['min-price']) && isset($data['max-price']) && $data != null) {
            $filter['min'] = $data['min-price'];
            $filter['max'] = $data['max-price'];
        }

        return $filter;
    }
}
