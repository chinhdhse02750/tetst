<?php

namespace App\Helpers;

use Carbon\Carbon;

class Common
{
    /**
     * Ensure env is local
     *
     * @return bool
     */
    public static function isLocalEnv(): bool
    {
        return config('app.env') === 'local';
    }

    /**
     * @param int $time
     * @return false|string
     * @throws \Exception
     */
    public static function addTimeFromNow(int $time)
    {
        $currentTime = date_format(Carbon::now(), 'Y-m-d H:i:s');
        $carbon_date = Carbon::parse($currentTime);
        $paymentExpired = $carbon_date->addHours($time);

        return  date_format($paymentExpired, 'Y-m-d H:i:s');
    }
}
