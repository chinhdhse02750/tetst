<?php

namespace App\Repositories;

use App\Entities\Rank;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class RankRepository
 * @package App\Repositories
 */
class RankRepository extends BaseRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Rank::class;
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

    /**
     * Get ranks with trashed.
     *
     * @return mixed
     */
    public function getWithTrashed()
    {
        return $this->model()::withTrashed()->get();
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
