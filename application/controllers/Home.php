<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
  public function index()
  {
		$reportingUrl = 'file://' . APPPATH . 'tests/build/coverage/index.html';
    $this->load->view('home/index', ['reportingUrl' => $reportingUrl]);
  }

}


/* End of file Home.php */
/* Location: ./application/controllers/Home.php */
