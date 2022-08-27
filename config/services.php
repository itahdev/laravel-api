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
        'client_id' => env('FACEBOOK_APP_ID'),
        'client_secret' => env('FACEBOOK_APP_SECRET'),
        'redirect' => env('FACEBOOK_APP_CALLBACK'),
    ],
    'twitter' => [
        'client_id' => env('TWITTER_CLIENT_ID'),
        'client_secret' => env('TWITTER_CLIENT_SECRET'),
        'redirect' => env('TWITTER_CLIENT_CALLBACK'),
    ],
    'line' => [
        'client_id' => env('LINE_CHANNEL_ID'),
        'client_secret' => env('LINE_CHANNEL_SECRET'),
        'redirect' => env('LINE_CHANNEL_CALLBACK'),
        'auth_url' => env('LINE_CHANNEL_AUTH_URL', 'https://access.line.me/oauth2/v2.1/authorize'),
        'token_url' => env('LINE_CHANNEL_TOKEN_URL', 'https://api.line.me/oauth2/v2.1/token'),
        'verify_url' => env('LINE_CHANNEL_VERIFY_URL', 'https://api.line.me/oauth2/v2.1/verify'),
    ],
    'yahoo' => [
        'client_id' => env('YAHOO_CLIENT_ID'),
        'client_secret' => env('YAHOO_CLIENT_SECRET'),
        'redirect' => env('YAHOO_CLIENT_CALLBACK'),
        'auth_url' => env('YAHOO_CLIENT_AUTH_URL', 'https://api.login.yahoo.com/oauth2/request_auth'),
        'token_url' => env('YAHOO_CLIENT_TOKEN_URL', 'https://api.login.yahoo.com/oauth2/get_token'),
        'userinfo' => env('YAHOO_CLIENT_USERINFO_URL', 'https://api.login.yahoo.com/oauth2/userinfo'),
    ],
    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        'redirect' => env('GOOGLE_CLIENT_CALLBACK'),
    ],
];
