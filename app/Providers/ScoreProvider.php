<?php

namespace App\Providers;

use App\Services\ScoreService;
use Illuminate\Support\ServiceProvider;

class ScoreProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('Score',function() {

            return New ScoreService();
        });
    }
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

    }
}
