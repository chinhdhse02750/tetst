<?php

namespace App\Modules\Admin\Controllers;

use App\Entities\News;
use App\Modules\Admin\Requests\News\StoreNewsRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use App\Repositories\NewsRepository;
use App\Helpers\Constants;
use Illuminate\View\View;
use PHPUnit\Exception;
use Prettus\Validator\Exceptions\ValidatorException;

class NewsController extends Controller
{
    protected $newsRepository;

    /**
     * NewsController constructor.
     *
     * @param NewsRepository $newsRepository
     */
    public function __construct(NewsRepository $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $news = $this->newsRepository->orderBy(Constants::TIME_ORDER_BY, Constants::FILTER_DEFAULT_SORT_ORDER)
            ->paginate(Constants::DEFAULT_PER_PAGE);

        return view('news.index', ['news' => $news]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreNewsRequest $request
     * @return RedirectResponse
     * @throws ValidatorException
     */
    public function store(StoreNewsRequest $request)
    {
        try {
            $data = $request->only(['content', 'direction', 'start_time', 'end_time', 'order', 'active']);
            $this->newsRepository->create($data);
            Session::flash('success_msg', trans('alerts.general.success.created'));

            return redirect()
                ->route('news.index');
        } catch (Exception $e) {
            Log::error('[ERROR_NEWS_CREATE]: '. $e->getMessage());

            return redirect()
                ->route('news.index')
                ->withErrors($e->getMessage());
        }//end try
    }

    /**
     * Show the form for editing the news.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $news = $this->newsRepository->find($id);

        return view('news.edit', ['news' => $news]);
    }

    /**
     * Update the news in storage
     *
     * @param StoreNewsRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(StoreNewsRequest $request, int $id)
    {
        try {
            $data = $request->only(['content', 'direction', 'start_time', 'end_time', 'order', 'active']);
            if (!isset($data['active'])) {
                $data['active'] = 0;
            }
            $this->newsRepository->find($id)->update($data);
            Session::flash('success_msg', trans('alerts.general.success.updated'));

            return redirect()
                ->route('news.index');
        } catch (Exception $e) {
            Log::error('[ERROR_News_CREATE]: '. $e->getMessage());

            return redirect()
                ->route('news.index')
                ->withErrors($e->getMessage());
        }//end try
    }

    /**
     * Remove the news from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id)
    {
        $result = $this->newsRepository->find($id);
        if ($result) {
            $result->delete();
            Session::flash('success_msg', trans('alerts.general.success.deleted'));
        }

        return redirect()->route('news.index');
    }

    /**
     * Get search data function.
     *
     * @param array $request
     * @return array
     */
    protected function getSearchData(array $request)
    {
        $data = [];
        if (isset($request['active'])) {
            $data['active'] = $request['active'];
        }
        if ($request['start_time']) {
            $data['start_time'] = $request['start_time'];
        }
        if ($request['end_time']) {
            $data['end_time'] = $request['end_time'];
        }

        return $data;
    }

    /**
     * Search news function.
     *
     * @param Request $request
     * @return array|string
     * @throws \Throwable
     */
    public function search(Request $request)
    {
        $dataRequest = $request->only('start_time', 'end_time', 'active');
        $dataFilter = $this->getSearchData($dataRequest);
        $news = $this->newsRepository->search($dataFilter);

        return view("news.result_search", compact('news', 'dataFilter'));
    }

    /**
     * Create a new controller instance.
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }
}
