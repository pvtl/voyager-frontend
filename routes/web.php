<?php

use Pvtl\VoyagerFrontend\Page;
use Illuminate\Support\Facades\Request;

$accountController = '\Pvtl\VoyagerFrontend\Http\Controllers\AccountController';
$searchController = '\Pvtl\VoyagerFrontend\Http\Controllers\SearchController';

/**
 * Authentication
 */
Route::group(['middleware' => ['web']], function () use ($accountController) {
    Route::group(['namespace' => 'App\Http\Controllers'], function () {
        Auth::routes();
    });

    Route::group(['middleware' => 'auth', 'as' => 'voyager-frontend.account'], function () use ($accountController) {
        Route::get('/account', "$accountController@index");
        Route::post('/account', "$accountController@updateAccount");

        /**
         * User impersonation
         */
        Route::get('/admin/users/impersonate/{userId}', "$accountController@impersonateUser")
            ->name('.impersonate')
            ->middleware(['web', 'admin.user']);

        Route::post('/admin/users/impersonate/{originalId}', "$accountController@impersonateUser")
            ->name('.impersonate')
            ->middleware(['web']);
    });
});

/**
 * Posts module
 */
Route::group([
    'prefix' => 'posts', // Must match its `slug` record in the DB > `data_types`
    'middleware' => ['web'],
    'as' => 'voyager-frontend.posts.',
    'namespace' => '\Pvtl\VoyagerFrontend\Http\Controllers'
], function () {
    Route::get('/', ['uses' => 'PostController@getPosts', 'as' => 'list']);
    Route::get('{slug}', ['uses' => 'PostController@getPost', 'as' => 'post']);
});

/**
 * Let's get some search going
 */
Route::get('/search', "$searchController@index")
    ->middleware(['web'])
    ->name('voyager-frontend.search');

/**
 * Pages catch-all route
 */
$slug = Request::path() === '/' ? 'home' : Request::path();

if (Page::where('slug', '=', $slug)->exists()) {
    if (class_exists('\Pvtl\VoyagerPageBlocks\Providers\PageBlocksServiceProvider')) {
        $pageController = '\Pvtl\VoyagerPageBlocks\Http\Controllers\PageController';
    } else {
        $pageController = '\Pvtl\VoyagerFrontend\Http\Controllers\PageController';
    }

    Route::get('/{slug?}', "$pageController@getPage")
        ->middleware('web')
        ->where('slug', '.+');
}
