<?php

namespace App\Traits\Scope;

trait NewsScope
{
    /**
     * Scope active news.$status
     *
     * @param object $query
     * @param string|null $status
     *
     * @return mixed
     */
    public function scopeActive(object $query, $status)
    {
        if (!is_null($status)) {
            return $query->where('active', $status);
        }

        return $query;
    }

    /**
     * Scope start time.
     *
     * @param object $query
     * @param string $startTime
     * @param string $endTime
     * @return mixed
     */
    public function scopeTime(object $query, $startTime, $endTime)
    {
        if (empty($startTime) && empty($endTime)) {
            return $query;
        }

        if (!empty($startTime)) {
            if (empty($endTime)) {
                return $query->where('start_time', '<=', $startTime)
                    ->where(function ($q) use ($startTime) {
                        $q->where('end_time', '>', $startTime)->orWhereNull('end_time');
                    });
            }

            return $query
                ->where(function ($q) use ($startTime) {
                    $q->where('start_time', '<=', $startTime)->where('end_time', '>', $startTime);
                })
                ->orWhere(function ($q) use ($startTime) {
                    $q->where('start_time', '>=', $startTime)->where('start_time', '<', $startTime);
                })
            ;
        }

        return $query->where('start_time', '<=', $endTime)->where('end_time', '>=', $endTime);
    }
}
