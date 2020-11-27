<?php

namespace App\Repositories;

use App\Helpers\Constants;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Entities\Product;


/**
 * Class ProductRepository.
 *
 * @package namespace App\Repositories;
 */
class ProductRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Product::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * @return mixed
     */
    public function getListSaleProduct()
    {
        return $this->model
            ->with([
                'units',
                'category',
            ])
            ->promotion()
            ->orderBy('created_at', 'DESC')
            ->get();
    }

    /**
     * @return mixed
     */
    public function getListDealOfWeek()
    {
        return $this->model
            ->with([
                'units',
                'category',
            ])
            ->dealOfWeek()
            ->orderBy('created_at', 'DESC')
            ->get();
    }

    /**
     * @return mixed
     */
    public function getListFeatured()
    {
        return $this->model
            ->with([
                'units',
                'category',
            ])
            ->featured()
            ->orderBy('created_at', 'DESC')
            ->get();
    }

    public function getListOrder($order, $condition, int $paged = Constants::MEMBER_LIST_PER_PAGE)
    {
        return $this->model
            ->with([
                'units',
                'category',
            ])
            ->order($order, $condition)
            ->paginate($paged);
    }
}
