<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function index()
	{
		// print_r($this->session->userdata('login_detail'));
		if($this->session->userdata('login_detail')) {
			redirect(base_url('/home'));
		}

		$this->load->view('login');
	}
    
}
