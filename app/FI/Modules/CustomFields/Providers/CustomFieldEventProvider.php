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

class CustomFieldEventProvider extends ServiceProvider {

	/**
	 * Register the service provider
	 * @return void
	 */
	public function register() {}

	/**
	 * Bootstrap the application events
	 * @return void
	 */
	public function boot()
	{
		// Delete any custom invoice records on invoice delete
		\Event::listen('invoice.deleted', function($invoiceId)
		{
			$invoiceCustom = $this->app->make('InvoiceCustomRepository');

			$invoiceCustom->delete($invoiceId);
		});

		// Delete any custom quote records on quote delete
		\Event::listen('quote.deleted', function($quoteId)
		{
			$quoteCustom = $this->app->make('QuoteCustomRepository');

			$quoteCustom->delete($quoteId);
		});

		// Delete any custom payment records on payment delete
		\Event::listen('payment.deleted', function($paymentId)
		{
			$paymentCustom = $this->app->make('PaymentCustomRepository');

			$paymentCustom->delete($paymentId);
		});

		// Delete any custom client records on client delete
		\Event::listen('client.deleted', function($clientId)
		{
			$clientCustom = $this->app->make('ClientCustomRepository');

			$clientCustom->delete($clientId);
		});
	}
}