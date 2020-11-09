<?php

namespace App\Entities\Attribute;

use App\Helpers\Constants;
use Carbon\Carbon;
use Illuminate\Contracts\Translation\Translator;
use Illuminate\Support\Facades\Auth;

trait UserAttribute
{
    /**
     * @return string
     */
    public function getProfileImageUrlAttribute()
    {
        if (empty($this->image_public)) {
            return '';
        }

        return $this->image_public[Constants::FIRST_IMAGE]->media_url;
    }

    /**
     * Get tag member attribute.
     *
     * @return string
     */
    public function getLabelMemberAttribute(): string
    {
        return '<span class="item-detail__label-member private-photo">プライベート写真</span>';
//        return '<span class="item-detail__label-member new-comment">新規コメント</span>';
//        return '<span class="item-detail__label-member online-dating">#オンラインデートOK</span>';
//        return '<span class="item-detail__label-member new-member">オンラインデートOK</span>';
    }

    /**
     * @return bool
     */
    public function getFemaleAttribute()
    {
        if ($this->type == Constants::USER_FEMALE) {
            return true;
        }

        return false;
    }

    /**
     * Get has video attribute.
     *
     * @return bool
     */
    public function getHasVideoAttribute(): bool
    {
        if ($this->videos->first()) {
            return true;
        }

        return false;
    }

    /**
     * Get image public attribute.
     *
     * @return array
     */
    public function getImagePublicAttribute(): array
    {
        $images = [];
        foreach ($this->medias as $media) {
            if ($media->pivot->type === Constants::IMAGE_PUBLISH) {
                $images[] = $media;
            }
        }

        return $images;
    }

    /**
     * Get image private attribute.
     *
     * @return array
     */
    public function getImagePrivateAttribute(): array
    {
        $images = [];
        foreach ($this->medias as $media) {
            if ($media->pivot->type === Constants::IMAGE_PRIVATE) {
                $images[] = $media;
            }
        }

        return $images;
    }

    /**
     * Get has image public attribute.
     *
     * @return bool
     */
    public function getHasImagePublicAttribute(): bool
    {
        if (empty($this->image_public)) {
            return false;
        }

        return true;
    }

    /**
     * Get has image private attribute.
     *
     * @return bool
     */
    public function getHasImagePrivateAttribute(): bool
    {
        if (empty($this->image_private)) {
            return false;
        }

        return true;
    }

    /**
     * get Type Name of user.
     *
     * @return string
     */
    public function getTypeNameAttribute()
    {
        if ($this->type == Constants::USER_FEMALE) {
            return Constants::TYPE_FEMALE;
        }

        return Constants::TYPE_MALE;
    }

    /**
     * get sum of amount.
     *
     * @return int
     */
    public function getTotalAmountAttribute()
    {
        $total = 0;
        foreach ($this->balances as $balance) {
            if (strpos($balance->model_type, Constants::BALANCE_TYPE_ADJUSTMENT) !== false) {
                $total += $balance->amount;
            } else {
                $total -= $balance->amount;
            }
        }

        return $total;
    }

    /**
     * get sum of amount.
     *
     * @return string
     */
    public function getTotalAmountLabelAttribute()
    {
        return number_format($this->total_amount) . ' P';
    }

    /**
     * Get expired attribute.
     *
     * @return string
     * @throws \Exception
     */
    public function getExpiredAttribute(): string
    {
        return $this->userProfile->expired_at
            ? Carbon::parse($this->userProfile->expired_at)->format('Y-m-d')
            : @trans('users.label.no_period');
    }

    /**
     * Get expired attribute.
     *
     * @return string
     * @throws \Exception
     */
    public function getCreatedAttribute(): string
    {
        return Carbon::parse($this->created_at)->format('Y-m-d');
    }

    /**
     * get sex of user.
     *
     * @return array|Translator|string|null
     */
    public function getSexAttribute()
    {
        if ($this->type == Constants::USER_FEMALE) {
            return @trans('users.label.female');
        }

        return @trans('users.label.male');
    }

    /**
     * Get Favorite label Attribute function.
     *
     * @return string
     */
    public function getFavoriteLabelAttribute()
    {
        $active = '';
        $dataFavorite = $this->favorites()
            ->where('user_id', '=', Auth::id())
            ->get()
            ->toArray();
        if (!empty($dataFavorite)) {
            $active = ' active';
        }

        return '<a href="javascript:void(0)"
         class="item-detail__favorite favorite-btn' . $active . '"
         data-toggle="tooltip"
         data-html="true"
         id="favorite-' . $this->id . '"
         data-favorite-id="' . $this->id . '"
         data-user-id="' . Auth::id() . '"
         data-original-title="<span class=\'tooltip__dating-type text--small\'>'
            . trans('user_profile.label.add_to_favorite') . '</span>">
          <svg xmlns="http://www.w3.org/2000/svg" width="24.35" height="22.829" viewBox="0 0 24.35 22.829">
            <path
              id="icon-heart"
              d="M12.275,2.1c6.754-6.943,23.641,5.206,0,20.829C-11.366,7.308,5.521-4.843,12.275,2.1Z"
              transform="translate(-0.1 -0.1)"
              fill="#f75d5d"
              stroke="#f76362bf"
              fill-rule="evenodd"/>
          </svg>
      </a>';
    }

