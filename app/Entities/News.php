<?php

namespace App\Entities;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use App\Traits\Scope\NewsScope;

/**
 * Class News.
 *
 * @package namespace App\Entities;
 */
class News extends Model implements Transformable
{
    use TransformableTrait, NewsScope;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content',
        'active',
        'order',
        'direction',
        'start_time',
        'end_time',
    ];
    /**
     * @var mixed
     */

    /**
     * Get content inline attribute function.
     *
     * @return string
     */
    public function getContentInlineAttribute(): string
    {
        return preg_replace("/\r\n|\n\r|\r|\n/", ' ', $this->content);
    }

    /**
     * Get content newline attribute function.
     *
     * @return string
     */
    public function getContentNewlineAttribute(): string
    {
        return preg_replace("/\r\n|\n\r|\r|\n/", '<br >', $this->content);
    }

    /**
     * Get content label attribute function.
     *
     * @return string
     */
    public function getContentLabelAttribute(): string
    {
        if (in_array($this->direction, ['up', 'down'])) {
            return $this->content_newline;
        }

        return $this->content_inline;
    }

    /**
     * Get StartTime Label Attribute.
     *
     * @return string
     * @throws Exception
     */
    public function getStartTimeLabelAttribute(): string
    {
        if ($this->start_time) {
            $startTime = new Carbon($this->start_time);

            return $startTime->format('Y-m-d H:i');
        }

        return '';
    }

    /**
     * Get EndTime Label Attribute.
     *
     * @return string
     * @throws Exception
     */
    public function getEndTimeLabelAttribute(): string
    {
        if ($this->end_time) {
            $endTime = new Carbon($this->end_time);

            return $endTime->format('Y-m-d H:i');
        }

        return '';
    }
}
