<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Prefecture
 * @package App\Entities
 */
class Prefecture extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'area_id', 'name'
    ];

    public function area()
    {
        return $this->belongsTo('App\Entities\Area');
    }

    /**
     * @return HasMany
     */
    public function userPrefecture()
    {
        return $this->hasMany('App\Entities\UserPrefecture');
    }
}
