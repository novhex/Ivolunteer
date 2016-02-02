<?php

defined('BASEPATH') or exit('Error!');

class Home extends CI_Controller{

	private $data;
	private $form_rules;

	public function __construct(){
		parent::__construct();	
		$this->load->helper(array('url'));
		$this->load->library(array('form_validation','registration','session'));
		$this->load->model('home_model');
                


	}

	public function index(){

		$this->data['page_title']= "Home &raquo; iVolunteer";
		$this->load->view('home/tpl/page_header',$this->data);
		$this->load->view('home/ivo_home');
		$this->load->view('home/tpl/page_footer');
                

	}

	
	public function dashboard(){

		if($this->session->userdata('userName')!='' && $this->session->userdata('userId')!=''){
		$this->data['page_title']= "Dashboard &raquo; iVolunteer";
		$this->load->view('home/tpl/page_header',$this->data);
		$this->load->view('home/ivo_dashboardmain');
		$this->load->view('home/tpl/page_footer');
		}else{
			redirect(base_url('index.php/home/login'));
		}
	}

	public function donate(){
		if($this->session->userdata('userName')!='' && $this->session->userdata('userId')!='' && $this->session->userdata('userType')!=''){
		$this->data['page_title']= "Donate &raquo; iVolunteer";
		$this->data['organization_lists']=$this->home_model->viewOrganization();
		$this->load->view('home/tpl/page_header',$this->data);
		$this->load->view('home/ivo_donate',$this->data);
		$this->load->view('home/tpl/page_footer');

		}else{
			redirect(base_url('index.php/home/login'));
		}

	}



	public function login(){

		if($this->session->userdata('userName')!='' && $this->session->userdata('userId')!=''){
			redirect(base_url('index.php/home/dashboard'));
		}else{

		$this->form_validation->set_rules('txtUser','Username','trim|required|min_length[6]');
		$this->form_validation->set_rules('txtPass','Password','trim|required|min_length[6]');
		

		if($this->form_validation->run()==FALSE){
		$this->data['page_title']= "User Login &raquo; iVolunteer";
		$this->load->view('home/tpl/page_header',$this->data);
		$this->load->view('home/ivo_login');
		$this->load->view('home/tpl/page_footer');	
		}else{
		$username = $this->input->post('txtUser');
		$password = $this->input->post('txtPass');


		$response = $this->home_model->checkuseraccount($username,$password);
		
		
			if($response==1){
				$this->session->set_userdata('userId',$this->home_model->fetchUserId($username));
				$this->session->set_userdata('userName',$username);
				$this->session->set_userdata('userType',$this->home_model->fetchUserType($username));

					redirect(base_url('index.php/home/dashboard'));
			}else{
					$this->session->set_flashdata('auth-error','Invalid Username or Password');
					redirect(base_url('index.php/home/login'));
			}
		}
		


	  }

	}

	public function logout(){
		$this->session->unset_userdata(array('userId','userName'));
		redirect(base_url('index.php/home/login'));
	}

	public function myorganization($userId){
			

			if($this->session->userdata('userName')=='' && $this->session->userdata('userId')==''){
				redirect(base_url('index.php/home/index'));
		}else{

			
			$this->data['page_title']= "My Organization &raquo; iVolunteer";
			$this->data['user_org_array']=$this->home_model->volunteerorginfo($userId);
			
			$this->data['org_details']= $this->home_model->viewOrganizationFullInfo($this->data['user_org_array'][0]['org_id']);
			$this->data['org_members']=$this->home_model->viewOrgMembers($this->data['user_org_array'][0]['org_id']);
			
			
			$this->load->view('home/tpl/page_header',$this->data);
			$this->load->view('home/ivo_volunteerorg',$this->data);
			$this->load->view('home/tpl/page_footer');
			
		}


	}

public function mydonation(){
		if($this->session->userdata('userName')!='' && $this->session->userdata('userId')!='' && $this->session->userdata('userType')!=''){
		$this->data['page_title']= "My Donations &raquo; iVolunteer";
		$this->data['donations']=$this->home_model->my_donations($this->session->userdata('userId'));
		$this->load->view('home/tpl/page_header',$this->data);
		$this->load->view('home/ivo_mydonations',$this->data);
		$this->load->view('home/tpl/page_footer');

		}else{
			redirect(base_url('index.php/home/login'));
		}
	}


