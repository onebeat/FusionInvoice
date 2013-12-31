<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class PaymentMethodController extends \BaseController {
	
	protected $paymentMethod;
	protected $validator;
	
	public function __construct($paymentMethod, $validator)
	{
		$this->paymentMethod = $paymentMethod;
		$this->validator     = $validator;
	}

	/**
	 * Display paginated list
	 * @return \Illuminate\View\View
	 */
	public function index()
	{
		$paymentMethods = $this->paymentMethod->getPaged(Input::get('page'));

		return View::make('payment_methods.index')
		->with('paymentMethods', $paymentMethods);
	}

	/**
	 * Display form for new record
	 * @return \Illuminate\View\View
	 */
	public function create()
	{
		return View::make('payment_methods.form')
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
			return Redirect::route('paymentMethods.create')
			->with('editMode', false)
			->withErrors($this->validator->errors())
			->withInput();
		}

		$this->paymentMethod->create($input);
		
		return Redirect::route('paymentMethods.index')
		->with('alertSuccess', trans('fi.record_successfully_created'));
	}

	/**
	 * Display form for existing record
	 * @param  int $id
	 * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$paymentMethod = $this->paymentMethod->find($id);
		
		return View::make('payment_methods.form')
		->with(array('editMode' => true, 'paymentMethod' => $paymentMethod));
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
			return Redirect::route('paymentMethods.edit', array($id))
			->with('editMode', true)
			->withErrors($this->validator->errors())
			->withInput();
		}

		$this->paymentMethod->update($input, $id);

		return Redirect::route('paymentMethods.index')
		->with('alertInfo', trans('fi.record_successfully_updated'));
	}

	/**
	 * Delete a record
	 * @param  int $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function delete($id)
	{
		$this->paymentMethod->delete($id);

		return Redirect::route('paymentMethods.index')
		->with('alert', trans('fi.record_successfully_deleted'));
	}

}