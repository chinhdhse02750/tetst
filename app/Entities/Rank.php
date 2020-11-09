<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class Rank
 * @package App\Entities
 */
class Rank extends Authenticatable implements Transformable
{
    use TransformableTrait, SoftDeletes;

    protected $table = 'ranks';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name_jp',
        'name_en',
        'amount',
        'priority',
        'color_code'
    ];

    public function userProfile()
    {
        return $this->hasMany('App\Entities\UserProfile');
    }

    /**
     * Get name attribute.
     *
     * @return mixed
     */
    public function getNameAttribute()
    {
        $locale = App::getLocale();
        if ($locale === 'en') {
            return $this->name_en;
        }

        return $this->name_jp;
    }

    /**
     * Get amount label attribute.
     *
     * @return string
     */
    public function getAmountLabelAttribute()
    {
        return number_format($this->amount).' P';
    }

    /**
     * Get rank button attribute.
     *
     * @return string
     */
    public function getRankButtonAttribute()
    {
        return '<button class="button__user-type button__user-type-item--square text--small"
                style="background: ' . $this->color_code . '">' .  $this->name .
                '</button>';
    }
}
