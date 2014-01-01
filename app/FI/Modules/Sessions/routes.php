<?php

Route::get('login', array('uses' => 'SessionController@login', 'as' => 'session.login'));
Route::post('login', array('uses' => 'SessionController@attempt', 'as' => 'session.attempt'));
Route::get('logout', array('uses' => 'SessionController@logout', 'as' => 'session.logout'));