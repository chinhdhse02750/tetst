<?php

namespace App\Modules\Admin\Controllers;

use App\Entities\Prefecture;
use App\Modules\Admin\Requests\Prefecture\StorePrefectureRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use App\Repositories\PrefectureRepository;
use App\Repositories\AreaRepository;
use PHPUnit\Exception;
use \Illuminate\Contracts\Foundation\Application;
use \Illuminate\Contracts\View\Factory;
use \Illuminate\View\View;
use \Illuminate\Http\RedirectResponse;
use Prettus\Validator\Exceptions\ValidatorException;

class PrefectureController extends Controller
{
    protected $prefectureRepository;
    protected $areaRepository;

    /**
     * PrefectureController constructor.
     * @param PrefectureRepository $prefectureRepository PrefectureRepository.
     * @param AreaRepository $areaRepository AreaRepository.
     */
    public function __construct(PrefectureRepository $prefectureRepository, AreaRepository $areaRepository)
    {
        $this->prefectureRepository = $prefectureRepository;
        $this->areaRepository = $areaRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $prefectures = $this->prefectureRepository->getAll();

        return view('prefecture.index', ['prefectures' => $prefectures]);
    }

    /**
     * Display the prefecture.
     *
     * @param int $id Id prefecture.
     *
     * @return Application|Factory|View
     */
    public function show(int $id)
    {
        $prefecture = $this->prefectureRepository->show($id);

        return view('prefecture.detail', ['prefecture' => $prefecture]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $areas = $this->areaRepository->pluck('name', 'id');

        return view('prefecture.create', ['areas' => $areas]);
    }

    /**
     * Store a newly created resource in storage.
     * @param StorePrefectureRequest $request Request.
     * @return RedirectResponse
     * @throws ValidatorException
     */
    public function store(StorePrefectureRequest $request)
    {
        try {
            $data = $request->only(['area_id', 'name']);
            $this->prefectureRepository->create($data);
            Session::flash('success_msg', trans('alerts.general.success.created'));

            return redirect()
                ->route('prefectures.index');
        } catch (Exception $e) {
            Log::error('[ERROR_Prefecture_CREATE]: '. $e->getMessage());

            return redirect()
                ->route('prefectures.index')
                ->withErrors($e->getMessage());
        }//end try
    }

    /**
     * Show the form for editing the prefecture.
     * @param int $id Id prefecture.
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $prefectures = $this->prefectureRepository->find($id);
        $areas = $this->areaRepository->pluck('name', 'id');

        return view('prefecture.edit', ['prefectures' => $prefectures, 'areas' => $areas]);
    }

    /**
     * Update the prefecture in storage.
     * @param StorePrefectureRequest $request Request.
     * @param int $id Id prefecture.
     * @return RedirectResponse
     */
    public function update(StorePrefectureRequest $request, int $id)
    {
        try {
            $data = $request->only(['area_id', 'name']);
            $this->prefectureRepository->find($id)->update($data);
            Session::flash('success_msg', trans('alerts.general.success.updated'));

            return redirect()
                ->route('prefectures.index');
        } catch (Exception $e) {
            Log::error('[ERROR_Prefecture_CREATE]: '. $e->getMessage());

            return redirect()
                ->route('prefectures.index')
                ->withErrors($e->getMessage());
        }//end try
    }

    /**
     * Remove the prefecture from storage.
     * @param int $id Id prefecture.
     * @return RedirectResponse
     */
    public function destroy(int $id)
    {
        try {
            $this->prefectureRepository->delete($id);
            Session::flash('success_msg', trans('alerts.general.success.deleted'));

            return redirect()
                ->route('prefectures.index');
        } catch (Exception $e) {
            Log::error('[ERROR_PREFECTURE_DELETE]: '. $e->getMessage());

            return redirect()
                ->route('prefectures.index')
                ->withErrors($e->getMessage());
        }//end try
    }

    /**
     * Create a new controller instance.
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }
}
