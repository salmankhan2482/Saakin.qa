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
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'google' => [

        'client_id' => '254686404569-tff9kjq40khefgbahbrvqe0tssj0t6v0.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'https://www.saakin.qa/auth/google/callback',
    ],
    'facebook' => [
        'client_id' => '935870547061067',
        'client_secret' => 'a2e9cbacbbbc3f8e7b60436d613bad1d',
        'redirect' => 'https://www.saakin.qa/auth/facebook/callback',
    ],
    'recaptcha' => [
        'key' => env('935870547061067'),
        'secret' => env('a2e9cbacbbbc3f8e7b60436d613bad1d'),
    ],
];
