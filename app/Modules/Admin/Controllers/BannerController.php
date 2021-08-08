<?php

namespace App\Modules\Admin\Controllers;


use App\Helpers\Constants;
use App\Modules\Admin\Requests\Banner\StoreBannerRequest;
use App\Repositories\ListBannerRepository;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use PHPUnit\Exception;
use \Illuminate\Contracts\Foundation\Application;
use \Illuminate\Contracts\View\Factory;
use \Illuminate\View\View;
use \Illuminate\Http\RedirectResponse;
use \Illuminate\Http\Request;
use App\Helpers\Media;
use Prettus\Validator\Exceptions\ValidatorException;

class BannerController extends Controller
{
    protected $listBannerRepository;

    const ACTIVE = 1;

    /**
     * bannerController constructor.
     * @param ListBannerRepository $bannerRepository bannerRepository.
     */
    public function __construct(ListBannerRepository $listBannerRepository)
    {
        $this->listBannerRepository = $listBannerRepository;
    }


    public function index()
    {
        $banners = $this->listBannerRepository->getBannerPaginated(Constants::DEFAULT_PER_PAGE, Constants::USER_ORDER_BY, Constants::USER_SORT);

        return view('banner.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     * @throws ValidatorException
     */
    public function create()
    {
        return view('banner.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreBannerRequest $request Request.
     * @return RedirectResponse
     * @throws \Exception
     */
    public function store(Request $request)
    {
        try {
            $data = $request->except(['_token']);
            $data['active'] = $request['active'] === null ? 0 : 1;
            $data['order '] = 1;

            if ($request->file('image')) {
                $imagePath = $request->file('image');
                $imageName = $imagePath->getClientOriginalName();

                $path = $request->file('image')->storeAs('uploads/banner', $imageName, 'public');
            }

            $data['image'] = '/storage/' . $path;

            $this->listBannerRepository->create($data);
            Session::flash('success_msg', trans('alerts.general.success.created'));

            return redirect()
                ->route('banners.index');
        } catch (Exception $e) {
            Log::error('[ERROR_BANNER_CREATE]: ' . $e->getMessage());

            return redirect()
                ->route('banners.index')
                ->withErrors($e->getMessage());
        }//end try
    }

    /**
     * Show the form for editing the banner.
     * @param int $id Id banner.
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $banner = $this->listBannerRepository->find($id);

        return view('banner.edit', ['banner' => $banner]);
    }

    /**
     * Update the banner in storage.
     *
     * @param Request $request
     * @param int $id
     * @return $this|RedirectResponse
     * @throws ValidatorException
     * @throws \Exception
     */
    public function update(Request $request, int $id)
    {
        try {
            $data = $request->except(['_token']);
            $data['active'] = $request['active'] === null ? 0 : 1;
            $data['order '] = 1;
            if ($request->file('image')) {
                $imagePath = $request->file('image');
                $imageName = $imagePath->getClientOriginalName();

                $path = $request->file('image')->storeAs('uploads/blogs', $imageName, 'public');
                $data['image'] = '/storage/' . $path;
            }

            $this->listBannerRepository->find($id)->update($data);

            Session::flash('success_msg', trans('alerts.general.success.updated'));
            return redirect()
                ->route('banners.index');
        } catch (Exception $e) {
            Log::error('[ERROR_CATEGORY_CREATE]: ' . $e->getMessage());
            return redirect()
                ->route('products.index')
                ->withErrors($e->getMessage());
        }//end try
    }

    /**
     * Remove the banner from storage.
     * @param int $id Id banner.
     * @return RedirectResponse
     */
    public function destroy(int $id)
    {
        $result = $this->listBannerRepository->find($id);
        if ($result) {
            $result->delete();
            Session::flash('success_msg', trans('alerts.general.success.deleted'));
        }
        return redirect()
            ->route('banners.index');
    }


    /**
     * Create a new controller instance.
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }
}
