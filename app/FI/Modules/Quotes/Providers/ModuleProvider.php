<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Quotes\Providers;

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
        $this->app->bind('QuoteAmountRepository', 'FI\Modules\Quotes\Repositories\QuoteAmountRepository');
        $this->app->bind('QuoteItemAmountRepository', 'FI\Modules\Quotes\Repositories\QuoteItemAmountRepository');
        $this->app->bind('QuoteItemRepository', 'FI\Modules\Quotes\Repositories\QuoteItemRepository');
        $this->app->bind('QuoteRepository', 'FI\Modules\Quotes\Repositories\QuoteRepository');
        $this->app->bind('QuoteTaxRateRepository', 'FI\Modules\Quotes\Repositories\QuoteTaxRateRepository');

        $this->app->bind('PublicQuoteController', function($app)
        {
            return new \FI\Modules\Quotes\Controllers\PublicQuoteController(
                $app->make('QuoteRepository')
            );
        });

        $this->app->bind('QuoteController', function($app)
        {
            return new \FI\Modules\Quotes\Controllers\QuoteController(
                $app->make('CustomFieldRepository'),
                $app->make('InvoiceGroupRepository'),
                $app->make('QuoteCustomRepository'),
                $app->make('QuoteItemRepository'),
                $app->make('QuoteRepository'),
                $app->make('QuoteTaxRateRepository'),
                $app->make('TaxRateRepository'),
                new \FI\Validators\QuoteValidator
            );
        });
	}

}