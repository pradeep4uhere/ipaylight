<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\ProfileData;
use Illuminate\Support\Facades\View;

class ProfileServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Bind the ProfileData service to the container
        //$this->app->singleton('ProfileData', function ($app) {
            //return new ProfileData();
        //});
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            //$profileData = resolve('ProfileData');
            //$view->with('profileData', $profileData);
        });
    }
}
