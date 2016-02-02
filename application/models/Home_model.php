<?php

defined('BASEPATH') or exit('Error!');

class Home_model extends CI_Model{

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function addorganization($org_id,$org_name,$org_incharge,$org_email,$org_contact){

		$info = array(
				'org_id'=>$org_id,
				'org_name'=>$org_name,
				'org_incharge'=>$org_incharge,
				'org_email'=>$org_email,
				'org_contactno'=>$org_contact
			);
		return $this->db->insert('organization',$info);

	}


	public function add_donation($amount,$recipient,$for){

	}

	public function addvolunteer($name,$lastname,$mi,$birth,$age,$cvstat,$religon,$nationality,$gender,$contact,$email,$profession,$username,$password,$reg_type){
		$rand_id = mt_rand(1000,9999999);

		$info = array(
			'user_id'=>$rand_id,
			'user_firstname'=>$name,
			'user_lastname'=>$lastname,
			'user_mi'=>$mi,
			'user_birthdate'=>$birth,
			'user_age'=>$age,
			'user_civil_status'=>$cvstat,
			'user_religion'=>$religon,
			'user_nationality'=>$nationality,
			'user_gender'=>$gender,
			'user_contact_no'=>$contact,
			'user_email_add'=>$email,
			'user_profession'=>$profession,
			'user_active'=>1,
			'dis_team_id'=>11,
			'location_id'=>1111
			);
		$this->add_user_settings($rand_id,$username,$password,$reg_type);
		return $this->db->insert('user',$info);
	}

	public function add_user_settings($id,$username,$password,$acctype){
		$user_settings = array('user_id'=>$id,'user_username'=>$username,'user_userpassword'=>$password,'user_account_type'=>$acctype);
		$this->db->insert('user_settings',$user_settings);
	}


	public function check_ifalreadyjoined_in_org($userId,$orgId){

		$query = $this->db->select("*");
		$query = $this->db->from('organization_members');
		$query = $this->db->where('organization_members.org_id',$orgId);
		$query = $this->db->where('organization_members.user_id',$userId);

			return $this->db->count_all_results();
	}



	public function checkuseraccount($username,$password){

		$query = $this->db->select("*");
		$query = $this->db->from('user_settings');
		$query = $this->db->where('user_username',$username);
		$query = $this->db->where('user_userpassword',$password);

		if($this->db->count_all_results()===1){
				return 1;
		}else{
			return 0;
		}
	}

   public function fetchUserId($username){
   		
   		$query = $this->db->query("SELECT user_id from user_settings where user_username='$username'");
   	

   			foreach($query->result() as $res){
   				return $res->user_id;
   			}
   }	

   public function fetchUserType($username){
   	 $query = $this->db->query("SELECT user_account_type from user_settings where user_username='$username'");
   	

   			foreach($query->result() as $res){
   				return $res->user_account_type;
   		}
   }

	public function get_disasterlists(){
		$query = $this->db->order_by("type","ASC");
		$query = $this->db->get("disaster_type");
		return $query->result_array();
	}
   
   public function hasJoinedinOrg($userId){
   		
   			$this->db->where("organization_members.user_id",$userId);
   			$this->db->from("organization_members");

   				if($this->db->count_all_results()==1){

   					return TRUE;
   				}else{
   					return FALSE;
   				}
   }



   public function join_user_to_org($userId,$orgId){

   		$data = array('user_id'=>$userId,'org_id'=>$orgId,'member_date'=>date('Y-m-d'));

   		$this->db->insert('organization_members',$data);
   }

   public function my_donations($sponsorId){
   		$query =$this->db->select("*");
   		$query =$this->db->from("sponsor");
   		$query =$this->db->join("disaster_type","disaster_type.disaster_type_id = sponsor.disaster_id");
   		$query =$this->db->join("organization","organization.org_id = sponsor.org_id");
   		$query =$this->db->where("sponsor.user_id",$sponsorId);
   		$query =$this->db->get();

   		return $query->result_array();
   }
   public function submit_donation($sponsorid,$amount,$recipient_org,$disaster_type){
   		$donation = array(
   			'sponsor_id'=>mt_rand(1000,9999999),
   			'user_id'=>$sponsorid,
   			'donation'=>$amount,
   			'date_given'=>date('Y-m-d'),
   			'org_id'=>$recipient_org,
   			'disaster_id'=>$disaster_type
   			);
   		$this->db->insert('sponsor',$donation);
   }
   public function volunteerorginfo($userId){
   	$query = $this->db->where("organization_members.user_id",$userId);
   	$query = $this->db->get("organization_members");
   	return $query->result_array();
   }


   public function viewOrganization(){

   	$query = $this->db->get('organization');
   	return $query->result_array();
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

   public function viewvolunteerlists(){
   	$query = $this->db->select("*");
   	$query = $this->db->from("user");
   	$query = $this->db->join("user_settings","user.user_id = user_settings.user_id");
   	$query = $this->db->where("user_settings.user_account_type","volunteer");
   	$query = $this->db->get();

   	return $query->result_array();

   }

}