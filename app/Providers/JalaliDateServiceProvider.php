<?php

namespace App\Providers;

use App\Services\JalaliDateService;
use Illuminate\Support\ServiceProvider;

class JalaliDateServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('jalaliDate',function()
        {
            return new JalaliDateService();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
