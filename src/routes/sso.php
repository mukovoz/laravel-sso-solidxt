<?php

use Illuminate\Support\Facades\Route;
use Solidxt\SSO\Controller\SSOController;

Route::any('sso/callback', [SSOController::class, 'callback'])
    ->name('sso.callback')
    ->middleware('web')
    ->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);;
