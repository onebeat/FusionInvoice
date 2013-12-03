<?php namespace FI\Storage\Interfaces;

interface SettingRepositoryInterface {

	/**
	 * Used during app start to place settings in Config
	 * @return void
	 */	
	public function setAll();

	/**
	 * Saves settings submitted by the setting form
	 * @param  string $key
	 * @param  string $value
	 * @return void
	 */
	public function save($key, $value);
}