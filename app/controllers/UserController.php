<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class UserController extends \BaseController {

	/**
	 * The user repository
	 * @var UserRepository
	 */
	protected $user;

	/**
	 * The user validator
	 * @var UserValidator
	 */
	protected $validator;

	/**
	 * Dependency injection
	 * @param UserRepository $user
	 * @param UserValidator $validator
	 */
	public function __construct($user, $validator)
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
		->with('editMode', false);
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
			->with('editMode', false)
			->withErrors($this->validator->errors())
			->withInput();
		}

		unset($input['password_confirmation']);

		$input['password'] = Hash::make($input['password']);

		$this->user->create($input);
	
		return Redirect::route('users.index')
		->with('alertSuccess', trans('fi.record_successfully_created'));
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
		->with(array('editMode' => true, 'user' => $user));
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
			->with('editMode', true)
			->withErrors($this->validator->errors())
			->withInput();
		}

		$this->user->update($input, $id);

		return Redirect::route('users.index')
		->with('alertInfo', trans('fi.record_successfully_updated'));
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