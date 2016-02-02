 
      <div class="jumbotron">
          <h1 style="text-align:center;"><i class="fa fa-search"></i> We're searching for volunteers </h1>
      </div>
<div class="container" style="margin-top:50px;">
	<div class="row">
  <div class="col-md-4"></div>
		<div class="col-md-4 well" id="register">
        <h3 style="text-align:center;"> <?php echo ucfirst($type); ?> Registration Form </h3>
      
       <form action="<?php echo base_url('index.php/home/register');?>" method="POST" accept-charset="utf-8">
       <input type="hidden" name="reg_type" value="<?php echo $this->input->get('type'); ?>" />
             	 <label><?php echo form_error('txtUsername'); ?></label>   
      	<input type="text" name="txtUsername" id="txtUsername" class="form-control" value="<?php echo set_value('txtUsername');?>" placeholder="Username" />

      	 <label><?php echo form_error('txtPassword'); ?></label>   
      	<input type="password" name="txtPassword" id="txtPassword" class="form-control" value="<?php echo set_value('txtPassword');?>" placeholder="Password" />


       <label><?php echo form_error('txtPasswordcf'); ?></label>   
      	<input type="password" name="txtPasswordcf" id="txtPasswordcf" class="form-control" value="<?php echo set_value('txtPasswordcf');?>" placeholder="Confirm Password" />
      		
      <label><?php echo form_error('txtfname'); ?></label>
        <input type="text" name="txtfname" id="txtfname" class="form-control" value="<?php echo set_value('txtfname');?>" placeholder="Firstname"/>

      <label><?php echo form_error('txtlname'); ?></label>
        <input type="text" name="txtlname" id="txtlname" class="form-control" value="<?php echo set_value('txtlname');?>" placeholder="Lastname"/>

    <label><?php echo form_error('txtmidi'); ?></label>
        <input type="text" name="txtmidi" id="txtmidi" class="form-control" value="<?php echo set_value('txtmidi');?>" placeholder="Middle Initial"/>

  <label><?php echo form_error('txtbirth'); ?></label>

  <input  type="text" placeholder="YYYY/mm/dd" name="txtbirth"  id="txtbirth" class="form-control">

  <label><?php echo form_error('txtAge'); ?></label>
  <input type="text" id="txtAge" name="txtAge" class="form-control" placeholder="Age" readonly="">


    <label><?php echo form_error('civil_stat'); ?></label>

        <select name="civil_stat" id="civil_stat" class="form-control">
        <option value="">-Select Civil Status-</option>	
          <option value="single">Single</option>
          <option value="married">Married</option>
          <option value="separated">Separated</option>
        </select>

    <label><?php echo form_error('txtreligion'); ?></label>
        <input type="text" name="txtreligion" id="txtreligion" class="form-control" placeholder="Religion"/>

       <label><?php echo form_error('txtnationality'); ?></label>
          <input type="text" name="txtnationality" id="txtnationality" class="form-control" value="<?php echo set_value('txtnationality');?>" placeholder="Nationality"/>

   <label><?php echo form_error('gender'); ?></label>
        <select name="gender" id="gender" class="form-control">
          <option value="">-Select Gender-</option>
          <option value="male">Male</option>
          <option value="female">Female</option>
        </select>

        <label><?php echo form_error('txtcontact'); ?></label>
          <input type="text" name="txtcontact" id="txtcontact" class="form-control" value="<?php echo set_value('txtcontact');?>" placeholder="Contact No."/>
        <label><?php echo form_error('txtemail'); ?></label>
          <input type="email" name="txtemail" id="txtemail" class="form-control" value="<?php echo set_value('txtemail');?>" placeholder="Email"/>

        <label><?php echo form_error('txtprofession'); ?></label>
          <input type="text" name="txtprofession" id="txtprofession" class="form-control" value="<?php echo set_value('txtprofession');?>" placeholder="Profession"/>



      <hr>
      <button type="submit" class="btn btn-primary btn-large" id="btn_reg" name="btn_reg"><i class="fa fa-user"></i> Register</button>
    </form>
    </div>
    <div class="col-md-4"></div>

</div>
</div>

<script type="text/javascript">
 <?php if($this->session->flashdata('success_reg')!=''){?>
 	bootbox.alert('Registration Succeded');
 <?php }?>
</script>
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
