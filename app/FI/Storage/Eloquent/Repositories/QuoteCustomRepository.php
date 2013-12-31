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

use FI\Storage\Eloquent\Models\QuoteCustom;

class QuoteCustomRepository {

	public function save($input, $quoteId)
	{
		$record = (QuoteCustom::find($quoteId)) ?: new QuoteCustom;

		$record->quote_id = $quoteId;
		
		$record->fill($input);

		$record->save();
	}

}