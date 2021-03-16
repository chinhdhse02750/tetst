<?php

namespace App\Modules\Admin\Controllers;

use App\Helpers\Media;
use App\Helpers\Common;
use App\Helpers\UserProfileAttribute;
use App\Modules\Admin\Requests\User\UpdateProductRequest;
use App\Repositories\AreaRepository;
use App\Repositories\MediaRepository;
use App\Repositories\RankRepository;
use App\Repositories\UserMediaRepository;
use App\Repositories\UserProfileRepository;
use App\Repositories\UserRepository;
use App\Repositories\UserVideoRepository;
use App\Repositories\VideoRepository;
use App\Modules\Admin\Requests\User\StoreProductRequest;
use App\Services\UserScheduleService;
use App\Services\UserService;
use App\Traits\MediaTrait;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Constants;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use PHPUnit\Exception;
use Illuminate\Support\Facades\DB;
use \Illuminate\Http\Response;
use \Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Prettus\Validator\Exceptions\ValidatorException;

class UserController extends Controller
{
    use MediaTrait {
        MediaTrait::__construct as private __fhConstruct;
    }

    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * @var UserProfileRepository
     */
    protected $userProfileRepository;

    /**
     * @var RankRepository
     */
    protected $rankRepository;

    /**
     * @var MediaRepository
     */
    protected $mediaRepository;

    /**
     * @var AreaRepository
     */
    protected $areaRepository;

    /**
     * @var UserMediaRepository
     */
    protected $userMediaRepository;

    /**
     * @var VideoRepository
     */
    protected $videoRepository;

    /**
     * @var UserVideoRepository
     */
    protected $userVideoRepository;

    /**
     * @var UserService
     */
    protected $userService;

    /**
     * @var UserScheduleService
     */
    protected $userScheduleService;

    /**
     * @var object
     */
    protected $user;

    /**
     * UserController constructor.
     *
     * @param UserRepository $userRepository
     * @param UserProfileRepository $userProfileRepository
     * @param RankRepository $rankRepository
     * @param MediaRepository $mediaRepository
     * @param AreaRepository $areaRepository
     * @param UserMediaRepository $userMediaRepository
     * @param VideoRepository $videoRepository
     * @param UserVideoRepository $userVideoRepository
     * @param UserService $userService
     * @param UserScheduleService $userScheduleService
     */
    public function __construct(
        UserRepository $userRepository,
        UserProfileRepository $userProfileRepository,
        RankRepository $rankRepository,
        MediaRepository $mediaRepository,
        AreaRepository $areaRepository,
        UserMediaRepository $userMediaRepository,
        VideoRepository $videoRepository,
        UserVideoRepository $userVideoRepository,
        UserService $userService,
        UserScheduleService $userScheduleService
    ) {
        $this->__fhConstruct();
        $this->userRepository = $userRepository;
        $this->userProfileRepository = $userProfileRepository;
        $this->rankRepository = $rankRepository;
        $this->mediaRepository = $mediaRepository;
        $this->areaRepository = $areaRepository;
        $this->userMediaRepository = $userMediaRepository;
        $this->videoRepository = $videoRepository;
        $this->userVideoRepository = $userVideoRepository;
        $this->userService = $userService;
        $this->userScheduleService = $userScheduleService;
    }

