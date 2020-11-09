<?php

namespace App\Entities;

use App\Helpers\Constants;
use Illuminate\Contracts\Translation\Translator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Contact.
 *
 * @package namespace App\Entities;
 */
class Contact extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'contacts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'title',
        'content',
        'status'
    ];

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Entities\User', 'user_id');
    }

    /**
     * get name status.
     *
     * @return array|Translator|string|null
     */
    public function getNameStatusAttribute()
    {
        if ($this->status === Constants::CONTACT_STATUS_NOT_PROCESS) {
            return @trans('contacts.label.not_process');
        } elseif ($this->status === Constants::CONTACT_STATUS_COMPLETED) {
            return @trans('contacts.label.completed');
        } elseif ($this->status === Constants::CONTACT_STATUS_PENDING) {
            return @trans('contacts.label.pending');
        }
        return "";
    }
}
