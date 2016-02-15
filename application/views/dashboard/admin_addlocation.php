<div class="col-md-12"><center><img src="<?php echo base_url('img/logo.jpg');?>"></center></div>
 

<div class="container" style="margin-top:70px;">

<div class="row">


		<div class="col-md-12">
			
			<div class="well">
			<h1> Add new location </h1>
			<hr>
			<?php
			if(validation_errors()!=''){
				echo "<div class='alert alert-warning'>".validation_errors()."</div>";
			}
			?>
			<form method="POST" accept-charset="utf-8" action="">


			<label>Location</label>
			<input type="text" name="loc" id="loc" class="form-control" value="<?php echo set_value('loc'); ?>">

			<label>Municipality</label>
			<input type="text" name="mun" id="mun" class="form-control" value="<?php echo set_value('mun'); ?>">

			<label>Street</label>
			<input type="text" name="street" id="street" class="form-control" value="<?php echo set_value('street'); ?>">

			<br>
			<button type="submit" id="btnSubmitRelief" name="btnSubmitRelief" class="btn btn-success"><i class="fa fa-life-saver"></i> Save</button>
</form>
<h1> Locations </h1>

<hr>
		<div class="table-responsive">
		<table id="tbl_loc">
				<thead>
					<tr>
					<th> # </th>
					<th> Location </th>
					<th> Municipality </th>
					<th> Street </th>
					</tr>
				</thead>
				<tbody>
				<?php $i=1; foreach($locations as $loc): ?>
				<tr>
				<td><?php echo $i++;?></td>
				<td><?php echo $loc['province']; ?></td>
				<td><?php echo $loc['municipality']; ?></td>
				<td><?php echo $loc['street']; ?></td>
				</tr>
			<?php endforeach;?>
				</tbody>
		</table>

		</div>

			</div>
		</div>

	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$("#tbl_loc").DataTable();
	});

	
		
</script>