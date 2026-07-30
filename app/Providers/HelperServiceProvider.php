<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class HelperServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Register your custom helper functions here
        $this->app->singleton('formatDate', function () {
            return new Helper();
        });
    }
}