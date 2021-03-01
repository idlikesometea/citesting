<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{
    
  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
	  echo "oh hi babyyy";
  }

	public function get() {
		echo 'yes';
	}

}


/* End of file Users.php */
/* Location: ./application/controllers/api/v1/Users.php */
