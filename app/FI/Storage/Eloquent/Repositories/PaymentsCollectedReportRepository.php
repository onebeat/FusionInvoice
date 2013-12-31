<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Storage\Eloquent\Repositories;

use FI\Classes\CurrencyFormatter;
use FI\Storage\Eloquent\Models\Payment;

class PaymentsCollectedReportRepository {
	
	/**
	 * Get the report results
	 * @param  string $fromDate
	 * @param  string $toDate
	 * @return array
	 */
	public function getResults($fromDate, $toDate)
	{
		$results = array('payments' => array(), 'total' => 0);

		$payments = Payment::byDateRange($fromDate, $toDate)->get();

		foreach ($payments as $payment)
		{
			$results['payments'][] = array(
				'client_name'    => $payment->invoice->client->name,
				'invoice_number' => $payment->invoice->number,
				'payment_method' => $payment->payment_method->name,
				'note'           => $payment->note,
				'date'           => $payment->formatted_paid_at,
				'amount'         => $payment->formatted_amount
			);

			$results['total'] += $payment->amount;
		}

		$results['total'] = CurrencyFormatter::format($results['total']);

		return $results;
	}
	
}