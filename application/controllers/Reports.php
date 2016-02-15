<?php

defined('BASEPATH') or exit('Error!');

class Reports extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->library(array('fpdf','session'));
		$this->load->model('admin_model');
	}

	public function index(){

	}

	public function donations_report(){

				//echo "<title> Organization Report PDF </title>";
		if($this->session->userdata('admin_username')!=''){
		$i=1;
		$header = array('Sponsor ID','Sponsor  Name','Amount','Date Given','Recipient Organization','Disaster Type');
		$w = array(40, 35, 40, 45);

			$lists  = $this->admin_model->getDonations();

			
				$this->fpdf->SetFont('Arial','',10);
				$this->fpdf->SetLineWidth(.1);
				$this->fpdf->AddPage();
					

			    $this->fpdf->Cell(80);
			   
			    $this->fpdf->Cell(15,10,'Donation Lists',0,0,'C');
			   
			    $this->fpdf->Ln(20);
			    $this->fpdf->Cell(30,7,$header[0],1);
				$this->fpdf->Cell(30,7,$header[1],1);
				$this->fpdf->Cell(30,7,$header[2],1);
				$this->fpdf->Cell(30,7,$header[3],1);
				$this->fpdf->Cell(40,7,$header[4],1);
				$this->fpdf->Cell(30,7,$header[5],1);
				
		
				$this->fpdf->Ln();
			


				foreach($lists as $data){
					
					
					$this->fpdf->Cell(30,7,$data['sponsor_id'],1);
					$this->fpdf->Cell(30,7,$data['user_firstname']." ".$data['user_lastname'],1);
					$this->fpdf->Cell(30,7,$data['donation'],1);
					$this->fpdf->Cell(30,7,$data['date_given'],1);
					$this->fpdf->Cell(40,7,$data['org_name'],1);
					$this->fpdf->Cell(30,7,$data['type'],1);
					
					$this->fpdf->Ln();
				}


				$this->fpdf->Output();
	}
	else{
		echo "Access Denied!";
	}

	}

	public function locations_rescued(){

		//get_locationlists

		if($this->session->userdata('admin_username')!=''){
		$i=1;
			$header=array('#','Province','Municipality','Street');
			$w = array(40, 35, 40, 45);

			$lists=$this->admin_model->get_locationlists();


			$this->fpdf->SetFont('Arial','',10);
				$this->fpdf->SetLineWidth(.1);
				$this->fpdf->AddPage();
					

			    $this->fpdf->Cell(80);
			   
			    $this->fpdf->Cell(15,10,'Locations Rescued',0,0,'C');
			   
			    $this->fpdf->Ln(20);
			    $this->fpdf->Cell(10,7,$header[0],1);
				$this->fpdf->Cell(60,7,$header[1],1);
				$this->fpdf->Cell(60,7,$header[2],1);
				$this->fpdf->Cell(60,7,$header[3],1);
				
				
		
				$this->fpdf->Ln();
			


				foreach($lists as $data){
					
					$this->fpdf->Cell(10,7,$i++,1);
					$this->fpdf->Cell(60,7,$data['province'],1);
					$this->fpdf->Cell(60,7,$data['municipality'],1);
					$this->fpdf->Cell(60,7,$data['street'],1);
					$this->fpdf->Ln();
				}


				$this->fpdf->Output();


		}

	}

	public function org_report(){
		//echo "<title> Organization Report PDF </title>";
		if($this->session->userdata('admin_username')!=''){
		$i=1;
		$header = array('#','Organization Name','In charge','Contact #','Email Address');
		$w = array(40, 35, 40, 45);

			$lists  = $this->admin_model->organizationlists();

			
				$this->fpdf->SetFont('Arial','',10);
				$this->fpdf->SetLineWidth(.1);
				$this->fpdf->AddPage();
					

			    $this->fpdf->Cell(80);
			   
			    $this->fpdf->Cell(15,10,'Organization Lists',0,0,'C');
			   
			    $this->fpdf->Ln(20);
			    $this->fpdf->Cell(10,7,$header[0],1);
				$this->fpdf->Cell(40,7,$header[1],1);
				$this->fpdf->Cell(40,7,$header[2],1);
				$this->fpdf->Cell(40,7,$header[3],1);
				$this->fpdf->Cell(59,7,$header[4],1);
				
		
				$this->fpdf->Ln();
			


				foreach($lists as $data){
					
					$this->fpdf->Cell(10,7,$i++,1);
					$this->fpdf->Cell(40,7,$data['org_name'],1);
					$this->fpdf->Cell(40,7,$data['org_incharge'],1);
					$this->fpdf->Cell(40,7,$data['org_contactno'],1);
					$this->fpdf->Cell(59,7,$data['org_email'],1);
					$this->fpdf->Ln();
				}


				$this->fpdf->Output();
	}
	else{
		echo "Access Denied!";
	}
}


	public function relief_operations(){
		if($this->session->userdata('admin_username')!=''){
			$i=1;
			$header = array("#","Disaster Type","Location","Organizer");

			$lists = $this->admin_model->reliefoperations();

							$this->fpdf->SetFont('Arial','',10);
				$this->fpdf->SetLineWidth(.1);
				$this->fpdf->AddPage();
					

			    $this->fpdf->Cell(80);
			   
			    $this->fpdf->Cell(15,10,'Location Rescued',0,0,'C');
			   
			    $this->fpdf->Ln(20);
			    $this->fpdf->Cell(10,7,$header[0],1);
				$this->fpdf->Cell(60,7,$header[1],1);
				$this->fpdf->Cell(60,7,$header[2],1);
				$this->fpdf->Cell(60,7,$header[3],1);
				
				
				
		
				$this->fpdf->Ln();
			


				foreach($lists as $data){
					
					$this->fpdf->Cell(10,7,$i++,1);
					$this->fpdf->Cell(60,7,$data['type'],1);
					$this->fpdf->Cell(60,7,$data['province'],1);
					$this->fpdf->Cell(60,7,$data['organized_by'],1);
					
					$this->fpdf->Ln();
				}


				$this->fpdf->Output();

		}else{
			echo "Access denied";
		}
	}


	public function sponsor_report(){

		//sponsorslists()

				if($this->session->userdata('admin_username')!=''){
		$i=1;
		$header = array('#','Name','Email','Profession','Contact #');
		$w = array(40, 35, 40, 45);

			$lists  = $this->admin_model->sponsorslists();

			
				$this->fpdf->SetFont('Arial','',10);
				$this->fpdf->SetLineWidth(.1);
				$this->fpdf->AddPage();
					

			    $this->fpdf->Cell(80);
			   
			    $this->fpdf->Cell(15,10,'Sponsor Lists',0,0,'C');
			   
			    $this->fpdf->Ln(20);
			    $this->fpdf->Cell(10,7,$header[0],1);
				$this->fpdf->Cell(40,7,$header[1],1);
				$this->fpdf->Cell(40,7,$header[2],1);
				$this->fpdf->Cell(40,7,$header[3],1);
				$this->fpdf->Cell(59,7,$header[4],1);
				
		
				$this->fpdf->Ln();
			


				foreach($lists as $data){
					
					$this->fpdf->Cell(10,7,$i++,1);
					$this->fpdf->Cell(40,7,$data['user_firstname']." ".$data['user_lastname'],1);
					$this->fpdf->Cell(40,7,$data['user_email_add'],1);
					$this->fpdf->Cell(40,7,$data['user_profession'],1);
					$this->fpdf->Cell(59,7,$data['user_contact_no'],1);
					$this->fpdf->Ln();
				}


				$this->fpdf->Output();
	}
	else{
		echo "Access Denied!";
	}

	}

	public function volunteer_report(){
		//echo "<title> Organization Report PDF </title>";
		if($this->session->userdata('admin_username')!=''){

		$i=1;
		$header = array('#','Name','Organization Joined','Join Date');
		$w = array(40, 35, 40, 45);

			$lists  = $this->admin_model->volunteerlists();

			
				$this->fpdf->SetFont('Arial','',10);
				$this->fpdf->SetLineWidth(.1);
				$this->fpdf->AddPage();
					

			    $this->fpdf->Cell(80);
			   
			    $this->fpdf->Cell(15,10,'Volunteeer Lists',0,0,'C');
			   
			    $this->fpdf->Ln(20);

				$this->fpdf->Cell(35,7,$header[0],1);
				$this->fpdf->Cell(50,7,$header[1],1);
				$this->fpdf->Cell(50,7,$header[2],1);
				$this->fpdf->Cell(59,7,$header[3],1);
				
		
				$this->fpdf->Ln();
			


				foreach($lists as $data){
					$this->fpdf->Cell(35,7,$i++,1);
					$this->fpdf->Cell(50,7,$data['user_firstname']." ".$data['user_lastname'],1);
					$this->fpdf->Cell(50,7,$data['org_name'],1);
					$this->fpdf->Cell(59,7,date("F  j, Y",strtotime($data['member_date'])),1);
					$this->fpdf->Ln();
				}


				$this->fpdf->Output();
	}
	else{
		echo "Access Denied!";
	}
}

		public function team_report(){
			if($this->session->userdata('admin_username')!=''){


		$i=1;
		$header = array('#','Team Name');
		$w = array(40, 35, 40, 45);

			$lists  = $this->admin_model->get_disasterteam();

			
				$this->fpdf->SetFont('Arial','',10);
				$this->fpdf->SetLineWidth(.1);
				$this->fpdf->AddPage();
					

			    $this->fpdf->Cell(80);
			   
			    $this->fpdf->Cell(15,10,'Team Lists',0,0,'C');
			   
			    $this->fpdf->Ln(20);

				$this->fpdf->Cell(10,7,$header[0],1);
				$this->fpdf->Cell(80,7,$header[1],1);
				
				
		
				$this->fpdf->Ln();
			


				foreach($lists as $data){
					$this->fpdf->Cell(10,7,$i++,1);
					$this->fpdf->Cell(80,7,$data['team_name'],1);
					
					$this->fpdf->Ln();
				}


				$this->fpdf->Output();



			}else{
				echo "Access Denied";
			}

		}
	public function org_member_report($orgId){

				if($this->session->userdata('admin_username')!=''){

		$i=1;
		$header = array('#','Name','Last Name','Organization Joined','Join Date');
		$w = array(40, 35, 40, 45);

				$list1= $this->admin_model->viewOrganizationFullInfo($orgId);
				$list2 = $this->admin_model->viewOrgMembers($orgId);

			
				$this->fpdf->SetFont('Arial','',10);
				$this->fpdf->SetLineWidth(.1);
				$this->fpdf->AddPage();
					

			    $this->fpdf->Cell(80);
			   
			    $this->fpdf->Cell(15,10,$list1[0]['org_name']." Members",0,0,'C');
			   
			    $this->fpdf->Ln(20);

				$this->fpdf->Cell(10,7,$header[0],1);
				$this->fpdf->Cell(90,7,$header[1],1);
				$this->fpdf->Cell(90,7,$header[2],1);
				
				
		
				$this->fpdf->Ln();
			


				foreach($list2 as $data){
					$this->fpdf->Cell(10,7,$i++,1);
					$this->fpdf->Cell(90,7,$data['user_firstname'],1);
					$this->fpdf->Cell(90,7,$data['user_lastname'],1);
				
					$this->fpdf->Ln();
				}


				$this->fpdf->Output();
	}
	else{
		echo "Access Denied!";
	}


	}

}