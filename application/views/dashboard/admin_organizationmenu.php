<div class="col-md-12"><center><img src="<?php echo base_url('img/logo.jpg');?>"></center></div>
 
<!-- Modal -->
<div id="modalAddOrg" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add New Organization</h4>
      </div>
      <div class="modal-body">
          <form action="<?php echo base_url('index.php/dashboard/addorg'); ?>" method="POST" accept-charset="utf-8">
            <label>Organization Name</label>
            <input type="text" name="org_name" class="form-control" required>
            <label> Organization Incharge</label>
           
            <select name="org_incharge"  class="form-control" required>
              
            <option value=""></option>
            <?php foreach($volunteerlists as $volunteer):?>
              <option value="<?php echo $volunteer['user_firstname']." ".$volunteer['user_lastname'];?>"><?php echo $volunteer['user_firstname']." ".$volunteer['user_lastname'];?></option>
          <?php endforeach;?>
            </select>

            <label>Organization Email</label>
            <input type="email" name="org_email" class="form-control" required>
            <label>Organization Contact #</label>
            <input type="text" name="org_contact" class="form-control" required>
            <br>
             <button type="submit" name="btnSaveOrg" class="btn btn-success">Save</button>
        </form>
      </div>
      <div class="modal-footer">
     
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>

          
    </div>

  </div>
</div>


<!-- Modal -->
<div id="modalEditOrg" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Organization</h4>
      </div>
      <div class="modal-body">
          <form action="<?php echo base_url('index.php/dashboard/updateorg'); ?>" method="POST" accept-charset="utf-8">
              
              <input type="text" name="orgID" id="orgID" style="display:none;" />

            <label>Organization Name</label>
            <input type="text" name="org_name_edit" id="org_name_edit" class="form-control" required>
            <label> Organization Incharge</label>
           
            <select name="org_incharge_edit"  class="form-control" required>
              
            <option value=""></option>
            <?php foreach($volunteerlists as $volunteer):?>
              <option value="<?php echo $volunteer['user_firstname']." ".$volunteer['user_lastname'];?>"><?php echo $volunteer['user_firstname']." ".$volunteer['user_lastname'];?></option>
          <?php endforeach;?>
            </select>

            <label>Organization Email</label>
            <input type="email" name="org_email_edit" id="org_email_edit" class="form-control" required>
            <label>Organization Contact #</label>
            <input type="text" name="org_contact_edit" id="org_contact_edit" class="form-control" required>
            <br>
             <button type="submit" name="btnSaveOrg" class="btn btn-success">Save</button>
        </form>
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
    <h1> Organizations </h1>
   <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#modalAddOrg"><i class="fa fa-plus"></i> Add New Organization</button>
    <button class="btn btn-success btn-lg" id="btnPrintOrg"><i class="fa fa-print"></i> Print Organization Lists</button>
    <hr>
      <div class="table-responsive">
          <table id="tbl_org">
            <thead>
              <tr>
                <th> # </th>
                  <th> Organization Name </th>
                  <th> Organization In Charge </th>
                  <th> Contact # </th>
                  <th> Email address</th>
                  <th> Option </th>

              </tr>
            </thead>
            <tbody>
              <?php $i=1; foreach($organizations as $org):?>
                <tr>
                  <td><?php echo $i++; ?></td>
                  <td><?php echo $org['org_name'];?></td>
                  <td><?php echo $org['org_incharge'];?></td>
                  <td><?php echo $org['org_contactno'];?></td>
                  <td><?php echo $org['org_email'];?></td>
                  <td>
                  <a href="<?php echo base_url('index.php/dashboard/vieworganizationinfo').'/'.$org['org_id']; ?>" class="btn btn-success"><i class="fa fa-search"></i> View</a>
                  <a data-email="<?php echo $org['org_email']; ?>" data-incharge="<?php echo $org['org_incharge']; ?>" data-contact="<?php echo $org['org_contactno']; ?>" data-orgname="<?php echo $org['org_name']; ?>" data-id="<?php echo $org['org_id']; ?>" href="#" class="editorg btn btn-success"><i class="fa fa-pencil"></i> Edit</a>
                
                  </td>

                </tr>
              <?php endforeach; ?>
          </tbody>

          </table>
    </div>
  </div>
</div>

</div>



<script type="text/javascript">
    
    $(document).ready(function(){


    $("#btnPrintOrg").click(function(){
        window.location = "<?php echo base_url('index.php/reports/org_report');?>";
    });

  


$('#tbl_org').DataTable( {
    dom: 'Bfrtip',
    buttons: [
        'copy', 'excel', 'pdf'
    ]
} );

$(document).on('click','.editorg',function(){
  console.log(this.dataset.orgname);
  var orgID = this.dataset.id;
  var orgName = this.dataset.orgname;
  var orgEmail = this.dataset.email;
  var orgContact =this.dataset.contact;

    $("#orgID").val(orgID);
    $("#org_name_edit").val(orgName);
    $("#org_email_edit").val(orgEmail);
    $("#org_contact_edit").val(orgContact);

    $("#modalEditOrg").modal("show");

  });

    });

</script>