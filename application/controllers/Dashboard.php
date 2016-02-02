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


			$this->form_validation->set_rules('disaster_type','Disaster Type','trim|required|max_length[50]|min_length[4]');
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

			$this->admin_model->add_disaster($this->input->post('disaster_type'));//$this->input->post('province'),$this->input->post('municipality'),$this->input->post('street'));
			redirect(base_url('index.php/dashboard/add_disaster_entry'));
		}




			}else{
				$this->session->set_flashdata('not-logged','You must signed-in to access this page');
				redirect(base_url('index.php/dashboard/index'));
		}	
	}


	public function home(){
			if($this->session->userdata('admin_username')!=''){

			$this->data['page_title'] = "iVolunteer &raquo; Dashboard Home";
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


	public function reliefoperation(){

			if($this->session->userdata('admin_username')!=''){

			$this->form_validation->set_rules('dis_type','Disaster Type','trim|required');
			$this->form_validation->set_rules('loc','Location','trim|required');
			$this->form_validation->set_rules('org_by','Organizer','trim|required|min_length[6]|max_length[30]');

			if($this->form_validation->run()==FALSE){
			$this->data['page_title'] = "iVolunteer - New Relief Operation &raquo; Dashboard Home";
			$this->data['disaster_type']= $this->admin_model->get_disasterlists();
			$this->data['location']=$this->admin_model->get_locationlists();
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

			return true;

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
			$this->load->view('dashboard/tpl/admin_header',$this->data);
			$this->load->view('dashboard/tpl/admin_navbars');
			$this->load->view('dashboard/admin_volunteersmenu',$this->data);
			$this->load->view('dashboard/tpl/admin_footer');

		}else{
			$this->session->set_flashdata('not-logged','You must signed-in to access this page');
			redirect(base_url('index.php/dashboard/index'));
		}
	}



}
