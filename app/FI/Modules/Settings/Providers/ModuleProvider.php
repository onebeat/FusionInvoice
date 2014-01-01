<?php namespace FI\Modules\Settings\Providers;

use Illuminate\Support\ServiceProvider;

class ModuleProvider extends ServiceProvider {

	public function boot()
	{
		// Bring in the routes
		require __DIR__ . '/../routes.php';

		// Register the view path
		$viewPaths = \Config::get('view.paths');
		$viewPaths[] = __DIR__ . '/../Views';
		\Config::set('view.paths', $viewPaths);
	}

	public function register()
	{
        $this->app->bind('SettingRepository', 'FI\Modules\Settings\Repositories\SettingRepository');

        $this->app->bind('SettingController', function($app)
        {
            return new \FI\Modules\Settings\Controllers\SettingController(
                $app->make('SettingRepository'),
                $app->make('InvoiceGroupRepository'),
                $app->make('TaxRateRepository')
            );
        });
	}

}