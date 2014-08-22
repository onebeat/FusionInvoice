<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\CustomFields\Controllers;

use Input;
use Redirect;
use View;

use FI\Classes\CustomFields;

class CustomFieldController extends \BaseController {

	/**
	 * Custom field repository
	 * @var CustomFieldRepository
	 */
	protected $customField;

	/**
	 * Custom field validator
	 * @var CustomFieldValidator
	 */
	protected $validator;

	/**
	 * Dependency injection
	 * @param CustomFieldRepository $customField
	 * @param CustomFieldValidator $validator
	 */
	public function __construct($customField, $validator)
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
		->with('customFields', $customFields)
		->with('tableNames', CustomFields::tableNames());
	}

	/**
	 * Display form for new record
	 * @return View
	 */
	public function create()
	{
		return View::make('custom_fields.form')
		->with('editMode', false)
		->with('tableNames', CustomFields::tableNames())
		->with('fieldTypes', CustomFields::fieldTypes());
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
		->with('tableNames', CustomFields::tableNames())
		->with('fieldTypes', CustomFields::fieldTypes());
	}

	/**
	 * Validate and handle existing record form submission
	 * @param  int $id
	 * @return Redirect
	 */
	public function update($id)
	{
		$input = Input::all();

		unset($input['table_name']);

		if (!$this->validator->validate($input, 'updateRules'))
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
