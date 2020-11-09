<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Area
 * @package App\Entities
 */
class Area extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'areas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function prefectures()
    {
        return $this->hasMany('App\Entities\Prefecture');
    }
}
