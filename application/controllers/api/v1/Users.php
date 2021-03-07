<?php
defined('BASEPATH') or exit('No direct script access allowed');

include_once APPPATH . 'controllers/BaseApi.php';
include_once APPPATH . 'models/interfaces/Crud_interface.php';

use Api\BaseApi as Api;
use Interfaces\iCRUD;

final class Users extends Api implements iCRUD
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('users_model', 'users');
		$this->load->library('form_validation');
	}

	public function index($id = null)
	{
		try {
			$this->setAllowedMethods();
			$httpRequestMethod = $this->getMethod();
			switch ($httpRequestMethod) {
				case 'GET':
					$this->get($id);
					break;
				case 'POST':
					if ($id)
						$this->update($id);
					else
						$this->create();
					break;
				case 'DELETE':
					$this->delete($id);
					break;
				default:
					throw new Exception("Http method not found.", 400);
					break;
			}
		} catch (Throwable $th) {
			$http_error_code = $th->getCode() ?: 400;
			$this->response($th->getMessage(), $http_error_code);
		}
	}

	public function get(int $id = null)
	{
		$users = $this->users->getUsers($id);
		$this->response($users);
	}

	public function create()
	{
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('lastName', 'Last name', 'required');
		$this->form_validation->set_rules('age', 'Age', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		if ($this->form_validation->run()) {
			$user = $this->input->post();
			$id = $this->users->createUser($user);
			$this->response(['id' => $id], 201);
		} else {
			$this->utils->formValidationError();
		}
	}

	public function update(int $id)
	{
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('lastName', 'Last name', 'required');
		$this->form_validation->set_rules('age', 'Age', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		if ($this->form_validation->run()) {
			$user = $this->input->post();
			$this->users->updateUser($id, $user);
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
