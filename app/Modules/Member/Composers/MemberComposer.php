<?php

namespace App\Modules\Member\Composers;

use App\Helpers\Constants;
use App\Repositories\BalanceRepository;
use App\Repositories\BannerRepository;
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
     * HomeController constructor.
     * @param UserPrefectureRepository $userPrefectureRepository
     * @param NewsService $newsService
     * @param BalanceRepository $balanceRepository
     * @param BannerRepository $bannerRepository
     * @param UserRepository $userRepository
     */
    public function __construct(
        UserPrefectureRepository $userPrefectureRepository,
        NewsService $newsService,
        BalanceRepository $balanceRepository,
        BannerRepository $bannerRepository,
        UserRepository $userRepository
    ) {
        $this->userPrefectureRepository = $userPrefectureRepository;
        $this->newsService = $newsService;
        $this->balanceRepository = $balanceRepository;
        $this->bannerRepository = $bannerRepository;
        $this->userRepository = $userRepository ;
    }

    /**
     * @param View $view
     *
     * @return bool|mixed
     */
    public function compose(View $view)
    {
        if (Auth::check()) {
            $userPrefectures = $this->userPrefectureRepository->totalUserByPrefectures();
            $news = $this->newsService->getNews();
            $balances = $this->balanceRepository->findWhere(['user_id' => Auth::id()]);
            $banners = $this->bannerRepository->getBannerDisplay();
            if (Auth::user()->type === null) {
                $newMembers = $this->userRepository->get();
            } else {
                $newMembers = $this->userRepository
                    ->getListUserActiveByType(Auth::user()->type, Constants::MEMBER_DISPLAY_LIMIT);
            }

            $countSetting = 0;
            if (Session::has('member_offer')) {
                $id = Session::get('member_offer');
                $countSetting = count($id);
            }

            return $view->with(compact('userPrefectures', 'news', 'balances', 'banners', 'countSetting', 'newMembers'));
        }

        return '';
    }
}
