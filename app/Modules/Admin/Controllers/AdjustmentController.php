<?php

namespace App\Modules\Admin\Controllers;

use App\Helpers\Constants;
use App\Modules\Admin\Requests\User\SendPointRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Repositories\AdjustmentRepository;
use App\Repositories\BalanceRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use PHPUnit\Exception;
use Prettus\Validator\Exceptions\ValidatorException;

class AdjustmentController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @param string $type
     * @param int $id
     * @return Response
     */
    public function createAdjustment(string $type, int $id)
    {
        $user = $this->userRepository->find($id);
        return response()->view('user.includes.point_send', [
            'user' => $user,
            'type' => $type
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SendPointRequest $request
     * @param string $type
     * @return RedirectResponse
     * @throws ValidatorException
     */
    public function storeAdjustment(SendPointRequest $request, string $type)
    {
        DB::beginTransaction();
        try {
            $dataAdjustments = $request->except(['_token', '_method']);
            $adjustments = $this->adjustmentRepository->create($dataAdjustments);
            $adjustments->balance()->create([
                'user_id' => $dataAdjustments['user_id'],
                'amount' => $dataAdjustments['amount'],
                'body' => $dataAdjustments]);

            Session::flash('success_msg', trans('alerts.general.success.send_point'));
            DB::commit();

            return redirect()->route('member.index', $type);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('[USER_LOG]: ' . $e->getMessage());

            return redirect()
                ->route('member.index', $type)
                ->withErrors($e->getMessage());
        }//end try
    }
}
