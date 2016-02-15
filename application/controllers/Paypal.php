<?php
defined("BASEPATH") or exit("Error!");

class Paypal extends CI_Controller{


	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
		$this->load->library('session');

	}


	public function cancelled(){
		if($this->session->userdata('userName')!='' && $this->session->userdata('userId')!=''){
		echo "Donation cancelled click <a href='".base_url('index.php/home/dashboard')."'>here</a> to return to your dashboard";
		}else{
			echo "Access denied";
		}
}

	public function successdonate(){

		/*var_dump($_GET);
		echo "<br>";
		echo "ORGID".$this->session->userdata('org_id');
		echo "USERID".$this->session->userdata('userId');*/
if($this->session->userdata('userName')!='' && $this->session->userdata('userId')!=''){
		$donation = array(
   			'sponsor_id'=>mt_rand(1000,9999999),
   			'user_id'=>$this->session->userdata('userId'),
   			'donation'=>$this->input->get('amt'),
   			'date_given'=>date('Y-m-d'),
   			'org_id'=>$this->session->userdata('org_id'),
   			'disaster_id'=>$this->input->get('item_number')
   			);

   			$this->db->insert('sponsor',$donation);
   			$this->session->set_flashdata('donation_ok','OK');
   			redirect(base_url('index.php/home/mydonation'));
	}else{
		echo "Acess denied";
	}
}

}