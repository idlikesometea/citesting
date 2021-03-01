<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_utils_model extends CI_Model {

  public function __construct()
  {
    parent::__construct();
  }

	/**
	 * jsonResponse
	 *
	 * @param array $data
	 **/
	public function jsonResponse(array $data)
	{
		echo json_encode($data);
	}
}

/* End of file Api_model.php */
/* Location: ./application/models/Api_model.php */
