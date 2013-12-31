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

use FI\Storage\Eloquent\Models\ClientCustom;

class ClientCustomRepository {

	public function save($input, $clientId)
	{
		$record = (ClientCustom::find($clientId)) ?: new ClientCustom;

		$record->client_id = $clientId;
		
		$record->fill($input);

		$record->save();
	}

}