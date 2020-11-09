<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class UserSchedule extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * @var string
     */
    protected $table = 'user_schedules';

    /**
     * @var bool
     */
    public $timestamps = true;

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'identify',
        'start_date',
        'end_date',
        'type',
        'created_at',
        'updated_at'
    ];
}
