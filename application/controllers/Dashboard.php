<?php
defined('BASEPATH') or exit('Error');

class Dashboard extends CI_Controller{

private $data;

	public function __construct(){
			parent::__construct();
			$this->load->library(array('form_validation','session'));
			$this->load->helper('url');
			$this->load->model('admin_model');
	}

	public function index(){
		if($this->session->userdata('admin_username')!=''){
			redirect(base_url('index.php/dashboard/home'));
		}

		$this->form_validation->set_rules('txtAdminuser','Username','required|trim|min_length[6]');
		$this->form_validation->set_rules('txtAdminpass','Password','required|trim');

		if($this->form_validation->run()==FALSE){
			$this->data['page_title'] = "iVolunteer &raquo; Admin Login";
			$this->load->view('dashboard/tpl/admin_header',$this->data);
			$this->load->view('dashboard/admin_loginform');
			$this->load->view('dashboard/tpl/admin_footer');
		}else{
			$response = $this->admin_model->checkadminaccount($this->input->post('txtAdminuser'),$this->input->post('txtAdminpass'));

			if($response==FALSE){
				$this->session->set_flashdata('auth-error','Invalid Username or Password');
				redirect(base_url('index.php/dashboard/index'));
			}else{
				$this->session->set_userdata('admin_username',$this->input->post('txtAdminuser'));
				redirect(base_url('index.php/dashboard/home'));
			}

		}
	}


	public function addorg(){
		
		if($this->session->userdata('admin_username')!=''){
			
			$this->admin_model->saveorg(
				$this->input->post('org_name'),
				$this->input->post('org_incharge'),
				$this->input->post('org_email'),
				$this->input->post('org_contact')
				);
	redirect(base_url('index.php/dashboard/organizations'));
			
		}else{
			echo 'access denied';
		}
		
	}

	public function add_disaster_entry(){

		if($this->session->userdata('admin_username')!=''){


			$this->form_validation->set_rules('disaster_type','Disaster Type','callback_cb_checkdisaster|trim|required|max_length[50]|min_length[4]');
			//$this->form_validation->set_rules('province','Province','trim|required|max_length[50]|min_length[4]');
			//$this->form_validation->set_rules('municipality','Municipality','trim|required|max_length[50]|min_length[4]');
			//$this->form_validation->set_rules('street','Street','trim|required|max_length[50]|min_length[4]');
			
			if($this->form_validation->run()==FALSE){

			$this->data['page_title'] = "iVolunteer &raquo; New Disaster Entry";
			$this->data['disaster_lists'] = $this->admin_model->get_disasterlists();
			$this->load->view('dashboard/tpl/admin_header',$this->data);
			$this->load->view('dashboard/tpl/admin_navbars');
			$this->load->view('dashboard/admin_disasterentry');
			$this->load->view('dashboard/tpl/admin_footer');
		}else{

			$this->admin_model->add_disaster(ucfirst($this->input->post('disaster_type')));//$this->input->post('province'),$this->input->post('municipality'),$this->input->post('street'));
			redirect(base_url('index.php/dashboard/add_disaster_entry'));
		}




			}else{
				$this->session->set_flashdata('not-logged','You must signed-in to access this page');
				redirect(base_url('index.php/dashboard/index'));
		}	
	}

	public function addlocation(){
		if($this->session->userdata('admin_username')!=''){

			$this->form_validation->set_rules('loc','Province','trim|required|max_length[50]|min_length[4]');
			$this->form_validation->set_rules('mun','Municipality','trim|required|max_length[50]|min_length[4]');
			$this->form_validation->set_rules('street','Street','trim|required|max_length[50]|min_length[4]');

			if($this->form_validation->run()==FALSE){

			$this->data['page_title'] = "iVolunteer &raquo; New Disaster Entry";
			$this->data['locations'] = $this->admin_model->get_locationlists();
			$this->load->view('dashboard/tpl/admin_header',$this->data);
			$this->load->view('dashboard/tpl/admin_navbars');
			$this->load->view('dashboard/admin_addlocation');
			$this->load->view('dashboard/tpl/admin_footer');

			}else{
				$this->admin_model->add_location($this->input->post('loc'),$this->input->post('mun'),$this->input->post('street'));
				redirect(base_url('index.php/dashboard/addlocation'));
			}
		}	

	}

