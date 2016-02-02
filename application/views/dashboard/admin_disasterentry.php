<div class="container" style="margin-top:70px;">

<div class="row">

		<div class="col-md-12">
				<div class="well">
				<h1> New Disaster Category </h1>
				<?php
					if(validation_errors()!=''){
						echo "<div class='alert alert-warning'>".validation_errors()."</div>";
					}
				?>
				<form method="POST" accept-charset="utf-8" action="">
					<label>Enter Disaster Category</label>
					<input type="text" name="disaster_type" value="<?php echo set_value('disaster_type');?>" class="form-control" />
					





					<br>
					<button name="submitDisaster" class="btn btn-success"><i class="fa fa-plus"></i> Add Disaster Category</button>
				</form>
				<hr>
				<h1> Disaster Category Lists</h1>

						<div class="table-responsive">
				<table id="tbl_disasterlist">
					<thead>
						<tr>
							<th> # </th>
							<th> Disaster ID </th>
							<th> Disaster Type </th>
						</tr>
					</thead>
					<tbody>
					<?php $i=1; foreach($disaster_lists  as $disaster_info):?>
						<tr>
						<td><?php echo $i++;?></td>
						<td><?php echo $disaster_info['disaster_type_id'];?></td>
						<td><?php echo $disaster_info['type'];?></td>
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
			$("#tbl_disasterlist").DataTable();

		});

</script>