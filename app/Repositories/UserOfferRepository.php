<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Entities\UserOffer;
use App\Validators\UserOfferValidator;

/**
 * Class UserOfferRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class UserOfferRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return UserOffer::class;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function createManyOffer(array $data)
    {
        return $this->model()::insert($data);
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
