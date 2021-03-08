<?php

final class User_test extends TestCase {

	/**
     * @runInSeparateProcess
     */
	public function test_get_users()
	{
		$output = $this->request('GET', 'api/v1/users');
		$expected = '{"data":[{"id":1,"name":"John","lastName":"Riddle","age":30,"email":"example@mail.com","type":"internal"},{"id":2,"name":"Arthur","lastName":"Clark","age":45,"email":"example2@mail.com","type":"external"},{"id":3,"name":"Louis","lastName":"Smith","age":19,"email":"example3@mail.com","type":"internal"},{"id":4,"name":"Jules","lastName":"Robertson","age":23,"email":"example4@mail.com","type":"external"}]}';

		$this->assertEquals(
			$expected,
			$output
		);
		$this->assertEquals(http_response_code(), 200);
	}

	/**
	 * @runInSeparateProcess
	 **/
	public function test_create_user()
	{
		$params = ['name' => 'Test', 'lastName' => 'Example', 'age' => 53, 'type' => 'internal', 'email' => 'email@example.com'];
		$this->request('POST', 'api/v1/users', $params);

		$this->assertEquals(http_response_code(), 201);
	}

	/**
	 * @runInSeparateProcess
	 **/
	public function test_failed_create_user()
	{
		$params = ['name' => 'Test', 'age' => 53, 'type' => 'internal', 'email' => 'email@example.com'];
		$output = $this->request('POST', 'api/v1/users', $params);

		$this->assertEquals(http_response_code(), 500);
		$this->assertStringContainsString('field is required', $output);
		
	}

	/**
	 * @runInSeparateProcess
	 **/
	public function test_put_user()
	{
		$params = ['name' => 'Test', 'lastName' => 'Johnson', 'age' => 53, 'type' => 'internal', 'email' => 'email@example.com'];
		$this->request('PUT', 'api/v1/users/1', json_encode($params));

		$this->assertEquals(http_response_code(), 202);
	}

	/**
	 * @runInSeparateProcess
	 **/
	public function test_failed_put_user()
	{
		$params = ['name' => '', 'lastName' => 'Johnson', 'age' => 53, 'type' => 'internal', 'email' => 'email@example.com'];
		$output = $this->request('PUT', 'api/v1/users/1', json_encode($params));

		$this->assertEquals(http_response_code(), 500);
		$this->assertStringContainsString('is required', $output);
	}

	/**
	 * @runInSeparateProcess
	 **/
	public function test_delete_user()
	{
		$this->request('DELETE', 'api/v1/users/1');
		$this->assertEquals(http_response_code(), 202);
	}
}
