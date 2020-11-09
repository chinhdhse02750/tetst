<?php

namespace App\Entities;

use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class UserFavorite
 * @package App\Entities
 */
class UserFavorite extends Authenticatable implements Transformable
{
    use TransformableTrait;

    /**
     * @var string
     */
    protected $table = 'user_favorites';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'favorite_id'
    ];
}
