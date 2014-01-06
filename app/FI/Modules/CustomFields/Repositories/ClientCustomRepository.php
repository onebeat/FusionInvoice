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

use FI\Modules\CustomFields\Models\ClientCustom;

class ClientCustomRepository {

	/**
	 * Save the record
	 * @param  array $input
	 * @param  int $clientId
	 * @return void
	 */
	public function save($input, $clientId)
	{
		$record = (ClientCustom::find($clientId)) ?: new ClientCustom;

		$record->client_id = $clientId;
		
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
		ClientCustom::destroy($id);
	}

}