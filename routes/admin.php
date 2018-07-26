<?php
Route::group(['middleware' => ['permission:admin.index.index']], function () {

	Route::get('/', 'IndexController@index')->name('admin.index.index');

});

//权限
Route::namespace('Rbac')->prefix('rbac')->group(function () {

	Route::resource('permission', 'PermissionController', ['names' => [
		'index'  => 'admin.rbac.permission.index',
		'store'  => 'admin.rbac.permission.store',
		'create'  => 'admin.rbac.permission.create',
		'update' => 'admin.rbac.permission.update',
		'edit' => 'admin.rbac.permission.edit',
		'show'   => 'admin.rbac.permission.show',
	], 'except' => ['destroy']]);

	Route::resource('role', 'RoleController', ['names' => [
		'index'  => 'admin.rbac.role.index',
		'store'  => 'admin.rbac.role.store',
		'create'  => 'admin.rbac.role.create',
		'update' => 'admin.rbac.role.update',
		'edit' => 'admin.rbac.role.edit',
		'show'   => 'admin.rbac.role.show',
	], 'except' => ['destroy']]);

	Route::resource('adminUser', 'AdminController', ['names' => [
		'index'  => 'admin.rbac.adminUser.index',
		'store'  => 'admin.rbac.adminUser.store',
		'create'  => 'admin.rbac.adminUser.create',
		'update' => 'admin.rbac.adminUser.update',
		'edit' => 'admin.rbac.adminUser.edit',
		'show'   => 'admin.rbac.adminUser.show',
	], 'except' => ['destroy']])->middleware(
		'permission:admin.rbac.adminUser.index|admin.rbac.adminUser.store|admin.rbac.adminUser.create|admin.rbac.adminUser.update|admin.rbac.adminUser.edit|admin.rbac.adminUser.show'
	);

});

// 财务管理
Route::namespace('Finance')->prefix('finance')->group(function () {
	// 用户提现管理
	Route::get('user-withdraw', 'UserWithdrawController@index')->name('admin.finance.user-withdraw.index');
	Route::post('user-withdraw/complete/{id}', 'UserWithdrawController@complete')->name('admin.finance.user-withdraw.complete');
	Route::post('user-withdraw/refuse/{id}', 'UserWithdrawController@refuse')->name('admin.finance.user-withdraw.refuse');

	// 用户加款管理
	Route::get('user-add-money', 'UserAddMoneyController@index')->name('admin.finance.user-add-money.index');
	Route::post('user-add-money', 'UserAddMoneyController@store')->name('admin.finance.user-add-money.store');
	Route::post('user-add-money/agree/{id}', 'UserAddMoneyController@agree')->name('admin.finance.user-add-money.agree');
	Route::post('user-add-money/refuse/{id}', 'UserAddMoneyController@refuse')->name('admin.finance.user-add-money.refuse');

	// 结算账号
	Route::resource('trading-account', 'TradingAccountController', ['names' => [
		'index'   => 'admin.finance.trading-account.index',
		'store'   => 'admin.finance.trading-account.store',
		'destroy' => 'admin.finance.trading-account.destroy',
	], 'only' => ['index', 'store', 'destroy']]);

	// 平台资产
	Route::get('platform-asset', 'PlatformAssetController@index')->name('admin.finance.platform.index');
	// 平台流水
	Route::get('platform-amount-flow', 'PlatformAmountFlowController@index')->name('admin.finance.platform-amount-flow.index');
	Route::get('platform-amount-flow/export', 'PlatformAmountFlowController@export')->name('admin.finance.platform-amount-flow.export');
	// 查看流水订单
	Route::get('platform-amount-flow/order/{id}', 'PlatformAmountFlowController@order')->name('admin.finance.platform-amount-flow.order');

	// 用户资产
	Route::get('user-asset', 'UserAssetController@index')->name('admin.finance.user-asset.index');

	// 用户流水
	Route::get('user-amount-flow', 'UserAmountFlowController@index')->name('admin.finance.user-amount-flow.index');

	// 平台资产日报
	Route::get('platform-asset-daily', 'PlatformAssetDailyController@index')->name('admin.finance.platform-asset-daily.index');
	Route::get('platform-asset-daily/export', 'PlatformAssetDailyController@export')->name('admin.finance.platform-asset-daily.export');

	// 用户资产日报
	Route::get('user-asset-daily', 'UserAssetDailyController@index')->name('admin.finance.user-asset-daily.index');
	Route::get('user-asset-daily/export', 'UserAssetDailyController@export')->name('admin.finance.user-asset-daily.export');

});

/*// 报表查询
Route::namespace('Statement')->prefix('statement')->group(function () {
	// 平台资产日报
	Route::get('platform-asset-daily', 'PlatformAssetDailyController@index')->name('admin.statement.platform-asset-daily.index');
	Route::get('platform-asset-daily/export', 'PlatformAssetDailyController@export')->name('admin.statement.platform-asset-daily.export');

	// 用户资产日报
	Route::get('user-asset-daily', 'UserAssetDailyController@index')->name('admin.statement.user-asset-daily.index');
	Route::get('user-asset-daily/export', 'UserAssetDailyController@export')->name('admin.statement.user-asset-daily.export');
});*/

// 后台系统日志
Route::group(['prefix' => 'log'],function ($router)
{
	$router->get('/','\Arcanedev\LogViewer\Http\Controllers\LogViewerController@index')->name('admin.log.log.dash')->middleware('permission:admin.log.log.dash');
	$router->get('list','\Arcanedev\LogViewer\Http\Controllers\LogViewerController@listLogs')->name('admin.log.log.index')->middleware('permission:admin.log.log.index');
	$router->delete('delete','\Arcanedev\LogViewer\Http\Controllers\LogViewerController@delete')->name('admin.log.log.destroy');
	$router->get('/{date}','\Arcanedev\LogViewer\Http\Controllers\LogViewerController@show')->name('admin.log.log.show');
	$router->get('/{date}/download','\Arcanedev\LogViewer\Http\Controllers\LogViewerController@download')->name('admin.log.log.download');
	$router->get('/{date}/{level}','\Arcanedev\LogViewer\Http\Controllers\LogViewerController@showByLevel')->name('admin.log.log.filter');
	$router->get('/logs/{date}/{level}/search','\Arcanedev\LogViewer\Http\Controllers\LogViewerController@search')->name('admin.log.log.search');
});