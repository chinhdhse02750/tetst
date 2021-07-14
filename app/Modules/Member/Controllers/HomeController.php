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
        UnitRepository $unitRepository
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
    }

    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request)
    {
        $userPrefectures = $this->userPrefectureRepository->totalUserByPrefectures();
        $filterData = $this->getFilterData($request);
        $members = $this->userProfileRepository->filter($filterData, Auth::user()->type);
        if ($request->get('search') != null) {
            $members = $this->userProfileRepository
                ->filter($filterData, Auth::user()->type, $request->get('search'));
        }
        $requests = $request->query();
        $ranks = $this->rankRepository->get();
        $areas = $this->areaRepository->with('prefectures')->get();
        $selectOption = config('user-profile');
        $news = $this->newsService->getNews();

        return view('top', compact('userPrefectures', 'members', 'ranks', 'areas', 'selectOption', 'requests', 'news'));
    }

//    public function index(Request $request)
//    {
//        \Cart::clear();
//        $products = $this->productRepository->orderBy('created_at', $direction = 'DESC')
//            ->with('units')
//            ->with('category')->get();
//
//        $cart = \Cart::getContent();
//        $total = \Cart::getTotal();
//        $count = $cart->count();
//
//        $saleProduct = $this->productRepository->getListSaleProduct();
//        $featuredProduct = $this->productRepository->getListFeatured();
//        $dealOfWeekProduct = $this->productRepository->getListDealOfWeek();
//        $bestSeller = $this->productRepository->getListBestSeller(8);
//
//        return view('top1', compact(
//            'products',
//            'saleProduct',
//            'featuredProduct',
//            'dealOfWeekProduct',
//            'bestSeller',
//            'cart',
//            'total',
//            'count'
//        ));
//    }

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


    protected function getFilterData(Request $request)
    {
        $filter = [];
        // filter member_info
        switch (Arr::get($request, 'member_info', 1)) {
            case Constants::FILTER_CHECK_NEW_MEMBER:
                $filter['label_type'] = Constants::LABEL_NEW_MEMBER_VALUE;
                break;
            case Constants::FILTER_CHECK_PICK_UP:
                $filter['pick_up'] = Constants::FILTER_CHECKED;
                break;
            case Constants::FILTER_CHECK_HAS_COMMENT:
                $filter['label_type'] = Constants::LABEL_NEW_COMMENT_VALUE;
                break;
        }

        //filter prefecture
        if (isset($request['prefecture_ids']) && empty($request['checkAllArea'])) {
            $filter['prefecture_ids'] = $request['prefecture_ids'];
        }

        //filter underwear_type
        if ($request['check_cup']) {
            $cups = array();
            $check_cup = array_values($request['check_cup']);
            foreach ($check_cup as $value) {
                if ($value == Constants::FILTER_CUP_A_C) {
                    $filter['underwear_types'] = array_push(
                        $cups,
                        Constants::VALUE_A_CUP,
                        Constants::VALUE_B_CUP,
                        Constants::VALUE_C_CUP
                    );
                }
                if ($value == Constants::FILTER_CUP_D_F) {
                    $filter['underwear_types'] = array_push(
                        $cups,
                        Constants::VALUE_D_CUP,
                        Constants::VALUE_E_CUP,
                        Constants::VALUE_F_CUP
                    );
                }
                if ($value == Constants::FILTER_CUP_G) {
                    $filter['underwear_types'] = array_push(
                        $cups,
                        Constants::VALUE_G_CUP
                    );
                }
            }//end foreach
            $filter['underwear_types'] = $cups;
        }//end if

        //filter ages
        if ($request['check_age'] && empty($request['checkAllAge'])) {
            $filter['ages'] = array_values($request['check_age']);
        }
        //filter height
        if ($request['check_height'] && empty($request['checkAllHeight'])) {
            $filter['heights'] = array_values($request['check_height']);
        }

        //filter dating type
        if ($request['check_dating_type'] && empty($request['checkAllDatingType'])) {
            $filter['dating_types'] = array_values($request['check_dating_type']);
        }

        //filter rank id
        if (isset($request['check_rank'])) {
            $filter['rank_ids'] = $request['check_rank'];
        }

        //filter smoking
        if (isset($request['smoking'])) {
            $filter['smoking'] = $request['smoking'];
        }

        //filter alcohol
        if (isset($request['alcohol'])) {
            $filter['alcohol'] = $request['alcohol'];
        }

        //filter male ages
        if ($request['check_male_age'] && empty($request['check_all_age'])) {
            $filter['male_ages'] = array_values($request['check_male_age']);
        }

        //filter male smoking
        if ($request['check_male_smoking'] && empty($request['checkAllMaleSmoking'])) {
            $filter['male_smoking'] = array_values($request['check_male_smoking']);
        }
        //filter favorite dating type
        if ($request['favorite_dating_type'] && empty($request['checkAllDatingType'])) {
            $filter['favorite_dating_types'] = array_values($request['favorite_dating_type']);
        }

        //sort order
        if ($request['order_by']) {
            $filter['sort'] = $request['order_by'];
        } else {
            $filter['sort'] = Constants::FILTER_DEFAULT_SORT_ORDER;
        }

        return $filter;
    }
}
