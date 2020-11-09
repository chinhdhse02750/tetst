<?php

namespace App\Repositories;

use App\Helpers\Constants;
use Illuminate\Support\Arr;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Entities\Offer;
use App\Validators\OfferValidator;

/**
 * Class OfferRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class OfferRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Offer::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Search offer function.
     *
     * @param array $dataSearch
     * @return mixed
     */
    public function search(array $dataSearch)
    {
        return Offer::idMember(Arr::get($dataSearch, 'id'))
            ->email(Arr::get($dataSearch, 'email'))
            ->time(Arr::get($dataSearch, 'dateFrom'), Arr::get($dataSearch, 'dateTo'))
            ->rank(Arr::get($dataSearch, 'ranks'))
            ->orderBy(Constants::TIME_ORDER_BY, Constants::FILTER_DEFAULT_SORT_ORDER)
            ->paginate(Constants::DEFAULT_PER_PAGE);
    }
}
