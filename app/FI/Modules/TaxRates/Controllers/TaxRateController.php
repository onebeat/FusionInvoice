<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\TaxRates\Controllers;

use Input;
use Redirect;
use View;

use FI\Classes\NumberFormatter;

class TaxRateController extends \BaseController {
	
	/**
	 * Tax rate repository
	 * @var TaxRateRepository
	 */
	protected $taxRate;

	/**
	 * Tax rate validator
	 * @var TaxRateValidator
	 */
	protected $validator;
	
	/**
	 * Dependency injection
	 * @param TaxRateRepository $taxRate
	 * @param TaxRateValidator $validator
	 */
	public function __construct($taxRate, $validator)
	{
		$this->taxRate = $taxRate;
		$this->validator = $validator;
	}

	/**
	 * Display paginated list
	 * @return \Illuminate\View\View
	 */
	public function index()
	{
		$taxRates = $this->taxRate->getPaged(Input::get('page'));

		return View::make('tax_rates.index')
		->with('taxRates', $taxRates);
	}

	/**
	 * Display form for new record
	 * @return \Illuminate\View\View
	 */
	public function create()
	{
		return View::make('tax_rates.form')
		->with('editMode', false);
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
			->with('editMode', false)
			->withErrors($this->validator->errors())
			->withInput();
		}

		$input['percent'] = NumberFormatter::unformat($input['percent']);

		$this->taxRate->create($input);
		
		return Redirect::route('taxRates.index')
		->with('alertSuccess', trans('fi.record_successfully_created'));
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
		->with(array('editMode' => true, 'taxRate' => $taxRate));
	}

	/**
	 * Validate and handle existing record form submission
	 * @param  int $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update($id)
	{
		$input = Input::all();

		if (!$this->validator->validate($input))
		{
			return Redirect::route('taxRates.edit', array($id))
			->with('editMode', true)
			->withErrors($this->validator->errors())
			->withInput();
		}

		$input['percent'] = NumberFormatter::unformat($input['percent']);

		$this->taxRate->update($input, $id);

		return Redirect::route('taxRates.index')
		->with('alertInfo', trans('fi.record_successfully_updated'));
	}

	/**
	 * Delete a record
	 * @param  int $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function delete($id)
	{
		$this->taxRate->delete($id);

		return Redirect::route('taxRates.index')
		->with('alert', trans('fi.record_successfully_deleted'));
	}

}