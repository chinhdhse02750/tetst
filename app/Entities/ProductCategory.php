<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class ProductCategory.
 *
 * @package namespace App\Entities;
 */
class ProductCategory extends Model implements Transformable
{
    use TransformableTrait;


    protected $table = 'product_category';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id',
        'category_id',
    ];

}
