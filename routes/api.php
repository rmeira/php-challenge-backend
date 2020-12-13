<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', '/swagger', 301);

Route::namespace('v1')->prefix('v1')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('login', 'LoginController@login')->name('auth.login');
        Route::post('logout', 'LoginController@logout')->name('auth.logout');
    });

    Route::middleware('auth:api')->group(function () {
        Route::get('profile', 'ProfileController@index')->name('profile.index');
        Route::put('profile', 'ProfileController@update')->name('profile.update');
        Route::apiResource('profile-notifications', 'ProfileNotificationController');
        Route::apiResource('profile-permissions', 'ProfilePermissionController', ['only' => ['index']]);
        Route::apiResource('profile-roles', 'ProfileRoleController', ['only' => ['index']]);
        Route::apiResource('profile-activities', 'ProfileActivityController', ['only' => ['index']]);
        Route::apiResource('users', 'UserController');
        Route::apiResource('storage', 'StorageController', ['only' => ['store']]);
        Route::apiResource('roles', 'RoleController');
        Route::apiResource('permissions', 'PermissionController');
        Route::apiResource('activities', 'ActivityController', ['only' => ['index', 'show']]);
    });

    Route::apiResource('storage', 'StorageController', ['only' => ['show']]);
});
