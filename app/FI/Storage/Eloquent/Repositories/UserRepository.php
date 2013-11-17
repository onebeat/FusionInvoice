<?php namespace FI\Storage\Eloquent\Repositories;

use \FI\Storage\Eloquent\Models\User;

class UserRepository implements \FI\Storage\Interfaces\UserRepositoryInterface {

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
		$user = new User;
		$user->fill($input);
		$user->password = $input['password'];
		$user->save();
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