	public function cb_checkdisaster($str){
		if($this->admin_model->check_disaster($str)==0){
			return TRUE;
		}else{
			
			$this->form_validation->set_message('cb_checkdisaster', 'Disaster type already exists!');
			return FALSE;
		}
	}


	public function editdisaster(){
		$response = $this->admin_model->update_disaster($this->input->post('disaster_type_edit'),$this->input->post('disaster_id'));
		if($response==1){
			redirect(base_url('index.php/dashboard/add_disaster_entry'));
		}else{
			echo "something wrong";
		}
	}

	public function deletecomment(){
		if($this->session->userdata('admin_username')!=''){
		$response = $this->admin_model->delete_comment($this->input->post('commentid'));
		echo $response;
		}
	}

	public function postcomment(){

		if($this->session->userdata('admin_username')!=''){
			$dis_id=$this->input->post('dis_id');
			$comment=$this->input->post('comment');

			$response =$this->admin_model->add_comment($dis_id,$comment,$this->session->userdata('admin_username'));

			echo $response;

		}else{
			redirect(base_url('index.php/home/login'));
		}

	}

	public function disasterteam(){

		if($this->session->userdata('admin_username')!=''){

					$this->form_validation->set_rules('team_name','Team Name','trim|required|max_length[50]');

					if($this->form_validation->run()==FALSE){

					$this->data['page_title']= "Add Disaster Team &raquo; iVolunteer";
					$this->data['disasterteam']=$this->admin_model->get_disasterteam();
					$this->load->view('dashboard/tpl/admin_header',$this->data);
					$this->load->view('dashboard/tpl/admin_navbars');
					$this->load->view('dashboard/admin_disasterteam',$this->data);
					$this->load->view('dashboard/tpl/admin_footer');
				}else{
					$response=$this->admin_model->add_team(mt_rand(1,9999999),$this->input->post('team_name'));
					if($response==1){
						redirect(base_url('index.php/dashboard/disasterteam'));
					}
				}

		}else{

		}

	}

	public function donationlist(){

			if($this->session->userdata('admin_username')!=''){

					$this->data['page_title']= "Donations &raquo; iVolunteer";
					$this->data['donations']=$this->admin_model->getDonations();
					$this->load->view('dashboard/tpl/admin_header',$this->data);
					$this->load->view('dashboard/tpl/admin_navbars');
					$this->load->view('dashboard/admin_donationlist',$this->data);
					$this->load->view('dashboard/tpl/admin_footer');

			}else{
			$this->session->set_flashdata('not-logged','You must signed-in to access this page');
			redirect(base_url('index.php/dashboard/index'));
			}

	}

	public function editteam(){
		if($this->session->userdata('admin_username')!=''){
			$response = $this->admin_model->update_team($this->input->post('teamID'),$this->input->post('team_name_edit'));
			if($response==1){
				redirect(base_url('index.php/dashboard/disasterteam'));
			}
		}else{
			$this->session->set_flashdata('not-logged','You must signed-in to access this page');
			redirect(base_url('index.php/dashboard/index'));
		}
	}

