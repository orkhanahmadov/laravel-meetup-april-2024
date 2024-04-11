<?php

namespace App\Providers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Stripe\StripeClient;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            StripeClient::class,
            fn (Application $app) => new StripeClient($app['config']->get('services.stripe.secret'))
        );
    }

    public function boot(): void
    {
        //
    }
}
