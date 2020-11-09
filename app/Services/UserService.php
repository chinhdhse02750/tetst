<?php

namespace App\Services;

use App\Helpers\Constants;
use App\Helpers\UserProfileAttribute;
use App\Repositories\AreaRepository;
use App\Repositories\RankRepository;
use App\Traits\MediaTrait;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;

class UserService
{
    use MediaTrait {
        MediaTrait::__construct as private __fhConstruct;
    }

    /**
     * @var RankRepository
     */
    protected $rankRepository;

    /**
     * @var AreaRepository
     */
    protected $areaRepository;

    /**
     * @var object
     */
    protected $user;

    /**
     * UserService constructor.
     * @param RankRepository $rankRepository
     * @param AreaRepository $areaRepository
     */
    public function __construct(
        RankRepository $rankRepository,
        AreaRepository $areaRepository
    ) {
        $this->__fhConstruct();
        $this->rankRepository = $rankRepository;
        $this->areaRepository = $areaRepository;
    }

    /**
     * Method convert data.
     *
     * @param array $data
     *
     * @return array
     */
    public function convertData(array $data): array
    {
        $data['comment'] = htmlentities(Arr::get($data, 'comment', ''));
        if (Arr::get($data, 'type') == Constants::USER_FEMALE) {
            $data['club_comment'] = htmlentities(Arr::get($data, 'club_comment', ''));
        }

        if (intval(Arr::get($data, 'label_type')) !== Constants::VALUE_LABEL_TYPE_CUSTOM) {
            $data['label_title'] = null;
            $data['label_color_code'] = null;
        }
        if (intval(Arr::get($data, 'receipt_type')) === Constants::VALUE_NO_RECEIPT) {
            $data['receipt_description'] = null;
        }

        if (!isset($data['is_publish'])) {
            $data['is_publish'] = Constants::NOT_PUBLISH_PROFILE;
        }

        return $data;
    }

    /**
     * @param object $member
     * @return object
     * @throws Exception
     */
    public function getDataFemaleMember(object $member): object
    {
        $member->rank_name = $this->rankRepository->find($member->rank)->name;
        $member->rating_star_calc = ($member->rating_star / Constants::MAX_RATING) * 100;
        $member->label_member = UserProfileAttribute::getLabelMember(
            $member->label_type,
            $member->label_color_code,
            $member->label_title
        );
        $member->full_about = $this->getFullAbout(
            $member->age,
            $member->height,
            $member->weight,
            $member->underwear_type
        );
        $member->area_name = $this->areaRepository->find($member->area)->name;

        if (!empty($member->{'private-images'})) {
            $member->private_images = $this->getPublicMedia($member->{'private-images'});
        }

        $member->public_videos = !empty($member->videos) ? $this->getPublicMedia($member->videos) : null;
        $member->data_schedules =
            !empty($member->user_schedule) ? $this->getDataSchedules($member->user_schedule) : null;
        $member->public_images = !empty($member->images) ? $this->getPublicMedia($member->images) : null;

        return $member;
    }

    public function getDataMaleMember(object $member): object
    {
        $selectOption = config('user-profile');
        $member->rank_name = $this->rankRepository->find($member->rank)->name;
        $member->male_age_label = !empty($member->mage_age) ? Arr::get(
            $selectOption,
            'male_ages.' . App::getLocale() . '.' . $member->mage_age
        ) : null;
        $member->birthday_balel
            = !empty($member->birthday) ? Carbon::parse($member->birthday)->format('Y-m-d') : null;
        $member->favorite_dating_type_label
            = !empty($member->favorite_dating_type)
            ? $this->getFavoriteDatingTypeLabel($member->favorite_dating_type) : null;

        $member->blood_type_label = Arr::get(
            $selectOption,
            'blood_types.' . App::getLocale() . '.' . $member->blood_type
        );
        $member->smoking_male_label = Arr::get(
            $selectOption,
            'male_smoking.' . App::getLocale() . '.' . $member->male_smoking
        );
        $member->income_label = Arr::get(
            $selectOption,
            'income.' . App::getLocale() . '.' . $member->income
        );

        $member->public_images = !empty($member->images) ? $this->getPublicMedia($member->images) : null;

        return $member;
    }

    /**
     * @param string $age
     * @param string $height
     * @param string $weight
     * @param string $underwear_type
     * @return string
     */
    public function getFullAbout(string $age, string $height, string $weight, string $underwear_type): string
    {
        return UserProfileAttribute::getFullAbout(
            $age . __('user_profile.label.age'),
            $height . 'cm',
            $weight . 'kg',
            $underwear_type . __('user_profile.label.underwear_type')
        );
    }

    /**
     * @param array $images
     * @return array
     */
    public function getPublicMedia(array $images)
    {
        $array = [];
        foreach ($images as $key => $image) {
            $image = explode('|', $image);
            $array[$key]['thumbnail_url'] = $this->getPublicUrl($image[1], Constants::DEFAULT_PUBLIC_PATH);
            $array[$key]['media_url'] = $this->getPublicUrl($image[0], Constants::DEFAULT_PUBLIC_PATH);
        }

        return $array;
    }

    /**
     * @param array $userSchedules
     * @return false|string
     * @throws Exception
     */
    public function getDataSchedules(array $userSchedules)
    {
        $dataSchedule = [];
        foreach ($userSchedules as $key => $userSchedule) {
            $title = __('users.label.noon');
            $className = 'is_noon_dating';
            $userSchedule = json_decode($userSchedule, true);
            if ($userSchedule['type'] === Constants::DATING_TYPE_NIGHT) {
                $title = __('users.label.night');
                $className = 'is_night_dating';
            }

            $dataSchedule[] = [
                'id' => $userSchedule['id'],
                'scheduleId' => $key,
                'start' => Carbon::parse(Arr::get($userSchedule, 'start_date')),
                'end' => Carbon::parse(Arr::get($userSchedule, 'end_date')),
                'title' => '<div class="dating-type__title">' . $title . '</div>',
                'classNames' => ['is_dating', $className],
            ];
        }

        return json_encode($dataSchedule);
    }

    /**
     * @param array $favoriteDatingTypes
     * @return string
     */
    public function getFavoriteDatingTypeLabel(array $favoriteDatingTypes): string
    {
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
}
