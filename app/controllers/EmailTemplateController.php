<?php

use FI\Storage\Interfaces\EmailTemplateRepositoryInterface;
use FI\Validators\EmailTemplateValidator;

class EmailTemplateController extends \BaseController {
	
	protected $emailTemplate;
	protected $validator;
	
	public function __construct(EmailTemplateRepositoryInterface $emailTemplate, EmailTemplateValidator $validator)
	{
		$this->emailTemplate = $emailTemplate;
		$this->validator = $validator;
	}

	/**
	 * Display paginated list
	 * @param  string $status
	 * @return \Illuminate\View\View
	 */
	public function index()
	{
		$emailTemplates = $this->emailTemplate->getPaged(Input::get('page'));

		return View::make('email_templates.index')
		->with('emailTemplates', $emailTemplates);
	}

	/**
	 * Display form for new record
	 * @return \Illuminate\View\View
	 */
	public function create()
	{
		return View::make('email_templates.form')
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
			return Redirect::route('emailTemplates.create')
			->with('edit_mode', false)
			->withErrors($this->validator->errors())
			->withInput();
		}

		$this->emailTemplate->create($input);
		
		return Redirect::route('emailTemplates.index')
		->with('alert_success', trans('fi.record_successfully_created'));
	}

	/**
	 * Display form for existing record
	 * @param  int $id
	 * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$emailTemplate = $this->emailTemplate->find($id);
		
		return View::make('email_templates.form')
		->with(['edit_mode' => true, 'emailTemplate' => $emailTemplate]);
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
			return Redirect::route('emailTemplates.edit', [$id])
			->with('edit_mode', true)
			->withErrors($this->validator->errors())
			->withInput();
		}

		$this->emailTemplate->update($input, $id);

		return Redirect::route('emailTemplates.index')
		->with('alert_info', trans('fi.record_successfully_updated'));
	}

	/**
	 * Delete a record
	 * @param  int $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function delete($id)
	{
		$this->emailTemplate->delete($id);

		return Redirect::route('emailTemplates.index')
		->with('alert', trans('fi.record_successfully_deleted'));
	}

}