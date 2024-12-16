<?php
return [
    'secret_key' => env('SOLIDXT_SSO_SECRET_KEY', ''),
    'user_create' => env('SOLIDXT_SSO_AUTO_USER_CREATE', true),
    'url' => env('SOLIDXT_SSO_URL', 'https://sso.solidxt.com/'),
];
