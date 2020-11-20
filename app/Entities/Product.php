<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;
use \Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Product.
 *
 * @package namespace App\Entities;
 */
class Product extends Model implements Transformable
{
    use TransformableTrait;


    protected $table = 'products';
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
        'store_id',
        'category_id'
    ];

    /**
     * @return BelongsTo
     */
    public function units()
    {
        return $this->belongsTo('App\Entities\Unit', 'unit_id');
    }


    /**
     * @return BelongsToMany
     */
    public function category()
    {
        return $this->belongsToMany('App\Entities\Category', 'product_category', 'product_id', 'category_id')
            ->withTimestamps();
    }

}
