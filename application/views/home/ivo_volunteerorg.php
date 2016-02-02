<?php
if(sizeof($org_details)!==0 && sizeof($org_members)!==0){?>

<div class="container" style="margin-top:70px;">
	<div class="row">
		<div class="col-md-12">
		<div class="well">
			<h1> Organization Info</h1>
	<hr>
	<?php if(sizeof($org_details)!==0){?>
	<p><label class="label label-info">Organization Name:</label> 	<?php echo $org_details[0]['org_name']; ?></p>
	
	<p><label class="label label-info">Organization In-Charge:</label> <?php echo $org_details[0]['org_incharge']; ?></p>

	<p><label class="label label-info">Organization Email:</label> <?php echo $org_details[0]['org_email']; ?></p>

	<p><label class="label label-info">Organization Contact #:</label> <?php echo $org_details[0]['org_contactno']; ?></p>
	<?php }?>
	<h1> Organization Members </h1>
	<hr>
			<div class="table-responsive">
			<table id="tbl_members">
				
				<thead>
				<tr>
					<th> # </th>
					<th> Name </th>
					<th> Joined Date </th>
				</tr>	
					</thead>
			
				<tbody>
					<?php 
					if(sizeof($org_members)!=0){
					$i=1; 
					foreach($org_members as $item):

					?>
					<tr>
						<td><?php echo $i++; ?> </td>
						<td><?php echo $item['user_firstname']." ".$item['user_lastname']; ?> </td>
						<td><?php echo $item['member_date']; ?> </td>
					</tr>	

				<?php endforeach; }?>

				</tbody>

			</table>
			</div>
</div>
		</div>

	</div>
</div>
<?php }else{?>

	<div class="container" style="margin-top:70px;">
		<div class="row">
			<div class="col-md-12">
			<div class="well">
			<div class="alert alert-warning">You have not joined in organization. Click <a href="<?php echo base_url("index.php/home/organizationlists");?>">here</a> to join an organization.</div>
			</div>
			</div>
		</div>
	</div>

<?php }?>
<script type="text/javascript">
	
	$(document).ready(function(){

		$("#tbl_members").DataTable();
	});
</script>