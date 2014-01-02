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
use FI\Calculators\InvoiceCalculator;

class InvoiceEventProvider extends ServiceProvider {

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
		\Event::listen('invoice.created', function($invoiceId, $invoiceGroupId)
		{
			\Log::info('Event Handler: invoice.created');

			$invoiceAmount = \App::make('InvoiceAmountRepository');
			$invoiceGroup  = \App::make('InvoiceGroupRepository');

			$invoiceAmount->create(
				array(
					'invoice_id'     => $invoiceId,
					'item_subtotal'  => 0,
					'item_tax_total' => 0,
					'tax_total'      => 0,
					'total'          => 0,
					'paid'           => 0,
					'balance'        => 0
				)
			);

			$invoiceGroup->incrementNextId($invoiceGroupId);
		});

		// Create the invoice item amount record
		\Event::listen('invoice.item.created', function($itemId)
		{
			\Log::info('Event Handler: invoice.item.created');

			$invoiceItem       = \App::make('InvoiceItemRepository');
            $invoiceItemAmount = \App::make('InvoiceItemAmountRepository');
            $taxRate           = \App::make('TaxRateRepository');

            $invoiceItem = $invoiceItem->find($itemId);

            if ($invoiceItem->tax_rate_id)
            {
                    $taxRatePercent = $taxRate->find($invoiceItem->tax_rate_id)->percent;
            }
            else
            {
                    $taxRatePercent = 0;
            }

            $subtotal = $invoiceItem->quantity * $invoiceItem->price;
            $taxTotal = $subtotal * ($taxRatePercent / 100);
            $total    = $subtotal + $taxTotal;

            $invoiceItemAmount->create(
            	array(
                    'item_id'   => $invoiceItem->id,
                    'subtotal'  => $subtotal,
                    'tax_total' => $taxTotal,
                    'total'     => $total
                )
            );
		});

		// Calculate all invoice amounts
		\Event::listen('invoice.modified', function($invoiceId)
		{
			\Log::info('Event Handler: invoice.modified');

			// Resolve ALL THE THINGS
			$invoiceItem       = \App::make('InvoiceItemRepository');
			$invoiceItemAmount = \App::make('InvoiceItemAmountRepository');
			$invoiceAmount     = \App::make('InvoiceAmountRepository');
			$invoiceTaxRate    = \App::make('InvoiceTaxRateRepository');
			$taxRate           = \App::make('TaxRateRepository');
			$payment           = \App::make('PaymentRepository');

			// Retrieve the required records
			$items           = $invoiceItem->findByInvoiceId($invoiceId);
			$invoiceTaxRates = $invoiceTaxRate->findByInvoiceId($invoiceId);
			$totalPaid       = $payment->getTotalPaidByInvoiceId($invoiceId);

			// Set up the calculator
			$calculator = new InvoiceCalculator;
			$calculator->setId($invoiceId);
			$calculator->setTotalPaid($totalPaid);

			// Add the items to be calculated
			foreach ($items as $item)
			{
				if ($item->tax_rate_id)
				{
					$taxRatePercent = $taxRate->find($item->tax_rate_id)->percent;
				}
				else
				{
					$taxRatePercent = 0;
				}

				$calculator->addItem($item->id, $item->quantity, $item->price, $taxRatePercent);
			}

			// Add the invoice tax rates to be calculated
			foreach ($invoiceTaxRates as $invoiceTax)
			{
				$taxRatePercent = $taxRate->find($invoiceTax->tax_rate_id)->percent;

				$calculator->addTaxRate($invoiceTax->tax_rate_id, $taxRatePercent, $invoiceTax->include_item_tax);
			}

			// Run the calculations
			$calculator->calculate();

			// Get the calculated values
			$calculatedItemAmounts = $calculator->getCalculatedItemAmounts();
			$calculatedTaxRates    = $calculator->getCalculatedTaxRates();
			$calculatedAmount      = $calculator->getCalculatedAmount();

			// Update the item amount records
			foreach ($calculatedItemAmounts as $calculatedItemAmount)
			{
				$invoiceItemAmount->update($calculatedItemAmount, $calculatedItemAmount['item_id']);
			}

			// Update the invoice tax rate records
			foreach ($calculatedTaxRates as $calculatedTaxRate)
			{
				$invoiceTaxRate->update($calculatedTaxRate, $invoiceId, $calculatedTaxRate['tax_rate_id']);
			}

			// Update the invoice amount record
			$invoiceAmount->update($calculatedAmount, $invoiceId);

			// Check to see if the invoice should be marked as paid
			if ($calculatedAmount['total'] > 0 and $calculatedAmount['balance'] <= 0)
			{
				$invoice = \App::make('InvoiceRepository');

				$invoice->update(array('invoice_status_id' => 4), $invoiceId);
			}
		});

		\Event::listen('invoice.deleted', function($invoiceId)
		{
			$invoiceAmount  = \App::make('InvoiceAmountRepository');
			$invoiceItem    = \App::make('InvoiceItemRepository');
			$invoiceTaxRate = \App::make('InvoiceTaxRateRepository');

			$invoiceAmounts  = $invoiceAmount->findByInvoiceId($invoiceId);
			$invoiceItems    = $invoiceItem->findByInvoiceId($invoiceId);
			$invoiceTaxRates = $invoiceTaxRate->findByInvoiceId($invoiceId);

			foreach ($invoiceTaxRates as $invoiceTaxRate)
			{
				$invoiceTaxRate->delete();
			}

			foreach ($invoiceItems as $invoiceItem)
			{
				$invoiceItem->amount->delete();
				$invoiceItem->delete();
			}

			$invoiceAmounts->delete();
		});

	}
}