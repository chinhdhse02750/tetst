<?php

namespace App\Entities;

use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class UserMedia
 * @package App\Entities
 */
class UserMedia extends Authenticatable implements Transformable
{
    use TransformableTrait;

    /**
     * @var string
     */
    protected $table = 'user_medias';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'media_id',
        'type',
        'order'
    ];
}
