<?php

namespace Pvtl\VoyagerFrontend\Providers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\ServiceProvider;
use Illuminate\Console\Scheduling\Schedule;
use Laravel\Scout\Console\ImportCommand;
use Pvtl\VoyagerFrontend\Commands;
use Pvtl\VoyagerFrontend\Http\Controllers\PageController;

class VoyagerFrontendServiceProvider extends ServiceProvider
{
    /**
     * Our root directory for this package to make traversal easier
     */
    const PACKAGE_DIR = __DIR__ . '/../../';

    /**
     * Bootstrap the application services
     *
     * @param Request $request
     *
     * @return void
     */
    public function boot(Request $request)
    {
        $this->strapEvents();
        $this->strapRoutes();
        $this->strapPublishers();
        $this->strapViews($request);
        $this->strapHelpers();
        $this->strapMigrations();
        $this->strapCommands();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(self::PACKAGE_DIR . 'config/voyager-frontend.php', 'voyager-frontend');

        // Merge our Scout config over
        $this->mergeConfigFrom(self::PACKAGE_DIR . 'config/scout.php', 'scout');

        $this->app->alias(VoyagerFrontend::class, 'voyager-frontend');
    }

    /**
     * Bootstrap our Events
     */
    protected function strapEvents()
    {
        // When an Eloquent Model is updated, re-generate our indices (could get intense)
        Event::listen(['eloquent.saved: *', 'eloquent.deleted: *'], function() {
            Artisan::call("search-indices:generate");
        });
    }

    /**
     * Bootstrap our Routes
     */
    protected function strapRoutes()
    {
        // Pull default web routes
        $this->loadRoutesFrom(base_path('/routes/web.php'));

        // Then add our Pages and Posts Routes
        $this->loadRoutesFrom(self::PACKAGE_DIR . 'routes/web.php');
    }

    /**
     * Bootstrap our Publishers
     */
    protected function strapPublishers()
    {
        // Defines which files to copy the root project
        $this->publishes([
            self::PACKAGE_DIR . 'resources/assets' => base_path('resources/assets'),
            self::PACKAGE_DIR . 'database/seeds' => base_path('database/seeds'),
        ]);
    }

    /**
     * Bootstrap our Views
     * @param Request $request
     */
    protected function strapViews(Request $request)
    {
        // Provide user data to all views
        View::composer('*', function ($view) use ($request) {
            $view->with('currentUser', \Auth::user());
            $view->with('breadcrumbs', PageController::getBreadcrumbs($request));
        });

        // Front-end views can be used like:
        //  - @include('voyager-frontend::partials.meta') OR
        //  - view('voyager-frontend::modules/posts/post');
        $this->loadViewsFrom(self::PACKAGE_DIR . 'resources/views', 'voyager-frontend');

        // Use our own paginator view
        Paginator::defaultView('voyager-frontend::partials.pagination');
    }

    /**
     * Load helpers.
     */
    protected function strapHelpers()
    {
        require_once self::PACKAGE_DIR . '/src/Helpers/ImageResize.php';
    }

    /**
     * Bootstrap our Migrations
     */
    protected function strapMigrations()
    {
        // Migrations
        $this->loadMigrationsFrom(self::PACKAGE_DIR . 'database/migrations');
    }

    /**
     * Bootstrap our Commands/Schedules
     */
    protected function strapCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                Commands\InstallCommand::class
            ]);
        }

        // Register our commands
        $this->commands([
            Commands\GenerateSitemap::class,
            Commands\GenerateSearchIndices::class,
            ImportCommand::class,
        ]);

        // Schedule our commands
        $this->app->booted(function () {
            $sitemapCommand = $this->app->make(Schedule::class);

            $sitemapCommand->command('sitemap:generate')->daily();
            $sitemapCommand->command('search-indices:generate')->daily();
        });
    }
}
