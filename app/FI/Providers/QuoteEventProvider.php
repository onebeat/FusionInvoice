<?php namespace FI\Providers;

use Illuminate\Support\ServiceProvider;

class QuoteEventProvider extends ServiceProvider {

	public function register() {}

	public function boot()
	{
		// Create the empty quote amount record
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

		// Create the calculated quote item amount record
		\Event::listen('quoteItem.created', function($quoteItem)
		{
			$quoteItemAmount = \App::make('FI\Storage\Interfaces\QuoteItemAmountRepositoryInterface');
			$taxRate         = \App::make('FI\Storage\Interfaces\TaxRateRepositoryInterface');

			$subtotal = $quoteItem->quantity * $quoteItem->price;

			if ($quoteItem->tax_rate_id)
			{
				$tax       = $taxRate->find($quoteItem->tax_rate_id);
				$tax_total = $subtotal * (($tax->percent) / 100);
			}
			else
			{
				$tax_total = 0;
			}

			$total = $subtotal + $tax_total;

			$quoteItemAmount->create(array(
				'item_id'   => $quoteItem->id,
				'subtotal'  => $subtotal,
				'tax_total' => $tax_total,
				'total'     => $total
				)
			);

			\Event::fire('quoteItemAmount.updated', $quoteItem->quote_id);
		});

		// Update the calculated quote item amount record
		\Event::listen('quoteItem.updated', function($quoteItem)
		{
			$quoteItemAmount = \App::make('FI\Storage\Interfaces\QuoteItemAmountRepositoryInterface');
			$taxRate         = \App::make('FI\Storage\Interfaces\TaxRateRepositoryInterface');

			$subtotal = $quoteItem->quantity * $quoteItem->price;

			if ($quoteItem->tax_rate_id)
			{
				$tax       = $taxRate->find($quoteItem->tax_rate_id);
				$tax_total = $subtotal * (($tax->percent) / 100);
			}
			else
			{
				$tax_total = 0;
			}

			$total = $subtotal + $tax_total;

			$quoteItemAmount->update(array(
				'subtotal'  => $subtotal,
				'tax_total' => $tax_total,
				'total'     => $total
				), $quoteItem->id
			);

			\Event::fire('quoteItemAmount.updated', $quoteItem->quote_id);
		});

		\Event::listen('quoteItemAmount.updated', function($quote_id)
		{
			$quoteAmount = \App::make('FI\Storage\Interfaces\QuoteAmountRepositoryInterface');

			$quoteAmount->calculateQuoteAmount($quote_id);
		});

	}
}