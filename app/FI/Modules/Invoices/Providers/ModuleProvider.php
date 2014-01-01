<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Invoices\Providers;

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
        $this->app->bind('InvoiceAmountRepository', 'FI\Modules\Invoices\Repositories\InvoiceAmountRepository');
        $this->app->bind('InvoiceItemAmountRepository', 'FI\Modules\Invoices\Repositories\InvoiceItemAmountRepository');
        $this->app->bind('InvoiceItemRepository', 'FI\Modules\Invoices\Repositories\InvoiceItemRepository');
        $this->app->bind('InvoiceRepository', 'FI\Modules\Invoices\Repositories\InvoiceRepository');
        $this->app->bind('InvoiceTaxRateRepository', 'FI\Modules\Invoices\Repositories\InvoiceTaxRateRepository');

        $this->app->bind('InvoiceController', function($app)
        {
            return new \FI\Modules\Invoices\Controllers\InvoiceController(
                $app->make('CustomFieldRepository'),
                $app->make('InvoiceRepository'),
                $app->make('InvoiceCustomRepository'),
                $app->make('InvoiceGroupRepository'),
                $app->make('InvoiceItemRepository'),
                $app->make('InvoiceTaxRateRepository'),
                $app->make('TaxRateRepository'),
                new \FI\Validators\InvoiceValidator
            );
        });

        $this->app->bind('PublicInvoiceController', function($app)
        {
            return new \FI\Modules\Invoices\Controllers\PublicInvoiceController(
                $app->make('InvoiceRepository')
            );
        });
	}

}