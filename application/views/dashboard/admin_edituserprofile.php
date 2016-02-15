<div class="col-md-12"><center><img src="<?php echo base_url('img/logo.jpg');?>"></center></div>
  
<div class="container" style="margin-top:50px;">
	<div class="row">
  <div class="col-md-4"></div>
		<div class="col-md-4 well" id="register">
        <h3 style="text-align:center;"><i class="fa fa-user"></i> Edit Profile</h3>
      
       <form action="" method="POST" accept-charset="utf-8">


    <?php foreach($profile as $userinfo):?>

      		
      <label><?php echo form_error('txtfname'); ?></label>
        <input value="<?php echo $userinfo['user_firstname'];?>" type="text" name="txtfname" id="txtfname" class="form-control" value="<?php ?>" placeholder="Firstname"/>

      <label><?php echo form_error('txtlname'); ?></label>
        <input type="text" name="txtlname" id="txtlname" class="form-control" value="<?php echo $userinfo['user_lastname']; ?>" placeholder="Lastname"/>


        <label><?php echo form_error('txtcontact'); ?></label>
          <input type="text" name="txtcontact" id="txtcontact" class="form-control" value="<?php echo $userinfo['user_contact_no']; ?>" placeholder="Contact No."/>
        <label><?php echo form_error('txtemail'); ?></label>

          <input value="<?php echo $userinfo['user_email_add']; ?>" type="email" name="txtemail" id="txtemail" class="form-control" value="<?php ?>" placeholder="Email"/>

          <?php foreach($account as $settings): ?>
          <label><?php form_error('txtuser'); ?></label>
          <input type="text" name="txtuser" class="form-control" value="<?php echo $settings['user_username']; ?>" />
        <?php endforeach;?>
          <label><?php echo form_error('txtpassword'); ?></label>
        <input type="password" name="txtpassword" class="form-control" value="<?php echo set_value('txtpassword')?>" placeholder="NEW PASSWORD (THIS FIELD IS OPTIONAL)" />

             <label><?php echo form_error('txtpasswordcf'); ?></label>
        <input type="password" name="txtpasswordcf" class="form-control" value="" placeholder="RETYPE NEW PASSWORD (THIS FIELD IS OPTIONAL)" />

<?php endforeach; ?>

      <hr>
      <button type="submit" class="btn btn-primary btn-large" id="btn_reg" name="btn_reg"><i class="fa fa-user"></i> Update Profile</button>
    </form>
    </div>
    <div class="col-md-4"></div>

</div>
</div>


<script type="text/javascript">
  $(document).ready(function() {
    // body...
       

       


$("#txtAge").click(function(){


        var currentTime = new Date();
        var month = currentTime.getMonth() + 1;
        var day = currentTime.getDate();
        var year = currentTime.getFullYear();
        var completedate = year + "/" + month + "/" + day;

        var current_year = completedate.substring(0,4);
        var birthdate = $("#txtbirth").val().substring(0,4);

        var age;

        age = (parseInt(current_year)-parseInt(birthdate));

        $(this).val(age);


});

  })

</script>
