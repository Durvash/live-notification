<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		if(!$this->session->userdata('login_detail')) {
			redirect(base_url('/'));
		}

		$data = [];
		$data['loginDetail'] = $this->session->userdata('login_detail');
		// print_r($data);
		$this->load->view('home', $data);
	}
    
}
