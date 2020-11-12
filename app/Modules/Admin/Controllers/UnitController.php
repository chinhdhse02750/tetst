<?php

namespace App\Modules\Admin\Controllers;

use App\Entities\Unit;
use App\Modules\Admin\Requests\Category\StoreCategoryRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use App\Repositories\UnitRepository;
use App\Helpers\Constants;
use PHPUnit\Exception;

class UnitController extends Controller
{
    protected $unitRepository;

    /**
     * CategoryController constructor.
     */
    public function __construct(UnitRepository $unitRepository)
    {
        $this->unitRepository = $unitRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $units = $this->unitRepository->orderBy('created_at', $direction = 'DESC')
            ->paginate(Constants::DEFAULT_PER_PAGE);

        return view('units.index', ['units' => $units]);
    }

    /**
     * Display the unit.
     *
     * @param int $id
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(int $id)
    {
        $units = $this->unitRepository->find($id);
        return view('units.detail', ['units' => $units]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('units.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreCategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(StoreCategoryRequest $request)
    {
        try {
            $data = $request->only(['name', 'description']);
            $this->unitRepository->create($data);
            Session::flash('success_msg', trans('alerts.general.success.created'));

            return redirect()
                ->route('units.index');
        } catch (Exception $e) {
            Log::error('[ERROR_CATEGORY_CREATE]: '. $e->getMessage());

            return redirect()
                ->route('units.index')
                ->withErrors($e->getMessage());
        }//end try
    }

    /**
     * Show the form for editing the category
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(int $id)
    {
        $units = $this->unitRepository->find($id);
        return view('units.edit', ['units' => $units]);
    }

    /**
     * Update the category in storage
     * @param StoreCategoryRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(StoreCategoryRequest $request, int $id)
    {
        try {
            $data = $request->only(['name', 'description']);
            $this->unitRepository->find($id)->update($data);
            Session::flash('success_msg', trans('alerts.general.success.updated'));
            return redirect()
                ->route('units.index');
        } catch (Exception $e) {
            Log::error('[ERROR_CATEGORY_CREATE]: '. $e->getMessage());
            return redirect()
                ->route('units.index')
                ->withErrors($e->getMessage());
        }//end try
    }

    /**
     * Remove the category from storage.
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id)
    {
        $result = $this->unitRepository->find($id);
        if ($result) {
            $result->delete();
            Session::flash('success_msg', trans('alerts.general.success.deleted'));
        }
        return redirect()->route('units.index');
    }

    /**
     * Create a new controller instance.
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }
}


