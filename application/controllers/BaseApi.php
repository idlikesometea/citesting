<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BaseApi extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('api_utils_model', 'utils');
	}

	public function index()
	{
		echo "oh hi";
	}
	
	/**
	 * Base API Response
	 *
	 * This function gives a JSON object to the user
	 *
	 * @param mixed $data
	 * @return string Prints JSON response
	 **/
	public function response(mixed $data, int $http_code = 200)
	{
		$this->utils->jsonResponse($data);
	}
}


/* End of file Api.php */
/* Location: ./application/controllers/Api.php */
