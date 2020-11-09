<?php

namespace App\Entities;

use App\Traits\Scope\OfferScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Offer.
 *
 * @package namespace App\Entities;
 */
class Offer extends Model implements Transformable
{
    use TransformableTrait, OfferScope;

    protected $table = 'offers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'public_id',
        'candidate_setting_option_1',
        'candidate_setting_option_2',
        'desired_option_1',
        'desired_option_2',
        'desired_option_3',
        'desired_option_4',
        'desired_option_5',
        'desired_content',
        'request_option',
        'request_other',
        'request_admin',
        'payment_method',
        'payment_link',
        'payment_link_token',
        'payment_link_expired',
        'status',
        'reject_message',
        'rejected_at'
    ];

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Entities\User', 'user_id');
    }

    /**
     * @return HasMany
     */
    public function userOffers()
    {
        return $this->hasMany('App\Entities\UserOffer', 'offer_id');
    }

    /**
     * @return int|void
     */
    public function getTotalMemberAttribute()
    {
        return count($this->userOffers);
    }

    /**
     * @return MorphOne
     */
    public function balance()
    {
        return $this->morphOne('App\Entities\Balance', 'model');
    }
}
