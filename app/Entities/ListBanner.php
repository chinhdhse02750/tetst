<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Product.
 *
 * @package namespace App\Entities;
 */
class ListBanner extends Model
{

    protected $table = 'list_banners';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'image',
        'order',
        'active'
    ];

}
