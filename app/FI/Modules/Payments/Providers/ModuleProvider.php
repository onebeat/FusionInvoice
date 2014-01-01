<?php namespace FI\Modules\Payments\Providers;

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
        $this->app->bind('PaymentRepository', 'FI\Modules\Payments\Repositories\PaymentRepository');

        $this->app->bind('PaymentController', function($app)
        {
            return new \FI\Modules\Payments\Controllers\PaymentController(
                $app->make('CustomFieldRepository'),
                $app->make('PaymentCustomRepository'),
                $app->make('PaymentMethodRepository'),
                $app->make('PaymentRepository'),
                new \FI\Validators\PaymentValidator
            );
        });
	}

}