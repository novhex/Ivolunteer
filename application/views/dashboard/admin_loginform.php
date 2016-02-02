<div class="container" style="margin-top:70px;">
	<div class="row">
	<div class="col-md-4"></div>
		<div class="col-md-4">
				<div class="well">
					<h1> Admin Login </h1>
					<hr>
					<?php
						if($this->session->userdata('auth-error')!=''){
							echo "<div class='alert alert-danger'>".$this->session->userdata('auth-error')."</div>";
						}

						if($this->session->userdata('not-logged')!=''){
							echo "<div class='alert alert-danger'>".$this->session->userdata('not-logged')."</div>";
						}

						if($this->session->userdata('logged-out')!=''){
							echo "<div class='alert alert-info'>".$this->session->userdata('logged-out')."</div>";
						}
							
					?>
					<form action="" method="POST" accept-charset="utf-8">
					<label><?php echo form_error('txtAdminuser');?></label>
					<input placeholder="Username" type="text" name="txtAdminuser" id="txtAdminuser" value="" required class="form-control" />
					<label><?php echo form_error('txtAdminpass');?></label>
					<input placeholder="Password" type="password" name="txtAdminpass" id="txtAdminpass" value="" required  class="form-control" />
					<br>
					<button type="submit" id="btnLogin" name="btnLogin" class="btn btn-success"><i class="fa fa-key"></i> Login</button>
					<br>
					<br>
					<a href="<?php echo base_url(); ?>" style="text-align:center;">&larr; Back to main page.</a>
				</form>
				</div>
		</div>
		<div class="col-md-4"></div>
	</div>
</div>