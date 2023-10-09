<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Cache;


class CacheClearHelper
{
    public static function languageCacheClear()
    {
        $array = ['admin_language', 'api_language'];
        foreach ($array as $value) {
            if (Cache::has($value)) {
                Cache::forget($value);
            }
        }
    }

    public static function languageStringCacheClear()
    {
        $array = CatchCreateHelper::getLanguage('admin_language');
        foreach ($array as $value) {
            Cache::forget($value['language_code'] . '_api_string');
            Cache::forget($value['language_code'] . '_web_string');
            Cache::forget($value['language_code'] . '_admin_string');
        }
    }
}
