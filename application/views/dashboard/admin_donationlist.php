<?php

?>
<div class="col-md-12"><center><img src="<?php echo base_url('img/logo.jpg');?>"></center></div>
 
<div class="container" style="margin-top:70px;">
	<div class="col-md-12">
	<div class="well">
	<h1> Donations </h1>
	
	<button type="button"  class="btn btn-success btn-lg" id="btnprint_donations"><i class="fa fa-print"></i> Print Donations</button>
	<hr>
	<table id="tbl_donations">
		<thead>
		<tr>
			<th> Sponsor ID </th>
			<th> Sponsor Name </th>
			<th> Amount </th>
			<th> Date Given </th>
			<th> Recipient Organization </th>
			<th> Disaster Type</th>
		</tr>
		</thead>
		<tbody>
			<?php foreach($donations  as $donation_arr):?>
				<tr>
				<td><?php echo $donation_arr['sponsor_id'];?></td>
				<td><?php echo $donation_arr['user_firstname']." ".$donation_arr['user_lastname'];?></td>
				<td><?php echo $donation_arr['donation'];?></td>
				<td><?php echo $donation_arr['date_given'];?></td>
				<td><?php echo $donation_arr['org_name'];?></td>
				<td><?php echo $donation_arr['type']; ?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$("#tbl_donations").DataTable();

		$("#btnprint_donations").click(function(){
			window.location = "<?php echo base_url('index.php/reports/donations_report'); ?>";
		});
	});
</script>