<div class="col-md-12"><center><img src="<?php echo base_url('img/logo.jpg');?>"></center></div>
 
<div class="container" style="margin-top:70px;">

<!-- Modal -->
<div id="modalEditDisaster" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"> Edit Disaster </h4>
      </div>
      <div class="modal-body">
          <form action="<?php echo base_url('index.php/dashboard/editdisaster'); ?>" method="POST" accept-charset="utf-8">
            <label>Edit Disaster Type</label>
      			<input required type="text" id="disaster_type_edit" name="disaster_type_edit" value="<?php echo set_value('disaster_type');?>" class="form-control" />
            <br>
            <input type="hidden" id="disaster_id" name="disaster_id" />
             <button type="submit" name="btnSaveOrg" class="btn btn-success">Update</button>
        </form>
      </div>
      <div class="modal-footer">
     
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>

          
    </div>

  </div>
</div>


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
							<th> Options </th>
						</tr>
					</thead>
					<tbody>
					<?php $i=1; foreach($disaster_lists  as $disaster_info):?>
						<tr>
						<td><?php echo $i++;?></td>
						<td><?php echo $disaster_info['disaster_type_id'];?></td>
						<td><?php echo $disaster_info['type'];?></td>
						<td><a  data-disastertype="<?php   echo $disaster_info['type']; ?>" data-toggle="modal" data-target="#modalEditDisaster" data-id="<?php echo $disaster_info['disaster_type_id'];?>" href="#" class="edit_disaster">Edit</a></td>
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

			$(document).on('click','.edit_disaster',function(){
				console.log(this.dataset.id);
				$("#disaster_type_edit").val(this.dataset.disastertype);
				$("#disaster_id").val(this.dataset.id);
			});
		});	

</script>