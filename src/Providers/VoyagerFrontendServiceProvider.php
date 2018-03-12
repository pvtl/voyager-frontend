<?php

namespace Pvtl\VoyagerFrontend\Providers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Console\Scheduling\Schedule;
use Pvtl\VoyagerFrontend\Commands;
use Pvtl\VoyagerFrontend\Commands\GenerateSitemap;
use Pvtl\VoyagerFrontend\Http\Controllers\PageController;

class VoyagerFrontendServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services
     *
     * @param Request $request
     *
     * @return void
     */
    public function boot(Request $request)
    {
        // Pull default web routes
        $this->loadRoutesFrom(base_path('/routes/web.php'));

        // Then add our Pages and Posts Routes
        $this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');

        // Defines which files to copy the root project
        $this->publishes([
            __DIR__ . '/../../resources/assets' => base_path('resources/assets'),
            __DIR__ . '/../../database/seeds' => base_path('database/seeds'),
        ]);

        // Provide user data to all views
        View::composer('*', function ($view) use ($request) {
            $view->with('currentUser', \Auth::user());
            $view->with('breadcrumbs', PageController::getBreadcrumbs($request));
        });

        // Migrations
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

        // Front-end views can be used like:
        //  - @include('voyager-frontend::partials.meta') OR
        //  - view('voyager-frontend::modules/posts/post');
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'voyager-frontend');

        // Use our own paginator view
        Paginator::defaultView('voyager-frontend::partials.pagination');

        if ($this->app->runningInConsole()) {
            $this->commands([
                Commands\InstallCommand::class
            ]);
        }

        // Schedule our commands
        $this->app->booted(function () {
            $sitemapCommand = $this->app->make(Schedule::class);
            $sitemapCommand->command('sitemap:generate')->daily();
        });

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/voyager-frontend.php', 'voyager-frontend');

        // Merge our Scout config over
        $this->mergeConfigFrom(__DIR__ . '/../../config/scout.php', 'scout');

        // Register our commands
        $this->commands([
            GenerateSitemap::class,
        ]);

        $this->app->alias(VoyagerFrontend::class, 'voyager-frontend');
    }
}
