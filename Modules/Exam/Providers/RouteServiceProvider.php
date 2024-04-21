<?php

namespace Modules\Exam\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The module namespace to assume when generating URLs to actions.
     *
     * @var string
     */
    protected $moduleNamespace = 'Modules\Exam\Http\Controllers';

    /**
     * Called before routes are registered.
     *
     * Register any model bindings or pattern based filters.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();
        $this->mapAdminRoutes();
        $this->mapUserRoutes();
        $this->mapWebRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->moduleNamespace)
            ->group(module_path('Exam', '/Routes/web.php'));
    }

    protected function mapAdminRoutes()
    {

        Route::middleware(['web','auth','auth.admin'])
            ->namespace($this->moduleNamespace.'\Admin')
            ->name('admin')
            ->prefix('admin')
            ->group(module_path('Exam', '/Routes/admin.php'));
    }

    protected function mapUserRoutes()
    {
        Route::middleware(['web','auth','auth.user'])
            ->namespace($this->moduleNamespace.'\User')
            ->name('User')
            ->prefix('panel')
            ->group(module_path('Exam', '/Routes/user.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->moduleNamespace)
            ->group(module_path('Exam', '/Routes/api.php'));
    }
}
