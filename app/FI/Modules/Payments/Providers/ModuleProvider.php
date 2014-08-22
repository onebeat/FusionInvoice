<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Payments\Providers;

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
        $this->app->register('FI\Modules\Payments\Providers\PaymentEventProvider');

        $this->app->bind('PaymentRepository', 'FI\Modules\Payments\Repositories\PaymentRepository');
        $this->app->bind('PaymentValidator', 'FI\Modules\Payments\Validators\PaymentValidator');

        $this->app->bind('PaymentController', function($app)
        {
            return new \FI\Modules\Payments\Controllers\PaymentController(
                $app->make('PaymentRepository'),
                $app->make('PaymentValidator')
            );
        });
	}

}