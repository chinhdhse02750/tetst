<?php

namespace App\Modules\Member\Controllers;

use App\Helpers\Constants;
use App\Repositories\BankRepository;
use App\Repositories\OfferRepository;
use App\Repositories\UserOfferRepository;
use App\Repositories\UserProfileRepository;
use App\Repositories\UserRepository;
use App\Traits\ResponseTrait;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\View\View;
use PHPUnit\Exception;
use Illuminate\Support\Facades\Mail;

class OfferController extends Controller
{
    use ResponseTrait;

    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * @var UserProfileRepository
     */
    protected $userProfileRepository;

    /**
     * @var OfferRepository
     */
    protected $offerRepository;

    /**
     * @var UserOfferRepository
     */
    protected $userOfferRepository;

    /**
     * @var BankRepository
     */
    protected $bankRepository;

    /**
     * OfferController constructor.
     * @param UserRepository $userRepository
     * @param UserProfileRepository $userProfileRepository
     * @param OfferRepository $offerRepository
     * @param UserOfferRepository $userOfferRepository
     * @param BankRepository $bankRepository
     */
    public function __construct(
        UserRepository $userRepository,
        UserProfileRepository $userProfileRepository,
        OfferRepository $offerRepository,
        UserOfferRepository $userOfferRepository,
        BankRepository $bankRepository
    ) {
        $this->middleware('auth')->except('logout');
        $this->userRepository = $userRepository;
        $this->userProfileRepository = $userProfileRepository;
        $this->offerRepository = $offerRepository;
        $this->userOfferRepository = $userOfferRepository;
        $this->bankRepository = $bankRepository;
    }

    /**
     * @return Factory|RedirectResponse|View|void
     */
    public function index()
    {
        try {
            if (!Session::has('member_offer')) {
                return redirect()->route('home');
            }
            $id = Session::has('member_offer') ? Session::get('member_offer') : null;
            $dataRequestOffer = Session::has('dataRequestOffer') ? Session::get('dataRequestOffer') : null;
            $members = $this->userRepository->findWhereIn('id', $id);
            $members = $members->sortBy(function ($members) use ($id) {
                return array_search($members->id, $id);
            })->values();

            return view('offers.index', compact('members', 'dataRequestOffer'));
        } catch (Exception $e) {
            return abort(404);
        }//end try
    }

    /**
     * @return Factory|RedirectResponse|View|void
     */
    public function detail()
    {
        try {
            if (!Session::has('member_offer') || !Session::has('data_setting')) {
                return redirect()->route('home');
            }
            $dataRequestOffer = Session::has('dataRequestOffer') ? Session::get('dataRequestOffer') : null;
            $dataOffer = Session::has('data_setting') ? Session::get('data_setting') : null;
            Session::put('member_offer', $dataOffer['member']);
            $totalOffer = $this->getTotalOfferAmount();
            $bank = $this->bankRepository->first();
            $settingMember = config('setting-member');

            return view('offers.setting_detail', compact('settingMember', 'dataRequestOffer', 'totalOffer', 'bank'));
        } catch (Exception $e) {
            return abort(404);
        }//end try
    }

    /**
     * @param Request $request
     * @return RedirectResponse|void
     */
    public function settingList(Request $request)
    {
        try {
            $dataOffer = $request->except('_token');
            if (!Session::has('member_offer')) {
                return redirect()->route('home');
            }
            Session::put('data_setting', $dataOffer);

            return redirect()->route('offer.detail');
        } catch (Exception $e) {
            return abort(404);
        }//end try
    }

    /**
     * @param Request $request
     * @return RedirectResponse|void
     */
    public function settingDetail(Request $request)
    {
        try {
            $dataOffer = $request->except('_token');
            $dataOffer['request_option'] = isset($request->request_option)
                ? implode(", ", $request->request_option) : null;
            if (!Session::has('member_offer') || !Session::has('data_setting')) {
                return abort(404);
            }
            $data_setting = Session::get('data_setting');
            $dataRequestOffer = array_merge($data_setting, $dataOffer);
            Session::put('dataRequestOffer', $dataRequestOffer);

            return redirect()->route('offer.confirm');
        } catch (Exception $e) {
            return abort(404);
        }//end try
    }

    /**
     * @return Factory|RedirectResponse|View|void
     */
    public function confirm()
    {
        try {
            if (!Session::has('member_offer') || !Session::has('dataRequestOffer')) {
                return redirect()->route('home');
            }
            $settingMember = config('setting-member');
            $dataRequestOffer = session::get('dataRequestOffer');
            $id = Session::has('member_offer') ? Session::get('member_offer') : null;
            $totalOffer = $this->getTotalOfferAmount();
            $members = $this->userRepository->findWhereIn('id', $id);
            $members = $members->sortBy(function ($members) use ($id) {
                return array_search($members->id, $id);
            })->values();

            return view(
                'offers.setting_confirm',
                compact('members', 'settingMember', 'dataRequestOffer', 'totalOffer')
            );
        } catch (Exception $e) {
            return abort(404);
        }//end try
    }

