<?php

namespace App\Traits\Scope;

use App\Helpers\Constants;

trait BalanceScope
{
    /**
     * Scope User ID.
     *
     * @param Object $query
     * @param string|null $id
     * @return Object
     */
    public function scopeUserId(Object $query, string $id = null)
    {
        if (!empty($id)) {
            return $query->whereHas('user', function ($q) use ($id) {
                $q->whereIn('users.id', explode(',', $id));
            });
        }

        return $query;
    }

    /**
     * Scope status active user.
     *
     * @param Object $query
     * @param int $status
     *
     * @return Object
     */
    public function scopeUserStatus(object $query, int $status = null)
    {
        if (!empty($status) || $status === Constants::USER_PRIVATE) {
            return $query->whereHas('user', function ($q) use ($status) {
                $q->where('users.active', (int)$status);
            });
        }

        return $query;
    }

    /**
     * Scope User Email.
     *
     * @param Object $query
     * @param string|null $email
     * @return Object
     */
    public function scopeUserEmail(Object $query, string $email = null)
    {
        if ($email !== null) {
            return $query->whereHas('user', function ($q) use ($email) {
                $q->where('users.email', 'LIKE', '%' . $email . '%');
            });
        }

        return $query;
    }

    /**
     * Scope Datetime send point.
     *
     * @param Object $query
     * @param string|null $dateFrom
     * @param string|null $dateTo
     * @return Object
     */
    public function scopeDateTime(Object $query, string $dateFrom = null, string $dateTo = null)
    {
        if ($dateFrom != null && $dateTo != null) {
            $query->whereDate('created_at', '>=', $dateFrom)->whereDate('created_at', '<=', $dateTo);
        }

        return $query;
    }

    /**
     * Scope balance type.
     *
     * @param Object $query
     * @param string $adjustment
     * @return Object
     */
    public function scopeAdjustment(Object $query, string $adjustment)
    {
        return $query->where('model_type', 'LIKE', '%' . $adjustment . '%');
    }
}
