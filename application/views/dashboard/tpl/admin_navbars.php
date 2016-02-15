    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><img style="max-width:150px; margin-top: -20px" src="<?php echo base_url('img/logo.jpg');?>"></a>
        </div>
        <div id="navbar" class="collapse navbar-collapse navbar-right">


          <ul class="nav navbar-nav">

            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-list"></i> Menu <span class="caret"></span></a>
                <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url('index.php/dashboard/home');?>"><i class="fa fa-home"></i> Dashboard Home</a></li>


                  <li><a href="<?php echo base_url('index.php/dashboard/volunteers'); ?>"><i class="fa fa-user"></i> Volunteer Lists</a></li>
                  <li><a href="<?php echo base_url('index.php/dashboard/sponsors'); ?>"><i class="fa fa-user"></i> Sponsor Lists</a></li>
                  
                  <li><a href="<?php echo base_url('index.php/dashboard/organizations'); ?>"><i class="fa fa-users"></i> Organization Lists</a></li>
             
                  <li><a href="<?php echo base_url('index.php/dashboard/donationlist');?>"><i class="fa fa-money"></i> Donations</a></li>
                  <li><a href="<?php echo base_url('index.php/dashboard/addlocation');?>"><i class="fa fa-location-arrow"></i> Locations</a></li>
                 <li><a href="<?php echo base_url('index.php/dashboard/add_disaster_entry');?>"><i class="fa fa-flash"></i> Disaster Entry</a></li>
                 <li><a href="<?php echo base_url('index.php/dashboard/reliefoperation');?>"><i class="fa fa-life-saver"></i> New Relief Operation</a></li>
                 <li><a href="<?php echo base_url('index.php/dashboard/disasterteam');?>"><i class="fa fa-group"></i> Disaster Team</a></li>
           

            
              

          </ul>
                      <li><a href="#" id="btn_logout"><i class="fa fa-unlock"></i> Log-out <?php echo $this->session->userdata('admin_username');?></a></li>

        </div><!--/.nav-collapse -->
      </div>
    </nav>
