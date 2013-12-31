<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class SessionController extends BaseController {

	protected $validator;

	public function __construct($validator)
	{
		$this->validator = $validator;
	}
	
	public function login()
	{
		return View::make('login');
	}

	public function attempt()
	{
		if (!$this->validator->validate(Input::all()))
		{
			return Redirect::route('session.login')->withErrors($this->validator->errors());
		}

		if (!Auth::attempt(array('email' => Input::get('email'), 'password' => Input::get('password'))))
		{
			return Redirect::route('session.login')->with('errors', array(trans('fi.invalid_login')));
		}

		return Redirect::route('dashboard.index');
	}

	public function logout()
	{
		Auth::logout();

		return Redirect::route('session.login');
	}

}