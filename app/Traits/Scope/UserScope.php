<?php

namespace App\Traits\Scope;

use App\Helpers\Constants;

trait UserScope
{
    /**
     * Scope status active user.
     *
     * @param Object $query
     * @param int $status
     *
     * @return Object
     */
    public function scopeStatus(object $query, int $status)
    {
        return $query->where('active', $status);
    }

    /**
     * Scope active user.
     *
     * @param object $query
     * @param int $status
     *
     * @return mixed
     */
    public function scopeActive(object $query, int $status = 1)
    {
        return $query->where('active', $status);
    }

    /**
     * Scope Email.
     *
     * @param Object $query
     * @param string $email
     *
     * @return Object
     */
    public function scopeEmail(Object $query, string $email = null)
    {
        if ($email !== null) {
            $query->where('email', 'LIKE', '%' . $email . '%');
        }

        return $query;
    }

    /**
     * Scope member ID.
     *
     * @param Object $query
     * @param string $id
     *
     * @return Object
     */
    public function scopeIdNumber(Object $query, string $id = null)
    {
        if ($id !== null) {
            $query->whereIn('id', explode(',', $id));
        }

        return $query;
    }

    /**
     * Scope name.
     *
     * @param Object $query
     * @param string $name
     *
     * @return Object
     */
    public function scopeName(Object $query, string $name = null)
    {
        if ($name !== null) {
            $query->whereHas('userProfile', function ($query) use ($name) {
                $query->where('name', 'LIKE', '%' . $name . '%');
            });
        }

        return $query;
    }

    /**
     * Scope join date.
     *
     * @param Object $query
     * @param string $dateFrom
     * @param string $dateTo
     *
     * @return Object
     */
    public function scopeDateTime(Object $query, string $dateFrom = null, string $dateTo = null)
    {
        if ($dateFrom != null && $dateTo != null) {
            $query->whereBetween('created_at', array($dateFrom, $dateTo));
        }

        return $query;
    }

    /**
     * Scope member rank.
     *
     * @param Object $query
     * @param array $rank
     *
     * @return Object
     */
    public function scopeRank(Object $query, array $rank = null)
    {
        if ($rank !== null) {
            $query->whereHas('userProfile', function ($query) use ($rank) {
                $query->whereIn('rank_id', $rank);
            });
        }

        return $query;
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
        if ($type == Constants::USER_FEMALE || $type == Constants::USER_MALE) {
            return $query->where('type', $type);
        }

        return $query;
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
        return $query->where('type', $reverseType);
    }
}
