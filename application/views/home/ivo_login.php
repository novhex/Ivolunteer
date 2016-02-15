
 <div class="col-md-12"><center><img src="<?php echo base_url('img/logo.jpg');?>"></center></div>
          <h1 style="text-align:center;"><i class="fa fa-search"></i> We're searching for volunteers </h1>

<div class="container" style="margin-top:90px;">
	<div class="row">
	<div class="col-md-4"></div>
		<div class="col-md-4">
			<div class=" well">
			<h1>User Login</h1>
			<?php 
				if(validation_errors()!=''){

					echo "<div class='alert alert-warning'>".validation_errors()."</div>";
				}

				if($this->session->flashdata('auth-error')!=''){

					echo "<div class='alert alert-warning'>".$this->session->flashdata('auth-error')."</div>";
				}
				
			 ?>
		<form accept-charset="utf-8" method="POST" action="<?php echo base_url('index.php/home/login');?>">
			<label></label>
			<input placeholder="Username" type="text" name="txtUser" id="txtUser" value=""  class="form-control"/>
			<label></label>
			<input type="password" value="" name="txtPass" id="txtPass" placeholder="Password" class="form-control">
			<hr>
			<button type="submit" class="btn btn-primary" id="btnLogin" name="btnLogin"><i class="fa fa-lock"></i> Login</button>
			</form>
		</div>
		</div>
		<div class="col-md-4"></div>
	</div>
</div>
