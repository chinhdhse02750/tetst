<?php

namespace App\Entities;

use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class Rank
 * @package App\Entities
 */
class Bank extends Authenticatable implements Transformable
{
    use TransformableTrait;

    protected $table = 'banks';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'branch_name',
        'account_number',
        'account_name',
        'receipt_name',
    ];
}
