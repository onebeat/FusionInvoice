<?php

use FI\Storage\Interfaces\UserRepositoryInterface;
use FI\Validators\UserValidator;

class UserController extends \BaseController {

	protected $user;
	protected $validator;

	public function __construct(UserRepositoryInterface $user, UserValidator $validator)
	{
		$this->user      = $user;
		$this->validator = $validator;
	}

	/**
	 * Display paginated list
	 * @return View
	 */
	public function index()
	{
		$users = $this->user->getPaged(Input::get('page'));

		return View::make('users.index')
		->with('users', $users);
	}

	/**
	 * Display form for new record
	 * @return View
	 */
	public function create()
	{
		return View::make('users.form')
		->with('edit_mode', false);
	}

	/**
	 * Validate and handle new record form submission
	 * @return RedirectResponse
	 */
	public function store()
	{
		$input = Input::all();

		if (!$this->validator->validate($input, 'createRules'))
		{
			return Redirect::route('users.create')
			->with('edit_mode', false)
			->withErrors($this->validator->errors())
			->withInput();
		}

		$input['password'] = \Hash::make($input['password']);

		unset($input['password_confirmation']);

		$this->user->create($input);
		
		return Redirect::route('users.index')
		->with('alert_success', trans('fi.record_successfully_created'));
	}

	/**
	 * Display form for existing record
	 * @param  int $id
	 * @return View
	 */
	public function edit($id)
	{
		$user = $this->user->find($id);
		
		return View::make('users.form')
		->with(array('edit_mode' => true, 'user' => $user));
	}

	/**
	 * Validate and handle existing record form submission
	 * @param  int $id
	 * @return RedirectResponse
	 */
	public function update($id)
	{
		$input = Input::all();

		if (!$this->validator->validate($input, 'updateRules'))
		{
			return Redirect::route('users.edit', array($id))
			->with('edit_mode', true)
			->withErrors($this->validator->errors())
			->withInput();
		}

		$this->user->update($input, $id);

		return Redirect::route('users.index')
		->with('alert_info', trans('fi.record_successfully_updated'));
	}

	/**
	 * Delete a record
	 * @param  int $id
	 * @return RedirectResponse
	 */
	public function delete($id)
	{
		$this->user->delete($id);

		return Redirect::route('users.index')
		->with('alert', trans('fi.record_successfully_deleted'));
	}

}