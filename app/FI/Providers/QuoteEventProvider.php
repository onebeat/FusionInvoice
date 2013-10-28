<?php namespace FI\Providers;

use Illuminate\Support\ServiceProvider;

class QuoteEventProvider extends ServiceProvider {

	public function register() {}

	public function boot()
	{
		\Event::listen('quote.created', function($quote)
		{
			$quoteAmount = \App::make('FI\Storage\Interfaces\QuoteAmountRepositoryInterface');

			$quoteAmount->create(array(
				'quote_id'       => $quote->id,
				'item_subtotal'  => 0,
				'item_tax_total' => 0,
				'tax_total'      => 0,
				'total'          => 0
				)
			);
		});
	}
}