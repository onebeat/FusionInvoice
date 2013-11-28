<?php namespace FI\Providers;

use Illuminate\Support\ServiceProvider;
use FI\Calculators\InvoiceCalculator;

class InvoiceEventProvider extends ServiceProvider {

	public function register() {}

	public function boot()
	{
		// Create the empty invoice amount record
		\Event::listen('invoice.created', function($invoiceId, $invoiceGroupId)
		{
			\Log::info('Event Handler: invoice.created');

			$invoiceAmount  = \App::make('FI\Storage\Interfaces\InvoiceAmountRepositoryInterface');
			$invoiceGroup = \App::make('FI\Storage\Interfaces\InvoiceGroupRepositoryInterface');

			$invoiceAmount->create(array(
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

			$invoiceItem       = \App::make('FI\Storage\Interfaces\InvoiceItemRepositoryInterface');
            $invoiceItemAmount = \App::make('FI\Storage\Interfaces\InvoiceItemAmountRepositoryInterface');
            $taxRate           = \App::make('FI\Storage\Interfaces\TaxRateRepositoryInterface');

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

            $invoiceItemAmount->create(array(
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
			$invoiceItem       = \App::make('FI\Storage\Interfaces\InvoiceItemRepositoryInterface');
			$invoiceItemAmount = \App::make('FI\Storage\Interfaces\InvoiceItemAmountRepositoryInterface');
			$invoiceAmount     = \App::make('FI\Storage\Interfaces\InvoiceAmountRepositoryInterface');
			$invoiceTaxRate    = \App::make('FI\Storage\Interfaces\InvoiceTaxRateRepositoryInterface');
			$taxRate           = \App::make('FI\Storage\Interfaces\TaxRateRepositoryInterface');
			$payment           = \App::make('FI\Storage\Interfaces\PaymentRepositoryInterface');

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
				$invoiceItemAmount->updateByItemId($calculatedItemAmount, $calculatedItemAmount['item_id']);
			}

			// Update the invoice tax rate records
			foreach ($calculatedTaxRates as $calculatedInvoiceTaxRate)
			{
				$invoiceTaxRate->updateByInvoiceIdAndTaxRateId($calculatedInvoiceTaxRate, $invoiceId, $calculatedInvoiceTaxRate['tax_rate_id']);
			}

			// Update the invoice amount record
			$invoiceAmount->updateByInvoiceId($calculatedAmount, $invoiceId);
		});

	}
}