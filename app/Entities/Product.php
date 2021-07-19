<?php

namespace App\Entities;

use App\Traits\Scope\ProductScope;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;
use \Illuminate\Database\Eloquent\Relations\BelongsToMany;
use \Illuminate\Database\Eloquent\Relations\HasMany;
use App\Traits\FullTextSearch;

/**
 * Class Product.
 *
 * @package namespace App\Entities;
 */
class Product extends Model implements Transformable
{
    use TransformableTrait, ProductScope, FullTextSearch;


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
        'best_seller',
        'featured',
        'deal_of_week',
        'status',
        'alias',
        'store_id'
    ];

    /**
     * @var array
     */
    protected $searchable = [
        'name',
        'description',
        'content'
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

    /**
     * @return HasMany
     */
    public function comment()
    {
        return $this->hasMany('App\Entities\ProductComment', 'product_id');
    }

    /**
     * @return BelongsToMany
     */
    public function tag()
    {
        return $this->belongsToMany('App\Entities\Tag', 'product_tag', 'product_id', 'tag_id')
           ->withTimestamps();
    }


    /**
     * @return mixed|string'
     */
    public function getFirstImageAttribute()
    {
        $image = explode(',', $this->image);

        return $image[0];
    }

    public function getPercentSaleAttribute()
    {
        return 100 - (($this->discount_price)*100)/$this->price;
    }

}
