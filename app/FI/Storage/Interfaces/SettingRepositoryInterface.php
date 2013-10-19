<?php namespace FI\Storage\Interfaces;

interface SettingRepositoryInterface {
	
	public function setAll();

	public function save($input);
}