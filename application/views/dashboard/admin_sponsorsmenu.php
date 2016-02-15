<div class="col-md-12"><center><img src="<?php echo base_url('img/logo.jpg');?>"></center></div>
 
<div class="container" style="margin-top:70px;">
<div class="row">
	<div class="col-md-12 well">
		<h1> Sponsor Menu </h1>
		<button class="btn btn-success btn-lg" id="btnSponsors"><i class="fa fa-print"></i> Print Sponsors</button>
		<hr>
	
		<div class="table-responsive">
					<table id="tblVolunteers" cellspacing="200">
						<thead>		
							<tr>
								<th> # </th>
								
								<th> Name </th>
								<th> Email </th>
								<th> Profession </th>
								<th> Contact No. </th>
								<th> Options </th>
								
								

							</tr>
						</thead>
						<tbody>
							<?php $i=1; foreach($sponsorlists as $sponsors){ ?>
							<tr>
							<td><?php echo $i++; ?></td>
						
							<td> <?php echo $sponsors['user_firstname']." ".$sponsors['user_lastname']; ?></td>
							
								<td><?php echo $sponsors['user_email_add'];?></td>

								<td><?php echo $sponsors['user_profession'];?></td>


									<td><?php echo $sponsors['user_contact_no'];?></td>

									<td><a href="<?php echo base_url('index.php/dashboard/editprofile').'/'.$sponsors['user_id']; ?>">Edit Profile</a>
</td>
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
		


		$(document).on('click','.btn_edit',function(){
			console.log('edit btn clicked!');
		});

		$("#btnSponsors").click(function(){
			window.location = "<?php echo base_url('index.php/reports/sponsor_report');?>";
		});

		$(document).on('click','.btn_delete',function(){
			console.log('delete btn clicked!');
		});

		$(document).on('click','.btn_view',function(){
			console.log('view btn clicked!');
		});
	});

</script>