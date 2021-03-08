<?php

class Users_model_test extends TestCase {

	public function setUp(): void
	{
		$this->resetInstance();
		$this->CI->load->model('Users_model');
		$this->obj = $this->CI->Users_model;
	}


	public function test_get_users()
	{
		$expected = [
			['id' => 1, 'name' => 'John', 'lastName' => 'Riddle', 'age' => 30, 'email' => 'example@mail.com', 'type' => 'internal'],
			['id' => 2, 'name' => 'Arthur', 'lastName' => 'Clark', 'age' => 45, 'email' => 'example2@mail.com', 'type' => 'external'],
			['id' => 3, 'name' => 'Louis', 'lastName' => 'Smith', 'age' => 19, 'email' => 'example3@mail.com', 'type' => 'internal'],
			['id' => 4, 'name' => 'Jules', 'lastName' => 'Robertson', 'age' => 23, 'email' => 'example4@mail.com', 'type' => 'external']
		];

		$users = $this->obj->getUsers();
		$this->assertEquals($expected, $users);
	}

	public function test_get_user()
	{
		$expected = ['id' => 1, 'name' => 'John', 'lastName' => 'Riddle', 'age' => 30, 'email' => 'example@mail.com', 'type' => 'internal'];

		$user = $this->obj->getUsers(1);
		$this->assertEquals($expected, $user);
	}

	public function test_get_filtered_users()
	{
		$expected = [
			['id' => 2, 'name' => 'Arthur', 'lastName' => 'Clark', 'age' => 45, 'email' => 'example2@mail.com', 'type' => 'external'],
			['id' => 4, 'name' => 'Jules', 'lastName' => 'Robertson', 'age' => 23, 'email' => 'example4@mail.com', 'type' => 'external']
		];

		$users = $this->obj->getUsers(null, ['type' => 'external']);
		$this->assertEquals($expected, $users);
	}

	public function test_non_existant_user()
	{
		$this->expectExceptionMessage("User not found");
		$this->obj->getUsers(9);
	}

	public function test_create_user()
	{
		$data = ['name' => 'John', 'lastName' => 'Riddle', 'age' => 30, 'email' => 'example@mail.com', 'type' => 'internal'];
		$id = $this->obj->createUser($data);
		$output = $this->obj->getUsers($id);
		$expected = array_merge(['id' => $id], $data);
		$this->assertEquals($expected, $output);
	}

	public function test_update_user()
	{
		$data = ['name' => 'John', 'lastName' => 'Riddle', 'age' => 30, 'email' => 'example@mail.com', 'type' => 'internal'];
		$id = 1;
		$this->obj->updateUser($id, $data);
		$output = $this->obj->getUsers($id);
		$expected = array_merge(['id' => $id], $data);
		$this->assertEquals($expected, $output);
	}

	public function test_update_non_existant_user()
	{
		$this->expectExceptionMessage("User not found");

		$this->obj->updateUser(10, []);
	}

	public function test_delete_user()
	{
		$id = 1;
		$this->obj->deleteUser($id);
		$this->expectExceptionMessage("User not found");
		$this->obj->getUsers(1);
	}

	public function test_delete_non_existant_user()
	{
		$this->expectExceptionMessage("User not found");

		$this->obj->deleteUser(10);
	}

}
