<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\CustomFields\Repositories;

use FI\Modules\CustomFields\Models\PaymentCustom;

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

	/**
	 * Delete a record
	 * @param  int $id
	 * @return void
	 */
	public function delete($id)
	{
		PaymentCustom::destroy($id);
	}

}