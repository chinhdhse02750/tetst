<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Unit.
 *
 * @package namespace App\Entities;
 */
class Unit extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'units';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description'
    ];

    public function product()
    {
        return $this->hasOne('App\Entities\Product');
    }

}
