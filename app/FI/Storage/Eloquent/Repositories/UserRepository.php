<?php namespace FI\Storage\Eloquent\Repositories;

use FI\Storage\Eloquent\Models\User;

class UserRepository {

	/**
	 * Get a paged list of records
	 * @param  int $page
	 * @param  int  $numPerPage
	 * @return User
	 */
	public function getPaged($page = 1, $numPerPage = null)
	{
		\DB::getPaginator()->setCurrentPage($page);
		return User::paginate($numPerPage ?: \Config::get('defaultNumPerPage'));
	}

	/**
	 * Get a single record
	 * @param  int $id
	 * @return User
	 */
	public function find($id)
	{
		return User::find($id);
	}
	
	/**
	 * Create a record
	 * @param  array $input
	 * @return int
	 */
	public function create($input)
	{
		$user = new User;

		$user->fill($input);

		$user->password = $input['password'];

		$user->save();

		return $user->id;
	}
	
	/**
	 * Update a record
	 * @param  array $input
	 * @param  int $id
	 * @return void
	 */
	public function update($input, $id)
	{
		$user = User::find($id);

		$user->fill($input);

		$user->save();
	}
	
	/**
	 * Delete a record
	 * @param  int $id
	 * @return void
	 */
	public function delete($id)
	{
		User::destroy($id);
	}
	
}