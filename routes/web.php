<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// With route prefix and name prefix
// Route assigned name "admin.users"... Matches The "/admin/users" URL
// eg: url: admin/users/{user}/edit  name: admin.users.edit

Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function () {
	Route::resource ('/users', 'UserController', ['except' => ['show', 'create', 'store']]);
	});