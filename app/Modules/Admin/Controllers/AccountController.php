<?php

namespace App\Modules\Admin\Controllers;

use App\Modules\Admin\Requests\Account\StoreAccountRequest;
use App\Modules\Admin\Requests\Account\UpdateAccountRequest;
use App\Repositories\AdminRepository;
use App\Repositories\RoleRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use App\Helpers\Constants;
use Illuminate\View\View;
use PHPUnit\Exception;
use Prettus\Validator\Exceptions\ValidatorException;

class AccountController extends Controller
{
    protected $adminRepository;
    protected $roleRepository;

    /**
     * AccountController constructor.
     *
     * @param AdminRepository $adminRepository
     * @param RoleRepository $roleRepository
     */
    public function __construct(AdminRepository $adminRepository, RoleRepository $roleRepository)
    {
        $this->adminRepository = $adminRepository;
        $this->roleRepository = $roleRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $accounts = $this->adminRepository
            ->withTrashed()
            ->orderBy(Constants::TIME_ORDER_BY, Constants::FILTER_DEFAULT_SORT_ORDER)
            ->paginate(Constants::DEFAULT_PER_PAGE);

        return view('account.index', ['accounts' => $accounts]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $roles = $this->roleRepository->findWhere(['name' => 'admin'])->pluck('name', 'id');

        return view('account.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreAccountRequest $request
     * @return RedirectResponse
     * @throws ValidatorException
     */
    public function store(StoreAccountRequest $request)
    {
        DB::beginTransaction();
        try {
            $dataRequest = $request->only(['name', 'email', 'password']);
            $roleRequest = $request->only(['role']);
            $data = $this->convertData($dataRequest);
            $account = $this->adminRepository->create($data);
            if (!$account) {
                Session::flash('error_msg', trans('alerts.general.error.created'));

                return redirect()
                    ->route('accounts.index');
            }

            $role = $this->roleRepository->find($roleRequest)->first();
            if (!$role || !$account->assignRole($role)) {
                Session::flash('error_msg', trans('alerts.general.error.created'));

                return redirect()
                    ->route('accounts.index');
            }

            DB::commit();

            Session::flash('success_msg', trans('alerts.general.success.created'));

            return redirect()->route('accounts.index');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('[ERROR_ACCOUNT_CREATE]: '. $e->getMessage());

            return redirect()
                ->route('accounts.index')
                ->withErrors($e->getMessage());
        }//end try
    }

    /**
     * Show the form for editing the account.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $account = $this->adminRepository->find($id);
        $roles = $this->roleRepository->findWhere(['name' => 'admin'])->pluck('name', 'id');

        return view('account.edit', ['account' => $account, 'roles' => $roles]);
    }

    /**
     * Update the account in storage.
     *
     * @param UpdateAccountRequest $request
     * @param int $id
     * @return RedirectResponse
     * @throws ValidatorException
     */
    public function update(UpdateAccountRequest $request, int $id)
    {
        try {
            $dataRequest = $request->only(['name', 'email', 'password']);
            $data = $this->convertData($dataRequest);
            if (!$this->adminRepository->update($data, $id)) {
                Session::flash('error_msg', trans('alerts.general.error.updated'));

                return redirect()->route('accounts.index');
            }
            Session::flash('success_msg', trans('alerts.general.success.updated'));

            return redirect()->route('accounts.index');
        } catch (Exception $e) {
            Log::error('[ERROR_ACCOUNT_UPDATE]: '. $e->getMessage());

            return redirect()
                ->route('accounts.index')
                ->withErrors($e->getMessage());
        }//end try
    }

    /**
     * Remove the account from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id)
    {
        if (!$this->adminRepository->delete($id)) {
            Session::flash('error_msg', trans('alerts.general.error.deleted'));

            return redirect()->route('accounts.index');
        }
        Session::flash('success_msg', trans('alerts.general.success.deleted'));

        return redirect()->route('accounts.index');
    }

    /**
     * Restore function.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function restore(int $id)
    {
        try {
            if (!$this->adminRepository->restore($id)) {
                Session::flash('success_msg', trans('alerts.general.error.restore'));

                return redirect()->route('accounts.index');
            }

            Session::flash('success_msg', trans('alerts.general.success.restore'));

            return redirect()->route('accounts.index');
        } catch (Exception $e) {
            Log::error('[RESTORE_ACCOUNT_LOG]: ' . $e->getMessage());

            return redirect()
                ->route('accounts.index')
                ->withErrors($e->getMessage());
        }
    }

    /**
     * Convert data function.
     *
     * @param array $data
     * @return mixed
     */
    private function convertData($data)
    {
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        if (is_null($data['password'])) {
            unset($data['password']);
        }

        return $data;
    }

    /**
     * Create a new controller instance.
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }
}
