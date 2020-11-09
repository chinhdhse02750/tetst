<?php

namespace App\Modules\Admin\Controllers;

use App\Entities\User;
use App\Helpers\Constants;
use App\Repositories\UserRepository;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * UserController constructor.
     *
     * @param UserRepository $userRepository
     *
     */
    public function __construct(
        UserRepository $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    /**
     * @return RedirectResponse
     */
    public function index()
    {
        return redirect()->route('admin.dashboard');
    }

    /**
     * @return Factory|View
     */
    public function dashboard()
    {
        $users = $this->userRepository
            ->getUserActivePaginated(Constants::DEFAULT_PER_PAGE, Constants::USER_ORDER_BY, Constants::USER_SORT);
        $allUser = $this->userRepository->getAllUserActive();
        $totalFemale = $allUser->where("type", Constants::USER_FEMALE)->count();
        $totalMale = $allUser->where("type", Constants::USER_MALE)->count();

        return view('home.welcome', compact('users', 'totalFemale', 'totalMale', 'allUser'));
    }

    /**
     * Create a new controller instance.
     *
     * @return StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }
}
