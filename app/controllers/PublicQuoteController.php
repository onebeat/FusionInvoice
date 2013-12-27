<?php

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