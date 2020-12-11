<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;
use \Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Category.
 *
 * @package namespace App\Entities;
 */
class Category extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'image',
        'alias',
        'parent',
        'top',
        'status',
        'sort',
        'title',
        'keyword'
    ];

    /**
     * @return HasMany
     */
    public function childrenCategories()
    {
        return $this->hasMany('App\Entities\Category', 'parent', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function media()
    {
        return $this->belongsTo('App\Entities\Media', 'profile_id');
    }


    /**
     * @return BelongsToMany
     */
    public function medias()
    {
        return $this->belongsToMany('App\Entities\Media', 'user_medias', 'user_id', 'media_id')
            ->withPivot('type', 'order')->withTimestamps();
    }


    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }
}
