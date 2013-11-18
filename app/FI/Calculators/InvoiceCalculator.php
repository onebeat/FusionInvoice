<?php namespace FI\Calculators;

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

	public function calculatePayments()
	{
		$this->calculatedAmount['balance'] = $this->calculatedAmount['total'] - $this->calculatedAmount['paid'];
	}
	
}