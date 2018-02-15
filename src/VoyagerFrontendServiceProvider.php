<?php
namespace Pvtl\VoyagerFrontend;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Pvtl\VoyagerFrontend\Commands\VoyagerFrontendCommand;

class VoyagerFrontendServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Pages and Posts Routes
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');

        // Defines which files to copy the root project
        $this->publishes([
            __DIR__.'/../resources/assets' => base_path('resources/assets'),
            __DIR__.'/database/seeds' => base_path('database/seeds'),
        ]);

        // Provide user data to all views
        View::composer('*', function($view) {
            $view->with('currentUser', \Auth::user());
        });

        // Migrations
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        // Front-end views can be used like:
        //  - @include('voyager-frontend::partials.meta') OR
        //  - view('voyager-frontend::modules/posts/post');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'voyager-frontend');

        if ($this->app->runningInConsole()) {
            $this->commands([
                commands\InstallCommand::class
            ]);
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom( __DIR__.'/config/voyager-frontend.php', 'voyager-frontend');

        $this->app->alias(VoyagerFrontend::class, 'voyager-frontend');
    }
}
