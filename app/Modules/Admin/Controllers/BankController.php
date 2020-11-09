<?php

namespace App\Modules\Admin\Controllers;

use App\Entities\Bank;
use App\Modules\Admin\Requests\Bank\StoreBankRequest;
use App\Repositories\BankRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use App\Helpers\Constants;
use Illuminate\View\View;
use PHPUnit\Exception;
use Prettus\Validator\Exceptions\ValidatorException;

class BankController extends Controller
{
    protected $bankRepository;

    /**
     * BankController constructor.
     *
     * @param BankRepository $bankRepository
     */
    public function __construct(BankRepository $bankRepository)
    {
        $this->bankRepository = $bankRepository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreBankRequest $request
     * @return RedirectResponse
     * @throws ValidatorException
     */
    public function store(StoreBankRequest $request)
    {
        try {
            $data = $request->only(['name', 'branch_name', 'account_number', 'account_name', 'receipt_name']);
            $dataId = $request->only(['id']);

            if (!$this->bankRepository->updateOrCreate(['id' => $dataId], $data)) {
                Session::flash('error_msg', trans('alerts.general.error.updated'));

                return redirect()
                    ->route('banks.edit');
            }

            Session::flash('success_msg', trans('alerts.general.success.updated'));

            return redirect()->route('banks.edit');
        } catch (Exception $e) {
            Log::error('[ERROR_BANK_CREATE]: '. $e->getMessage());

            return redirect()
                ->route('banks.edit')
                ->withErrors($e->getMessage());
        }//end try
    }

    /**
     * Show the form for editing the bank.
     *
     * @return Application|Factory|View
     */
    public function edit()
    {
        $bank = $this->bankRepository->first();

        return view('bank.edit', ['bank' => $bank]);
    }

    /**
     * Create a new controller instance.
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }
}
