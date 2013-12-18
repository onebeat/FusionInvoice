<?php

use FI\Storage\Interfaces\CustomFieldRepositoryInterface;
use FI\Validators\CustomFieldValidator;
use FI\Classes\CustomFields;

class CustomFieldController extends \BaseController {

	protected $customField;
	protected $validator;

	public function __construct(CustomFieldRepositoryInterface $customField, CustomFieldValidator $validator)
	{
		$this->customField	 = $customField;
		$this->validator	 = $validator;
	}

	/**
	 * Display paginated list
	 * @return View
	 */
	public function index()
	{
		$customFields = $this->customField->getPaged(Input::get('page'));

		return View::make('custom_fields.index')
		->with('customFields', $customFields);
	}

	/**
	 * Display form for new record
	 * @return View
	 */
	public function create()
	{
		return View::make('custom_fields.form')
		->with('editMode', false)
		->with('table_names', CustomFields::tableNames())
		->with('field_types', CustomFields::fieldTypes());
	}

	/**
	 * Validate and handle new record form submission
	 * @return Redirect
	 */
	public function store()
	{
		$input = Input::all();

		if (!$this->validator->validate($input))
		{
			return Redirect::route('customFields.create')
			->with('editMode', false)
			->withErrors($this->validator->errors())
			->withInput();
		}

		$input['column_name'] = $this->customField->getNextColumnName($input['table_name']);

		$this->customField->create($input);

		$this->customField->createCustomColumn($input['table_name'], $input['column_name']);

		return Redirect::route('customFields.index')
		->with('alertSuccess', trans('fi.record_successfully_created'));
	}

	/**
	 * Display form for existing record
	 * @param  int $id
	 * @return View
	 */
	public function edit($id)
	{
		$customField = $this->customField->find($id);

		return View::make('custom_fields.form')
		->with('editMode', true)
		->with('customField', $customField)
		->with('table_names', CustomFields::tableNames())
		->with('field_types', CustomFields::fieldTypes());
	}

	/**
	 * Validate and handle existing record form submission
	 * @param  int $id
	 * @return Redirect
	 */
	public function update($id)
	{
		$input = Input::all();

		if (!$this->validator->validate($input))
		{
			return Redirect::route('customFields.edit', array($id))
			->with('editMode', true)
			->withErrors($this->validator->errors())
			->withInput();
		}

		$this->customField->update($input, $id);

		return Redirect::route('customFields.index')
		->with('alertInfo', trans('fi.record_successfully_updated'));
	}

	/**
	 * Delete a record
	 * @param  int $id
	 * @return Redirect
	 */
	public function delete($id)
	{
		$customField = $this->customField->find($id);

		$this->customField->deleteCustomColumn($customField->table_name, $customField->column_name);

		$this->customField->delete($id);

		return Redirect::route('customFields.index')
		->with('alert', trans('fi.record_successfully_deleted'));
	}

}
