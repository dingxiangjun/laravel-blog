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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

// 后台管理员认证
Route::get('admin/login', 'Admin\Auth\LoginController@showLoginForm')->name('admin.login');
Route::post('admin/login', 'Admin\Auth\LoginController@login')->name('admin.login');
Route::post('admin/logout', 'Admin\Auth\LoginController@logout')->name('admin.logout');


// 报表查询
Route::namespace('Home')->prefix('wechat')->group(function () {

	Route::get('/', 'WechatController@wechat')->name('wechat');

	Route::any('wxNotify', 'WechatController@wxNotify')->name('wechat.wxNotify');

	Route::any('wxReturn', 'WechatController@wxReturn')->name('wechat.wxReturn');


});
