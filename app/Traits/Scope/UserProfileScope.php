<?php

namespace App\Traits\Scope;

use App\Helpers\Constants;
use Illuminate\Database\Eloquent\Builder;
use App\Traits\FullTextSearch;
use Illuminate\Support\Facades\Auth;

trait UserProfileScope
{
    /**
     * Scope active user.$status
     *
     * @param object $query
     * @param int $status
     *
     * @return mixed
     */
    public function scopeActive(object $query, int $status = 1)
    {
        return $query->whereHas('user', function ($q) use ($status) {
            $q->where('active', $status);
        });
    }

    /**
     * Scope type member.
     *
     * @param Object $query
     * @param int $type
     *
     * @return mixed
     */
    public function scopeType(Object $query, int $type)
    {
        return $query->whereHas('user', function ($q) use ($type) {
            $q->where('type', $type);
        });
    }

    /**
     * Scope reverse type user.
     *
     * @param Object $query Query.
     * @param int $type Type of user.
     *
     * @return mixed
     */
    public function scopeReverseType(Object $query, int $type)
    {
        if ($type == Constants::USER_FEMALE) {
            $reverseType = Constants::USER_MALE;
        } else {
            $reverseType = Constants::USER_FEMALE;
        }
        return $query->whereHas('user', function ($q) use ($reverseType) {
            $q->where('type', $reverseType);
        });
    }

    /**
     * Scope a query that matches a full text search of term.
     *
     * @param Builder $query Query.
     * @param string $search Search.
     * @return Builder
     */
    public function scopeSearch($query, $search)
    {
        if ($search != '') {
            $columns = implode(',', $this->searchable);
            $query->whereRaw("MATCH ({$columns}) AGAINST (? IN BOOLEAN MODE)", $this->fullTextWildcards($search));
        }
        return $query;
    }

    /**
     * Scope Is pickup.
     *
     * @param Builder $query
     * @param int $value
     * @return mixed
     */
    public function scopeIsPickup($query, $value)
    {
        if ($value == Constants::FILTER_CHECKED) {
            return $query->where('is_pickup', Constants::USER_IS_PICK_UP);
        }

        return $query;
    }

    /**
     * Scope New Member.
     *
     * @param Builder $query
     * @param int|null $value
     * @return mixed
     */
    public function scopeLabelType($query, $value)
    {
        if (!is_null($value)) {
            return $query->where('label_type', $value);
        }

        return $query;
    }


    /**
     * Scope Prefecture.
     *
     * @param Builder $query
     * @param array $ids
     * @return mixed
     */
    public function scopePrefectures($query, $ids)
    {
        if (!empty($ids)) {
            return $query->whereHas('user.prefecture', function ($q) use ($ids) {

            });
        }

        return $query;
    }

    /**
     * Scope Underwear Type.
     *
     * @param Builder $query
     * @param array $underwearTypes
     * @return mixed
     */
    public function scopeUnderwearType($query, $underwearTypes)
    {
        if (!empty($underwearTypes)) {
            return $query->whereIn('underwear_type', $underwearTypes);
        }

        return $query;
    }

    /**
     * Scope Dating Type.
     *
     * @param Builder $query
     * @param array $datingTypes
     * @return mixed
     */
    public function scopeDatingType($query, $datingTypes)
    {
        if (!empty($datingTypes)) {
            return $query->whereIn('dating_type', $datingTypes);
        }

        return $query;
    }

    /**
     * Scope Rank.
     *
     * @param Builder $query
     * @param array $rankIds
     * @return mixed
     */
    public function scopeRank($query, $rankIds)
    {
        if (!empty($rankIds)) {
            return $query->whereIn('rank_id', $rankIds);
        }

        return $query;
    }

    /**
     * Scope Smoking.
     *
     * @param Builder $query
     * @param int $value
     * @return mixed
     */
    public function scopeSmoking($query, $value)
    {
        if ($value != Constants::FILTER_CHECK_ALL_SMOKING) {
            return $query->where('smoking', $value);
        }

        return $query;
    }

    /**
     * Scope Alcohol.
     *
     * @param Builder $query
     * @param int $value
     * @return mixed
     */
    public function scopeAlcohol($query, $value)
    {
        if ($value != Constants::FILTER_CHECK_ALL_ALCOHOL) {
            return $query->where('alcohol', $value);
        }

        return $query;
    }