	public function organizationlists(){
		if($this->session->userdata('userName')=='' && $this->session->userdata('userId')==''){
			redirect(base_url('index.php/home/index'));
		}else{

			if($this->home_model->hasJoinedinOrg($this->session->userdata('userId'))==TRUE){
				$this->session->set_flashdata('has_joined',"Access Denied");
				redirect(base_url("index.php/home/dashboard"));
			}
			else{
			$this->data['page_title']= "Oraganization Lists &raquo; iVolunteer";
			$this->data['organization_lists']=$this->home_model->viewOrganization();
			$this->load->view('home/tpl/page_header',$this->data);
			$this->load->view('home/ivo_orglists',$this->data);
			$this->load->view('home/tpl/page_footer');
			}
		}	
	}

	public function register(){
		if($this->session->userdata('userName')!=''){
			redirect(base_url('index.php/home/dashboard'));
		}
		$data['type']=$this->input->get('type');

		$this->form_rules=array(array(
				'field'=>'txtfname',
				'label'=>'First Name',
				'rules'=>'trim|required|min_length[2]|max_length[30]'
			),
			array(
				'field'=>'txtlname',
				'label'=>'Last Name',
				'rules'=>'trim|required|min_length[2]|max_length[30]'
				),
			array(
				'field'=>'txtmidi',
				'label'=>'Middle Initial',
				'rules'=>'trim|required|min_length[1]'
			),
			array(
				'field'=>'civil_stat',
				'label'=>'Civil Status',
				'rules'=>'trim|required'
				),

			array(
				'field'=>'txtreligion',
				'label'=>'Religion',
				'rules'=>'trim|required|min_length[4]|max_length[50]'
				),		
			array(
				'field'=>'txtnationality',
				'label'=>'Nationality',
				'rules'=>'trim|required|max_length[50]'
				),
			array(
				'field'=>'gender',
				'label'=>'Gender',
				'rules'=>'trim|required'
				),		
			array(
				'field'=>'txtcontact',
				'label'=>'Contact Number',
				'rules'=>'trim|required|min_length[11]|max_length[30]'
				),	
			array(
				'field'=>'txtemail',
				'label'=>'Email',
				'rules'=>'trim|required|valid_email'
				),
			array(
				'field'=>'txtprofession',
				'label'=>'Profession',
				'rules'=>'trim|required|min_length[6]|max_length[50]'
				),
			array(
				'field'=>'txtUsername',
				'label'=>'Username',
				'rules'=>'trim|required|min_length[6]|max_length[30]'
				),	
			array(
				'field'=>'txtPassword',
				'label'=>'Password',
				'rules'=>'trim|required|min_length[6]|max_length[15]'
				),										
			array(
				'field'=>'txtPasswordcf',
				'label'=>'Password Confirmation',
				'rules'=>'trim|required|matches[txtPassword]'
				),
			array(
				'field'=>'txtbirth',
				'label'=>'Birthdate',
				'rules'=>'trim|required|max_length[10]'
			),		
			);

			$this->form_validation->set_rules($this->form_rules);
			$this->form_validation->set_error_delimiters('<p style="color:maroon;">','</p>');
			if($this->form_validation->run()==false){

							if($this->input->get('type')==''){

								$data['type'] = 'volunteer';
							}

								

							$this->data['page_title']= "User Registration &raquo; iVolunteer";
							$this->load->view('home/tpl/page_header',$this->data);
							$this->load->view('home/ivo_register',$data);
							$this->load->view('home/tpl/page_footer');
			}else{
				$data_response = $this->registration->processRegistration(
					$this->input->post('txtfname'),
					$this->input->post('txtlname'),
					$this->input->post('txtmidi'),
					$this->input->post('txtbirth'),
					$this->input->post('txtAge'),
					$this->input->post('civil_stat'),
					$this->input->post('txtreligion'),
					$this->input->post('txtnationality'),
					$this->input->post('gender'),
					$this->input->post('txtcontact'),
					$this->input->post('txtemail'),
					$this->input->post('txtprofession'),
					$this->input->post('txtUsername'),
					$this->input->post('txtPassword'),
					$this->input->post('reg_type')
				);
				if($data_response == 1){
					$this->session->set_flashdata('success_reg','Registration succeded');
					redirect(base_url('index.php/home/register'));
				}else{
					$this->session->set_flashdata('success_err','Registration failed');
					redirect(base_url('index.php/home/register'));	
				}
		}


	}

