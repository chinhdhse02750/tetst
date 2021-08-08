<?php

namespace App\Repositories;

use App\Entities\ListBanner;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Prettus\Repository\Eloquent\BaseRepository;

class ListBannerRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ListBanner::class;
    }
    /**
     * @param int $paged
     * @param string $orderBy
     * @param string $sort
     * @return LengthAwarePaginator
     */
    public function getBannerPaginated(int $paged, string $orderBy, string $sort)
    {
        return $this->model
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }
}
