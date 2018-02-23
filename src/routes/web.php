<?php

$controller = 'Pvtl\VoyagerFrontend\Http\Controllers\VoyagerFrontendController';

/**
 * Authentication
 */
Route::group(['middleware' => ['web'], 'namespace'=>'App\Http\Controllers'], function () {
    Auth::routes();
});

/**
 * Posts module
 */
Route::group(['prefix' => 'posts'], function () use ($controller) {
    Route::get('/', $controller . '@getAllPostsRoute');
    Route::get('/{slug}', $controller . '@getPostRoutes');
});

/**
 * Pages module
 * - Don't include this route when the VoyagerPageBlocks package is installed
 *   (it takes care of this route for us)
 */
if (!class_exists('Pvtl\VoyagerPageBlocks\PageBlocksServiceProvider')) {
    Route::get('/{slug?}', $controller . '@getPageRoutes');
}
