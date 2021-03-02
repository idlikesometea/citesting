<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Api_utils_model extends CI_Model
{
	private $successCodes = [200, 201, 202, 203];

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * jsonResponse
	 *
	 * @param mixed $data
	 * @param int $http_response_code
	 **/
	public function jsonResponse($data, int $http_response_code)
	{
	    http_response_code($http_response_code);
		if (in_array($http_response_code, $this->successCodes)) {
			echo json_encode(['data' => $data]);
		} else {
			echo json_encode(['message' => $data]);
		}
	}

	/**
	 * Validate method
	 *
	 * @param string $method
	 * @param array $allowedMethods
	 * @throws Exception
	 **/
	public function validateMethod(string $method, array $allowedMethods)
	{
		if (!in_array($method, $allowedMethods)) {
			$methodsList = implode(',', $allowedMethods);
			throw new Exception(
				"Invalid method found: ${method}. Allowed methods are: ${methodsList}", 
				400
			);
		}
	}
}

/* End of file Api_model.php */
/* Location: ./application/models/Api_model.php */
