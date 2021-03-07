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
	 * Set headers
	 *
	 * @param array $allowedMethods
	 * @param string $method
	 * @param bool $authentication
	 * @throws string Not allowed method 
	 **/
	public function setHeaders($allowedMethods, $method)
	{
		$methods = implode($allowedMethods);
		if (!in_array($method, $allowedMethods)) {
			throw new Exception(
				"Method ${method} not allowed. List of allowed methods: ${methods}", 
				405
			);
		}

		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
		header("Access-Control-Allow-Methods: ${methods}");
		header("Allow: ${methods}");
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
			$response = ['data' => $data];
		} else {
			$response = ['message' => $data];
		}

		echo json_encode($response);
	}

	/**
	 * Form validation error
	 *
	 * @throws string Form error message
	 **/
	public function formValidationError()
	{
		$errorArray = $this->form_validation->error_array();
		throw new Exception(reset($errorArray));
	}
}

/* End of file Api_model.php */
/* Location: ./application/models/Api_model.php */
