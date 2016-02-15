<div class="col-md-12"><center><img src="<?php echo base_url('img/logo.jpg');?>"></center></div>
 

<!-- end modal !-->

<div id="modalReAssign" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Re Assign Volunteer</h4>
      </div>
      <div class="modal-body">
     <label>Select Organization</label>
       <input type="hidden" id="volunteer_id" name="volunteer_id" />
     <select name="orglist" id="orglist" class="form-control">
   
     <option value="">-SELECT-</option>
     	<?php foreach($organizations as $orgs):?>
     	<option value="<?php echo $orgs['org_id'];?>"><?php echo $orgs['org_name']; ?></option>
     	<?php endforeach; ?>
     </select>
     <br>
     <button type="button" id="btn_move_volunteer" class="btn btn-primary"> Re Assign </button>
      </div>
      <div class="modal-footer">
     
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>

          
    </div>

  </div>
</div>

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
								<th> Options </th>
								

							</tr>
						</thead>
						<tbody>
							<?php $i=1; foreach($volunteerlists as $volunteers){ ?>
							<tr>
							<td><?php echo $i++; ?></td>
							<td> <?php echo $volunteers['user_firstname']." ".$volunteers['user_lastname']; ?></td>
							<td><?php echo $volunteers['org_name'];?></td>
							<td> <?php echo $volunteers['member_date']; ?></td>
							<td>
							<a href="#" class="reassign" data-id="<?php echo $volunteers['user_id']; ?>" data-toggle="modal" data-target="#modalReAssign">Re-Assign to org</a> | <a href="<?php echo base_url('index.php/dashboard/editprofile').'/'.$volunteers['user_id']; ?>">Edit Profile</a>

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
		

		$("#btn_logout").click(function(){

					bootbox.confirm("Are you sure you want to log-out?",function(answer){
						if(answer==true){
							window.location = "<?php echo base_url('index.php/dashboard/logout'); ?>";
						}
					});

		});

		$(document).on('click','.reassign',function(){
			$("#volunteer_id").val(this.dataset.id);
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

		$("#btn_move_volunteer").click(function(){
				if($("#orglist").val()!==''){

					$.ajax({
						url: "<?php echo base_url('index.php/dashboard/reassignvolunteer'); ?>",
						data: "vol_id="+$("#volunteer_id").val()+"&neworg="+$("#orglist").val(),
						type: "POST",
						success:function(res){
							if(res==1){
								window.location="<?php echo base_url('index.php/dashboard/volunteers');?>"
							}
						}
					});
				}else{
					bootbox.alert('Please select an Organization');
				}
		});
	});

</script>