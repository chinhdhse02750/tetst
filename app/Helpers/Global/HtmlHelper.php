<?php

use App\Helpers\General\HtmlHelper;
use Illuminate\Support\Facades\Lang;

if (!function_exists('style')) {
    /**
     * @param string $url
     * @param array $attributes
     * @param null $secure
     *
     * @return mixed
     */
    function style($url, $attributes = [], $secure = null)
    {
        return resolve(HtmlHelper::class)->style($url, $attributes, $secure);
    }
}

if (!function_exists('script')) {
    /**
     * @param string $url
     * @param array $attributes
     * @param null $secure
     *
     * @return mixed
     */
    function script($url, $attributes = [], $secure = null)
    {
        return resolve(HtmlHelper::class)->script($url, $attributes, $secure);
    }
}

if (!function_exists('active_class')) {
    /**
     * Get the active class if the condition is not falsy.
     *
     * @param boolean $condition
     * @param string $activeClass
     * @param string $inactiveClass
     *
     * @return string
     */
    function active_class($condition, $activeClass = 'active', $inactiveClass = '')
    {
        return $condition ? $activeClass : $inactiveClass;
    }
}

if (! function_exists('encrypt_file_name')) {
    /**
     * Encrypt file name
     *
     * @param string $id
     * @param string $ext
     * @return string
     */
    function encrypt_file_name(string $id, string $ext)
    {
        return sprintf("%s.%s", md5($id), $ext);
    }
}

if (! function_exists('random_st')) {
    /**
     * Random unique string over time
     *
     * @return string
     */
    function random_st()
    {
        return md5(uniqid((string) rand(), true));
    }
}

if (! function_exists('lang_schedule')) {
    /**
     * Language for schedule
     *
     * @return string
     */
    function lang_schedule()
    {
        if (Lang::getLocale() === 'jp') {
            return 'ja';
        }

        return Lang::getLocale();
    }
}
