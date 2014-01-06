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

class PaymentEventProvider extends ServiceProvider {

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
		// Create the empty invoice amount record
		\Event::listen('invoice.deleted', function($invoiceId)
		{
			$paymentRepo = $this->app->make('PaymentRepository');

			$payments = $paymentRepo->findByInvoiceId($invoiceId);

			foreach ($payments as $payment)
			{
				$paymentRepo->delete($payment->id);
			}
		});
	}
}