<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Cross_infinty_model');
	}

	function index(){
		$this->verify_auth();

		$session_data = $this->session->all_userdata();
		if($session_data['type'] == 'user'){
			redirect('user');
		}else{
			redirect('company');
		}
	}

	function contruction_page(){
		$data['title'] = "Contruction Page";
		$this->layout->setLayout('frontend/layout/layout');
		$this->layout->view('frontend/contruct',$data);
	}

	//get list cross infinity
	public function get_cross_infinity(){
		$session_data = $this->session->all_userdata();
		$this->verify_auth();
		$data['title'] = "CROSS INFINITY情報";
		$data['cross_infinity'] = $this->Cross_infinty_model->get_cross_infinty($session_data['type']);
		$data['menu'] = $this->session->userdata('type');
		$this->layout->setLayout('frontend/layout/layout');
		$this->layout->view('frontend/cross_infinity_information',$data);
	}
}
