<?php
defined('BASEPATH') or exit('Error');

class Admin_model extends CI_Model{

private $query = "" ;

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}




	public function add_disaster($type){//$province,$municipality,$street){
		$dis_id=mt_rand(1000,9999999);
			$data=array(
				'disaster_type_id'=>$dis_id,
				'type'=>ucfirst($type)
				);
			$this->db->insert('disaster_type',$data);

			/*$data2=array(
				'province'=>$province,
				'municipality'=>$municipality,
				'street'=>$street,
				'location_id'=>mt_rand(1000,9999999)
				);
			$this->db->insert('location',$data2);*/

			return true;
	}

	public function add_reliefop($dis_type,$location,$organizer){

		$data=array(
			'disaster_id'=>mt_rand(1000,9999999),
			'location_id'=>$location,
			'organized_by'=>$organizer,
			'dis_type_id'=>$dis_type,
			'disaster_date'=>date('Y-m-d')
			);

		$this->db->insert('process_relief_operation',$data);

		return true;



	}


	public function checkadminaccount($username,$password){
		$this->query = $this->db->select("*");
		$this->query = $this->db->from('user_settings');
		$this->query = $this->db->where('user_settings.user_username',$username);
		$this->query = $this->db->where('user_settings.user_userpassword',$password);
		$this->query = $this->db->where('user_settings.user_account_type','admin');

		if($this->db->count_all_results()==1){
			echo 'Ok';
			return TRUE;
		}
		else{

			return FALSE;
		}

	}

	public function get_disasterlists(){
		$query = $this->db->order_by("type","ASC");
		$query = $this->db->get("disaster_type");
		return $query->result_array();
	}

	public function get_locationlists(){
		$query = $this->db->order_by("province","ASC");
		$query = $this->db->get("location");
		return $query->result_array();
	}

	public function sponsorslists(){

		$this->query = $this->db->select("*");
		$this->query = $this->db->from("user_settings");
		$this->query = $this->db->where("user_account_type","sponsor");
		$this->query = $this->db->join("user","user.user_id = user_settings.user_id");
		$this->query = $this->db->get();
		return $this->query->result_array();


	}

	public function volunteerlists(){



		$query = $this->db->select("*");
   		$query = $this->db->from("user");
   		$query = $this->db->join('organization_members', 'organization_members.user_id = user.user_id');
   		$query = $this->db->join('organization','organization.org_id = organization_members.org_id');
		$query = $this->db->get();
   		return $query->result_array();

	}




	public function organizationlists(){
			$this->db->order_by("organization.org_name","ASC");
		
			$this->query = $this->db->get("organization");

			return $this->query->result_array();
		}

	public function  saveorg($orgname,$org_oic,$org_email,$org_contactno){

			$data = array(
				'org_id'=>mt_rand(1000,99999999),
				'org_name'=>$orgname,
				'org_incharge'=>$org_oic,
				'org_email'=>$org_email,
				'org_contactno'=>$org_contactno
				);
			$this->db->insert('organization',$data);
	}
	

	public function viewOrganizationFullInfo($orgId){
		    $query = $this->db->select("*");
		    $query = $this->db->from("organization");
		   	$query  = $this->db->where('organization.org_id',$orgId);
		   	$query = $this->db->get();
		   	return $query->result_array();
   }

      public function viewOrgMembers($orgId){
	   		$query = $this->db->select("*");
	   		$query = $this->db->from("organization_members");
	   		$query = $this->db->join("user","organization_members.user_id = user.user_id");
	   		$query = $this->db->where("organization_members.org_id",$orgId);
			$query = $this->db->get();
	   		return $query->result_array();
   }
}
