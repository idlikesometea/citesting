<?php
namespace BaseApi;
use Exception;

defined('BASEPATH') or exit('No direct script access allowed');

class BaseApi extends \CI_Controller
{
	protected $method;
	private $allowedMethods = ['GET', 'POST', 'DELETE'];

	public function __construct()
	{
		parent::__construct();
		$this->load->model('api_utils_model', 'utils');
		$this->prepareRequest();
	}

	/**
	 * Prepare request
	 *
	 * @throws Exception
	 **/
	private function prepareRequest()
	{
		$this->method = $this->input->server('REQUEST_METHOD');
	}

	/**
	 * Base API Response
	 *
	 * This function gives a JSON object to the user
	 *
	 * @param array/string $data
	 * @param int $http_response_code
	 * @return string Prints JSON response
	 **/
	protected function response($data, int $http_response_code = 200)
	{
		$this->utils->jsonResponse($data, $http_response_code);
	}

	/**
	 * Validate request method
	 *
	 *
	 * @param array $allowedMethods
	 * @throws Exception
	 **/
	public function validateMethod(array $allowedMethods = [])
	{
		$allowedMethods = $allowedMethods ?: $this->allowedMethods;
		$this->utils->validateMethod($this->method, $allowedMethods);
	}
}


/* End of file Api.php */
/* Location: ./application/controllers/Api.php */
