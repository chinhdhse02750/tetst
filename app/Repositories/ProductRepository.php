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
    public function getListProduct()
    {
        return $this->model
            ->with([
                'units',
                'category',
            ])
            ->isActive()
            ->orderBy('created_at', 'DESC')
            ->get();
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
            ->isActive()
            ->promotion()
            ->orderBy('updated_at', 'DESC')
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
            ->isActive()
            ->dealOfWeek()
            ->orderBy('updated_at', 'DESC')
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
            ->isActive()
            ->featured()
            ->orderBy('updated_at', 'DESC')
            ->paginate($paged);
    }


    /**
     * @return mixed
     */
    public function getSaleProduct($filter)
    {
        return $this->model
            ->with([
                'units',
                'category',
            ])
            ->isActive()
            ->promotion()
            ->order($filter['sort'], $filter['condition'])
            ->filterPrice($filter['min'], $filter['max'])
            ->paginate($filter['page']);
    }

    /**
     * @param $filter
     * @return mixed
     */
    public function getListOrder($filter)
    {
        return $this->model
            ->with([
                'units',
                'category',
            ])
            ->isActive()
            ->order($filter['sort'], $filter['condition'])
            ->filterPrice($filter['min'], $filter['max'])
            ->paginate($filter['page']);
    }

    /**
     * @param int $paged
     * @return mixed
     */
    public function getListNewProduct(int $paged = Constants::MEMBER_LIST_PER_PAGE)
    {
        return $this->model
            ->isActive()
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
    public function getListProductByCategory($filter, $cateId)
    {
        return $this->model
            ->with([
                'units',
                'category',
            ])
            ->isActive()
            ->category($cateId)
            ->order($filter['sort'], $filter['condition'])
            ->filterPrice($filter['min'], $filter['max'])
            ->paginate($filter['page']);
    }


    /**
     * @param $filter
     * @param $cateId
     * @param int $paged
     * @return mixed
     */
    public function getListProductByTag($filter, $tagId)
    {
        return $this->model
            ->with([
                'units',
                'tag',
            ])
            ->isActive()
            ->tag($tagId)
            ->order($filter['sort'], $filter['condition'])
            ->filterPrice($filter['min'], $filter['max'])
            ->paginate($filter['page']);
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
            ->isActive()
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
            ->isActive()
            ->bestSeller()
            ->orderBy('sold', 'DESC')
            ->paginate($paged);
    }


    /**
     * @param array $filter
     * @param int $type
     * @param string $search
     * @param int $paged
     * @param string $orderBy
     * @param string $sort
     * @return mixed
     */
    public function filter(
        string $search = '',
        $filter,
        int $paged = Constants::MEMBER_LIST_PER_PAGE
    ) {
        return $this->model
            ->with([
                'units',
                'category',
            ])
            ->isActive()
            ->search($search)
            ->order($filter['sort'], $filter['condition'])
            ->filterPrice($filter['min'], $filter['max'])
            ->paginate($paged);
    }


    /**
     * @param string $search
     * @param int $paged
     * @param string $orderBy
     * @param string $sort
     * @return mixed
     */
    public function getFilterPaginated(
        string $search = '', int $status,
        int $paged, string $orderBy, string $sort
    ) {
        return $this->model
            ->with([
                'units',
                'category',
            ])
            ->status($status)
            ->name($search)
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }
}
