<div class="container" style="margin-top:50px;">

	<div class="row">
			<div class="col-md-12 well">
				<h1> Register an Organization </h1>
				<form action="" method="POST" accept-charset="utf-8">
				<label><?php echo form_error('txtOrgname'); ?></label>
				<input type="text" name="txtOrgname" id="txtOrgname" value="<?php echo set_value('txtOrgname'); ?>" placeholder="Organization Name" required class="form-control" />
					<label><?php echo form_error('txtOrg_incharge'); ?></label>
				<input type="text" name="txtOrg_incharge" id="txtOrg_incharge" placeholder="In charge name"  value="<?php echo set_value('txtOrg_incharge');?>" required class="form-control" />
					<label><?php echo form_error('txtOrg_email'); ?></label>
				<input type="email" name="txtOrg_email" id="txtOrg_email" placeholder="Organization Email" value="<?php echo set_value('txtOrg_email');?>" required class="form-control" />
					<label><?php echo form_error('txtOrg_contact'); ?></label>
				<input type="text" name="txtOrg_contact" id="txtOrg_contact" placeholder="Organization Contact #" value="<?php echo set_value('txtOrg_contact');?>" required class="form-control" />
				<hr>
				<button class="btn btn-primary" id="btnregorg" name="btnregorg" type="submit"><i class="fa fa-building"></i> Register Organization </button>
				</form>

			</div>
	</div>

</div>


<script type="text/javascript">
 <?php if($this->session->flashdata('success_org_reg')!=''){?>
 	bootbox.alert('Registration Succeded');
 <?php }?>
</script>