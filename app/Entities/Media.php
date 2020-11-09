<?php

namespace App\Entities;

use App\Helpers\Constants;
use App\Traits\MediaTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Media.
 *
 * @package namespace App\Entities;
 */
class Media extends Model implements Transformable
{
    use MediaTrait {
        MediaTrait::__construct as private __fhConstruct;
    }
    use TransformableTrait;
    use SoftDeletes;

    public function __construct(array $attributes = [])
    {
        $this->__fhConstruct();
        parent::__construct($attributes);
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'medias';

    protected $fillable = [
        'name',
        'thumbnail_name',
        'type',
        'path',
        'size',
        'thumbnail_size'
    ];

    /**
     * Relation banner.
     *
     * @return HasOne
     */
    public function banner()
    {
        return $this->hasOne('App\Entities\Banner');
    }

    /**
     * getMediaUrlAttribute function.
     *
     * @return bool|string|null
     */
    public function getMediaUrlAttribute()
    {
        if (!$this->name || !$this->path) {
            return Constants::IMAGE_DEFAULT;
        }

        return $this->getPublicUrl($this->name, $this->path);
    }

    public function getThumbnailUrlAttribute()
    {
        if (!$this->thumbnail_name || !$this->path) {
            return Constants::IMAGE_DEFAULT_THUMBNAIL;
        }

        return $this->getPublicUrl($this->thumbnail_name, $this->path);
    }
}
