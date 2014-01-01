<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\CustomFields\Providers;

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
        $this->app->bind('CustomFieldRepository', 'FI\Modules\CustomFields\Repositories\CustomFieldRepository');
        $this->app->bind('ClientCustomRepository', 'FI\Modules\CustomFields\Repositories\ClientCustomRepository');
        $this->app->bind('InvoiceCustomRepository', 'FI\Modules\CustomFields\Repositories\InvoiceCustomRepository');
        $this->app->bind('PaymentCustomRepository', 'FI\Modules\CustomFields\Repositories\PaymentCustomRepository');
        $this->app->bind('QuoteCustomRepository', 'FI\Modules\CustomFields\Repositories\QuoteCustomRepository');

        $this->app->bind('CustomFieldController', function($app)
        {
            return new \FI\Modules\CustomFields\Controllers\CustomFieldController(
                $app->make('CustomFieldRepository'),
                new \FI\Validators\CustomFieldValidator
            );
        });
	}

}