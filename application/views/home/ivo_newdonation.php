<?php
    $this->session->set_userdata('org_id',$this->uri->segment(3));
?>
<div class="container" style="margin-top:70px;">
	<div class="row">
		<div class="col-md-12">
        
        <div class="well">
        <h1> Donation Form</h1>
        <?php
        if(validation_errors()!=''){
            echo "<div class='alert alert-warning'>".validation_errors()."</div>";
        }
        ?>
        <hr>
        <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="POST" accept-charset="utf-8">

         <input type='hidden' name='business' value='sriniv_1293527277_biz@inbox.com'>
          <input type='hidden' name='cmd' value='_xclick'>
         
                    <input type='hidden' name='item_name' value='Disaster Donation'>
                    <input type='hidden' name='no_shipping' value='1'>
                    <input type='hidden' name='currency_code' value='PHP'>
                    <input type='hidden' name='handling' value='0'>
                    <input type='hidden' name='cancel_return' value='<?php echo base_url('index.php/paypal/cancelled'); ?>'>
                    <input type='hidden' name='return' value='<?php echo base_url('index.php/paypal/successdonate'); ?>'>


        <label>Donation Amount</label>
        <input type="number" name="amount" class="form-control" value="<?php echo set_value('amount');?>" />
        <label>Disaster Type</label>
        <select name="item_number" class="form-control" required>
        <option value="">-Disaster Type-</option>
        <?php foreach($disaster as $dstr): ?>
        <option value="<?php echo $dstr['disaster_type_id'];?>"><?php echo $dstr['type'];?></option>
        <?php endforeach; ?>
        </select>
        <br>
        <button type="submit" name="btnSubmitDonation" class="btn btn-success"><i class="fa fa-money"></i> Submit Donation</button>
        </form>

        </div>


        </div>
     </div>
 </div>	
 <script type="text/javascript">
$(document).ready(function(){
    
}); 
 </script>