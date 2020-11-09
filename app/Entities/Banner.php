<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use App\Traits\MediaTrait;

/**
 * Class Banner
 * @package App\Entities
 */
class Banner extends Model implements Transformable
{
    use TransformableTrait;
    use MediaTrait{
        MediaTrait::__construct as private __fhConstruct;
    }

    public function __construct(array $attributes = [])
    {
        $this->__fhConstruct();
        parent::__construct($attributes);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'redirect_url',
        'order',
        'active',
        'media_id'
    ];

    /**
     * @return BelongsTo
     */
    public function media()
    {
        return $this->belongsTo('App\Entities\Media');
    }
}
