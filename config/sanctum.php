<?php

return [

    'stateful' => explode(',', env('SANCTUM_STATEFUL_DOMAINS', env('APP_URL', 'http://localhost:8000'))),

    'guard' => ['web'],

    'expiration' => null,

    'middleware' => [
        'verify_csrf_token' => App\Http\Middleware\VerifyCsrfToken::class,
        'encrypt_cookies' => App\Http\Middleware\EncryptCookies::class,
    ],

];
