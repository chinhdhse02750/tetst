<?php

namespace App\Entities;

use App\Entities\Attribute\UserAttribute;
use App\Traits\MediaTrait;
use App\Traits\Scope\UserScope;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use \Illuminate\Database\Eloquent\Relations\BelongsToMany;
use \Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\Member\ResetPasswordNotification as MemberResetPasswordNotification;

/**
 * Class User.
 *
 * @package namespace App\Entities;
 */
class User extends Authenticatable implements Transformable
{
    use TransformableTrait, Notifiable, UserScope, SoftDeletes, UserAttribute;
    use MediaTrait {
        MediaTrait::__construct as private __fhConstruct;
    }

    public function __construct(array $attributes = [])
    {
        $this->__fhConstruct();
        parent::__construct($attributes);
    }

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'password',
        'password_changed_at',
        'uuid',
        'name',
        'active',
        'type'
    ];

    /**
     * @var array
     */
    protected $appends = ['rank_name'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return HasOne
     */
    public function userProfile()
    {
        return $this->hasOne('App\Entities\UserProfile');
    }

    /**
     * @return HasOne
     */
    public function userPrefecture()
    {
        return $this->hasOne('App\Entities\UserPrefecture');
    }

    /**
     * @return HasMany
     */
    public function balances()
    {
        return $this->hasMany('App\Entities\Balance');
    }

    /**
     * @return BelongsToMany
     */
    public function medias()
    {
        return $this->belongsToMany('App\Entities\Media', 'user_medias', 'user_id', 'media_id')
            ->withPivot('type', 'order')->withTimestamps();
    }

    /**
     * @return BelongsToMany
     */
    public function prefecture()
    {
        return $this->belongsToMany('App\Entities\Prefecture', 'user_prefectures', 'user_id', 'prefecture_id')
            ->withTimestamps();
    }

    /**
     * @return BelongsToMany
     */
    public function videos()
    {
        return $this->belongsToMany('App\Entities\Video', 'user_videos', 'user_id', 'video_id')
            ->withTimestamps();
    }

    /**
     * @return hasMany
     */
    public function userSchedules()
    {
        return $this->hasMany('App\Entities\UserSchedule', 'user_id');
    }

    /**
     * @return HasMany
     */
    public function favorites()
    {
        return $this->hasMany('App\Entities\UserFavorite', 'favorite_id');
    }

    /**
     * @return bool
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * Send mail reset password.
     *
     * @return void
     * @var string $token Token verify.
     *
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify((new MemberResetPasswordNotification($token))->onQueue('member'));
    }
}
