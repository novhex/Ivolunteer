
<div class="container" style="margin-top:70px;">
<div class="row">
	<div class="col-md-12 well">
		<h1> Volunteer Menu </h1>
		<button class="btn btn-success btn-lg" id="btnPrintVolunteers"><i class="fa fa-print"></i> Print Volunteer Lists</button>
		<hr>
	
		<div class="table-responsive">
					<table id="tblVolunteers" cellspacing="200">
						<thead>		
							<tr>
								<th> # </th>
								
								<th> Name </th>
								<th> Organization Joined </th>
								<th> Date Joined</th>
								

							</tr>
						</thead>
						<tbody>
							<?php $i=1; foreach($volunteerlists as $volunteers){ ?>
							<tr>
							<td><?php echo $i++; ?></td>
							<td> <?php echo $volunteers['user_firstname']." ".$volunteers['user_lastname']; ?></td>
							<td><?php echo $volunteers['org_name'];?></td>
							<td> <?php echo $volunteers['member_date']; ?></td>
							
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
		

		$("#btn_logout").click(function(){

					bootbox.confirm("Are you sure you want to log-out?",function(answer){
						if(answer==true){
							window.location = "<?php echo base_url('index.php/dashboard/logout'); ?>";
						}
					});

		});

		$("#btnPrintVolunteers").click(function(){
			window.location="<?php echo base_url('index.php/reports/volunteer_report');?>";
		});

		$(document).on('click','.btn_edit',function(){
			console.log('edit btn clicked!');
		});

		$(document).on('click','.btn_delete',function(){
			console.log('delete btn clicked!');
		});

		$(document).on('click','.btn_view',function(){
			console.log('view btn clicked!');
		});
	});

</script>