    /**
     * Get data schedule attribute.
     *
     * @return false|string
     */
    public function getDataSchedulesAttribute()
    {
        $userSchedules = $this->userSchedules;
        $dataSchedule = [];
        foreach ($userSchedules as $userSchedule) {
            $title = __('users.label.noon');
            $className = 'is_noon_dating';
            if ($userSchedule->type === Constants::DATING_TYPE_NIGHT) {
                $title = __('users.label.night');
                $className = 'is_night_dating';
            }

            $dataSchedule[] = [
                'id' => $userSchedule->identify,
                'scheduleId' => $userSchedule->id,
                'start' => $userSchedule->start_date,
                'end' => $userSchedule->end_date,
                'title' => '<div class="dating-type__title">' . $title . '</div>',
                'classNames' => ['is_dating', $className],
                'type' => $userSchedule->type
            ];
        }

        return json_encode($dataSchedule);
    }

    /**
     * Get schedule html attribute.
     *
     * @return false|string
     * @throws \Exception
     */
    public function getScheduleHtmlAttribute()
    {
        $scheduleHtml = '';
        $formatDate = 'Y-m-d';
        foreach ($this->userSchedules as $userSchedule) {
            $scheduleHtml .= '<input
                      type="hidden"
                      name="user_schedule[]"
                      value="{&quot;start_date&quot;:&quot;'
                . Carbon::parse($userSchedule->start_date)->format($formatDate)
                . '&quot;,&quot;end_date&quot;:&quot;'
                . Carbon::parse($userSchedule->end_date)->format($formatDate)
                . '&quot;,&quot;type&quot;:'
                . $userSchedule->type . ',&quot;id&quot;:&quot;'
                . $userSchedule->identify . '&quot;}" id="'
                . $userSchedule->identify . '">';
        }//end foreach

        return $scheduleHtml;
    }

    /**
     * Get prefecture name attribute.
     *
     * @return string
     */
    public function getPrefectureNameAttribute(): string
    {
        if (empty($this->prefecture)) {
            return '';
        }

        return $this->prefecture->first()->name;
    }

    /**
     * Get leave member label attribute.
     *
     * @return string
     */
    public function getLeaveMemberLabelAttribute(): string
    {
        if ($this->deleted_at) {
            return __('users.label.restore');
        }

        return __('users.label.leave');
    }

    public function getButtonLeaveMemberAttribute(): string
    {
        $method = 'delete';
        $url = route('member.destroy', ['id' => $this->id, 'type_user' => $this->type_name]);
        $button = 'btn-danger';
        if ($this->deleted_at) {
            $method = 'post';
            $url = route('member.restore', ['id' => $this->id, 'type_user' => $this->type_name]);
            $button = 'btn-success';
        }

        return "<a href=\"{$url}\"
          class=\"btn {$button} mb-1\" data-method=\"{$method}\"
          data-trans-button-cancel=\"" . __('labels.general.cancel') . "\"
          data-trans-button-confirm=\"{$this->leave_member_label}\"
          data-trans-title=\"" . __('alerts.general.confirm.delete') . "\">{$this->leave_member_label}</a>";
    }

    /**
     *  Get link id attribute.
     *
     * @return string|int
     */
    public function getLinkIdAttribute()
    {
        $url = route('member.edit', ['id' => $this->id, 'type_user' => $this->type_name]);
        if ($this->trashed()) {
            return $this->id;
        }

        return "<a href=\"{$url}\" class=\"area-filter\" id=\"{$this->id}\">{$this->id}</a>";
    }

    /**
     * Get offer point attribute.
     *
     * @return string
     */
    public function getOfferPointAttribute()
    {
        return number_format($this->balances->sum('amount')) . ' P';
    }

    /**
     * Get request setting attribute.
     *
     * @return bool
     */
    public function getRequestSettingAttribute()
    {
        if (!empty($this->userProfile) && !empty(Auth::user()->userProfile)) {
            $rankPriority = $this->userProfile->rank->priority;
            $authRankPriority = Auth::user()->userProfile->rank->priority;

            if (!empty($rankPriority) && !empty($authRankPriority) && ($authRankPriority >= $rankPriority)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Get request button attribute.
     *
     * @return string
     */
    public function getRequestButtonAttribute()
    {
        $customClass = '';
        $iconButton = '+ ';
        $disabled = '';

        if (!$this->request_setting) {
            $customClass = ' disabled request-setting-disabled';
            $iconButton = '';
            $disabled = 'disabled';
        }

        return '<button type="button" data-id="{{ $member->id }}" 
                class="btn btn-outline-secondary btn-request-setting ' . $customClass . ' " ' . $disabled . '>
                             ' . $iconButton . trans('users.label.add_setting_list') . '
                        </button>';
    }
}
