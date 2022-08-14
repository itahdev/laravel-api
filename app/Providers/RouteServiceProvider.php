<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            $this->mapApiRoutes();
            $this->mapWebRoutes();

            $this->mapPartnerRoutes();
            $this->mapAdminRoutes();
            $this->mapSubdomainRoutes();
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }

    /**
     * @return void
     */
    protected function mapApiRoutes(): void
    {
        Route::middleware('api')
            ->prefix('api')
            ->group(base_path('routes/api.php'));
    }

    /**
     * @return void
     */
    protected function mapWebRoutes(): void
    {
        Route::middleware('web')
            ->group(base_path('routes/web.php'));
    }

    /**
     * @return void
     */
    protected function mapPartnerRoutes(): void
    {
        Route::prefix('partner-api/v1')
            ->middleware('api')
            ->group(base_path('modules/Partner/Routes/v1.php'));
    }

    /**
     * @return void
     */
    protected function mapAdminRoutes(): void
    {
        Route::prefix('admin-api/v1')
            ->middleware('admin')
            ->group(base_path('modules/Admin/Routes/v1.php'));
    }

    /**
     * @return void
     */
    protected function mapSubdomainRoutes(): void
    {
        Route::domain('app.' . config('app.domain'))
            ->namespace($this->namespace)
            ->group(base_path('routes/subdomain.php'));
    }
}
