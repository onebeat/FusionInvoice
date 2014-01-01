<?php namespace FI\Modules\PaymentMethods\Providers;

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
        $this->app->bind('PaymentMethodRepository', 'FI\Modules\PaymentMethods\Repositories\PaymentMethodRepository');

        $this->app->bind('PaymentMethodController', function($app)
        {
            return new \FI\Modules\PaymentMethods\Controllers\PaymentMethodController(
                $app->make('PaymentMethodRepository'),
                new \FI\Validators\PaymentMethodValidator
            );
        });
	}

}