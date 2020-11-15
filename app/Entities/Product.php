<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Product.
 *
 * @package namespace App\Entities;
 */
class Product extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type_id',
        'unit_id',
        'name',
        'description',
        'content',
        'discount_price',
        'image',
        'brand_id',
        'supplier_id',
        'price',
        'cost',
        'stock',
        'sold',
        'status',
        'alias',
        'category_store_id',
        'store_id'
    ];


    public function products()
    {
        return $this->belongsToMany('App\Product');
    }
}
