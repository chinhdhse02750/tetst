<?php

namespace App\Modules\Admin\Controllers;

use App\Helpers\Constants;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Repositories\AdjustmentRepository;
use App\Repositories\BalanceRepository;
use App\Repositories\UserRepository;

class BalanceController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * @var AdjustmentRepository
     */
    protected $adjustmentRepository;

    /**
     * @var BalanceRepository
     */
    protected $balanceRepository;

    /**
     * AdjustmentController constructor.
     * @param UserRepository $userRepository
     * @param BalanceRepository $balanceRepository
     * @param AdjustmentRepository $adjustmentRepository
     */
    public function __construct(
        UserRepository $userRepository,
        BalanceRepository $balanceRepository,
        AdjustmentRepository $adjustmentRepository
    ) {
        $this->userRepository = $userRepository;
        $this->balanceRepository = $balanceRepository;
        $this->adjustmentRepository = $adjustmentRepository;
    }

    /**
     *
     * @return Response
     */
    public function index()
    {
        $balances = $this->balanceRepository
            ->getBalancePaginated(Constants::DEFAULT_PER_PAGE, Constants::BALANCE_ORDER_BY, Constants::USER_SORT);

        return response()->view('point.index', compact('balances'));
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
        $dataFilter = $request->only('id', 'email', 'adjustment', 'dateFrom', 'dateTo', 'status');
        $balances = $this->balanceRepository
            ->filterBalance(
                Constants::DEFAULT_PER_PAGE,
                Constants::BALANCE_ORDER_BY,
                Constants::USER_SORT,
                $dataFilter
            );

        return view("point.includes.result_search", compact('balances'))->render();
    }
}