    /**
     * @return mixed
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }

    /**
     * @param string $type
     * @return Response
     */
    public function index(string $type)
    {
        $female = Constants::USER_FEMALE;
        $male = Constants::USER_MALE;
        $femaleUser = $this->userRepository
            ->getUserActivePaginated(
                Constants::DEFAULT_PER_PAGE,
                Constants::USER_ORDER_BY,
                Constants::USER_SORT,
                $female
            );
        $maleUser = $this->userRepository
            ->getUserActivePaginated(
                Constants::DEFAULT_PER_PAGE,
                Constants::USER_ORDER_BY,
                Constants::USER_SORT,
                $male
            );
        $rankData = $this->rankRepository->model()::withTrashed()->get();
        $areaData = $this->areaRepository->all();

        if ($type === Constants::TYPE_MALE) {
            return response()->view(
                'user.male.index',
                [
                    'typeName' => $type,
                    'maleUsers' => $maleUser,
                    'ranks' => $rankData,
                    'areas' => $areaData,
                ]
            );
        }

        return response()->view(
            'user.female.index',
            [
                'typeName' => $type,
                'users' => $femaleUser,
                'ranks' => $rankData,
                'areas' => $areaData,
            ]
        );
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
        $users = $this->userRepository
            ->getFilterPaginated(Constants::DEFAULT_PER_PAGE, Constants::USER_ORDER_BY, Constants::USER_SORT, $request);

        if ((int)$request->type === Constants::USER_FEMALE) {
            return view("user.includes.female.result_search", ['users' => $users]);
        }

        return view("user.includes.male.result_search", ['maleUsers' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param string $type
     * @return Response
     */
    public function create(string $type)
    {
        $selectOption = config('user-profile');
        $rankData = $this->rankRepository->all();
        $areaData = $this->areaRepository->all();
        $prefecture = $this->areaRepository->getPrefectureByAreaID($areaData->first()->id);

        if ($type === Constants::TYPE_FEMALE) {
            return response()->view('user.female.create', [
                'ranks' => $rankData,
                'areas' => $areaData,
                'selectOption' => $selectOption,
                'prefectures' => $prefecture
            ]);
        }
        return response()->view('user.male.create', [
            'ranks' => $rankData,
            'selectOption' => $selectOption,
        ]);
    }

    /**
     * Add new user.
     *
     * @param StoreProductRequest $request
     * @param string $type
     * @return RedirectResponse
     * @throws \Exception
     */
    public function store(StoreProductRequest $request, string $type)
    {
        DB::beginTransaction();
        try {
            $data = $this->userService->convertData($request->all());
            if ($data['type'] == Constants::USER_FEMALE) {
                $this->storeFemale($data);
            } else {
                $this->storeMale($data);
            }//end if

            Session::flash('success_msg', trans('alerts.general.success.created'));
            Session::forget('member_session');
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

    /**
     * @param Request $request
     * @param string $type
     * @return Factory|View|void
     * @throws \Exception
     */
    public function preview(Request $request, string $type)
    {
        try {
            $member = $request->all();
            if (!$member) {
                if (!Session::has('member_session')) {
                    return abort(404);
                } else {
                    $member = Session::get('member_session');
                }
            } else {
                Session::put('member_session', $member);
            }
            $member = (object) $member;
            if ($type === Constants::TYPE_FEMALE) {
                $member = $this->userService->getDataFemaleMember($member);

                return view('user.female.preview', compact('member'));
            } else {
                $member = $this->userService->getDataMaleMember($member);

                return view('user.male.preview', compact('member'));
            }//end if
        } catch (Exception $e) {
            return abort(404);
        }//end try
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param string $type
     * @param int $id
     * @return Response
     */
    public function edit(string $type, int $id)
    {
        if ($type === Constants::TYPE_FEMALE) {
            return $this->editFemale($id);
        }
        return $this->editMale($id);
    }

    /**
     * Update data users.
     *
     * @param UpdateProductRequest $request
     * @param int $id
     * @param string $type
     * @return RedirectResponse
     * @throws \Exception
     */
    public function update(UpdateProductRequest $request, string $type, int $id)
    {
        DB::beginTransaction();
        try {
            $user = $this->userRepository->find($id);
            $this->user = $user;
            $data = $request->all();
            if (isset($data['login-form'])) {
                //update login information
                if (isset($data['password'])) {
                    $this->editPassword($data['password']);
                }
            } elseif (isset($data['register-form'])) {
                //Update register information
                $dataRegister = $request->only(['name', 'rank_id', 'tel', 'line_id', 'expired_at']);
                $this->editRegisterInformation($dataRegister);
            } elseif (isset($data['public-image-form'])) {
                //update public images when submit from public image form
                $dataImage = $request->only(['images', 'nameMedia', 'nameThumbnailMedia']);
                $this->editPublicImage($dataImage, $id);
            } elseif (isset($data['private-image-form'])) {
                //update private images when submit from private image form
                $dataImage = $request->only(['private-images', 'nameMedia', 'nameThumbnailMedia']);
                $this->editPrivateImage($dataImage, $id);
            } elseif (isset($data['video-form'])) {
                //Update Video when submit from video-form
                $dataVideo = $request->only(['videos', 'nameVideos', 'nameThumbnailVideo']);
                $this->editVideo($dataVideo, $id);
            } elseif (isset($data['profile-image-form'])) {
                $dataImage = $request->only(['profile-image', 'old-profile-image']);
                $this->editProfileImage($dataImage, $id, $user->userProfile->id);
            } elseif (isset($data['schedule-form'])) {
                $this->userScheduleService->updateUser($id, $data);
            } else {
                //update profile information when submit from profile-form
                if ($data['type'] == Constants::USER_FEMALE) {
                    $dataProfile = $this->userService->convertData($request->except(
                        ['_token', '_method', 'profile-form', 'area', 'prefecture', 'type']
                    ));
                    $this->editProfile($dataProfile, $data['prefecture'], true);
                } else {
                    $dataProfile = $this->userService->convertData($request->except(
                        ['_token', '_method', 'profile-form', 'type']
                    ));
                    $this->editProfile($dataProfile);
                }
            }//end if

            Session::flash('success_msg', trans('alerts.general.success.updated'));
            DB::commit();

            return redirect()->route('member.index', $type);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('[ERROR_CATEGORY_CREATE]: ' . $e->getMessage());

            return redirect()
                ->route('member.index', $type)
                ->withErrors($e->getMessage());
        }//end try
    }

    /**
     * Delete user.
     *
     * @param int $id
     * @param string $type
     * @return $this|RedirectResponse
     */
    public function destroy(string $type, int $id)
    {
        try {
            $result = $this->userRepository->delete($id);
            if ($result) {
                Session::flash('success_msg', trans('alerts.general.success.leave'));
            }

            return redirect()->route('member.index', $type);
        } catch (Exception $e) {
            Log::error('[DELETE_USER_LOG]: ' . $e->getMessage());

            return redirect()
                ->route('member.index', $type)
                ->withErrors($e->getMessage());
        }
    }

    /**
     * Restore user.
     *
     * @param int $id
     * @param string $type
     * @return $this|RedirectResponse
     */
    public function restore(string $type, int $id)
    {
        try {
            $result = $this->userRepository->restore($id);
            if ($result) {
                Session::flash('success_msg', trans('alerts.general.success.restore'));
            }

            return redirect()->route('member.index', $type);
        } catch (Exception $e) {
            Log::error('[RESTORE_USER_LOG]: ' . $e->getMessage());

            return redirect()
                ->route('member.index', $type)
                ->withErrors($e->getMessage());
        }
    }

    /**
     * Get Data Media
     *
     * @param string $data
     * @param int $id
     * @param string $path
     * @return array
     */
    public function getDataMedia(string $data, int $id, string $path): array
    {
        $now = Carbon::now();
        $mediaValue = explode('|', $data);
        $pathMedia = Media::getPathMedia($path, $id);
        $mediaData = [
            'name' => $mediaValue[0],
            'thumbnail_name' => $mediaValue[1],
            'type' => $mediaValue[2],
            'path' => $pathMedia,
            'size' => $mediaValue[3],
            'thumbnail_size' => $mediaValue[4],
            'created_at' => $now,
            'updated_at' => $now
        ];

        return $mediaData;
    }

    /**
     * Insert images to DB and receiver new ID.
     *
     * @param array $data
     * @param int $userId
     * @param bool $video
     * @return array
     */
    public function getNewIdMedia(array $data, int $userId, bool $video = false): array
    {
        $dataMedia = [];
        $path = Constants::MEDIA_PATH_USER;
        foreach ($data as $value) {
            array_push($dataMedia, $this->getDataMedia($value, $userId, $path));
        }
        if ($video) {
            $idMedia = $this->videoRepository->createManyVideo($dataMedia);
        } else {
            $idMedia = $this->mediaRepository->createManyMedia($dataMedia);
        }

        return $idMedia;
    }

    /**
     * GET name of images to move
     *
     * @param array $data
     * @return array
     */
    public function getNameMedia(array $data): array
    {
        $nameImages = [];

        if (isset($data['videos'])) {
            foreach ($data['videos'] as $value) {
                $mediaValue = explode('|', $value);
                array_push($nameImages, $mediaValue[Constants::KEY_NAME_IMAGE]);
                array_push($nameImages, $mediaValue[Constants::KEY_THUMBNAIL_NAME]);
            }
        }

        if (isset($data['images'])) {
            foreach ($data['images'] as $value) {
                $mediaValue = explode('|', $value);
                array_push($nameImages, $mediaValue[Constants::KEY_NAME_IMAGE]);
                array_push($nameImages, $mediaValue[Constants::KEY_THUMBNAIL_NAME]);
            }
        }

        if (isset($data['private-images'])) {
            foreach ($data['private-images'] as $value) {
                $mediaValue = explode('|', $value);
                array_push($nameImages, $mediaValue[Constants::KEY_NAME_IMAGE]);
                array_push($nameImages, $mediaValue[Constants::KEY_THUMBNAIL_NAME]);
            }
        }

        if (isset($data['profile-image'])) {
            foreach ($data['profile-image'] as $value) {
                $mediaValue = explode('|', $value);
                array_push($nameImages, $mediaValue[Constants::KEY_NAME_IMAGE]);
                array_push($nameImages, $mediaValue[Constants::KEY_THUMBNAIL_NAME]);
            }
        }

        return $nameImages;
    }

    /**
     * Move file
     *
     * @param array $data
     * @param int $id
     * @param string $oldPath
     * @param string $newPath
     */
    public function moveFileMedia(array $data, int $id, string $oldPath, string $newPath)
    {
        foreach ($data as $key => $value) {
            if (Common::isLocalEnv()) {
                Storage::move(Media::getTempPathMedia($oldPath, $value), Media::getPathMedia($newPath, $id, $value));
            } else {
                $this->moveObject(
                    Media::getTempPathMedia($oldPath, $value),
                    Media::getPathMedia($newPath, $id, $value)
                );
            }
        }
    }

    /**
     * Update image for member.
     *
     * @param array $data
     * @param array $dataImage
     * @param int $id
     * @param bool $public
     */
    public function updateImage(array $data, array $dataImage, int $id, $public = true)
    {
        $idMediaPublic = $this->getNewIdMedia($dataImage, $id);
        if (!$public) {
            $data['id_private_images'] = $idMediaPublic;
        } else {
            $data['id_public_images'] = $idMediaPublic;
        }
        $imageMove = Arr::get($data, 'nameMedia', []);
        $thumbnailImageMove = Arr::get($data, 'nameThumbnailMedia', []);
        $dataMove = array_merge($imageMove, $thumbnailImageMove);
        $this->userRepository->createUserRelation($id, $data);
        $this->moveFileUpdate($data, $dataMove, $id);
    }

    /**
     * @param array $data
     * @param array $dataVideo
     * @param int $id
     */
    public function updateVideo(array $data, array $dataVideo, int $id)
    {
        $idVideo = $this->getNewIdMedia($dataVideo, $id, Constants::IS_PUBLIC);
        $data['id_videos'] = $idVideo;
        $videoMove = Arr::get($data, 'nameVideos', []);
        $thumbnailImageMove = Arr::get($data, 'nameThumbnailVideo', []);
        $dataMove = array_merge($videoMove, $thumbnailImageMove);
        $this->userRepository->createUserRelation($id, $data['id_videos'], Constants::MODAL_VIDEO_RELATIONS);
        $this->moveFileUpdate($data, $dataMove, $id);
    }

    /**
     * Move File when edit image or video.
     *
     * @param array $data
     * @param array $dataMove
     * @param int $id
     */
    public function moveFileUpdate(array $data, array $dataMove, int $id)
    {
        $nameMedia = $this->getNameMedia($data);
        $oldPath = Constants::DEFAULT_PUBLIC_PATH;
        $newPath = Constants::MEDIA_PATH_USER;
        if (empty($dataMove)) {
            $this->moveFileMedia($nameMedia, $id, $oldPath, $newPath);
        } else {
            $arrayBefore = array_diff($dataMove, $nameMedia);
            $arrayAfter = array_diff($nameMedia, $dataMove);
            $nameMove = array_merge($arrayBefore, $arrayAfter);
            if (!empty($nameMove)) {
                $this->moveFileMedia($nameMove, $id, $oldPath, $newPath);
            }
        }
    }

    /**
     * View edit female.
     *
     * @param int $id
     * @return Response
     */
    public function editFemale(int $id)
    {
        $selectOption = config('user-profile');
        $ranks = $this->rankRepository->all();
        $user = $this->userRepository->find($id);
        $isPublic = Constants::IMAGE_PUBLISH;
        $isPrivate = Constants::IMAGE_PRIVATE;
        $areas = $this->areaRepository->all();
        $userPrefecture = $user->prefecture->first();
        $areaId = $userPrefecture->area_id;
        $prefectures = $this->areaRepository->getPrefectureByAreaID($areaId);
        $dataProfile = $user->userProfile->media;

        return response()->view('user.female.edit', [
            'user' => $user,
            'ranks' => $ranks,
            'selectOption' => $selectOption,
            'isPublic' => $isPublic,
            'isPrivate' => $isPrivate,
            'areas' => $areas,
            'prefectures' => $prefectures,
            'userPrefecture' => $userPrefecture,
            'dataProfile' => $dataProfile
        ]);
    }

    /**
     * View edit Male.
     *
     * @param int $id
     * @return Response
     */
    public function editMale(int $id)
    {
        $selectOption = config('user-profile');
        $ranks = $this->rankRepository->all();
        $user = $this->userRepository->find($id);
        $isPublic = Constants::IMAGE_PUBLISH;
        $isPrivate = Constants::IMAGE_PRIVATE;
        $dataProfile = $user->userProfile->media;

        return response()->view('user.male.edit', [
            'user' => $user,
            'ranks' => $ranks,
            'selectOption' => $selectOption,
            'isPublic' => $isPublic,
            'isPrivate' => $isPrivate,
            'dataProfile' => $dataProfile
        ]);
    }

    /**
     * Store data female.
     *
     * @param array $data
     * @throws \Exception
     */
    public function storeFemale(array $data)
    {
        $user = $this->userRepository->create($data);
        $userProfileId = $user->userProfile->id;
        $userId = $user->id;
        $this->userRepository->createUserRelation($userId, $data, Constants::MODAL_RELATIONS);
        if ($userSchedule = Arr::get($data, 'user_schedule')) {
            $this->userScheduleService->saveSchedule($userId, $userSchedule);
        }

        $oldPath = Constants::DEFAULT_PUBLIC_PATH;
        $newPath = Constants::MEDIA_PATH_USER;
        if (isset($data['images']) || isset($data['private-images'])
            || isset($data['videos']) || isset($data['profile-image'])) {
            if (isset($data['profile-image'])) {
                $idMediaPublic = $this->getNewIdMedia($data['profile-image'], $userId);
                $dataProfile['profile_id'] = Arr::get($idMediaPublic, 0, null);
                $this->userProfileRepository->update($dataProfile, $userProfileId);
            }

            if (isset($data['images'])) {
                $idMediaPublic = $this->getNewIdMedia($data['images'], $userId);
                $data['id_public_images'] = $idMediaPublic;
            }

            if (isset($data['private-images'])) {
                $idMediaPrivate = $this->getNewIdMedia($data['private-images'], $userId);
                $data['id_private_images'] = $idMediaPrivate;
            }

            if (isset($data['videos'])) {
                $idVideo = $this->getNewIdMedia($data['videos'], $userId, Constants::IS_PUBLIC);
                $data['id_videos'] = $idVideo;
                $this->userRepository
                    ->createUserRelation($userId, $data['id_videos'], Constants::MODAL_VIDEO_RELATIONS);
            }

            $nameMedia = $this->getNameMedia($data);
            $this->userRepository->createUserRelation($userId, $data);
            $this->moveFileMedia($nameMedia, $userId, $oldPath, $newPath);
        }//end if
    }

    /**
     * Store data male.
     *
     * @param array $data
     * @throws \Exception
     */
    public function storeMale(array $data)
    {
        $data['favorite_dating_type'] = isset($data['favorite_dating_type'])
            ? implode(", ", $data['favorite_dating_type']) : null;
        $user = $this->userRepository->create($data);
        $userId = $user->id;
        $userProfileId = $user->userProfile->id;
        $oldPath = Constants::DEFAULT_PUBLIC_PATH;
        $newPath = Constants::MEDIA_PATH_USER;

        if (isset($data['images']) || isset($data['profile-image'])) {
            if (isset($data['images'])) {
                $idMediaPublic = $this->getNewIdMedia($data['images'], $userId);
                $data['id_public_images'] = $idMediaPublic;
                $this->userRepository->createUserRelation($userId, $data);
            }
            if (isset($data['profile-image'])) {
                $idMediaPublic = $this->getNewIdMedia($data['profile-image'], $userId);
                $dataProfile['profile_id'] = Arr::get($idMediaPublic, 0, null);
                $this->userProfileRepository->update($dataProfile, $userProfileId);
            }

            $nameMedia = $this->getNameMedia($data);
            $this->moveFileMedia($nameMedia, $userId, $oldPath, $newPath);
        }//end if
    }

    /**
     * @param string $data
     */
    public function editPassword(string $data)
    {
        $dataLogin['password'] = Hash::make($data);
        $dataLogin['password_changed_at'] = Carbon::now();
        $this->user->update($dataLogin);
    }

    /**
     * @param array $data
     * @throws \Exception
     */
    public function editRegisterInformation(array $data)
    {
        $data['expired_at'] = $data['expired_at'] ? Carbon::parse($data['expired_at']) : null;
        $this->user->userProfile()->update($data);
    }

    /**
     * @param array $dataImage
     * @param int $id
     * @param int $profileId
     * @throws ValidatorException
     */
    public function editProfileImage(array $dataImage, int $id, int $profileId)
    {
        if (isset($dataImage['profile-image']) && !isset($dataImage['old-profile-image'])) {
            $oldPath = Constants::DEFAULT_PUBLIC_PATH;
            $newPath = Constants::MEDIA_PATH_USER;
            $idMediaPublic = $this->getNewIdMedia($dataImage['profile-image'], $id);
            $dataProfile['profile_id'] = Arr::get($idMediaPublic, 0, null);
            $this->userProfileRepository->update($dataProfile, $profileId);
            $nameMedia = $this->getNameMedia($dataImage);
            $this->moveFileMedia($nameMedia, $id, $oldPath, $newPath);
        } elseif (!isset($dataImage['profile-image'])) {
            $dataProfile['profile_id'] = null;
            $this->userProfileRepository->update($dataProfile, $profileId);
        }
    }

    /**
     * @param array $dataImage
     * @param int $id
     */
    public function editPublicImage(array $dataImage, int $id)
    {
        $this->userMediaRepository->deleteWhere(['user_id' => $id, 'type' => Constants::IMAGE_PUBLISH]);
        if (isset($dataImage['images'])) {
            //update if  public images exits
            $this->updateImage($dataImage, $dataImage['images'], $id);
        }
    }

    /**
     * @param array $dataImage
     * @param int $id
     */
    public function editPrivateImage(array $dataImage, int $id)
    {
        $this->userMediaRepository->deleteWhere(['user_id' => $id, 'type' => Constants::IMAGE_PRIVATE]);
        if (isset($dataImage['private-images'])) {
            //update if private image exits
            $this->updateImage($dataImage, $dataImage['private-images'], $id, false);
        }
    }

    /**
     * @param array $dataVideo
     * @param int $id
     */
    public function editVideo(array $dataVideo, int $id)
    {
        $this->userVideoRepository->deleteWhere(['user_id' => $id]);
        if (isset($dataVideo['videos'])) {
            //update if private image exits
            $this->updateVideo($dataVideo, $dataVideo['videos'], $id);
        }
    }

    /**
     * @param array $dataProfile
     * @param string|null $prefecture
     * @param bool $type_user
     */
    public function editProfile(array $dataProfile, string $prefecture = null, bool $type_user = false)
    {
        if ($type_user) {
            $this->user->prefecture()
                ->updateExistingPivot($this->user->prefecture->first()->id, ['prefecture_id' => $prefecture]);
        } else {
            $dataProfile['favorite_dating_type'] = isset($dataProfile['favorite_dating_type'])
                ? implode(", ", $dataProfile['favorite_dating_type']) : null;
        }
        $this->user->userProfile()->update($dataProfile);
    }

    /**
     * @param string $type
     * @param int $id
     * @return Application|Factory|View|void
     */
    public function show(string $type, int $id)
    {
        try {
            $member = $this->userRepository->find($id);
            if (!$member) {
                return abort(404);
            }

            $ranks = $this->rankRepository->getWithTrashed();
            $areas = $this->areaRepository->with('prefectures')->get();
            $selectOption = config('user-profile');

            return view('user.detail', compact(
                'member',
                'ranks',
                'areas',
                'selectOption'
            ));
        } catch (\Exception $e) {
            return abort(404);
        }//end try
    }
}
