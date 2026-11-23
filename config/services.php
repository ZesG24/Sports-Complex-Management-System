<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Resend, Postmark, AWS, and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'key' => env('POSTMARK_API_KEY'),
    ],

    'resend' => [
        'key' => env('RESEND_API_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'zalopay' => [
        'app_id' => (int) env('ZALOPAY_APP_ID', 554),
        'key1' => env('ZALOPAY_KEY1', ''),
        'key2' => env('ZALOPAY_KEY2', ''),
        'create_url' => env('ZALOPAY_CREATE_URL', 'https://sb-openapi.zalopay.vn/v2/create'),
        'query_url' => env('ZALOPAY_QUERY_URL', 'https://sb-openapi.zalopay.vn/v2/query'),
        'callback_url' => env('ZALOPAY_CALLBACK_URL'),
        'verify_ssl' => env('ZALOPAY_VERIFY_SSL', true),
    ],

];
