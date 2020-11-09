<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class UserOffer.
 *
 * @package namespace App\Entities;
 */
class UserOffer extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'user_offers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'offer_id',
        'user_id'
    ];

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Entities\User');
    }

    public function getNameOfferAttribute()
    {
        return $this->user->userProfile->name;
    }
}
