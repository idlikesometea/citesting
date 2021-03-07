<?php
namespace Api;

include_once APPPATH . 'models/interfaces/Api_interface.php';
use Interfaces\iApi;

defined('BASEPATH') or exit('No direct script access allowed');

class BaseApi extends \CI_Controller implements iApi
{
	private $method;
	private $allowedMethods;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('api_utils_model', 'utils');
	}

	/**
	 * Set allowed HTTP methods
	 *
	 * @param array $methods
	 **/
	public function setAllowedMethods($methods = [])
	{
		$this->allowedMethods = $methods ?: ['GET', 'POST', 'DELETE'];
		$this->setMethod();
		$this->utils->setHeaders($this->allowedMethods, $this->method);
	}

	/**
	 * Get allowed HTTP methods
	 *
	 * @return array $http_methods
	 **/
	public function getAllowedMethods()
	{
		return $this->allowedMethods;
	}

	/**
	 * Set incoming request method
	 * 
	 **/
	public function setMethod()
	{
		$this->method = $this->input->server('REQUEST_METHOD');
	}

	/**
	 * Get incoming request method
	 * 
	 * @return string HTTP request method
	 **/
	public function getMethod()
	{
		return $this->method;
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
	public function response($data, int $http_response_code = 200)
	{
		$this->utils->jsonResponse($data, $http_response_code);
	}
}

/* End of file Api.php */
/* Location: ./application/controllers/Api.php */
