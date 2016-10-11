<?php


Route::group(['prefix' => '/', 'namespace' => 'Modules\Admin\Http\Controllers'], function()
{
	Route::get('/', 'HomeController@index');
	Route::get('search/{id}', 'HomeController@search');
	
	//Route::get('contact', function(){ return View('site.contact'); });
	//Route::post('contact', 'HomeController@sendContact');
});

Route::group(['prefix' => 'admin', 'namespace' => 'Modules\Admin\Http\Controllers', 'middleware'=>'auth'], function()
{
	Route::get('/', 'AdminController@index');
 	Route::get('/test', function(){
 		$repository = app()->make('Modules\Admin\Repositories\UserRepository');
 		return $repository->all();
 	});
    Route::post('password/{id}', 'UserController@updatePass')->name('admin.user.updatePass');

    Route::post('users/{id}/role', 'UserController@updateRole')->name('admin.user.updateRole');
    Route::post('users/{id}/password', 'UserController@updatePass')->name('admin.user.updatePass');
	Route::resource('users', 'UserController' );

	Route::resource('roles', 'RolesController', [
        'except' => 'show',
        'names' => [
            'index' => 'admin.roles.index',
            'create' => 'admin.roles.create',
            'store' => 'admin.roles.store',
            'show' => 'admin.roles.show',
            'update' => 'admin.roles.update',
            'edit' => 'admin.roles.edit',
            'destroy' => 'admin.roles.destroy',
        ],
    ]);

    Route::resource('permissions', 'PermissionsController', [
        'except' => 'show',
        'names' => [
            'index' => 'admin.permissions.index',
            'create' => 'admin.permissions.create',
            'store' => 'admin.permissions.store',
            'show' => 'admin.permissions.show',
            'update' => 'admin.permissions.update',
            'edit' => 'admin.permissions.edit',
            'destroy' => 'admin.permissions.destroy',
        ],
    ]);

    Route::get('modules', ['as' => 'admin.modules.index', 'uses' => 'ModulesController@index']);
    Route::get('modules/enable/{name}', ['as' => 'admin.modules.enable', 'uses' => 'ModulesController@enable']);
    Route::get('modules/disable/{name}', ['as' => 'admin.modules.disable', 'uses' => 'ModulesController@disable']);
	
});

Route::group(['prefix'=>'api', 'namespace'=>'Modules\Admin\Http\Controllers', 'middleware'=>['oauth','cors']], function()
{
	Route::get('/user', function(){
		$id = \LucaDegasperi\OAuth2Server\Facades\Authorizer::getResourceOwnerId();
		return App\User::select(['id','name','last_name','email'])->find($id);
	});
});

view()->composer('admin::index', function ($view) 
{
    $view->widgets[] = view('admin::widget');
    $view->with('widgets', $view->widgets );
});