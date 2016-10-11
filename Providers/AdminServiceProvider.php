<?php namespace Modules\Admin\Providers;


use Illuminate\Support\ServiceProvider;
use Menu, App, Auth;

class AdminServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Boot the application events.
	 * 
	 * @return void
	 */
	public function boot()
	{
		$this->registerTranslations();
		$this->registerConfig();
		$this->registerViews();
 		// Using Closure based composers...
       
        //
		// CREATING THE MENU
		//
		$menu = Menu::instance('menu-left');
		$menu->url('/admin', 'Dashboard', 0, ['auth'=>true]);

		$menuRight = Menu::instance('menu-right');
		$menuRight->dropdown( '<i class="glyphicon glyphicon-cog"></i>', function ($menu2) 
		{
			$menu2->route('admin.users.index', trans('admin::profile.account'), [], ['perm'=>'manage-users', 'role'=>'admin'] )->order(1);
			$menu2->route('admin.roles.index', trans('admin::layout.roles'), [], ['perm'=>'manage-roles'] )->order(2);
			$menu2->route('admin.permissions.index', trans('admin::layout.permissions'), [], ['perm'=>'manage-permissions'])->order(3);
			$menu2->route('admin.modules.index', trans('admin::layout.modules'), [], ['perm'=>'manage-modules'] )->order(4);
			$menu2->divider()->order(5);
			$menu2->url('admin/users/profile/edit', trans('admin::profile.myprofile') )->order(6);
			$menu2->url('auth/logout', trans('admin::layout.logout'))->order(7);
    	}, 99, ['auth'=>true, 'role'=>'admin'] );
	
			 

		

		/*view()->composer('admin::index', function ($view) 
        {
        	$view->widgets[] = view('petition::widget');
        	$view->with('widgets', $view->widgets );
        }); */
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{		
		//
		$this->app->bind(
			'Modules\Admin\Repositories\User\UserRepository',
			'Modules\Admin\Repositories\User\UserRepositoryEloquent'
		);
		$this->app->bind(
			'Modules\Admin\Repositories\Roles\RoleRepository',
			'Modules\Admin\Repositories\Roles\EloquentRoleRepository'
		);
		$this->app->bind(
			'Modules\Admin\Repositories\Permissions\PermissionRepository',
			'Modules\Admin\Repositories\Permissions\EloquentPermissionRepository'
		);
	}

	/**
	 * Register config.
	 * 
	 * @return void
	 */
	protected function registerConfig()
	{
		$this->publishes([
		    __DIR__.'/../Config/config.php' => config_path('admin.php'),
		]);
		$this->mergeConfigFrom(
		    __DIR__.'/../Config/config.php', 'admin'
		);
	}

	/**
	 * Register views.
	 * 
	 * @return void
	 */
	public function registerViews()
	{
		$viewPath = base_path('resources/views/modules/admin');

		$sourcePath = __DIR__.'/../Resources/views';

		$this->publishes([
			$sourcePath => $viewPath
		]);

		$this->loadViewsFrom(array_merge(array_map(function ($path) {
			return $path . '/modules/admin';
		}, \Config::get('view.paths')), [$sourcePath]), 'admin');
	}

	/**
	 * Register translations.
	 * 
	 * @return void
	 */
	public function registerTranslations()
	{
		$langPath = base_path('resources/lang/modules/admin');

		if (is_dir($langPath)) {
			$this->loadTranslationsFrom($langPath, 'admin');
		} else {
			$this->loadTranslationsFrom(__DIR__ .'/../Resources/lang', 'admin');
		}
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
