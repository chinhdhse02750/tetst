<?php

namespace App\Repositories;

use App\Entities\Blog;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Prettus\Repository\Eloquent\BaseRepository;

class BlogRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Blog::class;
    }

    /**
     * @param int $paged
     * @param string $orderBy
     * @param string $sort
     * @return LengthAwarePaginator
     */
    public function getBlogsPaginated(int $paged, string $orderBy, string $sort)
    {
        return $this->model
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }
}
