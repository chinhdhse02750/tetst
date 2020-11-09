<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class UserPrefecture
 * @package App\Entities
 */
class UserPrefecture extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'user_prefectures';

    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'prefecture_id'
    ];

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Entities\User');
    }

    /**
     * @return BelongsTo
     */
    public function prefecture()
    {
        return $this->belongsTo('App\Entities\Prefecture');
    }
}
