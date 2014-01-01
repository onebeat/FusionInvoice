<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

Route::group(array('before' => 'auth'), function()
{
	Route::get('users', array('uses' => 'UserController@index', 'as' => 'users.index'));
	Route::get('users/create', array('uses' => 'UserController@create', 'as' => 'users.create'));
	Route::get('users/{user}/edit', array('uses' => 'UserController@edit', 'as' => 'users.edit'));
	Route::get('users/{user}', array('uses' => 'UserController@show', 'as' => 'users.show'));
	Route::get('users/{user}/delete', array('uses' => 'UserController@delete', 'as' => 'users.delete'));

	Route::post('users', array('uses' => 'UserController@store', 'as' => 'users.store'));
	Route::post('users/{user}', array('uses' => 'UserController@update', 'as' => 'users.update'));
});