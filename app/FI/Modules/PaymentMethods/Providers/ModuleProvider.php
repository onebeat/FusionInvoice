<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\PaymentMethods\Providers;

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
        $this->app->bind('PaymentMethodValidator', 'FI\Modules\PaymentMethods\Validators\PaymentMethodValidator');

        $this->app->bind('PaymentMethodController', function($app)
        {
            return new \FI\Modules\PaymentMethods\Controllers\PaymentMethodController(
                $app->make('PaymentMethodRepository'),
                $app->make('PaymentMethodValidator')
            );
        });
	}

}