<?php

namespace App\Entities;

use App\Helpers\Constants;
use App\Traits\MediaTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Video.
 *
 * @package namespace App\Entities;
 */
class Video extends Model implements Transformable
{
    use MediaTrait {
        MediaTrait::__construct as private __fhConstruct;
    }
    use TransformableTrait,SoftDeletes;

    /**
     * Video constructor.
     * @param array $attributes
     */
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
    protected $fillable = [];

    /**
     * getMediaUrlAttribute function.
     *
     * @return bool|string|null
     */
    public function getVideoUrlAttribute()
    {
        if (!$this->name || !$this->path) {
            return null;
        }

        return $this->getPublicUrl($this->name, $this->path);
    }

    /**
     * @return bool|null|string
     */
    public function getThumbnailUrlAttribute()
    {
        if (!$this->thumbnail_name || !$this->path) {
            return Constants::IMAGE_DEFAULT_THUMBNAIL;
        }

        return $this->getPublicUrl($this->thumbnail_name, $this->path);
    }
}
