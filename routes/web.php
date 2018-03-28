<?php

$accountController = '\Pvtl\VoyagerFrontend\Http\Controllers\AccountController';
$pageController = '\Pvtl\VoyagerFrontend\Http\Controllers\PageController';
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
 * Pages module
 * - Don't include this route when the VoyagerPageBlocks package is installed
 *   (it takes care of this route for us)
 * - The following is a "catch-all" route, so we need to exclude any (DB) registered
 *   slugs to avoid overriding everything.
 */
if (!class_exists('\Pvtl\VoyagerPageBlocks\Providers\PageBlocksServiceProvider')) {
    $dataTypes = \TCG\Voyager\Models\DataType::all();
    $excludedRoutes = array();
    foreach ($dataTypes as $dataTypes) {
        array_push($excludedRoutes, $dataTypes->slug, $dataTypes->slug . '/*');
    }

    if (!Request::is($excludedRoutes)) {
        Route::get('/{slug?}', "$pageController@getPage")->middleware('web')->where('slug', '.+');
    }
}

/**
 * Let's get some search going
 */
Route::get('/search', "$searchController@index");
