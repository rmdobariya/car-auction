<?php

namespace App\Helpers;

use App\Models\Country;
use App\Models\Language;
use App\Models\LanguageScreen;
use App\Models\LanguageString;
use Illuminate\Support\Facades\Cache;

class CatchCreateHelper
{
    public static function getLanguage( $local )
    {
        if (Cache::has($local . '_language')) {
            return Cache::get($local . '_language');
        } else {
            $array = [];
            $languages = Language::where('status', 'active')->get();
            foreach ($languages as $language) {
                $array[] = [
                    'id'            => $language->id,
                    'name'          => $language['name'],
                    'is_rtl'        => $language->is_rtl,
                    'language_code' => $language['language_code'],
                    'status'        => $language->status,
                ];
            }
            Cache::forever($local . '_language', $array);
            return $array;
        }
    }

    public static function getLanguageStringCatch( $catch_name, $locale ): array
    {
        if (Cache::has($locale . '_' . $catch_name)) {
            return Cache::get($locale . '_' . $catch_name);
        } else {
            $array = [];
            if ($catch_name == 'admin_string') {
                $languageStrings = LanguageString::get();
                foreach ($languageStrings as $languageString) {
                    $array[$languageString->name_key] = $languageString->name;
                }
            } else if ($catch_name == 'api_string') {
                $languageStrings = LanguageString::whereHas('language_screen', function ( $query ) {
                    $query->where('app_or_panel', 0);
                })->get();
                foreach ($languageStrings as $languageString) {
                    $array[$languageString->name_key] = $languageString->name;
                }
            } else if ($catch_name == 'web_string') {
                $languageStrings = LanguageString::whereHas('language_screen', function ( $query ) {
                    $query->where('app_or_panel', 2);
                })->get();
                foreach ($languageStrings as $languageString) {
                    $array[$languageString->name_key] = $languageString->name;
                }
            } else if ($catch_name == 'admin_display_string') {
                // \DB::enableQueryLog();
                $languageStrings = LanguageString::with('languageScreen')->get();
                // dd(\DB::getQueryLog());

                foreach ($languageStrings as $languageString) {
                    if($languageString->languageScreen) {
                        $array[] = [
                            'id'           => $languageString->id,
                            'app_or_panel' => $languageString->languageScreen->app_or_panel,
                            'screen_name'  => $languageString->languageScreen->name,
                            'name_key'     => $languageString->name_key,
                            'en_value'     => $languageString->translateOrNew('en')->name,
                            'ar_value'     => $languageString->translateOrNew('ar')->name
                        ];
                    }
                    //$array[$languageString->name_key] = $languageString->name;
                }
            }
            Cache::forever($locale . '_' . $catch_name, $array);
            return $array;
        }
    }
}