	public function editprofile($userID){
		if($this->session->userdata('admin_username')!=''){
		$this->form_validation->set_rules('txtfname','First Name','trim|required|max_length[30]');
		$this->form_validation->set_rules('txtlname','Last Name','trim|required|max_length[30]');
		$this->form_validation->set_rules('txtcontact','Contact No.','trim|required|max_length[30]');
		$this->form_validation->set_rules('txtemail','Email','trim|required|max_length[255]');
		$this->form_validation->set_rules('txtuser','Username','trim|required|min_length[6]|max_length[30]');

		if(strlen($this->input->post('txtpassword'))>0){
			$this->form_validation->set_rules('txtpassword','Password','trim|required|min_length[6]|max_length[15]');
			$this->form_validation->set_rules('txtpasswordcf','Password Confirmation','trim|required|matches[txtpassword]');
		}

		if($this->form_validation->run()==FALSE){
		$this->data['page_title']= "Edit Profile &raquo; iVolunteer";
		$this->data['profile']=$this->admin_model->getProfile($userID);
		$this->data['account']=$this->admin_model-> getProfileAccount($userID);
		$this->load->view('dashboard/tpl/admin_header',$this->data);
		$this->load->view('dashboard/tpl/admin_navbars');
		$this->load->view('dashboard/admin_edituserprofile',$this->data);
		$this->load->view('dashboard/tpl/admin_footer');

		}else{
				$response = $this->admin_model->update_profile($userID,$this->input->post('txtfname'),$this->input->post('txtlname'),$this->input->post('txtcontact'),$this->input->post('txtemail'),$this->input->post('txtuser'));
			
			if(strlen($this->input->post('txtpassword'))>0){
				$response2 = $this->admin_model->update_loginaccount($userID,$this->input->post('txtuser'),$this->input->post('txtpassword'));
			}

			if(strlen($this->input->post('txtuser'))>0){
				$response3 = $this->admin_model->update_user($userID,$this->input->post('txtuser'));
			}
			if($response==1){
			redirect(base_url('index.php/dashboard'));
			}

		}
	}else{
		$this->session->set_flashdata('not-logged','You must signed-in to access this page');
			redirect(base_url('index.php/dashboard/index'));
	}

	}

	public function getcomments(){
		if($this->session->userdata('admin_username')!=''){
			$this->data['comments'] = $this->admin_model->fetchComments($this->input->get('dist_id'));
			$this->data['accesstype']='admin';
			$this->load->view('home/ivo_ajaxcomments',$this->data);
		}else{
			echo "Access denied";
		}

	}
	public function home(){
			if($this->session->userdata('admin_username')!=''){

			$this->data['page_title'] = "iVolunteer &raquo; Dashboard Home";
			$this->data['disasters'] = $this->admin_model->get_disasterlists();
			$this->data['volunteers'] = $this->admin_model->fullvolunteerlist();
			$this->load->view('dashboard/tpl/admin_header',$this->data);
			$this->load->view('dashboard/tpl/admin_navbars');
			$this->load->view('dashboard/admin_dashboardhome');
			$this->load->view('dashboard/tpl/admin_footer');

			}else{
				$this->session->set_flashdata('not-logged','You must signed-in to access this page');
				redirect(base_url('index.php/dashboard/index'));
		}
	}

	public function logout(){
		$this->session->unset_userdata('admin_username');
		$this->session->set_flashdata('logged-out','Session ended.');
		redirect(base_url('index.php/dashboard/index'));
	}

public function organizations(){

	if($this->session->userdata('admin_username')!=''){

		$this->data['page_title'] = "iVolunteer &raquo; organization Menu";
		$this->data['organizations']=$this->admin_model->organizationlists();
		$this->data['volunteerlists'] = $this->admin_model->fullvolunteerlist();
		$this->load->view('dashboard/tpl/admin_header',$this->data);
		$this->load->view('dashboard/tpl/admin_navbars');
		$this->load->view('dashboard/admin_organizationmenu',$this->data);
		$this->load->view('dashboard/tpl/admin_footer');

	}else{
		$this->session->set_flashdata('not-logged','You must signed-in to access this page');
		redirect(base_url('index.php/dashboard/index'));
	}

}

	public function vieworganizationinfo($orgId){

		if($this->session->userdata('admin_username')!=''){

		$this->data['page_title']= "iVolunteer &raquo; Organization Info";
		$this->data['org_info'] = $this->admin_model->viewOrganizationFullInfo($orgId);
		$this->data['org_members'] = $this->admin_model->viewOrgMembers($orgId);
		$this->load->view('dashboard/tpl/admin_header',$this->data);
		$this->load->view('dashboard/tpl/admin_navbars');
		$this->load->view('home/ivo_orginfo',$this->data);
		$this->load->view('home/tpl/page_footer');
		}else{
			redirect(base_url('index.php/home/dashboard'));
		}

	}

