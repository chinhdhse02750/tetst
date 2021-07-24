<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Order.
 *
 * @package namespace App\Entities;
 */
class Order extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'orders';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'subtotal',
        'shipping',
        'daibiky',
        'discount',
        'time_shipping',
        'status',
        'tax',
        'total',
        'full_name',
        'facebook',
        'address',
        'pref_id',
        'postcode',
        'phone',
        'email',
        'comment',
        'payment_method',
        'payment_status',
        'shipping_method',
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pref()
    {
        return $this->belongsTo('App\Entities\Pref');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function orderDetail()
    {
        return $this->belongsTo('App\Entities\OrderDetail');
    }
}
