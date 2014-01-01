<?php namespace FI\Modules\ItemLookups\Providers;

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
        $this->app->bind('ItemLookupRepository', 'FI\Modules\ItemLookups\Repositories\ItemLookupRepository');

        $this->app->bind('ItemLookupController', function($app)
        {
            return new \FI\Modules\ItemLookups\Controllers\ItemLookupController(
                $app->make('ItemLookupRepository'),
                new \FI\Validators\ItemLookupValidator
            );
        });
	}

}