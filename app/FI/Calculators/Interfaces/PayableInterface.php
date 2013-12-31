<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Calculators\Interfaces;

interface PayableInterface {
	
	public function setTotalPaid($totalPaid);

	public function calculatePayments();

}