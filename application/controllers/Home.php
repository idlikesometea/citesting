<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
  public function index()
  {
    $this->load->view('home/index');
  }

}


/* End of file Home.php */
/* Location: ./application/controllers/Home.php */