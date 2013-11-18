<?php namespace FI\Calculators\Interfaces;

interface PayableInterface {
	
	public function setTotalPaid($totalPaid);

	public function calculatePayments();

}