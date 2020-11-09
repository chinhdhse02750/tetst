<?php

namespace App\Modules\Admin\Controllers;

use App\Modules\Admin\Requests\Rank\StoreRankRequest;
use App\Repositories\RankRepository;
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

class RankController extends Controller
{
    protected $rankRepository;

    /**
     * RankController constructor.
     *
     * @param RankRepository $rankRepository
     */
    public function __construct(RankRepository $rankRepository)
    {
        $this->rankRepository = $rankRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $ranks = $this->rankRepository
            ->withTrashed()
            ->orderBy('priority', $direction = 'DESC')
            ->paginate(Constants::DEFAULT_PER_PAGE);

        return view('rank.index', ['ranks' => $ranks]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('rank.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRankRequest $request
     * @return RedirectResponse
     * @throws ValidatorException
     */
    public function store(StoreRankRequest $request)
    {
        try {
            $dataRequest = $request->only(['name_jp', 'name_en', 'amount', 'priority', 'color_code']);
            $data = $this->convertData($dataRequest);
            if (!$this->rankRepository->create($data)) {
                Session::flash('error_msg', trans('alerts.general.error.created'));

                return redirect()
                    ->route('ranks.index');
            }

            Session::flash('success_msg', trans('alerts.general.success.created'));

            return redirect()->route('ranks.index');
        } catch (Exception $e) {
            Log::error('[ERROR_RANK_CREATE]: '. $e->getMessage());

            return redirect()
                ->route('ranks.index')
                ->withErrors($e->getMessage());
        }//end try
    }

    /**
     * Show the form for editing the rank.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $rank = $this->rankRepository->find($id);
        
        return view('rank.edit', ['rank' => $rank]);
    }

    /**
     * Update the rank in storage.
     *
     * @param StoreRankRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(StoreRankRequest $request, int $id)
    {
        try {
            $dataRequest = $request->only(['name_jp', 'name_en', 'amount', 'priority', 'color_code']);
            $data = $this->convertData($dataRequest);
            if (!$this->rankRepository->update($data, $id)) {
                Session::flash('error_msg', trans('alerts.general.error.updated'));
                
                return redirect()->route('ranks.index');
            }
            Session::flash('success_msg', trans('alerts.general.success.updated'));
            
            return redirect()->route('ranks.index');
        } catch (Exception $e) {
            Log::error('[ERROR_RANK_UPDATE]: '. $e->getMessage());

            return redirect()
                ->route('ranks.index')
                ->withErrors($e->getMessage());
        }//end try
    }

    /**
     * Remove the rank from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id)
    {
        if (!$this->rankRepository->delete($id)) {
            Session::flash('error_msg', trans('alerts.general.error.deleted'));

            return redirect()->route('ranks.index');
        }
        Session::flash('success_msg', trans('alerts.general.success.deleted'));

        return redirect()->route('ranks.index');
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
            $result = $this->rankRepository->restore($id);
            if ($result) {
                Session::flash('success_msg', trans('alerts.general.success.restore'));
            }

            return redirect()->route('ranks.index');
        } catch (Exception $e) {
            Log::error('[RESTORE_RANK_LOG]: ' . $e->getMessage());

            return redirect()
                ->route('ranks.index')
                ->withErrors($e->getMessage());
        }
    }

    public function convertData($data)
    {
        if (is_null($data['amount'])) {
            $data['amount'] = 0;
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
