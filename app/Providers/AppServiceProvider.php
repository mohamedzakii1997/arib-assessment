<?php

namespace App\Providers;

use App\Helpers\Pagination;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind('Pagination', function()
        {
            return new Pagination();
        });
    }



    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
