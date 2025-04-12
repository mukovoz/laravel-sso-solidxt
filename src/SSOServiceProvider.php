<?php
namespace Solidxt\SSO;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;

class SSOServiceProvider extends ServiceProvider{

    public function boot(Router $router)
    {
        $router->aliasMiddleware('auth', SSOAuthMiddleware::class);

        $this->loadRoutesFrom(__DIR__.'/routes/sso.php');

        $this->publishes([
            __DIR__.'/config/sso.php' => config_path('sso.php'),
        ],'laravel-assets');


    }
}

