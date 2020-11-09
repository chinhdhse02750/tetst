<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Payments.
 *
 * @package namespace App\Entities;
 */
class Payments extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'payments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'offer_id',
        'transaction_id',
        'transaction_type',
        'payment_type',
        'payment_amount',
        'payment_fee',
        'payment_tax',
        'currency_code',
        'exchange_rate',
        'payment_status',
        'pending_reason',
        'reason_code',
        'seller_paypal_account',
        'seller_paypal_ack'
    ];
}
