<?php
namespace Api;

include_once APPPATH . 'models/interfaces/Api_interface.php';
use Throwable;
use Interfaces\iApi;

defined('BASEPATH') or exit('No direct script access allowed');

class BaseApi extends \CI_Controller implements iApi
{
	protected $method;
	private $allowedMethods;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('api_utils_model', 'utils');
		$this->setRequest();
	}

	/**
	 * Set allowed HTTP methods
	 *
	 * @param array $methods
	 **/
	public function setAllowedMethods($methods = [])
	{
		$this->allowedMethods = $methods ?: ['GET', 'POST', 'DELETE'];
	}

	/**
	 * Set incoming request
	 *
	 **/
	public function setRequest()
	{
		try {
			$this->method = $this->input->server('REQUEST_METHOD');
			$this->utils->setHeaders($this->allowedMethods, $this->method);
		} catch(Throwable $th) {
			$this->response($th->getMessage(), $th->getCode());
		}
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
