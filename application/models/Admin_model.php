<?php
defined('BASEPATH') or exit('Error');

class Admin_model extends CI_Model{

private $query = "" ;

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}



	public function add_team($team_id,$team_name){
		$data=array(
			'dis_team_id'=>$team_id,
			'team_name'=>$team_name
			);
		return $this->db->insert('disaster_team',$data);
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


	public function add_location($province,$municipality,$street){

		$data2=array(
				'province'=>$province,
				'municipality'=>$municipality,
				'street'=>$street,
				'location_id'=>mt_rand(1000,9999999)
				);
			$this->db->insert('location',$data2);
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

   public function add_comment($dis_id,$comment,$comment_by){
      $comment=array(
         'dis_type_id'=>$dis_id,
         'comment_id'=>mt_rand(1000,9999999),
         'message'=>$comment,
         'date_comment'=>date('Y-m-d'),
         'comment_by'=>11111111111
         );

      return $this->db->insert('comments',$comment);
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

	public function check_disaster($type){
		$this->db->where("type",$type);
		$this->db->from("disaster_type");
		return $this->db->count_all_results();
	}

	public function delete_comment($id){
		$this->db->where("comment_id",$id);
		return $this->db->delete("comments");
	}



	public function get_disasterlists(){
		$query = $this->db->order_by("type","ASC");
		$query = $this->db->get("disaster_type");
		return $query->result_array();
	}

	public function getDonations(){
		$q = $this->db->join("user","user.user_id = sponsor.user_id");
		$q = $this->db->join("organization","organization.org_id = sponsor.org_id");
		$q = $this->db->join("disaster_type","disaster_type.disaster_type_id = sponsor.disaster_id");
		$q = $this->db->get("sponsor");

		return $q->result_array();


	}

	public function get_disasterteam(){
		$query = $this->db->order_by("team_name","ASC");
		$query = $this->db->get("disaster_team");
		return $query->result_array();
	}


	public function get_locationlists(){
		$query = $this->db->order_by("province","ASC");
		$query = $this->db->get("location");
		return $query->result_array();
	}

	   public function getProfile($userID){
      $query = $this->db->where("user_id",$userID);
      $query = $this->db->get("user");

      return $query->result_array();

   }

   public function getProfileAccount($userID){
   		$query = $this->db->where("user_id",$userID);
        $query = $this->db->get("user_settings");

      return $query->result_array();
   }

      public function fetchComments($dist_id){
      $query = $this->db->select("*");
      $query = $this->db->from("comments");
      $query = $this->db->join("user","user.user_id = comments.comment_by");
      $query = $this->db->where("comments.dis_type_id",$dist_id);
      $query = $this->db->get();
      return $query->result_array();
   }

   public function reliefoperations(){
   	$query = $this->db->join("location","location.location_id = process_relief_operation.location_id");
   	$query = $this->db->join("disaster_type","disaster_type.disaster_type_id = process_relief_operation.dis_type_id");
   	$query = $this->db->get("process_relief_operation");
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


	public function fullvolunteerlist(){
		$query = $this->db->select("*");
		$query = $this->db->from("user");
		$query = $this->db->join("user_settings","user_settings.user_id = user.user_id");
		$query = $this->db->where("user_settings.user_account_type","volunteer");
		$query = $this->db->order_by("user.id","DESC");
		$query = $this->db->get();
		return $query->result_array();
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
	

   public function update_loginaccount($userid,$username,$password){
      $account =array('user_username'=>$username,'user_userpassword'=>$password);
      $this->db->where("user_id",$userid);
      $this->db->update("user_settings",$account);

      echo $this->db->last_query();
   }



      public function update_profile($id,$firstname,$lastname,$number,$email,$username){
      $profile=array('user_firstname'=>$firstname,
         'user_lastname'=>$lastname,
         'user_contact_no'=>$number,
         'user_email_add'=>$email,
         );
      $this->db->where("user_id",$id);
      return $this->db->update("user",$profile);


   }

   public function update_disaster($newType,$id){
   	$disaster = array(
   		'type'=>$newType
   		);
   	$this->db->where('disaster_type.disaster_type_id',$id);
   	return $this->db->update('disaster_type',$disaster);

   }

   public function update_team($id,$team_name){
   			$data=array(
			
			'team_name'=>$team_name
			);
		$this->db->where('disaster_team.dis_team_id',$id);
		return $this->db->update('disaster_team',$data);
   }

   public function update_user($id,$newUser){
   	$user = array('user_username'=>$newUser);
   	$this->db->where('user_settings.user_id',$id);
   	$this->db->update('user_settings',$user);
   }

   	public function  update_org($org_id,$orgname,$org_oic,$org_email,$org_contactno){

			$data = array(
		
				'org_name'=>$orgname,
				'org_incharge'=>$org_oic,
				'org_email'=>$org_email,
				'org_contactno'=>$org_contactno
				);
			$this->db->where('organization.org_id',$org_id);
			$this->db->update('organization',$data);
	}
	

     public function reassignvolunteer($volunteer_id,$neworgID){
      $neworg_info =array('org_id'=>$neworgID);
      $this->db->where('organization_members.user_id',$volunteer_id);
      return $this->db->update('organization_members',$neworg_info);
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