	/*public function registerorganization(){

		$this->form_rules = array(
			array('label'=>'Organization Name',
				  'field'=>'txtOrgname',
				  'rules'=>'trim|required|min_length[3]|max_length[50]',
				),
			array('label'=>'Organization In Charge',
				  'field'=>'txtOrg_incharge',
				  'rules'=>'trim|required|min_length[3]|max_length[50]',
				),
			array('label'=>'Organization Email',
				  'field'=>'txtOrg_email',
				  'rules'=>'trim|required|valid_email|max_length[50]',
				),
			array('label'=>'Organization Contact #',
				  'field'=>'txtOrg_contact',
				  'rules'=>'trim|required|max_length[11]',
				),			

			);
		$this->form_validation->set_rules($this->form_rules);


		if($this->form_validation->run()==FALSE){
			$this->data['page_title']= "Register an Organization &raquo; iVolunteer";
			$this->load->view('home/tpl/page_header',$this->data);
			$this->load->view('home/ivo_organizationregister');
			$this->load->view('home/tpl/page_footer');
		}else{

		$data_response	= $this->registration->processRegistration_Organization(
					mt_rand(1,99999999999),
					$this->input->post('txtOrgname'),
					$this->input->post('txtOrg_incharge'),
					$this->input->post('txtOrg_email'),
					$this->input->post('txtOrg_contact')
				);

		if($data_response==1){
				$this->session->set_flashdata('success_org_reg','OK');
				redirect(base_url('index.php/home/registerorganization'));
		}else{
			$this->session->set_flashdata('success_org_fail','FAIL');
			redirect(base_url('index.php/home/registerorganization'));
		}

		}
	}*/


	public function submit_donation($orgId=NULL){

	if($this->session->userdata('userName')!='' && $this->session->userdata('userId')!='' && $this->session->userdata('userType')!=''){
		
		if($orgId!==NULL){
		
		$this->form_validation->set_rules('amount','Amount','trim|required');
	
		$this->form_validation->set_rules('dis_type','Disaster Type','trim|required');
		
		if($this->form_validation->run()===FALSE){
			$this->data['page_title']= "Submit a donation &raquo; iVolunteer";
			$this->data['organization']=$this->home_model->viewOrganization();
			$this->data['disaster'] = $this->home_model->get_disasterlists();
			$this->load->view('home/tpl/page_header',$this->data);
			$this->load->view('home/ivo_newdonation');
			$this->load->view('home/tpl/page_footer');
		}else{
			//userId
			
			$this->home_model->submit_donation(
				$this->session->userdata('userId'),
				$this->input->post('amount'),
				$this->uri->segment(3),
				$this->input->post('dis_type'));
		}
		}else{
			show_404();
		}
		}else{
			redirect(base_url('index.php/home/login'));
		}
	}



	public function vieworganizationinfo($orgId){

		if($this->session->userdata('userName')!='' && $this->session->userdata('userId')!=''){
		$this->data['page_title']= "Organization Info &raquo; iVolunteer";
		$this->load->view('home/tpl/page_header',$this->data);
		$this->data['org_info'] = $this->home_model->viewOrganizationFullInfo($orgId);
		$this->data['org_members'] = $this->home_model->viewOrgMembers($orgId);
		$this->load->view('home/ivo_orginfo',$this->data);
		$this->load->view('home/tpl/page_footer');
		}else{
			redirect(base_url('index.php/home/login'));
		}

	}

