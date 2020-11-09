<?php

namespace App\Repositories;

use App\Entities\Area;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class AreaRepository
 * @package App\Repositories
 */
class AreaRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Area::class;
    }

    /**
     * Get prefecture.
     *
     * @param int $id
     * @return mixed
     */
    public function getPrefectureByAreaID(int $id)
    {
        $pre = $this->model()::with('prefectures')->find($id);

        return $pre->prefectures;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
