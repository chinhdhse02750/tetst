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
     * @param int $paged
     * @return mixed
     */
    public function getListFeatured(int $paged = Constants::MEMBER_LIST_PER_PAGE)
    {
        return $this->model
            ->with([
                'units',
                'category',
            ])
            ->featured()
            ->orderBy('created_at', 'DESC')
            ->paginate($paged);
    }

    /**
     * @param $filter
     * @param int $paged
     * @return mixed
     */
    public function getListOrder($filter, int $paged = Constants::MEMBER_LIST_PER_PAGE)
    {
        return $this->model
            ->with([
                'units',
                'category',
            ])
            ->order($filter['sort'], $filter['condition'])
            ->filterPrice($filter['min'], $filter['max'])
            ->paginate($paged);
    }

    /**
     * @param int $paged
     * @return mixed
     */
    public function getListNewProduct(int $paged = Constants::MEMBER_LIST_PER_PAGE)
    {
        return $this->model
            ->orderBy('created_at', $direction = 'DESC')
            ->with('units')
            ->with('category')
            ->paginate($paged);
    }

    /**
     * @param $filter
     * @param $cateId
     * @param int $paged
     * @return mixed
     */
    public function getListProductByCategory($filter, $cateId, int $paged = Constants::MEMBER_LIST_PER_PAGE)
    {
        return $this->model
            ->with([
                'units',
                'category',
            ])
            ->category($cateId)
            ->order($filter['sort'], $filter['condition'])
            ->filterPrice($filter['min'], $filter['max'])
            ->paginate($paged);
    }

    /**
     * @param $order
     * @param $condition
     * @param $cateId
     * @param int $paged
     * @param $data
     * @return mixed
     */
    public function getListProductWithCondition(
        $data,
        $condition,
        $cateId,
        int $paged = Constants::MEMBER_LIST_PER_PAGE
    ) {
        return $this->model
            ->with([
                'units',
                'category',
            ])
            ->category($cateId)
            ->filterPrice(
                isset($data['min-price']) ? $data['min-price'] : null,
                isset($data['max-price']) ? $data['max-price'] : null
            )
            ->order(isset($data['order_by']) ? $data['order_by'] : null, $condition)
            ->paginate($paged);
    }


    /**
     * @param int $paged
     * @return mixed
     */
    public function getListBestSeller(int $paged = Constants::MEMBER_LIST_PER_PAGE)
    {
        return $this->model
            ->with([
                'units',
                'category',
            ])
            ->orderBy('sold', 'DESC')
            ->paginate($paged);
    }
}
