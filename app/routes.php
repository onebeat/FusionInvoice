<?php

Route::get('login', array('uses' => 'SessionController@login', 'as' => 'session.login'));
Route::post('login', array('uses' => 'SessionController@attempt', 'as' => 'session.attempt'));
Route::get('logout', array('uses' => 'SessionController@logout', 'as' => 'session.logout'));

Route::group(array('before' => 'auth'), function()
{
	/*
	|--------------------------------------------------------------------------
	| Routes: Dashboard
	|--------------------------------------------------------------------------
	*/
	Route::get('/', 'DashboardController@index');
	Route::get('dashboard', array('uses' => 'DashboardController@index', 'as' => 'dashboard.index'));
});