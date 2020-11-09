<?php

namespace App\Modules\Member\Controllers;

use App\Repositories\AreaRepository;
use App\Repositories\RankRepository;
use App\Repositories\UserPrefectureRepository;
use App\Repositories\UserRepository;
use App\Services\NewsService;
use Illuminate\Support\Facades\Session;

class MemberController extends Controller
{
    protected $userPrefectureRepository;
    protected $userRepository;
    protected $rankRepository;
    protected $areaRepository;
    protected $newsService;

    /**
     * MemberController constructor.
     *
     * @param UserPrefectureRepository $userPrefectureRepository
     * @param UserRepository $userRepository
     * @param RankRepository $rankRepository
     * @param AreaRepository $areaRepository
     * @param NewsService $newsService
     */
    public function __construct(
        UserPrefectureRepository $userPrefectureRepository,
        UserRepository $userRepository,
        RankRepository $rankRepository,
        AreaRepository $areaRepository,
        NewsService $newsService
    ) {
        $this->middleware('auth')->except('logout');
        $this->userPrefectureRepository = $userPrefectureRepository;
        $this->userRepository = $userRepository;
        $this->rankRepository = $rankRepository;
        $this->areaRepository = $areaRepository;
        $this->newsService = $newsService;
    }

    public function show(int $id)
    {
        try {
            $userPrefectures = $this->userPrefectureRepository->totalUserByPrefectures();
            $member = $this->userRepository->find($id);
            if (!$member) {
                return abort(404);
            }

            $idSetting = Session::has('member_offer') ? session::get('member_offer') : [];
            $ranks = $this->rankRepository->get();
            $areas = $this->areaRepository->with('prefectures')->get();
            $selectOption = config('user-profile');
            $news = $this->newsService->getNews();

            return view('member.show', compact(
                'userPrefectures',
                'member',
                'ranks',
                'areas',
                'selectOption',
                'news',
                'idSetting'
            ));
        } catch (\Exception $e) {
            return abort(404);
        }//end try
    }
}
