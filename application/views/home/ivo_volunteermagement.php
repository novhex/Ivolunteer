
<div class="container" style="margin-top:70px;">
	<div class="row">
		<div class="col-md-12 well">
		<h1> Volunteer Management </h1>
		<hr>
		  <a href="<?php echo base_url('index.php/home/volunteermanagement_addvolunteer');?>" id="addvolunteer" class="btn btn-primary">Add Volunteer</a>
 
<hr>
			<div class="table-responsive"> 
					<table id="tblVolunteers" cellspacing="200">
						<thead>		
							<tr>
								<th> # </th>
								<th> Name </th>
								<th> Options </th>
							</tr>
						</thead>
						<tbody>
							<?php $i=1; foreach($volunteerlists as $volunteers){ ?>
							<tr>
							<td><?php echo $i++; ?></td>
							<td> <?php echo $volunteers['user_firstname']." ".$volunteers['user_lastname']; ?></td>
							<td><a href="#" class="btn btn-warning">Edit</a> &nbsp; <a href="#" class="btn btn-danger">Delete</a></td>
							</tr>
							<?php }?>
						</tbody>	
					</table>
			</div>

		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
			$("#tblVolunteers").DataTable();
 

	});

</script>