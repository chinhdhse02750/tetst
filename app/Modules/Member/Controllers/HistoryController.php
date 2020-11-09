<?php

namespace App\Modules\Member\Controllers;

use App\Repositories\OfferRepository;
use App\Repositories\UserProfileRepository;
use App\Repositories\UserRepository;
use App\Traits\ResponseTrait;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class HistoryController extends Controller
{
    /**
     * @var OfferRepository
     */
    protected $offerRepository;


    /**
     * HistoryController constructor.
     * @param OfferRepository $offerRepository
     */
    public function __construct(
        OfferRepository $offerRepository
    ) {
        $this->middleware('auth')->except('logout');
        $this->offerRepository = $offerRepository;
    }

    /**
     * @return Factory|View|void
     */
    public function index()
    {
        try {
            $offers = $this->offerRepository->findByField('user_id', Auth::id())->reverse();

            return view('history.offer', compact('offers'));
        } catch (\Exception $e) {
            return abort(404);
        }
    }

    /**
     * @param string $id
     * @return Factory|View|void
     */
    public function detail(string $id)
    {
        try {
            $offer = $this->offerRepository->findByField('public_id', $id)->first();
            $settingMember = config('setting-member');

            return view('history.detail', compact('offer', 'settingMember'));
        } catch (\Exception $e) {
            return abort(404);
        }
    }
}
