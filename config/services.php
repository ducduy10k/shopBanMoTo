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
    'facebook' => [
        'client_id' => '309062063469898',  //client face của bạn
        'client_secret' => '9a983b41ce5d3e108353b4d19b949d11',  //client app service face của bạn
        'redirect' => 'http://localhost:8080/shopbanmoto/admin/callback' //callback trả về
    ],
    'google' => [
        'client_id' => '406345216669-tukdd0iatqagu0g0hti5c4g901hhrc9f.apps.googleusercontent.com',
        'client_secret' => 'sO2mTTp9gVtviXjbTRDG47N9',
        'redirect' => 'http://localhost:8080/shopbanmoto/google/callback'
    ],


];
