<?php

defined('BASEPATH') or exit('Error!');

class Ajax extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->library(array('session'));
		$this->load->model('home_model');
		$this->load->helper('url');


	}

	public function login(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');


		$response = $this->home_model->checkuseraccount($username,$password);
		
		
echo $response;

			if($response==1){
				$this->session->set_userdata('userId',$this->home_model->fetchUserId($username));
				$this->session->set_userdata('userName',$username);
				$this->session->set_userdata('userType',$this->home_model->fetchUserType($username));
				
			}
	}

	public function join_org(){

		$message = "";

		if($this->session->userdata('userId')!='' && $this->session->userdata('userName')!=''){

			$orgId = $this->input->get('orgid');
			$userId = $this->input->get('userid');


			if($this->home_model->check_ifalreadyjoined_in_org($userId,$orgId)==0){
				$this->home_model->join_user_to_org($userId,$orgId);
				$message="join_ok";
				
			}else{
				$message="already_joined";
		
			}
			echo $message;
		}
	}

	public function openadddialog(){
		echo $this->load->view('ivo_register');
	}

	
}