	public function reassignvolunteer(){

		if($this->session->userdata('admin_username')!=''){

			$volunteer_id = $this->input->post('vol_id');
			$new_org = $this->input->post('neworg');

			$response = $this->admin_model->reassignvolunteer($volunteer_id,$new_org);

			echo $response;

		}else{
			echo "access denied";
		}
	}


	public function reliefoperation(){

			if($this->session->userdata('admin_username')!=''){

			$this->form_validation->set_rules('dis_type','Disaster Type','trim|required');
			$this->form_validation->set_rules('loc','Location','trim|required');
			$this->form_validation->set_rules('org_by','Organizer','trim|required|min_length[6]|max_length[30]');

			if($this->form_validation->run()==FALSE){
			$this->data['page_title'] = "iVolunteer - New Relief Operation &raquo; Dashboard Home";
			$this->data['disaster_type']= $this->admin_model->get_disasterlists();
			$this->data['location']=$this->admin_model->get_locationlists();
			$this->data['relief_op']=$this->admin_model->reliefoperations();
			$this->data['volunteerlists'] = $this->admin_model->fullvolunteerlist();
			$this->load->view('dashboard/tpl/admin_header',$this->data);

			$this->load->view('dashboard/tpl/admin_navbars');
			$this->load->view('dashboard/admin_reliefop');
			$this->load->view('dashboard/tpl/admin_footer');
		}else{
			$this->admin_model->add_reliefop(
				$this->input->post('dis_type'),
				$this->input->post('loc'),
				$this->input->post('org_by')
				);

			redirect(base_url('index.php/dashboard/reliefoperation'));

		}

		}else{
			$this->session->set_flashdata('not-logged','You must signed-in to access this page');
			redirect(base_url('index.php/dashboard/index'));
		}

	}




	public function sponsors(){

		if($this->session->userdata('admin_username')!=''){

			$this->data['page_title'] = "iVolunteer - Sponsors &raquo; Dashboard Home";
			$this->data['sponsorlists'] = $this->admin_model->sponsorslists();
			$this->load->view('dashboard/tpl/admin_header',$this->data);
			$this->load->view('dashboard/tpl/admin_navbars');
			$this->load->view('dashboard/admin_sponsorsmenu',$this->data);
			$this->load->view('dashboard/tpl/admin_footer');

		}else{
			$this->session->set_flashdata('not-logged','You must signed-in to access this page');
			redirect(base_url('index.php/dashboard/index'));
		}
	}


	public function volunteers(){

		if($this->session->userdata('admin_username')!=''){

			$this->data['page_title'] = "iVolunteer - Volunteers &raquo; Dashboard Home";
			$this->data['volunteerlists'] = $this->admin_model->volunteerlists();
			$this->data['organizations']=$this->admin_model->organizationlists();
			$this->load->view('dashboard/tpl/admin_header',$this->data);
			$this->load->view('dashboard/tpl/admin_navbars');
			$this->load->view('dashboard/admin_volunteersmenu',$this->data);
			$this->load->view('dashboard/tpl/admin_footer');

		}else{
			$this->session->set_flashdata('not-logged','You must signed-in to access this page');
			redirect(base_url('index.php/dashboard/index'));
		}
	}

	public function updateorg(){

if($this->session->userdata('admin_username')!=''){
			
			$this->admin_model->update_org(
				$this->input->post('orgID'),
				$this->input->post('org_name_edit'),
				$this->input->post('org_incharge_edit'),
				$this->input->post('org_email_edit'),
				$this->input->post('org_contact_edit')
				);
	redirect(base_url('index.php/dashboard/organizations'));
			
		}else{
			echo 'access denied';
		}

	}

}
