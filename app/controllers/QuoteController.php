<?php

use FI\Storage\Interfaces\QuoteRepositoryInterface;
use FI\Validators\QuoteValidator;
use FI\Libraries\Quotes;

class QuoteController extends BaseController {

	protected $quote;
	protected $validator;
	
	public function __construct(QuoteRepositoryInterface $quote, QuoteValidator $validator)
	{
		$this->quote     = $quote;
		$this->validator = $validator;
	}

	/**
	 * Display paginated list
	 * @param  string $status
	 * @return \Illuminate\View\View
	 */
	public function index($status = 'all')
	{
		$quotes   = $this->quote->getPagedByStatus(Input::get('page'), null, $status);
		$statuses = Quotes::statuses();

		return View::make('quotes.index')
		->with(array('quotes' => $quotes, 'status' => $status, 'statuses' => $statuses));
	}
	
}