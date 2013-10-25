<?php

use FI\Storage\Interfaces\PaymentMethodRepositoryInterface;
use FI\Validators\PaymentMethodValidator;

class PaymentMethodController extends \BaseController {
	
	protected $paymentMethod;
	protected $validator;
	
	public function __construct(PaymentMethodRepositoryInterface $paymentMethod, PaymentMethodValidator $validator)
	{
		$this->paymentMethod = $paymentMethod;
		$this->validator = $validator;
	}

	/**
	 * Display paginated list
	 * @param  string $status
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
		->with('edit_mode', false);
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
			->with('edit_mode', false)
			->withErrors($this->validator->errors())
			->withInput();
		}

		$this->paymentMethod->create($input);
		
		return Redirect::route('paymentMethods.index')
		->with('alert_success', trans('fi.record_successfully_created'));
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
		->with(array('edit_mode' => true, 'paymentMethod' => $paymentMethod));
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
			->with('edit_mode', true)
			->withErrors($this->validator->errors())
			->withInput();
		}

		$this->paymentMethod->update($input, $id);

		return Redirect::route('paymentMethods.index')
		->with('alert_info', trans('fi.record_successfully_updated'));
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