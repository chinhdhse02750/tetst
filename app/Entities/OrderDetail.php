<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class OrderDetail.
 *
 * @package namespace App\Entities;
 */
class OrderDetail extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'order_details';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id',
        'product_id',
        'name',
        'price',
        'qty',
        'total_price',
        'tax'
    ];

}
