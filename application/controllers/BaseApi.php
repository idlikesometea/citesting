<?php
namespace Api;

include_once APPPATH . 'models/interfaces/Api_interface.php';

use Exception;
use Interfaces\iApi;

defined('BASEPATH') or exit('No direct script access allowed');

class BaseApi extends \CI_Controller implements iApi
{
	private $method;
	private $allowedMethods;
	private $allowedFormats = ['JSON'];
	private $requestParams;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('api_utils_model', 'utils');
	}

	/**
	 * Prepare request
	 * 
	 * Sets methods, body and queryparams from incoming request and prepares headers for response.
	 *
	 * @param array $methods array of allowed methods for this instance
	 **/
	public function prepareRequest($methods = [])
	{
		$this->setAllowedMethods($methods); 
		$this->setRequestMethod();
		$this->setRequestParams();
		$this->utils->setHeaders($this->allowedMethods, $this->method);
	}

	/**
	 * Set allowed methods
	 *
	 * @param array $methods Allowed methods for this instance.
	 **/
	public function setAllowedMethods(array $methods)
	{
		$this->allowedMethods = $methods ?: ['GET', 'POST', 'PUT', 'DELETE'];
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
	public function setRequestMethod()
	{
		$this->method = $this->input->server('REQUEST_METHOD');
	}

	/**
	 * Get incoming request method
	 * 
	 * @param bool $toLower returns method in lowercase.
	 * @return string HTTP request method
	 **/
	public function getRequestMethod($toLower = false)
	{
		return $toLower ? strtolower($this->method) : $toLower;
	}

	/**
	 * Set request parameters
	 *
	 **/
	public function setRequestParams()
	{
		switch ($this->method) {
			case 'GET':
				$this->requestParams = $this->input->get();
				break;
			case 'POST':
				$this->requestParams = $this->input->post();
				break;
			case 'PUT':
			case 'DELETE':
				$params = file_get_contents("php://input");
				$this->requestParams = json_decode($params, true);
				break;
			default:
				break;
		}
	}

	/**
	 * Get request params
	 *
	 * @return array $body Request body parameters
	 **/
	public function getRequestParams()
	{
		return $this->requestParams;
	}

	/**
	 * Base API Response
	 *
	 * This function gives an object to the user in the requested format
	 *
	 * @param array/string $data
	 * @param int $httpResponseCode
	 * @param string $format
	 * @return string Prints response
	 **/
	public function response($data, int $httpResponseCode = 200, string $format = 'JSON')
	{
		switch ($format) {
			case 'JSON':
				$this->utils->jsonResponse($data, $httpResponseCode);
				break;
			default:
				$formats = implode(', ', $this->allowedFormats);
				throw new Exception("${format} format currently not supported. Please try one of the followings: ${formats}");
				break;
		}
	}
}

/* End of file Api.php */
/* Location: ./application/controllers/Api.php */
