<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class Auth extends REST_Controller {

	public $response_arr = array(
		'success' => 0,
		'message' => ''
	);

	function __construct()
	{
        parent::__construct();
        $this->load->model('auth_model');
    }

	public function index_post()
	{
        try {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $result = $this->auth_model->checkUserPassword($username, $password);
            
            if(!$result)
            {
                throw new Exception($this->lang->line('INVALID_LOGIN'));
            }
            
            $login_detail = array(
                'username'  => $username,
                'time'      => time()
            );

            $this->session->set_userdata('login_detail', $login_detail);
            
            $this->response_arr['success'] = 1;
            $this->response_arr['message'] = $this->lang->line('LOGIN_SUCCESS');

        } catch (Exception $e) {

			$this->response_arr['success'] = 0;
			$this->response_arr['message'] = $e->getMessage();
		}
		// print_r($this->response_arr);exit;
		$this->response($this->response_arr, REST_Controller::HTTP_OK);
	}

	public function logout_get()
	{
        $this->session->unset_userdata('login_detail');
        
        $this->response_arr['success'] = 1;
        $this->response_arr['message'] = $this->lang->line('LOGOUT_SUCCESS');
        
        $this->response($this->response_arr, REST_Controller::HTTP_OK);
    }
}
