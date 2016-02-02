<?php

defined('BASEPATH') or exit('Error!');

class Registration{

	private $CI;
 

	public function __construct(){
		 

		$this->CI = &get_instance();
		$this->CI->load->model('home_model');
 
	}

	public function processRegistration($name,$lastname,$mi,$birth,$age,$cvstat,$religon,$nationality,$gender,$contact,$email,$profession,$username,$password,$reg_type){

		$response = $this->CI->home_model->addvolunteer($name,$lastname,$mi,$birth,$age,$cvstat,$religon,$nationality,$gender,$contact,$email,$profession,$username,$password,$reg_type);

		return $response;
	
	}

	public function processRegistration_Organization($org_id,$org_name,$org_incharge,$org_email,$org_contact){
		$response = $this->CI->home_model->addorganization($org_id,$org_name,$org_incharge,$org_email,$org_contact);
		return $response;
	}



}