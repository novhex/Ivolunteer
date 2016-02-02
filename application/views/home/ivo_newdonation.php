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
        <form action="" method="POST" accept-charset="utf-8">
        <label>Donation Amount</label>
        <input type="number" name="amount" class="form-control" value="<?php echo set_value('amount');?>" />
        <label>Disaster Type</label>
        <select name="dis_type" class="form-control">
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