<?php

use FI\Storage\Interfaces\InvoiceGroupRepositoryInterface;
use FI\Validators\InvoiceGroupValidator;

class InvoiceGroupController extends \BaseController {
	
	protected $invoiceGroup;
	protected $validator;
	
	public function __construct(InvoiceGroupRepositoryInterface $invoiceGroup, InvoiceGroupValidator $validator)
	{
		$this->invoiceGroup = $invoiceGroup;
		$this->validator = $validator;
	}

	/**
	 * Display paginated list
	 * @param  string $status
	 * @return \Illuminate\View\View
	 */
	public function index()
	{
		$invoiceGroups = $this->invoiceGroup->getPaged(Input::get('page'));

		return View::make('invoice_groups.index')
		->with('invoiceGroups', $invoiceGroups);
	}

	/**
	 * Display form for new record
	 * @return \Illuminate\View\View
	 */
	public function create()
	{
		return View::make('invoice_groups.form')
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
			return Redirect::route('invoiceGroups.create')
			->with('editMode', false)
			->withErrors($this->validator->errors())
			->withInput();
		}

		$this->invoiceGroup->create($input);
		
		return Redirect::route('invoiceGroups.index')
		->with('alertSuccess', trans('fi.record_successfully_created'));
	}

	/**
	 * Display form for existing record
	 * @param  int $id
	 * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$invoiceGroup = $this->invoiceGroup->find($id);
		
		return View::make('invoice_groups.form')
		->with(array('editMode' => true, 'invoiceGroup' => $invoiceGroup));
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
			return Redirect::route('invoiceGroups.edit', array($id))
			->with('editMode', true)
			->withErrors($this->validator->errors())
			->withInput();
		}

		$this->invoiceGroup->update($input, $id);

		return Redirect::route('invoiceGroups.index')
		->with('alertInfo', trans('fi.record_successfully_updated'));
	}

	/**
	 * Delete a record
	 * @param  int $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function delete($id)
	{
		$this->invoiceGroup->delete($id);

		return Redirect::route('invoiceGroups.index')
		->with('alert', trans('fi.record_successfully_deleted'));
	}

}