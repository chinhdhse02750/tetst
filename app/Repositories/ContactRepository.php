<?php

namespace App\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Entities\Contact;

/**
 * Class ContactRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ContactRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Contact::class;
    }

    /**
     * @param int $paged
     * @param string $orderBy
     * @param string $sort
     * @return LengthAwarePaginator
     */
    public function getContactPaginated(int $paged, string $orderBy, string $sort)
    {
        return $this->model
            ->with('user')
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
