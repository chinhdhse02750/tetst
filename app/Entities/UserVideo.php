<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class UserVideo.
 *
 * @package namespace App\Entities;
 */
class UserVideo extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'user_videos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'video_id'
    ];
}
