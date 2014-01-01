<?php namespace FI\Modules\InvoiceGroups\Providers;

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
        $this->app->bind('InvoiceGroupRepository', 'FI\Modules\InvoiceGroups\Repositories\InvoiceGroupRepository');

        $this->app->bind('InvoiceGroupController', function($app)
        {
            return new \FI\Modules\InvoiceGroups\Controllers\InvoiceGroupController(
                $app->make('InvoiceGroupRepository'),
                new \FI\Validators\InvoiceGroupValidator
            );
        });
	}

}