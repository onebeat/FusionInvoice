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

		$client = $this->initClient();

		return $client->orderBy('name')->where('active', 1)->paginate($numPerPage ?: \Config::get('defaultNumPerPage'));
	}

	/**
	 * @TODO Refactor to single getPagedByStatus method
	 */
	public function getPagedInactive($page = 1, $numPerPage = null)
	{
		\DB::getPaginator()->setCurrentPage($page);

		$client = $this->initClient();

		return $client->orderBy('name')->where('active', 0)->paginate($numPerPage ?: \Config::get('defaultNumPerPage'));
	}

	/**
	 * @TODO Refactor to single getPagedByStatus method
	 */
	public function getPagedAll($page = 1, $numPerPage = null)
	{
		\DB::getPaginator()->setCurrentPage($page);

		$client = $this->initClient();

		return $client->orderBy('name')->paginate($numPerPage ?: \Config::get('defaultNumPerPage'));
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
		$client = $this->initClient();

		return $client->where('id', $id)->first();
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
	public function create($name, $active = 1, $address1 = null, $address2 = null, $city = null, $state = null, $zip = null, $country = null, $phone = null, $fax = null, $mobile = null, $email = null, $web = null)
	{
		return Client::create(
			array(
				'name'      => $name,
				'address_1' => $address1,
				'address_2' => $address2,
				'city'      => $city,
				'state'     => $state,
				'zip'       => $zip,
				'country'   => $country,
				'phone'     => $phone,
				'fax'       => $fax,
				'mobile'    => $mobile,
				'email'     => $email,
				'web'       => $web,
				'active'    => $active
			)
		)->id;
	}
	
	/**
	 * Update an existing client record
	 * @param  array $input
	 * @param  int $id
	 */
	public function update($clientId, $name, $active, $address1 = null, $address2 = null, $city = null, $state = null, $zip = null, $country = null, $phone = null, $fax = null, $mobile = null, $email = null, $web = null)
	{
		$client = Client::find($clientId);

		$client->fill(
			array(
				'name'      => $name,
				'address_1' => $address1,
				'address_2' => $address2,
				'city'      => $city,
				'state'     => $state,
				'zip'       => $zip,
				'country'   => $country,
				'phone'     => $phone,
				'fax'       => $fax,
				'mobile'    => $mobile,
				'email'     => $email,
				'web'       => $web,
				'active'    => $active
			)
		);
		
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

	/**
	 * Prebuild the query including any necessary subqueries
	 * @return Client
	 */
	public function initClient()
	{
		$client = Client::select('clients.*', 
			\DB::raw('(SELECT SUM(balance) FROM invoice_amounts WHERE invoice_id IN (SELECT id FROM invoices WHERE invoices.client_id = clients.id)) AS balance'),
			\DB::raw('(SELECT SUM(total) FROM invoice_amounts WHERE invoice_id IN (SELECT id FROM invoices WHERE invoices.client_id = clients.id)) AS total'),
			\DB::raw('(SELECT SUM(paid) FROM invoice_amounts WHERE invoice_id IN (SELECT id FROM invoices WHERE invoices.client_id = clients.id)) AS paid')
		);
		
		return $client;
	}
	
}