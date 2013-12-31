<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class PublicQuoteController extends BaseController {

	protected $quote;

	public function __construct($quote)
	{
		$this->quote = $quote;
	}
	
	/**
	 * Displays the quote based on the quote key
	 * @param  string $urlKey
	 * @return View
	 */
	public function show($urlKey)
	{
		$quote = $this->quote->findByUrlKey($urlKey);

		return View::make('templates.quotes.' . str_replace('.blade.php', '', Config::get('fi.quoteTemplate')))
		->with('quote', $quote);
	}

}