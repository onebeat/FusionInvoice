<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\TaxRates\Providers;

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
        $this->app->bind('TaxRateValidator', 'FI\Modules\TaxRates\Validators\TaxRateValidator');

        $this->app->bind('TaxRateController', function($app)
        {
            return new \FI\Modules\TaxRates\Controllers\TaxRateController(
                $app->make('TaxRateRepository'),
                $app->make('TaxRateValidator')
            );
        });
	}

}