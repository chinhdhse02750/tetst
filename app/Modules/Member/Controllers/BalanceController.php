<?php

namespace App\Modules\Member\Controllers;

use App\Repositories\AdjustmentRepository;
use App\Repositories\BalanceRepository;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class BalanceController extends Controller
{
    /**
     * @var AdjustmentRepository
     */
    protected $adjustmentRepository;

    /**
     * @var BalanceRepository
     */
    protected $balanceRepository;

    /**
     * BalanceController constructor.
     *
     * @param BalanceRepository $balanceRepository
     * @param AdjustmentRepository $adjustmentRepository
     */
    public function __construct(
        BalanceRepository $balanceRepository,
        AdjustmentRepository $adjustmentRepository
    ) {
        $this->middleware('auth')->except('logout');
        $this->balanceRepository = $balanceRepository;
        $this->adjustmentRepository = $adjustmentRepository;
    }

    /**
     * @return Factory|View|void
     */
    public function index()
    {
        try {
            $balances = $this->balanceRepository->findWhere(['user_id' => Auth::id()]);

            return view('balances.index', compact('balances'));
        } catch (\Exception $e) {
            return abort(404);
        }
    }
}
