<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiteSettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('site_settings')->delete();

        \DB::table('site_settings')->insert(array(
            0 => array(
                'setting_key' => 'SITE_URL',
            ),
            1 => array(
                'setting_key' => 'LOGO_IMG',
            ),
            2 => array(
                'setting_key' => 'FAVICON_IMG',
            ),
            3 => array(
                'setting_key' => 'SMTP_HOST',
            ),
            4 => array(
                'setting_key' => 'SMTP_PORT',
            ),
            5 => array(
                'setting_key' => 'SMTP_USERNAME',
            ),
            6 => array(
                'setting_key' => 'SMTP_PASSWORD',
            ),
            7 => array(
                'setting_key' => 'SMTP_SCHEME',
            ),
            8 => array(
                'setting_key' => 'FROM_EMAIL',
            ),
            9 => array(
                'setting_key' => 'FROM_EMAIL_TITLE',
            ),
            10 => array(
                'setting_key' => 'ANDROID_VERSION',
            ),
            11 => array(
                'setting_key' => 'ANDROID_UPDATE_TEXT',
            ),
            12 => array(
                'setting_key' => 'ANDROID_FORCE_UPDATE',
            ),
            13 => array(
                'setting_key' => 'IOS_VERSION',
            ),
            14 => array(
                'setting_key' => 'IOS_UPDATE_TEXT',
            ),
            15 => array(
                'setting_key' => 'IOS_FORCE_UPDATE',
            ),
            16 => array(
                'setting_key' => 'CONTACT_NUMBER_1',
            ),
            17 => array(
                'setting_key' => 'CONTACT_NUMBER_2',
            ),
            18 => array(
                'setting_key' => 'WHATSAPP_NUMBER',
            ),
            19 => array(
                'setting_key' => 'ADDRESS_1',
            ),
            20 => array(
                'setting_key' => 'ADDRESS_2',
            ),
            21 => array(
                'setting_key' => 'COUNTRY',
            ),
            22 => array(
                'setting_key' => 'STATE',
            ),
            23 => array(
                'setting_key' => 'CITY',
            ),
            24 => array(
                'setting_key' => 'ZIPCODE',
            ),
            25 => array(
                'setting_key' => 'FACEBOOK_LINK',
            ),
            26 => array(
                'setting_key' => 'INSTAGRAM_LINK',
            ),
            27 => array(
                'setting_key' => 'TWITTER_LINK',
            ),
            28 => array(
                'setting_key' => 'PINTEREST_LINK',
            ),
            29 => array(
                'setting_key' => 'DRIBBLE_LINK',
            ),
        ));
    }
}
