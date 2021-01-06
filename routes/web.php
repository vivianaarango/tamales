<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;

Route::get('/', 'Admin\UsersController@validateSession');

### Users ###
/* Validate session */
Route::get('/admin/user-session', 'Admin\UsersController@validateSession');
/* Login */
Route::post('/admin/user-login', 'Admin\UsersController');
/* Logout */
Route::get('/admin/user-logout', 'Admin\UsersController@logout');
/* Change status */
Route::post('/admin/users/{user}/status', 'Admin\UsersController@changeStatus')->name('admin/users/status');
/* Delete */
Route::delete('/admin/users/{user}', 'Admin\UsersController@delete')->name('admin/users/delete');
/* View edit */
Route::get('/admin/users/{user}/edit','Admin\UsersController@edit')->name('admin/users/edit');
/* View add location */
Route::get('/admin/users/{user}/add-location', 'Admin\UsersController@location')->name('admin/users/add-location');
/* Store */
Route::post('/admin/users/store-location', 'Admin\UsersController@storeLocation');
/* View add document */
Route::get('/admin/users/{user}/add-document', 'Admin\UsersController@document')->name('admin/users/add-document');

### Admin ###
/* View create */
Route::get('/admin/admin-users-create', 'Admin\AdminUsersController@create');
/* Store */
Route::post('/admin/admin-users-store', 'Admin\AdminUsersController@store');

### Production
/* List */
Route::get('/admin/production-list', 'Admin\ProductionController@list');
/* View create */
Route::get('/admin/production-create', 'Admin\ProductionController@create');
/* Store */
Route::post('/admin/production-store', 'Admin\ProductionController@store');
/* View edit */
Route::get('/admin/production/{production}/edit','Admin\ProductionController@edit')->name('admin/production/edit');
/* Export */
Route::get('/admin/production/export', 'Admin\ProductionController@export')->name('admin/production/export');