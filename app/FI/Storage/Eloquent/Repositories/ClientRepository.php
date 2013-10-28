<?php namespace FI\Storage\Eloquent\Repositories;

use \FI\Storage\Eloquent\Models\Client;

class ClientRepository implements \FI\Storage\Interfaces\ClientRepositoryInterface {
	
	/**
	 * Get a list of all clients
	 * @return Clients
	 */
	public function all()
	{
		return Client::all();
	}

	/**
	 * @TODO Refactor to single getPagedByStatus method
	 */
	public function getPagedActive($page = 1, $numPerPage = null)
	{
		\DB::getPaginator()->setCurrentPage($page);
		return Client::orderBy('name')->where('active', 1)->paginate($numPerPage ?: \Config::get('defaultNumPerPage'));
	}

	/**
	 * @TODO Refactor to single getPagedByStatus method
	 */
	public function getPagedInactive($page = 1, $numPerPage = null)
	{
		\DB::getPaginator()->setCurrentPage($page);
		return Client::orderBy('name')->where('active', 0)->paginate($numPerPage ?: \Config::get('defaultNumPerPage'));
	}

	/**
	 * @TODO Refactor to single getPagedByStatus method
	 */
	public function getPagedAll($page = 1, $numPerPage = null)
	{
		\DB::getPaginator()->setCurrentPage($page);
		return Client::orderBy('name')->paginate($numPerPage ?: \Config::get('defaultNumPerPage'));
	}

	/**
	 * Provides a json encoded array of matching client names
	 * @param  string $name
	 * @return json
	 */
	public function lookupByName($name)
	{
		$clients = Client::select('name')->orderBy('name')->where('name', 'like', '%' . $name . '%')->get();

		$return = array();

		foreach ($clients as $client)
		{
			$return[] = $client->name;
		}

		return json_encode($return);
	}

	/**
	 * Retrieve a single client record
	 * @param  int $id
	 * @return Client
	 */
	public function find($id)
	{
		return Client::find($id);
	}

	public function findIdByName($name)
	{
		if ($client = Client::select('id')->where('name', $name)->first())
		{
			return $client->id;
		}

		return null;
	}
	
	/**
	 * Create a new client record
	 * @param  array $input
	 * @return  int
	 */
	public function create($input)
	{
		return Client::create($input)->id;
	}
	
	/**
	 * Update an existing client record
	 * @param  array $input
	 * @param  int $id
	 */
	public function update($input, $id)
	{
		$client = Client::find($id);
		$client->fill($input);
		$client->save();
	}
	
	/**
	 * Delete a client record
	 * @param  int $id
	 */
	public function delete($id)
	{
		Client::destroy($id);
	}
	
}