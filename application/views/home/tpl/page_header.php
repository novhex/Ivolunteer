<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?php echo base_url('bootstrap/css/bootstrap.min.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('bootstrap/css/dataTable.css');?>" rel="stylesheet"> 
    <link href="<?php echo base_url('bootstrap/css/datepicker.css');?>" rel="stylesheet">   
    <link href="<?php echo base_url('bootstrap/font-awesome/css/font-awesome.min.css');?>" rel="stylesheet">

    <script type="text/javascript" src="<?php echo base_url('bootstrap/js/jquery.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('bootstrap/js/bootstrap.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('bootstrap/js/bootbox.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('bootstrap/js/dataTables.js');?>"></script> 
    <script type="text/javascript" src="<?php echo base_url('bootstrap/js/bootstrap-datepicker.js');?>"></script> 


	<title><?php echo $page_title; ?></title>
</head>



<body>

  <style type="text/css">
  body{
    padding-top: 50px;
  }
</style>

	    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo base_url();?>"><img style="max-width:150px; margin-top: -20px;" src="<?php echo base_url('img/logo.jpg');?>"></a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="<?php echo base_url();?>"><i class="fa fa-home"></i> Home</a></li>
           
            <?php if($this->session->userdata('userName')!='' && $this->session->userdata('userId')!='' ){?>

           <?php if($this->session->userdata('userType')=='volunteer') {?>

             <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-list"></i> Menu <span class="caret"></span></a>
                <ul class="dropdown-menu">
            <li><a href="<?php echo base_url('index.php/home/editprofile');?>"><i class="fa fa-pencil"></i> Edit Profile</a></li>
            <li><a href="<?php echo base_url('index.php/home/dashboard');?>"><i class="fa fa-dashboard"></i> My Dashboard</a></li>
             <li><a href="<?php echo base_url('index.php/home/myorganization')."/".$this->session->userdata('userId');?>"><i class="fa fa-users"></i> My Organization</a></li>
            
            <li><a href="<?php echo base_url('index.php/home/notifications'); ?>"><i class="fa fa-comment"></i> My Notifications</a></li>
               
              <li><a href="<?php echo base_url('index.php/home/logout');?>"><i class="fa fa-unlock"></i> Logout <?php echo $this->session->userdata('userName');?></a></li>
            </ul>
            <?php }?>

            <?php if($this->session->userdata('userType')=='sponsor') {?>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-list"></i> Menu <span class="caret"></span></a>
                <ul class="dropdown-menu">

             <li><a href="<?php echo base_url('index.php/home/dashboard');?>"><i class="fa fa-dashboard"></i> My Dashboard</a></li>
             <li><a href="<?php echo base_url('index.php/home/notifications'); ?>"><i class="fa fa-comment"></i> My Notifications</a></li>
              <li><a href="<?php echo base_url('index.php/home/editprofile');?>"><i class="fa fa-pencil"></i> Edit Profile</a></li>
             <li><a href="<?php echo base_url('index.php/home/donate');?>"><i class="fa fa-money"></i> Donate In An Organization</a></li>
             <li><a href="<?php echo base_url('index.php/home/mydonation');?>"><i class="fa fa-list-alt"></i> My Donations</a></li>
            

             <li><a href="<?php echo base_url('index.php/home/logout');?>"><i class="fa fa-unlock"></i> Logout <?php echo $this->session->userdata('userName');?></a></li>
            </ul>
            <?php }?>

            <?php }

            else{?>


       
              <li><a href="<?php echo base_url('index.php/home/register/');?>"><i class="fa fa-users"></i> Register</a></li>
              
         
 


         
             <li><a href="<?php echo base_url('index.php/home/login');?>"><i class="fa fa-lock"></i> Login</a></li>
             <?php }?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>