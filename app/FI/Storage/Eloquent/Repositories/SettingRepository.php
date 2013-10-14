<?php namespace FI\Storage\Eloquent\Repositories;

use \FI\Storage\Eloquent\Models\Setting;

class SettingRepository implements \FI\Storage\Interfaces\SettingRepositoryInterface {
	
	public function all()
	{
		return Setting::all();
	}

	public function find($id)
	{
		return Setting::find($id);
	}
	
	public function create($input)
	{
		Setting::create($input);
	}
	
	public function update($input, $id)
	{
		$setting = Setting::find($id);
		$setting->fill($input);
		$setting->save();
	}
	
	public function delete($id)
	{
		Setting::destroy($id);
	}
	
}