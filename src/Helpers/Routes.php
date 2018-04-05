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
        $pages = Cache::remember('models.pages', 30, function () {
          return Page::all();
        });

        $pageController = '\Pvtl\VoyagerFrontend\Http\Controllers\PageController';

        if (class_exists('\Pvtl\VoyagerPageBlocks\Providers\PageBlocksServiceProvider')) {
            $pageController = '\Pvtl\VoyagerPageBlocks\Http\Controllers\PageController';
        }

        $slug = Request::path() === '/' ? 'home' : Request::path();

        if ($pages->contains('slug', $slug)) {
            Route::get('/{slug?}', "$pageController@getPage")
                ->middleware('web')
                ->where('slug', '.+');
        }
    }
}
