<?php
namespace Pivotal\VoyagerFrontend;

use Illuminate\Support\ServiceProvider;
use Pivotal\VoyagerFrontend\Commands\VoyagerFrontendCommand;

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

        // Migrations
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        // Front-end views can be used like:
        //  - @include('voyagerfrontend::partials.meta') OR
        //  - view('voyagerfrontend::modules/posts/post');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'voyagerfrontend');

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
        $this->mergeConfigFrom( __DIR__.'/config/voyager-frontend.php', 'voyagerfrontend');

        $this->app->alias(VoyagerFrontend::class, 'voyagerfrontend');
    }
}
