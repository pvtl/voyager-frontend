<?php

$controller = 'Pivotal\VoyagerFrontend\Http\Controllers\VoyagerFrontendController';

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
Route::get('/{slug?}', $controller . '@getPageRoutes');