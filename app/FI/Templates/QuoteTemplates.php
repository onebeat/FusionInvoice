<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Templates;

class QuoteTemplates extends Templates {

	/**
	 * Returns an array of quote templates
	 * @return array
	 */
	public static function lists()
	{
		return parent::listTemplates(app_path() . '/views/templates/quotes');
	}

}