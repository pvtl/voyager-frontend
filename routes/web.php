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

Route::group([
    'as' => 'voyager-frontend.pages.',
    'prefix' => 'admin/pages/',
    'middleware' => ['web', 'admin.user'],
    'namespace' => '\Pvtl\VoyagerFrontend\Http\Controllers'
], function () {
    Route::post('layout/{id}', ['uses' => "PageController@changeLayout", 'as' => 'layout']);
});

/**
 * Let's get some search going
 */
Route::get('/search', "$searchController@index")
    ->middleware(['web'])
    ->name('voyager-frontend.search');
