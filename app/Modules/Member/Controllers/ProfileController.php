<?php

namespace App\Modules\Member\Controllers;

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
use App\Repositories\PrefRepository;
use App\Repositories\OrderRepository;
use App\Repositories\OrderDetailRepository;

class ProfileController extends Controller
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
     * @var PrefRepository
     */
    protected $prefRepository;

    /**
     * @var
     */
    protected $oderRepository;

    /**
     * @var
     */
    protected $oderDetailRepository;

    /**
     * ProfileController constructor.
     * @param UserRepository $userRepository
     * @param UserProfileRepository $userProfileRepository
     * @param PrefRepository $prefRepository
     * @param OrderRepository $oderRepository
     * @param OrderDetailRepository $oderDetailRepository
     */
    public function __construct(
        UserRepository $userRepository,
        userProfileRepository $userProfileRepository,
        PrefRepository $prefRepository,
        OrderRepository $oderRepository,
        OrderDetailRepository $oderDetailRepository
    ) {
        $this->middleware('auth')->except('logout');
        $this->userRepository = $userRepository;
        $this->userProfileRepository = $userProfileRepository;
        $this->prefRepository = $prefRepository;
        $this->orderRepository = $oderRepository;
        $this->oderDetailRepository = $oderDetailRepository;
    }

    /**
     * @return Factory|View|void
     */
    public function index()
    {
        try {
            $user = $this->userRepository->find(Auth::id());
            $pref = $this->prefRepository->all();
            $prefConfig = config('pref');
            $selectTime = $prefConfig['select_time'];

            return view('profile.index_shop', compact('user', 'pref', 'selectTime'));
        } catch (\Exception $e) {

            return abort(404);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Request $request)
    {
        try {
            $request->all();
            $data = $request->except('_token');
            $user = $this->userRepository->find(Auth::id());
            $userProfile = $this->userProfileRepository->findByField('user_id', Auth::id())->first();
            if(!$userProfile){
                $data['user_id'] = $user->id;
                $dataUpdate = $this->userProfileRepository->create($data);
            }else{
                $dataUpdate = $this->userProfileRepository->update($data, $user->userProfile->id);
            }


            return $this->success($dataUpdate->toArray());
        } catch (\Exception $e) {
            return $this->error('[ERROR_STORE_FAVORITE]: ' . $e->getMessage());
        }
    }

    /**
     * @return Factory|View
     */
    public function password()
    {
        return view('profile.change_password_shop');
    }

    /**
     * @return Factory|View
     */
    public function order()
    {
        $orders = $this->orderRepository->findByField('customer_id',Auth::id());
        $countOrder = $orders->count();

        return view('profile.order', compact('orders', 'countOrder') );
    }


    /**
     * @param Request $request
     * @return RedirectResponse|void
     */
    public function changePassword(Request $request)
    {
        try {
            $dataLogin['password'] = Hash::make($request->password);
            $dataLogin['password_changed_at'] = Carbon::now();
            $this->userRepository->update($dataLogin, Auth::id());
            Auth::guard('web')->logout();

            return redirect()->route('login');
        } catch (\Exception $e) {
            return abort(404);
        }
    }
}
