<?php

namespace App\Repositories;

use App\Helpers\Constants;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Entities\Balance;

/**
 * Class BalanceRepository
 * @package App\Repositories
 */
class BalanceRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Balance::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Get balance with pagination.
     *
     * @param int $paged
     * @param string $orderBy
     * @param string $sort
     * @return LengthAwarePaginator
     */
    public function getBalancePaginated(int $paged, string $orderBy, string $sort)
    {
        return $this->model
            ->with('user', 'user.userProfile')
            ->userStatus(Constants::USER_PUBLIC)
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    /**
     * Get balances with filter condition.
     *
     * @param int $paged
     * @param string $orderBy
     * @param string $sort
     * @param array $dataFilter
     * @return mixed
     */
    public function filterBalance(int $paged, string $orderBy, string $sort, array $dataFilter)
    {
        return $this->model
            ->with('user', 'user.userProfile')
            ->userEmail($dataFilter['email'])
            ->userId($dataFilter['id'])
            ->dateTime($dataFilter['dateFrom'], $dataFilter['dateTo'])
            ->adjustment($dataFilter['adjustment'])
            ->userStatus($dataFilter['status'])
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }
}
