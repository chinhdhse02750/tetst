<?php

namespace App\Entities;

use App\Helpers\Constants;
use App\Helpers\UserProfileAttribute;
use App\Traits\FullTextSearch;
use App\Traits\Scope\UserProfileScope;
use ArrayAccess;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class UserProfile.
 *
 * @package namespace App\Entities;
 */
class UserProfile extends Model implements Transformable
{
    use TransformableTrait, UserProfileScope, FullTextSearch;

    protected $table = 'user_profiles';

    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'admin_id',
        'rank_id',
        'profile_id',
        'name',
        'tel',
        'line_id',
        'expired_at',
        'age',
        'height',
        'weight',
        'underwear_type',
        'rating_star',
        'dating_type',
        'area',
        'sign',
        'blood_type',
        'occupation',
        'smoking',
        'alcohol',
        'address',
        'conversation_lang',
        'hobby',
        'offer',
        'tag',
        'comment',
        'club_comment',
        'is_publish',
        'is_pickup',
        'birthday',
        'male_age',
        'favorite_dating_type',
        'male_smoking',
        'male_alcohol',
        'income',
        'label_type',
        'label_title',
        'label_color_code',
        'receipt_type',
        'receipt_description',
    ];

    /**
     * @var array
     */
    protected $searchable = [
        'name',
        'comment',
        'club_comment'
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
    public function rank()
    {
        return $this->belongsTo('App\Entities\Rank', 'rank_id')->withTrashed();
    }

    /**
     * @return BelongsTo
     */
    public function media()
    {
        return $this->belongsTo('App\Entities\Media', 'profile_id');
    }

    /**
     * @return string
     */
    public function getShortCommentAttribute()
    {
        if ($this->user->type === Constants::USER_MALE && !$this->publish_profile) {
            return '';
        }

        $commentHtml = html_entity_decode($this->comment);

        return Str::limit(strip_tags($commentHtml), Constants::SHORT_COMMENT);
    }

    /**
     * Get rank name attribute.
     *
     * @return string
     */
    public function getRankNameAttribute(): string
    {
        if (!$this->rank) {
            return '';
        }

        return $this->rank->name;
    }

    /**
     * Get age label attribute.
     *
     * @return string
     */
    public function getAgeLabelAttribute(): string
    {
        return !empty($this->age) ? $this->age . __('user_profile.label.age') : '';
    }

    /**
     * Get height label attribute.
     *
     * @return string
     */
    public function getHeightLabelAttribute(): string
    {
        return !empty($this->height) ? $this->height . 'cm' : '';
    }

    /**
     * Get weight label attribute.
     *
     * @return string
     */
    public function getWeightLabelAttribute(): string
    {
        return !empty($this->weight) ? $this->weight . 'kg' : '';
    }

    /**
     * Get underwear type label attribute.
     *
     * @return string
     */
    public function getUnderwearTypeLabelAttribute(): string
    {
        return !empty($this->underwear_type)
            ? $this->underwear_type . __('user_profile.label.underwear_type')
            : '';
    }

    /**
     * Get full about attribute.
     *
     * @return string
     */
    public function getFullAboutAttribute(): string
    {
        return UserProfileAttribute::getFullAbout(
            $this->age_label,
            $this->height_label,
            $this->weight_label,
            $this->underwear_type_label
        );
    }

    /**
     * Get dating type label attribute.
     *
     * @return string
     */
    public function getDatingTypeLabelAttribute(): string
    {
        return !empty($this->dating_type) ? $this->dating_type : '';
    }

    /**
     * Get rank button attribute.
     *
     * @return string
     */
    public function getRankButtonAttribute(): string
    {
        if ($this->user->type === Constants::USER_MALE && !$this->publish_profile) {
            return '';
        }

        return $this->rank->rank_button;
    }

    /**
     * Get profile image attribute.
     *
     * @return string
     */
    public function getProfileImageAttribute(): string
    {
        if ($this->user->type === Constants::USER_MALE && !$this->is_publish) {
            return '<img class="lazy" src="' . Constants::IMAGE_LAZY_LOAD . '" ' .
                'data-src="' . Constants::IMAGE_DEFAULT . '" alt="' . $this->name . '">';
        }

        if (!empty($this->media->media_url)) {
            return '<img class="lazy" src="' . Constants::IMAGE_LAZY_LOAD . '" ' .
                'data-src="' . $this->media->media_url . '" alt="' . $this->name . '">';
        }

        if (empty($this->user->profile_image_url)) {
            return '<img class="lazy" src="' . Constants::IMAGE_LAZY_LOAD . '" ' .
                'data-src="' . Constants::IMAGE_DEFAULT . '" alt="' . $this->name . '">';
        }

        return '<img class="lazy" src="' . Constants::IMAGE_LAZY_LOAD . '" ' .
            'data-src="' . $this->user->profile_image_url . '" alt="' . $this->name . '">';
    }

    /**
     * Get blood type label attribute.
     *
     * @return string
     */
    public function getBloodTypeLabelAttribute(): string
    {
        $selectOption = config('user-profile');
        if (!$this->blood_type) {
            return '';
        }

        return Arr::get($selectOption, 'blood_types.' . App::getLocale() . '.' . $this->blood_type);
    }

    /**
     * Get smoking label attribute.
     *
     * @return string
     */
    public function getSmokingFemaleLabelAttribute(): string
    {
        if (!$this->smoking) {
            return __('users.label.no_smoking');
        }

        return __('users.label.has_smoking');
    }

    /**
     * Get alcohol label attribute.
     *
     * @return string
     */
    public function getAlcoholLabelAttribute(): string
    {
        if (!$this->alcohol) {
            return '';
        }

        return '飲みます';
    }

    /**
     * Get rating star calculator attribute.
     *
     * @return float|int
     */
    public function getRatingStarCalcAttribute()
    {
        if ($this->rating_star) {
            return ($this->rating_star / Constants::MAX_RATING) * 100;
        }

        return Constants::MIN_RATING;
    }

    /**
     * @return mixed
     */
    public function getSignLabelAttribute()
    {
        return $this->sign;
    }

    /**
     * @return string
     */
    public function getLabelMemberAttribute()
    {
        return UserProfileAttribute::getLabelMember($this->label_type, $this->label_color_code, $this->label_title);
    }

    /**
     * Get birthday label attribute.
     *
     * @return string
     * @throws \Exception
     */
    public function getBirthdayLabelAttribute(): string
    {
        if ($this->birthday) {
            return Carbon::parse($this->birthday)->format('Y-m-d');
        }

        return '';
    }

    /**
     * Get favorite dating type label attribute.
     *
     * @return string
     */
    public function getFavoriteDatingTypeLabelAttribute(): string
    {
        if (!$this->favorite_dating_type) {
            return '';
        }

        $favoriteDatingTypes = explode(', ', $this->favorite_dating_type);
        $favoriteLabels = [];
        $selectOption = config('user-profile');
        foreach ($favoriteDatingTypes as $favoriteDatingType) {
            $favoriteLabels[] = Arr::get(
                $selectOption,
                'favorite_dating_type.' . App::getLocale() . '.' . $favoriteDatingType
            );
        }

        return implode(', ', $favoriteLabels);
    }

    /**
     * Get income label attribute.
     *
     * @return string
     */
    public function getIncomeLabelAttribute(): string
    {
        if (!$this->income) {
            return '';
        }

        $selectOption = config('user-profile');

        return Arr::get(
            $selectOption,
            'income.' . App::getLocale() . '.' . $this->income
        );
    }

    /**
     * Get smoking male label attribute.
     *
     * @return string
     */
    public function getSmokingMaleLabelAttribute(): string
    {
        if (!$this->male_smoking) {
            return '';
        }

        $selectOption = config('user-profile');

        return Arr::get(
            $selectOption,
            'male_smoking.' . App::getLocale() . '.' . $this->male_smoking
        );
    }

    /**
     * Get male age label attribute.
     *
     * @return string
     */
    public function getMaleAgeLabelAttribute(): string
    {
        if (!$this->male_age || ($this->user->type === Constants::USER_MALE && !$this->is_publish)) {
            return '';
        }

        $selectOption = config('user-profile');

        return Arr::get(
            $selectOption,
            'male_ages.' . App::getLocale() . '.' . $this->male_age
        );
    }

    /**
     * Get publish profile attribute.
     *
     * @return bool
     */
    public function getPublishProfileAttribute()
    {
        if ($this->is_publish) {
            return true;
        }

        return false;
    }

    /**
     * Get dating type description attribute.
     *
     * @return string
     */
    public function getDatingTypeDescriptionAttribute()
    {
        $locale = App::getLocale();
        $config = config('user-profile');

        return Arr::get($config, 'dating_types_description.' . $locale . '.' . $this->dating_type, '');
    }

    /**
     * Get rank amount.
     *
     * @return int
     */
    public function getRankAmountAttribute(): int
    {
        if (!$this->rank) {
            return 0;
        }

        return $this->rank->amount;
    }

    /**
     * Get dating type title attribute.
     *
     * @return string
     */
    public function getDatingTypeTitleAttribute()
    {
        $locale = App::getLocale();
        $config = config('user-profile');

        return Arr::get($config, 'dating_types.' . $locale . '.' . $this->dating_type, '');
    }
}
