<?php

namespace App\Modules\Member\Controllers;

use App\Repositories\AreaRepository;
use App\Repositories\RankRepository;
use App\Repositories\UserFavoriteRepository;
use App\Repositories\UserProfileRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class FavoriteController extends HomeController
{

    protected $userProfileRepository;
    protected $userFavoriteRepository;

    /**
     * @var UserFavoriteRepository
     */

    /**
     * HomeController constructor.
     * @param UserProfileRepository $userProfileRepository
     * @param UserFavoriteRepository $userFavoriteRepository
     * @param RankRepository $rankRepository
     * @param AreaRepository $areaRepository
     */
    public function __construct(
        UserProfileRepository $userProfileRepository,
        UserFavoriteRepository $userFavoriteRepository,
        RankRepository $rankRepository,
        AreaRepository $areaRepository
    ) {
        $this->middleware('auth')->except('logout');
        $this->userProfileRepository = $userProfileRepository;
        $this->userFavoriteRepository = $userFavoriteRepository;
        $this->rankRepository = $rankRepository;
        $this->areaRepository = $areaRepository;
    }

    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request)
    {
        $selectOption = config('user-profile');
        $ranks = $this->rankRepository->getWithTrashed();
        $areas = $this->areaRepository->with('prefectures')->get();

        $filterData = $this->getFilterData($request);
        $members= $this->userProfileRepository
            ->filterFavorite($filterData, Auth::user()->type);

        return view('favorites.index', compact('members', 'selectOption', 'ranks', 'areas'));
    }
}
