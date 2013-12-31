<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Calculators;

use FI\Calculators\Interfaces\PayableInterface;

class InvoiceCalculator extends Calculator implements PayableInterface {

	/**
	 * Call the calculation methods
	 */
	public function calculate()
	{
		$this->calculateItems();
		$this->calculateTaxRates();
		$this->calculatePayments();
	}

	/**
	 * Set the total paid amount
	 * @param float $totalPaid
	 */
	public function setTotalPaid($totalPaid)
	{
		if ($totalPaid)
		{
			$this->calculatedAmount['paid'] = $totalPaid;
		}
		else
		{
			$this->calculatedAmount['paid'] = 0;
		}
	}

	/**
	 * Calculate additional properties
	 * @return void
	 */
	public function calculatePayments()
	{
		$this->calculatedAmount['balance'] = $this->calculatedAmount['total'] - $this->calculatedAmount['paid'];
	}
	
}