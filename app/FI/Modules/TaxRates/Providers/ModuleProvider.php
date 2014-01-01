<?php namespace FI\Modules\TaxRates\Providers;

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
        $this->app->bind('TaxRateRepository', 'FI\Modules\TaxRates\Repositories\TaxRateRepository');

        $this->app->bind('TaxRateController', function($app)
        {
            return new \FI\Modules\TaxRates\Controllers\TaxRateController(
                $app->make('TaxRateRepository'),
                new \FI\Validators\TaxRateValidator
            );
        });
	}

}