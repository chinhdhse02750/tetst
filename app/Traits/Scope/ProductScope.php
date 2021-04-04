<?php

namespace App\Traits\Scope;

use App\Helpers\Constants;
use Illuminate\Support\Facades\DB;

trait ProductScope
{
    /**
     * @param object $query
     * @return mixed
     */
    public function scopePromotion(object $query)
    {
        return $query->whereNotNull('discount_price');
    }

    /**
     * @param object $query
     * @return mixed
     */
    public function scopeDealOfWeek(object $query)
    {
        return $query->where('deal_of_week', 1);
    }

    /**
     * @param object $query
     * @return mixed
     */
    public function scopeBestSeller(object $query)
    {
        return $query->where('best_seller', 1);
    }

    /**
     * @param object $query
     * @return mixed
     */
    public function scopeFeatured(object $query)
    {
        return $query->where('featured', 1);
    }


    /**
     * @param object $query
     * @param $order
     * @param $condition
     * @return mixed
     */
    public function scopeOrder(object $query, $order, $condition)
    {
        if ($order === "discount_price") {
            return $query->orderByRaw("COALESCE(discount_price, price) $condition");
        }

        return $query->orderBy($order, $condition);
    }

    /**
     * @param object $query
     * @param $cateId
     * @return mixed
     */
    public function scopeCategory(object $query, $cateId)
    {
        return $query->whereHas('category', function ($q) use ($cateId) {
            $q->whereIn('category_id', $cateId);
        });
    }


    /**
     * @param object $query
     * @param $cateId
     * @return mixed
     */
    public function scopeTag(object $query, $tagId)
    {
        return $query->whereHas('tag', function ($q) use ($tagId) {
            $q->where('tag_id', $tagId);
        });
    }
    /**
     * @param object $query
     * @param $alias
     * @return mixed
     */
    public function scopeWhereAlias(object $query, $alias)
    {
        return $query ->where('alias', 'like', "%" . $alias . "%");
    }

    /**
     * @param object $query
     * @param $minPrice
     * @param $maxPrice
     * @return object
     */
    public function scopeFilterPrice(object $query, $minPrice, $maxPrice)
    {
        if ((isset($minPrice) && $minPrice != 0) || ((isset($maxPrice) && $maxPrice != 0))) {
            return $query->where(DB::raw('COALESCE(discount_price, price)'), '>', $minPrice)
                ->where(DB::raw('COALESCE(discount_price, price)'), '<', $maxPrice);
        }

        return $query;
    }

}
