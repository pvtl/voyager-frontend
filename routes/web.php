<?php

$accountController = 'Pvtl\VoyagerFrontend\Http\Controllers\AccountController';
$postController = 'Pvtl\VoyagerFrontend\Http\Controllers\PostController';
$pageController = 'Pvtl\VoyagerFrontend\Http\Controllers\PageController';
$searchController = 'Pvtl\VoyagerFrontend\Http\Controllers\SearchController';

/**
 * Authentication
 */
Route::group(['middleware' => ['web']], function () use ($accountController) {
    Route::group(['namespace' => 'App\Http\Controllers'], function () {
        Auth::routes();
    });

    Route::group(['middleware' => 'auth', 'as' => 'voyager-frontend.account',], function () use ($accountController) {
        Route::get('/account', "$accountController@index");
        Route::post('/account', "$accountController@updateAccount");
    });
});


/**
 * Posts module
 */
Route::group(['prefix' => 'posts', 'middleware' => ['web']], function () use ($postController) {
    Route::get('/', "$postController@getPosts");
    Route::get('/{slug}', "$postController@getPost");
});

/**
 * Pages module
 * - Don't include this route when the VoyagerPageBlocks package is installed
 *   (it takes care of this route for us)
 */
if (!class_exists('Pvtl\VoyagerPageBlocks\Providers\PageBlocksServiceProvider')) {
    Route::get('/{slug?}', "$pageController@getPage")->middleware('web');
}

/**
 * Let's get some search going
 */
Route::get('/search', "$searchController@index");