	public function volunteermanagement(){

	  if($this->session->userdata('userName')!='' && $this->session->userdata('userId')!=''){


	  	if($this->session->userdata('userType')=='volunteer'){
		$this->data['page_title']= "Volunteer Management &raquo; iVolunteer";
		$this->data['volunteerlists'] = $this->home_model->viewvolunteerlists();
		$this->load->view('home/tpl/page_header',$this->data);
		$this->load->view('home/ivo_volunteermagement',$this->data);
		$this->load->view('home/tpl/page_footer');
		}else{
			redirect(base_url('index.php/home/dashboard'));
		}


		}else{
			redirect(base_url('index.php/home/login'));
		}
	}

		public function volunteermanagement_addvolunteer(){

	  if($this->session->userdata('userName')!='' && $this->session->userdata('userId')!='' && $this->session->userdata('userType')=='volunteer'){

	  	$data['type']="volunteer";



	  	$this->form_rules=array(array(
				'field'=>'txtfname',
				'label'=>'First Name',
				'rules'=>'trim|required|min_length[2]|max_length[30]'
			),

			array(
				'field'=>'txtlname',
				'label'=>'Last Name',
				'rules'=>'trim|required|min_length[2]|max_length[30]'
				),

			 array(
				'field'=>'txtbirth',
				'label'=>'Birthdate',
				'rules'=>'trim|max_length[10]'
				),

			array(
				'field'=>'txtmidi',
				'label'=>'Middle Initial',
				'rules'=>'trim|required|min_length[1]'
			),
			array(
				'field'=>'civil_stat',
				'label'=>'Civil Status',
				'rules'=>'trim|required'
				),

			array(
				'field'=>'txtreligion',
				'label'=>'Religion',
				'rules'=>'trim|required|min_length[4]|max_length[50]'
				),		
			array(
				'field'=>'txtnationality',
				'label'=>'Nationality',
				'rules'=>'trim|required|max_length[50]'
				),
			array(
				'field'=>'gender',
				'label'=>'Gender',
				'rules'=>'trim|required'
				),		
			array(
				'field'=>'txtcontact',
				'label'=>'Contact Number',
				'rules'=>'trim|required|min_length[11]|max_length[30]'
				),	
			array(
				'field'=>'txtemail',
				'label'=>'Email',
				'rules'=>'trim|required|valid_email'
				),
			array(
				'field'=>'txtprofession',
				'label'=>'Profession',
				'rules'=>'trim|required|min_length[6]|max_length[50]'
				),
			array(
				'field'=>'txtUsername',
				'label'=>'Username',
				'rules'=>'trim|required|min_length[6]|max_length[30]'
				),	
			array(
				'field'=>'txtPassword',
				'label'=>'Password',
				'rules'=>'trim|required|min_length[6]|max_length[15]'
				),										
			array(
				'field'=>'txtPasswordcf',
				'label'=>'Password Confirmation',
				'rules'=>'trim|required|matches[txtPassword]'
				),	
			);

			$this->form_validation->set_rules($this->form_rules);
			$this->form_validation->set_error_delimiters('<p style="color:maroon;">','</p>');
			if($this->form_validation->run()==false){

				$this->data['page_title']= "Volunteer Management - Add New Volunteer &raquo; iVolunteer";
				$this->load->view('home/tpl/page_header',$this->data);
				$this->load->view('home/ivo_addvolunteer',$data);
				$this->load->view('home/tpl/page_footer');

			}else{
				$data_response = $this->registration->processRegistration(
					$this->input->post('txtfname'),
					$this->input->post('txtlname'),
					$this->input->post('txtmidi'),
					$this->input->post('txtbirth'),
					$this->input->post('txtAge'),
					$this->input->post('civil_stat'),
					$this->input->post('txtreligion'),
					$this->input->post('txtnationality'),
					$this->input->post('gender'),
					$this->input->post('txtcontact'),
					$this->input->post('txtemail'),
					$this->input->post('txtprofession'),
					$this->input->post('txtUsername'),
					$this->input->post('txtPassword'),
					$this->input->post('reg_type')
				);
				if($data_response == 1){
					$this->session->set_flashdata('success_reg','Registration succeded');
					redirect(base_url('index.php/home/volunteermanagement_addvolunteer'));
				}else{
					$this->session->set_flashdata('success_err','Registration failed');
					redirect(base_url('index.php/home/volunteermanagement_addvolunteer'));	
				}
		}


		}else{
			redirect(base_url('index.php/home/login'));
		}
	}


}