<div class="container" style="margin-top:70px;">
	<div class="row">
		<div class="col-md-12">
				<div class="well">
			
				<h1>My Donations</h1>
				<hr> 
						<div class="table-responsive">
						<table id="tbl_mdonations">
							<thead>
								<tr>
								<th> # </th>
								<th> Amount </th>
								<th> Recipient Organization </th>
								<th> Date Given </th>
								<th> Disaster Type </th>
								</tr>
								<tbody>
									<?php $i=1; foreach($donations as $donation_arr):?>
									<tr>
									<td><?php echo $i++; ?></td>
									<td><?php echo $donation_arr['donation']; ?></td>
									<td><?php echo $donation_arr['org_name']; ?></td>
									<td><?php echo date('F  j, Y',strtotime( $donation_arr['date_given'])); ?></td>
									<td><?php echo $donation_arr['type']; ?></td>
									</tr>
									<?php endforeach; ?>
								</tbody>
							</thead>
						</table>
						</div>
				</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	
		$(document).ready(function(){
		$("#tbl_mdonations").DataTable();

		<?php if($this->session->flashdata('donation_ok')!=''){?>
			bootbox.alert("You have successfully donated in an Organization");
		<?php }?>

	
	});

</script>