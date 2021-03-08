<?php

class Api_model_test extends TestCase {

	public function setUp(): void
	{
		$this->resetInstance();
		$this->CI->load->model('Api_model');
		$this->obj = $this->CI->Api_model;
	}

	public function test_non_valid_method()
	{
		$this->expectExceptionCode(405);

		$this->obj->setHeaders(['GET'], 'POST');
	}

	public function test_success_json_response()
	{
		$expected = ['data' => []];

		$this->obj->jsonResponse([], 200);

		$this->expectOutputString(json_encode($expected));
	}

	public function test_error_json_response()
	{
		$expected = ['message' => 'An error ocurred'];

		$this->obj->jsonResponse('An error ocurred', 500);

		$this->expectOutputString(json_encode($expected));
	}

}
