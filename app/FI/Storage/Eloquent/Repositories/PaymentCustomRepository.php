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

use FI\Storage\Eloquent\Models\PaymentCustom;

class PaymentCustomRepository {

	/**
	 * Save the record
	 * @param  array $input
	 * @param  int $paymentId
	 * @return void
	 */
	public function save($input, $paymentId)
	{
		$record = (PaymentCustom::find($paymentId)) ?: new PaymentCustom;

		$record->payment_id = $paymentId;
		
		$record->fill($input);

		$record->save();
	}

}