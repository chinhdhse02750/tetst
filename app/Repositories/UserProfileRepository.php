<?php

namespace App\Repositories;

use App\Helpers\Constants;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Entities\UserProfile;
use App\Validators\UserProfileValidator;

/**
 * Class UserProfileRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class UserProfileRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return UserProfile::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Get list user active by type function.
     *
     * @param int $type
     * @param string $search
     * @param int $paged
     * @param string $orderBy
     * @param string $sort
     * @return mixed
     */
    public function getListUserActiveByType(
        int $type,
        string $search = '',
        int $paged = Constants::MEMBER_LIST_PER_PAGE,
        string $orderBy = Constants::TIME_ORDER_BY,
        string $sort = Constants::USER_SORT
    ) {
        return $this->model
            ->with([
                'rank',
                'user.videos',
                'user.medias',
            ])
            ->active(Constants::USER_PUBLIC)
            ->reverseType($type)
            ->search($search)
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    /**
     * @param array $filter
     * @param int $type
     * @param string $search
     * @param int $paged
     * @param string $orderBy
     * @param string $sort
     * @return mixed
     */
    public function filter(
        array $filter,
        int $type,
        string $search = '',
        int $paged = Constants::MEMBER_LIST_PER_PAGE,
        string $orderBy = Constants::TIME_ORDER_BY,
        string $sort = Constants::USER_SORT
    ) {
        return $this->model
            ->with([
                'rank',
                'media',
                'user.prefecture',
                'user.videos',
                'user.medias',
            ])
            ->active(Constants::USER_PUBLIC)
            ->reverseType($type)
            ->search($search)
            ->isPickup(Arr::get($filter, 'pick_up', 0))
            ->labelType(Arr::get($filter, 'label_type'))
            ->prefectures(Arr::get($filter, 'prefecture_ids'))
            ->underwearType(Arr::get($filter, 'underwear_types'))
            ->datingType(Arr::get($filter, 'dating_types'))
            ->rank(Arr::get($filter, 'rank_ids'))
            ->smoking(Arr::get($filter, 'smoking', Constants::FILTER_CHECK_ALL_SMOKING))
            ->alcohol(Arr::get($filter, 'alcohol', Constants::FILTER_CHECK_ALL_ALCOHOL))
            ->age(Arr::get($filter, 'ages'))
            ->height(Arr::get($filter, 'heights'))
            ->maleAge(Arr::get($filter, 'male_ages'))
            ->favoriteDatingType(Arr::get($filter, 'favorite_dating_types'))
            ->maleSmoking(Arr::get($filter, 'male_smoking'))
            ->orderBy($orderBy, Arr::get($filter, 'sort', $sort))
            ->paginate($paged);
    }

    /**
     * Filter Favorite Member.
     *
     * @param array $filter
     * @param int $type
     * @param int $paged
     * @param string $orderBy
     * @param string $sort
     * @return mixed
     */
    public function filterFavorite(
        array $filter,
        int $type,
        int $paged = Constants::MEMBER_LIST_PER_PAGE,
        string $orderBy = Constants::TIME_ORDER_BY,
        string $sort = Constants::USER_SORT
    ) {
        return $this->model
            ->with([
                'rank',
                'media',
                'user.prefecture',
                'user.videos',
                'user.medias',
                'user.favorites' => function ($q) {
                    $q->where('user_id', '=', Auth::id());
                }
            ])
            ->favorite()
            ->active(Constants::USER_PUBLIC)
            ->reverseType($type)
            ->isPickup(Arr::get($filter, 'pick_up', 0))
            ->labelType(Arr::get($filter, 'label_type'))
            ->prefectures(Arr::get($filter, 'prefecture_ids'))
            ->underwearType(Arr::get($filter, 'underwear_types'))
            ->datingType(Arr::get($filter, 'dating_types'))
            ->rank(Arr::get($filter, 'rank_ids'))
            ->smoking(Arr::get($filter, 'smoking', Constants::FILTER_CHECK_ALL_SMOKING))
            ->alcohol(Arr::get($filter, 'alcohol', Constants::FILTER_CHECK_ALL_ALCOHOL))
            ->age(Arr::get($filter, 'ages'))
            ->height(Arr::get($filter, 'heights'))
            ->maleAge(Arr::get($filter, 'male_ages'))
            ->favoriteDatingType(Arr::get($filter, 'favorite_dating_types'))
            ->maleSmoking(Arr::get($filter, 'male_smoking'))
            ->orderBy($orderBy, Arr::get($filter, 'sort', $sort))
            ->paginate($paged);
    }
}
