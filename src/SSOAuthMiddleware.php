<?php
namespace Solidxt\SSO;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Http\Request;

class SSOAuthMiddleware extends Authenticate
{

    protected function unauthenticated($request, array $guards)
    {

        throw new AuthenticationException(
            'Unauthenticated.',
            $guards,
            $request->expectsJson() ? null : config('sso.url')
        );
    }

}
