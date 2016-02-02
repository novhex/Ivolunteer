    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">iVolunteer</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse navbar-right">
          <ul class="nav navbar-nav">
            <li><a href="<?php echo base_url('index.php/dashboard/home');?>"><i class="fa fa-home"></i> Dashboard Home</a></li>


                  <li><a href="<?php echo base_url('index.php/dashboard/volunteers'); ?>"><i class="fa fa-user"></i> Volunteer Lists</a></li>
                  <li><a href="<?php echo base_url('index.php/dashboard/sponsors'); ?>"><i class="fa fa-money"></i> Sponsor Lists</a></li>
                  
                  <li><a href="<?php echo base_url('index.php/dashboard/organizations'); ?>"><i class="fa fa-users"></i> Organization Lists</a></li>
             

         
                 <li><a href="<?php echo base_url('index.php/dashboard/add_disaster_entry');?>"><i class="fa fa-flash"></i> Disaster Entry</a></li>
                 <li><a href="<?php echo base_url('index.php/dashboard/reliefoperation')?>"><i class="fa fa-life-saver"></i> New Relief Operation</a></li>
                 <li><a href="#"><i class="fa fa-group"></i> Disaster Team</a></li>
           

            <li><a href="#" id="btn_logout"><i class="fa fa-unlock"></i> Log-out <?php echo $this->session->userdata('admin_username');?></a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
