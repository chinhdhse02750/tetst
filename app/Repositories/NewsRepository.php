<?php

namespace App\Repositories;

use App\Entities\News;
use App\Helpers\Constants;
use Illuminate\Support\Arr;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class NewsRepository.
 *
 * @package namespace App\Repositories;
 */
class NewsRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return News::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function search(array $dataSearch)
    {
        return News::active(Arr::get($dataSearch, 'active'))
            ->time(Arr::get($dataSearch, 'start_time'), Arr::get($dataSearch, 'end_time'))
            ->orderBy(Constants::TIME_ORDER_BY, Constants::FILTER_DEFAULT_SORT_ORDER)
            ->paginate(Constants::DEFAULT_PER_PAGE);
    }
}
