<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users_model extends CI_Model
{

	public $users = [
		['id' => 1, 'name' => 'John', 'lastName' => 'Riddle', 'age' => 30, 'email' => 'example@mail.com'],
		['id' => 2, 'name' => 'Arthur', 'lastName' => 'Clark', 'age' => 45, 'email' => 'example2@mail.com'],
		['id' => 3, 'name' => 'Louis', 'lastName' => 'Smith', 'age' => 19, 'email' => 'example3@mail.com'],
		['id' => 4, 'name' => 'Jules', 'lastName' => 'Robertson', 'age' => 23, 'email' => 'example4@mail.com']
	];

	public function __construct()
	{
		parent::__construct();
	}

	public function getUsers(int $userId = null)
	{
		if ($userId) {
			$data = [];
			foreach ($this->users as $user) {
				if ($user['id'] === $userId) {
					$data = $user;
					break;
				}
			}
			if (!$data) {
				throw new Exception("User with id ${userId} not found", 404);
			}
			return $data;
		}
		return $this->users;
	}

	public function createUser($user) {
		$user['id'] = end($this->users)['id'] + 1;
		array_push($this->users, $user);
		return $user['id'];
	}

	public function updateUser($id, $user) {
		return 3;
	}
}

/* End of file Users_model.php */
/* Location: ./application/models/Users_model.php */
