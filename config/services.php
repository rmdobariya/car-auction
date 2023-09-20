<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'facebook' => [
    'client_id' => '264737989800475', //Facebook API
    'client_secret' => 'fed25e72d585571e9389533e42fe5f12', //Facebook Secret
    'redirect' => 'http://127.0.0.1:8000/facebookCallback',
    ],
    'google' => [
        'client_id' => '152652525397-ino1ja962ppmr80o6t4g6099lulhdk79.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'https://car-auction.projectdemo.click/googleCallback',
    ],

];
