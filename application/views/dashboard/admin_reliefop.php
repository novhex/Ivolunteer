<div class="container" style="margin-top:70px;">

<div class="row">
		<div class="col-md-12">
			<div class="well">
			<h1> New Relief Operation</h1>
			<hr>
			<?php
			if(validation_errors()!=''){
				echo "<div class='alert alert-warning'>".validation_errors()."</div>";
			}
			?>
			<form method="POST" accept-charset="utf-8" action="">
			<label>Disaster Type</label>
			<select name="dis_type" class="form-control">
				<option value="">-Select-</option>
				<?php foreach($disaster_type as $disastertype):?>
				<option value="<?php echo $disastertype['disaster_type_id'];?>"><?php echo $disastertype['type']?></option>
			<?php endforeach;?>
			</select>

			<label>Location</label>
			<select name="loc" class="form-control">
				<option value="">-Select-</option>
				<?php foreach($location as $loc):?>
				<option value="<?php echo $loc['location_id'];?>"><?php echo $loc['province']." | ". $loc['municipality']." | ".$loc['street']?></option>
				<?php endforeach;?>
			</select>
			<label>Organized By</label>
			<input type="text" name="org_by" id="org_by" class="form-control" value="<?php echo set_value('org_by');?>" />

			<br>
			<button type="submit" id="btnSubmitRelief" name="btnSubmitRelief" class="btn btn-success"><i class="fa fa-life-saver"></i> Save</button>
</form>

			</div>
		</div>

	</div>
</div>