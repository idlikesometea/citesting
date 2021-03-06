<?php
defined('BASEPATH') or exit('No direct script access allowed');

include_once APPPATH . 'controllers/BaseApi.php';
include_once APPPATH . 'models/interfaces/HttpMethods_interface.php';

use Api\BaseApi as Api;
use Interfaces\iHttpMethods;

final class Users extends Api implements iHttpMethods
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('users_model', 'users');
	}

	public function index($id = null)
	{
		try {
			$this->prepareRequest();
			$requestMethod = $this->getRequestMethod(true);
			$this->{$requestMethod}($id);
		} catch (Throwable $th) {
			$errorCode = $th->getCode() ?: 400;
			$this->response($th->getMessage(), $errorCode);
		}
	}

	public function get(int $id = null)
	{
		$filters = $this->getRequestParams();
		$users = $this->users->getUsers($id, $filters);
		$this->response($users);
	}

	public function post()
	{
		$data = $this->getRequestParams();
		$this->form_validation->set_data($data);
		$this->users->setValidations();
		if ($this->form_validation->run()) {
			$id = $this->users->createUser($data);
			$this->response(['id' => $id], 201);
		} else {
			$this->utils->formValidationError();
		}
	}

	public function put(int $id)
	{
		$data = $this->getRequestParams();
		$this->form_validation->set_data($data);
		$this->users->setValidations();
		if ($this->form_validation->run()) {
			$this->users->updateUser($id, $data);
			$this->response([], 202);
		} else {
			$this->utils->formValidationError();
		}

	}

	public function delete(int $id)
	{
		$this->users->deleteUser($id);
		$this->response([], 202);
	}
}


/* End of file Users.php */
/* Location: ./application/controllers/api/v1/Users.php */