    /**
     * @return Factory|RedirectResponse|View
     */
    public function success()
    {
        if (!Session::has('offer_success')) {
            return redirect()->route('home');
        }

        return view('offers.success');
    }

    /**
     * @return RedirectResponse|void
     */
    public function settingConfirm()
    {
        DB::beginTransaction();
        try {
            if (!Session::has('member_offer') || !Session::has('dataRequestOffer')) {
                return redirect()->route('home');
            }
            $dataRequestOffer = session::get('dataRequestOffer');
            $dataOffer = $this->getDataOffer($dataRequestOffer);
            $offer = $this->offerRepository->create($dataOffer);

            $amountOffer = $this->getTotalOfferAmount();
            if ((int)$dataRequestOffer['payment_method'] === Constants::REQUEST) {
                $offer->balance()->create([
                    'user_id' => $offer->user_id,
                    'amount' => $amountOffer,
                    'body' => $offer]);
            }
            $offerId = $offer->id;
            $dataUserOffer = $this->getDataUserOffer($dataRequestOffer, $offerId);
            $this->userOfferRepository->createManyOffer($dataUserOffer);
            DB::commit();
            $this->sendEMail($dataOffer, $offerId);
            Session::put('offer_success', true);
            Session::forget(['member_offer', 'dataRequestOffer', 'data_setting']);

            return redirect()->route('offer.success');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('[SETTING_OFFER]: ' . $e->getMessage());

            return abort(404);
        }//end try
    }

    /**
     * @param array $data
     * @return array
     * @throws \Exception
     */
    public function getDataOffer(array $data)
    {
        return [
            'user_id' => Auth::id(),
            'public_id' => (string)Str::random(8),
            'candidate_setting_option_1' => $data['candidate_setting_option_1'],
            'candidate_setting_option_2' => $data['candidate_setting_option_2'],
            'desired_option_1' => $data['desired_option_1'] ? Carbon::parse($data['desired_option_1']) : null,
            'desired_option_2' => $data['desired_option_2'] ? Carbon::parse($data['desired_option_2']) : null,
            'desired_option_3' => $data['desired_option_3'] ? Carbon::parse($data['desired_option_3']) : null,
            'desired_option_4' => $data['desired_option_4'] ? Carbon::parse($data['desired_option_4']) : null,
            'desired_option_5' => $data['desired_option_5'] ? Carbon::parse($data['desired_option_5']) : null,
            'desired_content' => $data['desired_content'],
            'request_option' => $data['request_option'],
            'request_other' => $data['request_other'],
            'request_admin' => $data['request_admin'],
            'payment_method' => $data['payment_method'],
            'status' => (int)$data['payment_method'] === Constants::POINT ? Constants::APPROVE : Constants::REQUEST,
        ];
    }

    /**
     * @param array $data
     * @param int $offerId
     * @return array
     */
    public function getDataUserOffer(array $data, int $offerId)
    {
        $now = Carbon::now();
        $dataUserOffer = [];
        if ($data['member']) {
            foreach ($data['member'] as $key => $value) {
                $insert['offer_id'] = $offerId;
                $insert['user_id'] = $value;
                $insert['created_at'] = $now;
                $insert['updated_at'] = $now;
                array_push($dataUserOffer, $insert);
            }
        }

        return $dataUserOffer;
    }

    /**
     * @return int
     */
    public function getTotalOfferAmount()
    {
        $id = Session::has('member_offer') ? Session::get('member_offer') : null;
        $members = $this->userRepository->findWhereIn('id', $id);
        $amount = 0;
        foreach ($members as $key => $value) {
            $amount += (int)$value->userProfile->rank_amount;
        }

        return $amount;
    }

    /**
     * @param string $id
     * @param string $token
     * @return RedirectResponse|void
     * @throws \Exception
     */
    public function redirect(string $id, string $token)
    {
        $userId = Auth::id();
        $offer = $this->offerRepository->findWhere([
            'public_id' => $id,
            'payment_link_token' => $token,
        ])->first();

        if (!$offer || !Carbon::parse($offer->payment_link_expired)->gt(Carbon::now()) || $userId !== $offer->user_id) {
            return abort(404);
        }
        $ids = array_column($offer->userOffers->toArray(), 'user_id');
        Session::put('ids', $ids);
        Session::put('public_id', $id);

        return redirect()->route('paypal.ec-checkout');
    }


    public function sendEMail($dataOffer, $offerId)
    {
        $settingMember = config('setting-member');
        $members = $this->userRepository->find($dataOffer['user_id']);

        Mail::send(
            'offers.includes.email',
            array('user' => $members, 'idOffer' => $offerId,'now' => now(),
                  'dataOffer' => $dataOffer, 'settingMember' => $settingMember),
            function ($message) {
                $message->to(Constants::EMAIL_ADMIN)->subject(Constants::SUBJECT_EMAIL);
            }
        );
    }
}
