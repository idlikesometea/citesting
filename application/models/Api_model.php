<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Api_model extends CI_Model
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
	public function setHeaders(array $allowedMethods, string $method, bool $authentication = false)
	{
		$methods = implode(', ', $allowedMethods);
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
	 * Returns JSON with success data or error message
	 *
	 * @param mixed $data
	 * @param int $httpResponseCode
	 **/
	public function jsonResponse($data, int $httpResponseCode)
	{
	    http_response_code($httpResponseCode);

		if (in_array($httpResponseCode, $this->successCodes)) {
			$response = ['data' => $data];
		} else {
			$response = ['message' => $data];
		}

		$response = json_encode($response);

		if (json_encode($response) !== null) {
			echo $response;
		} else {
			throw new Exception('Malformed data structure.', 500);
		}
	}

	/**
	 * Form validation error
	 *
	 * @throws string Form error message
	 **/
	public function formValidationError()
	{
		$errorArray = $this->form_validation->error_array();
		$errorMessage = reset($errorArray) ?: 'There was an unkown error in your request';
		throw new Exception($errorMessage, 500);
	}
}

/* End of file Api_model.php */
/* Location: ./application/models/Api_model.php */
