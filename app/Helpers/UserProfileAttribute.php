<?php

namespace App\Helpers;

class UserProfileAttribute
{
    /**
     * @param int $label_type
     * @param string|null $label_color_code
     * @param string|null $label_title
     * @return string
     */
    public static function getLabelMember(int $label_type, string $label_color_code = null, string $label_title = null)
    {
        $labelName = Constants::LABEL_NEW_MEMBER_NAME;
        switch ($label_type) {
            case Constants::LABEL_NEW_COMMENT_VALUE:
                $labelName = Constants::LABEL_NEW_COMMENT_NAME;
                break;
            case Constants::LABEL_OTHER_VALUE:
                $labelName = Constants::LABEL_OTHER_NAME;
                break;
        }
        if ($labelName === Constants::LABEL_OTHER_NAME) {
            return '<span class="item-detail__label-member ' . $labelName . '"' .
                'style="background: ' . $label_color_code . '"> ' . $label_title . '</span>';
        }

        return '<span class="item-detail__label-member ' . $labelName . '"> '
            . trans('user_profile.label.'. $labelName . '') .'</span>';
    }

    /**
     * @param string $age
     * @param string $height
     * @param string $weight
     * @param string $underwear_type
     * @return string
     */
    public static function getFullAbout(string $age, string $height, string $weight, string $underwear_type): string
    {
        return '<span class="detail__about-item detail__age">' . $age . '</span>' .
            '<span class="detail__about-item detail__height">' . $height . '</span>' .
            '<span class="detail__about-item detail__weight">' . $weight . '</span>' .
            '<span class="detail__about-item detail__underwear_type">' . $underwear_type . '</span>';
    }
}
