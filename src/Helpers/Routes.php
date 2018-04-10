<?php

namespace Pvtl\VoyagerFrontend\Helpers;

use Pvtl\VoyagerFrontend\Page;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;

class Routes
{
    /**
     * Dynamically register pages.
     */
    public static function registerPageRoutes()
    {
        // Which Page Controller shall we use to display the page? Page Blocks or standard page?
        $pageController = class_exists('\Pvtl\VoyagerPageBlocks\Providers\PageBlocksServiceProvider')
            ? '\Pvtl\VoyagerPageBlocks\Http\Controllers\PageController'
            : '\Pvtl\VoyagerFrontend\Http\Controllers\PageController';

        // Get all page slugs (note it's cached for 5mins)
        $pages = Cache::remember('page/slugs', 5, function () {
            return Page::all('slug');
        });

        $slug = Request::path() === '/' ? 'home' : Request::path();

        // When the current URI is known to be a page slug, let it be a route
        if ($pages->contains('slug', $slug)) {
            Route::get('/{slug?}', "$pageController@getPage")
                ->middleware('web')
                ->where('slug', '.+');
        }
    }
}