    /**
     * Scope Age.
     *
     * @param Builder $query
     * @param array $ageLevels
     * @return mixed
     */
    public function scopeAge($query, $ageLevels)
    {
        if (!empty($ageLevels)) {
            $minValue = Constants::MIN_AGE;
            $maxValue = Constants::MAX_AGE;
            foreach ($ageLevels as $key => $level) {
                switch ($level) {
                    case Constants::LEVEL_1:
                        $minValue = Constants::MIN_AGE_LEVEL_1;
                        $maxValue = Constants::MAX_AGE_LEVEL_1;
                        break;
                    case Constants::LEVEL_2:
                        $minValue = Constants::MIN_AGE_LEVEL_2;
                        $maxValue = Constants::MAX_AGE_LEVEL_2;
                        break;
                    case Constants::LEVEL_3:
                        $minValue = Constants::MIN_AGE_LEVEL_3;
                        $maxValue = Constants::MAX_AGE_LEVEL_3;
                        break;
                    case Constants::LEVEL_4:
                        $minValue = Constants::MIN_AGE_LEVEL_4;
                        $maxValue = Constants::MAX_AGE_LEVEL_4;
                        break;
                    case Constants::LEVEL_5:
                        $minValue = Constants::MIN_AGE_LEVEL_5;
                        $maxValue = Constants::MAX_AGE_LEVEL_5;
                        break;
                    case Constants::LEVEL_6:
                        $minValue = Constants::MIN_AGE_LEVEL_6;
                        $maxValue = Constants::MAX_AGE_LEVEL_6;
                        break;
                }//end switch

                if ($key == 0) {
                    $query = $query->whereBetween('age', [$minValue, $maxValue]);
                } else {
                    $query = $query->orwhereBetween('age', [$minValue, $maxValue]);
                }
            }//end foreach
        }//end if

        return $query;
    }

    /**
     * Scope Height.
     *
     * @param Builder $query
     * @param array $heightLevels
     * @return mixed
     */
    public function scopeHeight($query, $heightLevels)
    {
        if (!empty($heightLevels)) {
            $minValue = Constants::MIN_HEIGHT;
            $maxValue = Constants::MAX_HEIGHT;
            foreach ($heightLevels as $key => $heightLevel) {
                switch ($heightLevel) {
                    case Constants::LEVEL_1:
                        $minValue = Constants::MIN_HEIGHT;
                        $maxValue = Constants::MAX_HEIGHT_LEVEL_1;
                        break;
                    case Constants::LEVEL_2:
                        $minValue = Constants::MIN_HEIGHT_LEVEL_2;
                        $maxValue = Constants::MAX_HEIGHT_LEVEL_2;
                        break;
                    case Constants::LEVEL_3:
                        $minValue = Constants::MIN_HEIGHT_LEVEL_3;
                        $maxValue = Constants::MAX_HEIGHT_LEVEL_3;
                        break;
                    case Constants::LEVEL_4:
                        $minValue = Constants::MIN_HEIGHT_LEVEL_4;
                        $maxValue = Constants::MAX_HEIGHT_LEVEL_4;
                        break;
                    case Constants::LEVEL_5:
                        $minValue = Constants::MIN_HEIGHT_LEVEL_5;
                        $maxValue = Constants::MAX_HEIGHT_LEVEL_5;
                        break;
                    case Constants::LEVEL_6:
                        $minValue = Constants::MIN_HEIGHT_LEVEL_6;
                        $maxValue = Constants::MAX_HEIGHT;
                        break;
                }//end switch

                if ($key == 0) {
                    $query = $query->whereBetween('height', [$minValue, $maxValue]);
                } else {
                    $query = $query->orwhereBetween('height', [$minValue, $maxValue]);
                }
            }//end foreach
        }//end if

        return $query;
    }

    /**
     * Scope Male Age.
     *
     * @param Builder $query
     * @param array $ages
     * @return mixed
     */
    public function scopeMaleAge($query, $ages)
    {
        if (!empty($ages)) {
            return $query->whereIn('male_age', $ages);
        }

        return $query;
    }

    /**
     * Scope Male Smoking.
     *
     * @param Builder $query
     * @param array $values
     * @return mixed
     */
    public function scopeMaleSmoking($query, $values)
    {
        if (!empty($values)) {
            return $query->whereIn('male_smoking', $values);
        }

        return $query;
    }

    /**
     * Scope Favorite Dating Type.
     *
     * @param Builder $query
     * @param array $datingTypes
     * @return mixed
     */
    public function scopeFavoriteDatingType($query, $datingTypes)
    {
        if (!empty($datingTypes)) {
            return $query->whereIn('favorite_dating_type', $datingTypes);
        }

        return $query;
    }

    /**
     * Scope Favorite.
     *
     * @param Builder $query
     * @return mixed
     */
    public function scopeFavorite($query)
    {
        return $query->whereHas('user.favorites', function ($q) {
            $q->where('user_favorites.user_id', Auth::id());
        });
    }
}
