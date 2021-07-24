<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Shipping.
 *
 * @package namespace App\Entities;
 */
class Shipping extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['pref_id', 'price'];

    /**
     * @return BelongsTo
     */
    public function pref()
    {
        return $this->belongsTo('App\Entities\Pref');
    }

    public function price()
    {
        return $this->price;
    }
}
