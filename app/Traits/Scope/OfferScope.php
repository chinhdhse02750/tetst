<?php

namespace App\Traits\Scope;

trait OfferScope
{
    /**
     * Scope Id member.
     *
     * @param object $query
     * @param int|null $id
     * @return mixed
     */
    public function scopeIdMember(object $query, $id)
    {
        if (!is_null($id)) {
            return $query->where('user_id', $id);
        }
        return $query;
    }

    /**
     * Scope email member.
     *
     * @param object $query
     * @param string|null $email
     * @return object
     */
    public function scopeEmail(object $query, $email)
    {
        if (!is_null($email)) {
            $query->whereHas('user', function ($query) use ($email) {
                $query->where('email', 'LIKE', '%' . $email . '%');
            });
        }

        return $query;
    }

    /**
     * Scope time offer.
     *
     * @param object $query
     * @param string|null $startTime
     * @param string|null $endTime
     * @return mixed
     */
    public function scopeTime(object $query, $startTime, $endTime)
    {
        if (empty($startTime) && empty($endTime)) {
            return $query;
        }
        if ($startTime && is_null($endTime)) {
            return $query->where('created_at', '>=', $startTime);
        }
        if (is_null($startTime) && $endTime) {
            return $query->where('created_at', '<=', $endTime);
        }

        return $query->whereBetween('created_at', [$startTime, $endTime]);
    }

    /**
     * Scope rank.
     *
     * @param object $query
     * @param array $rankIds
     * @return mixed
     */
    public function scopeRank($query, $rankIds)
    {
        if (!empty($rankIds)) {
            $query->whereHas('user.userProfile', function ($query) use ($rankIds) {
                $query->whereIn('rank_id', $rankIds);
            });
        }

        return $query;
    }
}
