<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Entities\Admin;

/**
 * Class AdminRepository
 * @package App\Repositories
 */
class AdminRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Admin::class;
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
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
