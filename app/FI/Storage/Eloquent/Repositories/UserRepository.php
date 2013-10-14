<?php namespace FI\Storage\Eloquent\Repositories;

use \FI\Storage\Eloquent\Models\User;

class UserRepository implements \FI\Storage\Interfaces\UserRepositoryInterface {
	
	public function all()
	{
		return User::all();
	}

	public function getPaged($page = 1, $numPerPage = null)
	{
		\DB::getPaginator()->setCurrentPage($page);
		return User::paginate($numPerPage ?: \Config::get('defaultNumPerPage'));
	}

	public function find($id)
	{
		return User::find($id);
	}
	
	public function create($input)
	{
		User::create($input);
	}
	
	public function update($input, $id)
	{
		$user = User::find($id);
		$user->fill($input);
		$user->save();
	}
	
	public function delete($id)
	{
		User::destroy($id);
	}
	
}