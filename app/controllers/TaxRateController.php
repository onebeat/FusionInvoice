<?php

use FI\Storage\Interfaces\TaxRateRepositoryInterface;
use FI\Validators\TaxRateValidator;

class TaxRateController extends \BaseController {
	
	protected $taxRate;
	protected $validator;
	
	public function __construct(TaxRateRepositoryInterface $taxRate, TaxRateValidator $validator)
	{
		$this->taxRate = $taxRate;
		$this->validator = $validator;
	}

	/**
	 * Display paginated list
	 * @param  string $status
	 * @return \Illuminate\View\View
	 */
	public function index($status = 'active')
	{
		$taxRates = $this->taxRate->getPaged(Input::get('page'));

		return View::make('tax_rates.index')
		->with(array('taxRates' => $taxRates, 'status' => $status));
	}

	/**
	 * Display form for new record
	 * @return \Illuminate\View\View
	 */
	public function create()
	{
		return View::make('tax_rates.form')->with('edit_mode', false);
	}

	/**
	 * Validate and handle new record form submission
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store()
	{
		$input = Input::all();

		if (!$this->validator->validate($input))
		{
			return Redirect::route('taxRates.create')
			->with(['edit_mode' => false])
			->withErrors($this->validator->errors())->withInput();
		}

		$this->taxRate->create($input);
		
		return Redirect::route('taxRates.index')->with(['alert' => trans('fi.record_successfully_created')]);
	}

	/**
	 * Display form for existing record
	 * @param  int $id
	 * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$taxRate = $this->taxRate->find($id);
		
		return View::make('tax_rates.form')
		->with(['edit_mode' => true, 'taxRate' => $taxRate]);
	}

	/**
	 * Validate and handle existing record form submission
	 * @param  int $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update($id)
	{
		$this->taxRate->update(Input::all(), $id);
		return Redirect::route('taxRates.index');
	}

	/**
	 * Delete a record
	 * @param  int $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function delete($id)
	{
		$this->taxRate->delete($id);
		return Redirect::route('taxRates.index');
	}

}