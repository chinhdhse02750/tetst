<?php

namespace App\Modules\Admin\Controllers;

use App\Entities\Banner;
use App\Helpers\Common;
use App\Helpers\Constants;
use App\Modules\Admin\Requests\Banner\StoreBannerRequest;
use App\Modules\Admin\Requests\Banner\UpdateBannerRequest;
use App\Repositories\MediaRepository;
use App\Traits\MediaTrait;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use App\Repositories\BannerRepository;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Exception;
use \Illuminate\Contracts\Foundation\Application;
use \Illuminate\Contracts\View\Factory;
use \Illuminate\View\View;
use \Illuminate\Http\RedirectResponse;
use App\Helpers\Media;
use Carbon\Carbon;
use Prettus\Validator\Exceptions\ValidatorException;

class BannerController extends Controller
{
    protected $bannerRepository;
    protected $mediaRepository;
    use MediaTrait {
        MediaTrait::__construct as private __fhConstruct;
    }

    /**
     * bannerController constructor.
     * @param BannerRepository $bannerRepository bannerRepository.
     * @param MediaRepository $mediaRepository MediaRepository.
     */
    public function __construct(BannerRepository $bannerRepository, MediaRepository $mediaRepository)
    {
        $this->__fhConstruct();
        $this->bannerRepository = $bannerRepository;
        $this->mediaRepository = $mediaRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $banners = $this->bannerRepository
            ->with(['media'])
            ->orderBy('created_at', $direction = 'DESC')
            ->paginate(Constants::DEFAULT_PER_PAGE);

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
    public function store(StoreBannerRequest $request)
    {
        try {
            $bannerData = $request->only(['redirect_url', 'order', 'active']);
            $mediaData = Media::getDataMedia($request->image, 'banners', true);
            if (!$banner = $this->storeBanner($bannerData, $mediaData)) {
                Session::flash('error_msg', trans('alerts.general.error.created'));

                return redirect()->route('banners.index');
            }

            Session::flash('success_msg', trans('alerts.general.success.created'));

            return redirect()
                ->route('banners.index');
        } catch (Exception $e) {
            Log::error('[ERROR_BANNER_CREATE]: '. $e->getMessage());

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
        $banner = $this->bannerRepository->with('media')->find($id);

        return view('banner.edit', ['banner' => $banner]);
    }

    /**
     * Update the banner in storage.
     * @param UpdateBannerRequest $request Request.
     * @param int $id Id banner.
     *
     * @return RedirectResponse
     * @throws \Exception
     */
    public function update(UpdateBannerRequest $request, int $id)
    {
        try {
            $dataBanner = $request->only(['redirect_url', 'order', 'active']);
            $dataBanner['active'] = Arr::get($dataBanner, 'active', 0);
            $media = $request->hasFile('image') ? Media::getDataMedia($request->file('image'), 'banners', true) : [];
            if ($mediaId = $this->storeMedia($media)) {
                $dataBanner['media_id'] = $mediaId;
            }

            if (!$this->bannerRepository->update($dataBanner, $id)) {
                Session::flash('error_msg', trans('alerts.general.error.updated'));

                return redirect()->route('banners.index');
            }

            Session::flash('success_msg', trans('alerts.general.success.updated'));

            return redirect()
                ->route('banners.index');
        } catch (Exception $e) {
            Log::error('[ERROR_BANNER_UPDATE]: '. $e->getMessage());

            return redirect()
                ->route('banners.index')
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
        try {
            $banner = $this->bannerRepository->find($id);
            if (!$banner) {
                Session::flash('error_msg', trans('alerts.general.error.deleted'));

                return redirect()
                    ->route('banners.index');
            } else {
                $this->mediaRepository->delete($banner['media_id']);
            }
            if ($this->bannerRepository->delete($id)) {
                Session::flash('success_msg', trans('alerts.general.success.deleted'));
            }

            return redirect()
                ->route('banners.index');
        } catch (Exception $e) {
            Log::error('[ERROR_BANNER_DELETE]: '. $e->getMessage());

            return redirect()
                ->route('banners.index')
                ->withErrors($e->getMessage());
        }//end try
    }

    /**
     * @param array $bannerData
     * @param array $mediaData
     * @return bool
     */

    /**
     * Store media and banner.
     * @param array $bannerData BannerData.
     * @param array $mediaData MediaData.
     * @return bool
     */
    private function storeBanner(array $bannerData, array $mediaData): bool
    {
        try {
            DB::beginTransaction();
            if (!$mediaId = $this->storeMedia($mediaData)) {
                return false;
            }

            $bannerData['media_id'] = $mediaId;
            if (!$banner = $this->bannerRepository->create($bannerData)) {
                return false;
            }

            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();

            return false;
        }//end try
    }

    /**
     * Create new media and return mediaId.
     * @param array $mediaData Media Data.
     * @return int
     * @throws ValidatorException
     */
    private function storeMedia(array $mediaData): int
    {
        if (empty($mediaData)) {
            return 0;
        }

        $dataMedia = [
            'name' => Arr::get($mediaData, 'name', ''),
            'thumbnail_name' => '',
            'type' => Arr::get($mediaData, 'type', ''),
            'path' => Arr::get($mediaData, 'path', ''),
            'size' => Arr::get($mediaData, 'size', ''),
            'thumbnail_size' => '',
        ];
        $media = $this->mediaRepository->create($dataMedia)->toArray();

        return Arr::get($media, 'id', 0);
    }

    /**
     * Create a new controller instance.
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }
}
