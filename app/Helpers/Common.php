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

    /**
     * @param $str
     * @param string $delimiter
     * @return string
     */
    public static function createSlug($str, $delimiter = '-')
    {
        return strtolower(trim(preg_replace(
            '/[\s-]+/',
            $delimiter,
            preg_replace('/[^A-Za-z0-9-]+/', $delimiter, preg_replace(
                '/[&]/',
                'and',
                preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $str))
            ))
        ), $delimiter));
    }
}
