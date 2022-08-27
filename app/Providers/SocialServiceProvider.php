<?php

namespace App\Providers;

use Laravel\Socialite\Contracts\Factory;
use Laravel\Socialite\SocialiteServiceProvider as SocialiteParentServiceProvider;
use Modules\Partner\Services\Socials\SocialiteService;

class SocialServiceProvider extends SocialiteParentServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(Factory::class, function ($app) {
            return new SocialiteService($app);
        });
    }
}
