<?php

namespace App\Repositories;

use App\Entities\UserPrefecture;
use App\Entities\Prefecture;
use App\Helpers\Constants;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class UserPrefectureRepository
 * @package App\Repositories
 */
class UserPrefectureRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return UserPrefecture::class;
    }

    /**
     * Total active user by Area function
     *
     * @return \Illuminate\Support\Collection
     */
    public function totalUserByPrefectures()
    {
        $activeUsers = DB::table('users')
            ->where('active', '=', Constants::USER_PUBLIC)
            ->where('type', '!=', Auth::user()->type)
            ->where('deleted_at', null)
            ->get();
        $activeUserIds = array_column($activeUsers->toArray(), 'id');
        $userPrefectures = DB::table('prefectures')
            ->leftJoin('user_prefectures', 'prefectures.id', '=', 'user_prefectures.prefecture_id')
            ->whereIn('user_prefectures.user_id', $activeUserIds)
            ->select(DB::raw(' count(*) as total, user_prefectures.prefecture_id, prefectures.name'))
            ->groupBy('prefecture_id')
            ->get();

        $userPrefectures['total'] = $activeUsers->count();

        return $userPrefectures;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
