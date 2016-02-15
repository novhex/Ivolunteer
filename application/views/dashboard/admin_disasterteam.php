<!-- Modal -->
<div id="modalEditTeam" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Team</h4>
      </div>
      <div class="modal-body">
          <form action="<?php echo base_url('index.php/dashboard/editteam'); ?>" method="POST" accept-charset="utf-8">
            <label>Team Name</label>
            <input type="text" name="team_name_edit" id="team_name_edit" class="form-control" required>
     		<input name="teamID" id="teamID" type="text" style="display:none;" />
            <br>
             <button type="submit" name="btnsaveTeam" class="btn btn-success">Save</button>
        </form>
      </div>
      <div class="modal-footer">
     
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>

          
    </div>

  </div>
</div>
<div class="col-md-12"><center><img src="<?php echo base_url('img/logo.jpg');?>"></center></div>

	<div class="container" style="margin-top:70px;">
<div class="row">
  <div class="col-md-12">
	<div class="well">

		<h1> Add Disaster Team </h1>
			<?php
		if(validation_errors()!=''){
			echo "<div class='alert alert-warning'>".validation_errors()."</div>";
		}
	?>
		<hr>
		<form action="" method="POST" accept-charset="utf-8">
		<label>Team Name: </label>
		<input type="text" name="team_name" id="team_name" value="<?php echo set_value('team_name'); ?>" class="form-control"/>
		<br>
		<button name="btnAddTeam" id="btnAddTeam" class="btn btn-success btn-lg"> Add Disaster Team</button>
		</form>
	<hr>
		<h1>Disaster Teams</h1>

			<button class="btn btn-lg btn-success" id="btnPrintTeam"><i class="fa fa-print"></i> Print Disaster Teams</button>
	<hr>	
		<div class="table-responsive">
				<table id="tbl_teams">
				<thead>
					<tr>
					<th> # </th>
					<th> Team Name </th>
					<th> Options </th>
					</tr>
				</thead>
				<tbody>
					<?php $i=1; foreach($disasterteam as $teams): ?>
					<tr>
					<td><?php echo $i++;?></td>
					<td><?php echo $teams['team_name']; ?></td>
					<td><a  data-teamname="<?php echo $teams['team_name']; ?>" data-id="<?php echo $teams['dis_team_id'];?>" href="#" class="editteam btn btn-success"><i class="fa fa-pencil"></i> Edit</a></td>
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
		$("#tbl_teams").DataTable();

	$("#btnPrintTeam").click(function(){
		window.location="<?php echo base_url('index.php/reports/team_report'); ?>";
	});

	$(document).on('click','.editteam',function(){
		var team_id = this.dataset.id;
		var team_name = this.dataset.teamname;

		$("#team_name_edit").val(team_name);
		$("#teamID").val(team_id);

		$("#modalEditTeam").modal("show");
	});

	});
</script>