<?php

namespace App\Helpers;

/**
 * Class Constants
 * @package App\Helpers
 */
class Constants
{
    const DEFAULT_PER_PAGE = 12;
    const DEFAULT_ACTIVE = 1;
    const DEFAULT_COLOR = '#2b2b2b';

    /**
     *  Start Media
     */
    const DEFAULT_GB = 1073741824;
    const DEFAULT_MB = 1048576;
    const DEFAULT_KB = 1024;
    const PAGE_DEFAULT = 1;

    const IMAGE_PUBLISH = 0;
    const IMAGE_PRIVATE = 1;
    const MODAL_RELATIONS = 'ranks';
    const MODAL_VIDEO_RELATIONS = 'videos';
    const DEFAULT_PUBLIC_PATH = 'tmp';
    const IS_PUBLIC = false;
    const MEDIA_PATH_USER = 'users';
    const FIRST_IMAGE = 0;
    const IMAGE_LAZY_LOAD = '/image/frontend/loading-lazy.gif';
    const IMAGE_DEFAULT = '/image/frontend/no_image.png';
    const IMAGE_DEFAULT_THUMBNAIL = '/image/frontend/no-thumbnail.jpg';

    /**
     *  End Media
     */

    /**
     *  Start USER
     */
    const USER_ORDER_BY = 'id';
    const USER_SORT = 'desc';
    const USER_PUBLIC = 1;
    const USER_PRIVATE = 0;
    const USER_FEMALE = 1;
    const USER_MALE = 0;
    const NOT_TYPE_USER = 99;
    const USER_IS_PICK_UP = 1;
    const THUMBNAIL_IMAGE_WIDTH = 150;
    const THUMBNAIL_NAME_PREFIX = 'thumbnail_';
    const THUMBNAIL_VIDEO_PREFIX = 'thumbnail_video_';
    const TIME_CREATE_THUMBNAIL = 3;
    const THUMBNAIL_VIDEO_WIDTH = 200;
    const THUMBNAIL_VIDEO_HEIGHT = 150;
    const TYPE_MALE = 'male';
    const TYPE_FEMALE = 'female';
    const MIN_RATING = 0;
    const MAX_RATING = 5;
    const KEY_NAME_IMAGE = 0;
    const KEY_THUMBNAIL_NAME = 1;
    const VALUE_LABEL_TYPE_CUSTOM = 3;
    const VALUE_NO_RECEIPT = 0;
    const NOT_PUBLISH_PROFILE = 0;
    const MEMBER_DISPLAY_LIMIT = 4;
    /**
     *  End USER
     */

    /**
     *  Start USER SCHEDULE
     */
    const DATING_TYPE_NIGHT = 1;
    /**
     *  End USER SCHEDULE
     */

    const SHORT_COMMENT = 80;
    const MEMBER_LIST_PER_PAGE = 20;
    const PUBLIC_MEDIA_TYPE = 0;
    const TIME_ORDER_BY = 'created_at';
    const TEXT_SEARCH_LIMIT = 1;

    /**
     *  Start FILTER
     */
    const FILTER_CHECKED = 1;
    const FILTER_TIME_CREATE_USER = 7;
    const DEFAULT_CHECK_ALL = 0;
    const FILTER_CUP_A_C = 1;
    const FILTER_CUP_D_F = 2;
    const FILTER_CUP_G = 3;
    const FILTER_CHECK_NEW_MEMBER = 2;
    const FILTER_CHECK_PICK_UP = 3;
    const FILTER_CHECK_PRIVATE_PHOTO = 4;
    const FILTER_CHECK_HAS_COMMENT = 5;
    const VALUE_A_CUP = 'A';
    const VALUE_B_CUP = 'B';
    const VALUE_C_CUP = 'C';
    const VALUE_D_CUP = 'D';
    const VALUE_E_CUP = 'E';
    const VALUE_F_CUP = 'F';
    const VALUE_G_CUP = 'G';
    const MIN_AGE_LEVEL_1 = 18;
    const MAX_AGE_LEVEL_1 = 19;
    const MIN_AGE_LEVEL_2 = 20;
    const MAX_AGE_LEVEL_2 = 24;
    const MIN_AGE_LEVEL_3 = 25;
    const MAX_AGE_LEVEL_3 = 29;
    const MIN_AGE_LEVEL_4 = 30;
    const MAX_AGE_LEVEL_4 = 34;
    const MIN_AGE_LEVEL_5 = 35;
    const MAX_AGE_LEVEL_5 = 39;
    const MIN_AGE_LEVEL_6 = 40;
    const MAX_AGE_LEVEL_6 = 100;
    const FILTER_CHECK_ALL_ALCOHOL = 2;
    const FILTER_CHECK_ALL_SMOKING = 2;
    const MIN_AGE = 0;
    const MAX_AGE = 100;
    const MIN_HEIGHT = 0;
    const MAX_HEIGHT = 300;
    const MAX_HEIGHT_LEVEL_1 = 150;
    const MIN_HEIGHT_LEVEL_2 = 151;
    const MAX_HEIGHT_LEVEL_2 = 154;
    const MIN_HEIGHT_LEVEL_3 = 155;
    const MAX_HEIGHT_LEVEL_3 = 160;
    const MIN_HEIGHT_LEVEL_4 = 161;
    const MAX_HEIGHT_LEVEL_4 = 164;
    const MIN_HEIGHT_LEVEL_5 = 165;
    const MAX_HEIGHT_LEVEL_5 = 169;
    const MIN_HEIGHT_LEVEL_6 = 170;
    const LEVEL_1 = 1;
    const LEVEL_2 = 2;
    const LEVEL_3 = 3;
    const LEVEL_4 = 4;
    const LEVEL_5 = 5;
    const LEVEL_6 = 6;
    const FILTER_DEFAULT_SORT_ORDER = 'DESC';
    /**
     *  End FILTER
     */

    /**
     *  Start Point
     */
    const BALANCE_TYPE_ADJUSTMENT = 'Adjustment';
    const BALANCE_ORDER_BY = 'user_id';
    /**
     *  End Point
     */

    /**
     *  Start Contact
     */
    const CONTACT_STATUS_NOT_PROCESS = 0;
    const CONTACT_STATUS_COMPLETED = 1;
    const CONTACT_STATUS_PENDING = 2;
    /**
     *  End Contact
     */

    /**
     *  Start Member Label
     */
    const LABEL_NEW_MEMBER_NAME = 'new_member';
    const LABEL_NEW_COMMENT_NAME = 'new_comment';
    const LABEL_NEW_COMMENT_VALUE = 2;
    const LABEL_OTHER_NAME = 'other';
    const LABEL_OTHER_VALUE = 3;
    const LABEL_NEW_MEMBER_VALUE = 0;

    /**
     *  End Member Label
     */

    /**
     *  Start display banner
     */
    const BANNER_DISPLAY_LIMIT = 6;
    const BANNER_ORDER_BY = 'ASC';
    /**
     *  End display banner
     */

    /**
     *  Start OFFER
     */
    const REQUEST = 0;
    const APPROVE = 1;
    const REJECT = 2;
    const TIME_EXPIRED = 72;
    const CURRENCY = 'JPY';
    const POINT = 0;
    const BANK_TRANSFER = 1;
    const PAY_PAL = 2;
    const EMAIL_ADMIN = 'admin@oriental-club.net';
    const SUBJECT_EMAIL = 'Confirm Offer!';
    /**
     *  End OFFER
     */
}
