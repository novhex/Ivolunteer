<div class="col-md-12"><center><img src="<?php echo base_url('img/logo.jpg');?>"></center></div>
 

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
			<select name="loc" id="loc" class="form-control">
			<option value="">SELECT LOCATION</option>
			<?php foreach($location as $loc): ?>
				<option value="<?php echo $loc['location_id'];?>"><?php echo $loc['street']." , ".$loc['municipality']."".$loc['province'] ;?></option>
			<?php endforeach; ?>
			</select>

			
			<label>Organized By</label>
			<select name="org_by" id="org_by" class="form-control">
				<option value=""></option>
				<?php foreach($volunteerlists as $volunteers): ?>
				<option value="<?php echo $volunteers['user_firstname']." ".$volunteers['user_lastname']; ?>"><?php echo $volunteers['user_firstname']." ".$volunteers['user_lastname']; ?></option>
				<?php endforeach; ?>
			</select>

			<br>
			<button type="submit" id="btnSubmitRelief" name="btnSubmitRelief" class="btn btn-success"><i class="fa fa-life-saver"></i> Save</button>
</form>
<h1> Relief Operations </h1>
<button class="btn btn-success btn-lg" id="btnReliefOp"><i class="fa fa-print"></i> Print Relief Operations</button>
<button class="btn btn-success btn-lg" id="btnLoc"><i class="fa fa-print"></i> Print Locations</button>
<hr>
		<div class="table-responsive">
		<table id="tbl_reliefs">
				<thead>
					<tr>
					<th> # </th>
					<th> Disaster Type </th>
					<th> Location </th>
					<th> Organized by </th>
					</tr>
				</thead>
				<tbody>
					<?php $i=1; foreach($relief_op as $rop): ?>
						<tr>
						<td><?php echo $i++;?></td>
						<td><?php echo $rop['type']; ?></td>
						<td><?php echo $rop['province']." ".$rop['municipality']." ".$rop['street'];?></td>
						<td><?php echo $rop['organized_by']; ?></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
		</table>

		</div>

			</div>
		</div>

	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$("#tbl_reliefs").DataTable();
	});

	$("#btnReliefOp").click(function(){
		window.location ="<?php echo base_url('index.php/reports/relief_operations'); ?>";
	});

	$("#btnLoc").click(function(){
		window.location="<?php echo base_url('index.php/reports/locations_rescued');?>";
	});
</script>