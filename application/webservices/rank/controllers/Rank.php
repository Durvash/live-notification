<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class Rank extends REST_Controller {

	public $response_arr = array(
		'success' => 0,
		'message' => ''
	);

	function __construct()
	{
        parent::__construct();
        $this->load->model('rank_model');
    }

	public function index_get($id = 0)
	{
		$result = $this->rank_model->rankList($id);

		if(!empty($result))
		{
			$this->response_arr['success'] = 1;
			$this->response_arr['message'] = $this->lang->line('DATA_FOUND');
			$this->response_arr['data'] = $result;
		}
		
		$this->response($this->response_arr, REST_Controller::HTTP_OK);
	}

	public function updateRank_post()
	{
		$params = array(
			'id'		 => $this->input->post('id'),
			'rank_value' => $this->input->post('value')
		);

		$result = $this->rank_model->updateRank($params);

		$this->response_arr['success'] = 1;
		$this->response_arr['message'] = $this->lang->line('DATA_UPDATED');
		
		$this->response($this->response_arr, REST_Controller::HTTP_OK);
	}

}
