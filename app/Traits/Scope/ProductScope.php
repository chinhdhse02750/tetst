<?php

namespace App\Traits\Scope;

use App\Helpers\Constants;

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

    public function scopeOrder(object $query, $order, $condition)
    {
        if ($order === "discount_price") {
            return $query->orderByRaw("COALESCE(discount_price, price) $condition");
        }

        return $query->orderBy($order, $condition);
    }

}
