<?php

namespace App\Repositories;

use App\Helpers\Constants;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Prettus\Repository\Eloquent\BaseRepository;
use App\Entities\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class UserRepository
 * @package App\Repositories
 */
class UserRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    /**
     * Create new User with relation profile
     *
     * @param array $data
     * @return mixed
     * @throws \Exception
     */
    public function create(array $data)
    {
        $user = $this->model()::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'uuid' => uniqid(),
            'active' => $data['active_user'],
            'type' => $data['type']
        ]);
        if ($data['type'] == Constants::USER_MALE) {
            $userProfile = $this->getDataMaleUserProfile($data);
        } else {
            $userProfile = $this->getDataUserProfile($data);
        }
        $user->userProfile()->create($userProfile);

        return $user;
    }

    /**
     * Relation for user
     *
     * @param int $userId
     * @param array $data
     * @param String $model
     */
    public function createUserRelation(int $userId, array $data, String $model = "medias")
    {
        $user = $this->model()::find($userId);
        if ($model === Constants::MODAL_RELATIONS) {
            $userPrefecture = $this->getDataPrefecture($data['prefecture']);
            $user->prefecture()->attach($userPrefecture);
        } elseif ($model === Constants::MODAL_VIDEO_RELATIONS) {
            $userVideo = $this->getDataVideo($data);
            $user->videos()->attach($userVideo);
        } else {
            $userMedia = $this->getDataUserMedia($data);
            $user->medias()->attach($userMedia);
        }
    }

    /**
     * Get data user profiles
     *
     * @param array $data
     * @return array
     * @throws \Exception
     */
    public function getDataUserProfile(array $data): array
    {
        return [
            'admin_id' => Auth::id(),
            'rank_id' => $data['rank'],
            'name' => $data['name'],
            'tel' => $data['tel'],
            'line_id' => $data['line_id'],
            'expired_at' => $data['expired'] ? Carbon::parse($data['expired']) : null,
            'age' => $data['age'],
            'height' => $data['height'],
            'weight' => $data['weight'],
            'underwear_type' => $data['underwear_type'],
            'rating_star' => $data['rating_star'],
            'dating_type' => $data['dating_type'],
            'sign' => $data['sign'],
            'blood_type' => $data['blood_type'],
            'occupation' => $data['occupation'],
            'smoking' => $data['smoking'],
            'alcohol' => $data['alcohol'],
            'address' => $data['address'],
            'conversation_lang' => $data['conversation_lang'],
            'hobby' => $data['hobby'],
            'offer' => $data['offer'],
            'tag' => $data['tag'],
            'comment' => $data['comment'],
            'club_comment' => $data['club_comment'],
            'is_publish' => $data['active_user'],
            'is_pickup' => Arr::get($data, 'pickup', 0),
            'label_type' => $data['label_type'],
            'label_title' => $data['label_title'],
            'label_color_code' => $data['label_color_code'],
        ];
    }

    public function getDataMaleUserProfile(array $data): array
    {
        return [
            'admin_id' => Auth::id(),
            'rank_id' => $data['rank'],
            'name' => $data['name'],
            'tel' => $data['tel'],
            'line_id' => $data['line_id'],
            'expired_at' => $data['expired'] ? Carbon::parse($data['expired']) : null,
            'birthday' => $data['birthday'] ? Carbon::parse($data['birthday']) : null,
            'male_age' => $data['male_age'],
            'favorite_dating_type' => $data['favorite_dating_type'],
            'blood_type' => $data['blood_type'],
            'occupation' => $data['occupation'],
            'male_smoking' => $data['male_smoking'],
            'male_alcohol' => $data['male_alcohol'],
            'address' => $data['address'],
            'hobby' => $data['hobby'],
            'income' => $data['income'],
            'is_publish' => $data['is_publish'],
            'is_pickup' => Arr::get($data, 'pickup', 0),
            'comment' => $data['comment']
        ];
    }

    /**
     * Get data user rank.
     *
     * @param int $id
     * @return array
     */
    public function getDataUserRank(int $id): array
    {
        $userRank = ['rank_id' => $id];

        return $userRank;
    }

    /**
     * get data user prefecture.
     *
     * @param int $id
     * @return array
     */
    public function getDataPrefecture(int $id)
    {
        $userPrefecture = ['prefecture_id' => $id];

        return $userPrefecture;
    }

    /**
     * Get data user media
     *
     * @param array $data
     * @return array
     */
    public function getDataUserMedia(array $data): array
    {
        $publicMedia = [];
        $privateMedia = [];
        if (isset($data['id_public_images'])) {
            $publicMedia = $this->fillDataUserMedia($data['id_public_images'], false);
        }

        if (isset($data['id_private_images'])) {
            $privateMedia = $this->fillDataUserMedia($data['id_private_images']);
        }

        $userMedia = array_merge($publicMedia, $privateMedia);

        return $userMedia;
    }

    /**
     * @param array $data
     * @return array
     */
    public function getDataVideo(array $data): array
    {
        $videoData = [];
        foreach ($data as $key => $value) {
            $arrayVideo = [
                'video_id' => $value,
            ];
            array_push($videoData, $arrayVideo);
        }

        return $videoData;
    }

    /**
     * Pagination
     *
     * @param int $paged
     * @param string $orderBy
     * @param string $sort
     * @param int $type
     * @return LengthAwarePaginator
     */
    public function getUserActivePaginated(
        int $paged,
        string $orderBy,
        string $sort,
        int $type = Constants::NOT_TYPE_USER
    ) {
        return $this->model()
            ::withTrashed()
            ->with('userProfile', 'balances', 'prefecture', 'userProfile.rank')
            ->active(Constants::USER_PUBLIC)
            ->type($type)
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    /**
     * get all User active.
     *
     * @return mixed
     */
    public function getAllUserActive()
    {
        return $this->model
            ->with('userProfile')
            ->withTrashed()
            ->active(Constants::USER_PUBLIC)
            ->get();
    }

    /**
     * @param int $paged
     * @param string $orderBy
     * @param string $sort
     * @param Request $request
     * @return mixed
     */
    public function getFilterPaginated(int $paged, string $orderBy, string $sort, Request $request)
    {
        return $this->model
            ->with('userProfile', 'balances', 'userPrefecture', 'prefecture')
            ->withTrashed()
            ->status($request->status)
            ->type($request->type)
            ->name($request->name)
            ->email($request->email)
            ->idNumber($request->id)
            ->dateTime($request->dateFrom, $request->dateTo)
            ->rank($request->rank)
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    /**
     * fill data user media
     *
     * @param array $data
     * @param bool $private
     * @return array
     */
    public function fillDataUserMedia(array $data, bool $private = true): array
    {
        $arrayMedia = [];
        $type = Constants::IMAGE_PUBLISH;
        if ($private) {
            $type = Constants::IMAGE_PRIVATE;
        }

        $idMedia = $data;
        foreach ($idMedia as $key => $value) {
            $dataMedia = [
                'media_id' => $value,
                'type' => $type,
                'order' => $key + 1
            ];
            array_push($arrayMedia, $dataMedia);
        }

        return $arrayMedia;
    }

    /**
     * Get list user active by type function.
     *
     * @param int $type
     * @param int|null $limit
     * @param string $orderBy
     * @param string $sort
     * @return mixed
     */
    public function getListUserActiveByType(
        int $type,
        $limit,
        string $orderBy = 'created_at',
        string $sort = 'DESC'
    ) {
        return $this->model
            ->with([
                'userProfile',
                'medias' => function ($query) {
                    $query->where('user_medias.type', '=', constants::PUBLIC_MEDIA_TYPE);
                },
            ])
            ->active(Constants::USER_PUBLIC)
            ->reverseType($type)
            ->orderBy($orderBy, $sort)
            ->limit($limit)
            ->get();
    }

    /**
     * Restore soft delete.
     *
     * @param int $id
     *
     * @return mixed
     */
    public function restore(int $id)
    {
        return $this->model()::withTrashed()->find($id)->restore();
    }
}
