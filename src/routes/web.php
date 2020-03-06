<?php

use Illuminate\Support\Facades\Route;
Auth::routes();
Route::group(['prefix' => 'administration', 'as' => 'admin.', 'namespace' => 'Admin','middleware' => ['web', 'auth','checkPermission:admin'] ], function () {

//Role
    Route::group(['prefix' => 'role', 'as' => 'role.'], function () {
        Route::get('/', '\LaraPack\RolePermission\Http\Controllers\Admin\RoleController@index')->name('index');
        Route::get('/creer', '\LaraPack\RolePermission\Http\Controllers\Admin\RoleController@create')->name('create');
        Route::get('/{role}/editer', '\LaraPack\RolePermission\Http\Controllers\Admin\RoleController@edit')->name('edit');
        Route::post('/', '\LaraPack\RolePermission\Http\Controllers\Admin\RoleController@save')->name('save');
        Route::get('/{role}/supprimer', '\LaraPack\RolePermission\Http\Controllers\Admin\RoleController@delete')->name('delete');
        Route::get('/datatable', '\LaraPack\RolePermission\Http\Controllers\Admin\RoleController@ajaxDataTable')->name('ajax.datatable');
        Route::post('/generate-slug', '\LaraPack\RolePermission\Http\Controllers\Admin\RoleController@generateSlug')->name('ajax.generate.slug');
    });

    //Permission
    Route::group(['prefix' => 'permission', 'as' => 'permission.'], function () {
        Route::get('/', '\LaraPack\RolePermission\Http\Controllers\Admin\PermissionController@index')->name('index');
        Route::get('/creer', '\LaraPack\RolePermission\Http\Controllers\Admin\PermissionController@create')->name('create');
        Route::get('/{permission}/editer', '\LaraPack\RolePermission\Http\Controllers\Admin\PermissionController@edit')->name('edit');
        Route::post('/', '\LaraPack\RolePermission\Http\Controllers\Admin\PermissionController@save')->name('save');
        Route::get('/{permission}/supprimer', '\LaraPack\RolePermission\Http\Controllers\Admin\PermissionController@delete')->name('delete');
        Route::get('/datatable', '\LaraPack\RolePermission\Http\Controllers\Admin\PermissionController@ajaxDataTable')->name('ajax.datatable');
    });

    //Assign Permission
    Route::group(['prefix' => 'assign-permission', 'as' => 'assign-permission.'], function () {
        Route::get('/', '\LaraPack\RolePermission\Http\Controllers\Admin\AssignPermissionController@index')->name('index');
        Route::get('/creer', '\LaraPack\RolePermission\Http\Controllers\Admin\AssignPermissionController@create')->name('create');
        Route::get('/{role}/editer', '\LaraPack\RolePermission\Http\Controllers\Admin\AssignPermissionController@edit')->name('edit');
        Route::post('/', '\LaraPack\RolePermission\Http\Controllers\Admin\AssignPermissionController@save')->name('save');
        Route::get('/{role}/supprimer', '\LaraPack\RolePermission\Http\Controllers\Admin\AssignPermissionController@delete')->name('delete');
        Route::get('/datatable', '\LaraPack\RolePermission\Http\Controllers\Admin\AssignPermissionController@ajaxDataTable')->name('ajax.datatable');
    });

});
