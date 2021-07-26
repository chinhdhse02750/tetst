<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Product.
 *
 * @package namespace App\Entities;
 */
class Blog extends Model
{

    protected $table = 'blogs';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'blog_title',
        'blog_content',
    ];


}
