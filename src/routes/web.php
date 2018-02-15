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
 */
if (!Request::is('admin')) {
    Route::get('/{slug?}', $controller . '@getPageRoutes');
}
