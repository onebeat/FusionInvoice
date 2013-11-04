<?php namespace FI\Providers;

use Illuminate\Support\ServiceProvider;
use FI\Classes\QuoteAmounts;

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

			if ($quoteItem->tax_rate_id)
			{
				$taxRatePercent = $taxRate->find($quoteItem->tax_rate_id)->percent;
			}
			else
			{
				$taxRatePercent = 0;
			}

			$quoteItemAmounts = QuoteAmounts::calculateQuoteItemAmount($quoteItem->quantity, $quoteItem->price, $taxRatePercent);

			$quoteItemAmount->create(array(
				'item_id'   => $quoteItem->id,
				'subtotal'  => $quoteItemAmounts['subtotal'],
				'tax_total' => $quoteItemAmounts['tax_total'],
				'total'     => $quoteItemAmounts['total']
				)
			);

			\Event::fire('quoteItemAmount.updated', $quoteItem->quote_id);
		});

		// Update the calculated quote item amount record
		\Event::listen('quoteItem.updated', function($quoteItem)
		{
			$quoteItemAmount = \App::make('FI\Storage\Interfaces\QuoteItemAmountRepositoryInterface');
			$taxRate         = \App::make('FI\Storage\Interfaces\TaxRateRepositoryInterface');

			if ($quoteItem->tax_rate_id)
			{
				$taxRatePercent = $taxRate->find($quoteItem->tax_rate_id)->percent;
			}
			else
			{
				$taxRatePercent = 0;
			}

			$quoteItemAmounts = QuoteAmounts::calculateQuoteItemAmount($quoteItem->quantity, $quoteItem->price, $taxRatePercent);

			$quoteItemAmount->update($quoteItemAmounts, $quoteItem->id);

			\Event::fire('quoteItemAmount.updated', $quoteItem->quote_id);
		});

		// Update the calculated quote amount record
		\Event::listen('quoteItemAmount.updated', function($quote_id)
		{
			$quoteAmount = \App::make('FI\Storage\Interfaces\QuoteAmountRepositoryInterface');
			$quoteItemAmount = \App::make('FI\Storage\Interfaces\QuoteItemAmountRepositoryInterface');

			$quoteItemAmounts = $quoteItemAmount->findByQuoteId($quote_id);

			$quoteAmounts = QuoteAmounts::calculateQuoteAmount($quoteItemAmounts);

			$quoteAmount->updateByQuoteId($quoteAmounts, $quote_id);
		});

	}
}