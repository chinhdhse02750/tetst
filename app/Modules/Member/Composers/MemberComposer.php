<?php

namespace App\Modules\Member\Composers;

use App\Helpers\Constants;
use App\Repositories\BalanceRepository;
use App\Repositories\BannerRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\UserPrefectureRepository;
use App\Repositories\UserRepository;
use App\Services\NewsService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

/**
 * Class MemberComposer.
 */
class MemberComposer
{
    /**
     * @var UserPrefectureRepository
     */
    protected $userPrefectureRepository;

    /**
     * @var BalanceRepository
     */
    protected $balanceRepository;

    /**
     * @var NewsService
     */
    protected $newsService;

    /**
     * @var BannerRepository
     */
    protected $bannerRepository;

    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * @var CategoryRepository
     */
    protected $categoryRepository;

    /**
     * HomeController constructor.
     * @param UserPrefectureRepository $userPrefectureRepository
     * @param NewsService $newsService
     * @param BalanceRepository $balanceRepository
     * @param BannerRepository $bannerRepository
     * @param UserRepository $userRepository
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(
        UserPrefectureRepository $userPrefectureRepository,
        NewsService $newsService,
        BalanceRepository $balanceRepository,
        BannerRepository $bannerRepository,
        UserRepository $userRepository,
        CategoryRepository $categoryRepository
    ) {
        $this->userPrefectureRepository = $userPrefectureRepository;
        $this->newsService = $newsService;
        $this->balanceRepository = $balanceRepository;
        $this->bannerRepository = $bannerRepository;
        $this->userRepository = $userRepository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param View $view
     *
     * @return bool|mixed
     */
    public function compose(View $view)
    {
        $cart = \Cart::getContent();
        $total = \Cart::getTotal();
        $count =  $cart->count();
        $categories = $this->categoryRepository->findByField('parent', '1');

        return $view->with(compact(
            'total',
            'count',
            'categories'
        ));
    }
}
