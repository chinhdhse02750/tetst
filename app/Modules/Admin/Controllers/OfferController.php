<?php

namespace App\Modules\Admin\Controllers;

use App\Helpers\Common;
use App\Helpers\Constants;
use App\Repositories\RankRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Repositories\OfferRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use PHPUnit\Exception;
use Prettus\Validator\Exceptions\ValidatorException;

class OfferController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * @var OfferRepository
     */
    protected $offerRepository;

    /**
     * @var RankRepository
     */
    protected $rankRepository;

    /**
     * AdjustmentController constructor.
     * @param UserRepository $userRepository
     * @param OfferRepository $offerRepository
     * @param RankRepository $rankRepository
     */
    public function __construct(
        UserRepository $userRepository,
        OfferRepository $offerRepository,
        RankRepository $rankRepository
    ) {
        $this->userRepository = $userRepository;
        $this->offerRepository = $offerRepository;
        $this->rankRepository = $rankRepository;
    }

    /**
     *
     * @return Response
     */
    public function index()
    {
        $ranks = $this->rankRepository->getWithTrashed();
        $settingMember = config('setting-member');
        $offers = $this->offerRepository
            ->with(['user'])
            ->orderBy(Constants::TIME_ORDER_BY, Constants::FILTER_DEFAULT_SORT_ORDER)
            ->paginate(Constants::DEFAULT_PER_PAGE);

        return response()->view('offer.index', compact('offers', 'ranks', 'settingMember'));
    }

    /**
     * @param int $id
     * @return Application|Factory|View
     */
    public function show(int $id)
    {
        $offer = $this->offerRepository->with(['userOffers'])->find($id);
        $settingMember = config('setting-member');
        $requestSetting = $settingMember['request_setting'];
        $userOfferIds = array_column($offer->userOffers->toArray(), 'user_id');
        $userOffers = $this->userRepository->findWhereIn('id', $userOfferIds);

        return view('offer.detail', [
            'offer' => $offer,
            'requestSetting' => $requestSetting,
            'userOffers' => $userOffers,
        ]);
    }

    /**
     * @param int $id
     * @return Response
     */
    public function edit(int $id)
    {
        $offer = $this->offerRepository->with(['userOffers'])->find($id);
        $settingMember = config('setting-member');
        $requestSetting = $settingMember['request_setting'];
        $userOfferIds = array_column($offer->userOffers->toArray(), 'user_id');
        $userOffers = $this->userRepository->findWhereIn('id', $userOfferIds);

        return response()->view(
            'offer.edit',
            compact('offer', 'requestSetting', 'userOffers', 'settingMember', 'userOfferIds')
        );
    }

    /**
     * @param Request $request
     * @param int $id
     * @return $this|RedirectResponse
     * @throws ValidatorException
     */
    public function update(Request $request, int $id)
    {
        try {
            $status = $request->except('_token, _method');
            $this->offerRepository->update($status, $id);

            Session::flash('success_msg', trans('alerts.general.success.updated'));

            return redirect()->route('offers.index');
        } catch (Exception $e) {
            Log::error('[ERROR_OFFERS_UPDATE]: ' . $e->getMessage());

            return redirect()
                ->route('offers.index')
                ->withErrors($e->getMessage());
        }//end try
    }

    /**
     * @param Request $request
     * @return $this|string
     * @throws ValidatorException
     */
    public function linkPaypal(Request $request)
    {
        try {
            $id = $request['id'];
            $public_id = $request['public_id'];
            $token = \Str::random(30);
            $tokenExpired = Common::addTimeFromNow(Constants::TIME_EXPIRED);
            $url = urldecode(url('/offers/' . $public_id . '/payments/' . $token));
            $this->offerRepository->update([
                'payment_link' => $url,
                'payment_link_token' => $token,
                'payment_link_expired' => $tokenExpired], $id);

            return $url;
        } catch (Exception $e) {
            Log::error('[ERROR_OFFERS_GETLINK_PAYMENT]: ' . $e->getMessage());

            return redirect()
                ->route('offers.index')
                ->withErrors($e->getMessage());
        }//end try
    }

    /**
     * Search member.
     *
     * @param Request $request
     * @return array|string
     * @throws \Throwable
     */
    public function search(Request $request)
    {
        $dataFilter = $request->only('id', 'email', 'dateFrom', 'dateTo', 'ranks');
        $offers = $this->offerRepository->search($dataFilter);
        $settingMember = config('setting-member');

        return view("offer.result_search", compact('offers', 'settingMember'))->render();
    }
}
