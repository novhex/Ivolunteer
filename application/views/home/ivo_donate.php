<div class="container" style="margin-top:70px;">
	<div class="row">
		<div class="col-md-12">
        <div class="well">
			<div class="table-responsive">
			<h1> Organization Lists</h1>
<table id="tbl_organizations"  cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>#</th>
                <th>ID</th>
                <th>Name</th>
                <th>In-Charge</th>
                <th>Email</th>
                <th>Contact</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($organization_lists as $org_info):?>
        	<tr>
        		<td><?php echo $org_info['id']; ?></td>
        		<td><?php echo $org_info['org_id']; ?></td>
        		<td><?php echo $org_info['org_name']; ?></td>
        		<td><?php echo $org_info['org_incharge'];?></td>
        		<td><?php echo $org_info['org_email'];?></td>
        		<td><?php echo $org_info['org_contactno']; ?></td>
        		<td><a href="<?php echo base_url('index.php/home/submit_donation')."/".$org_info['org_id'];?>" data-orgid="<?php echo $org_info['org_id']; ?>" data-userlogged="<?php echo $this->session->userdata('userId'); ?>" class="donate_org btn btn-primary"><i class="fa fa-user-plus"></i> Donate </a> &nbsp; <a data-orgid="<?php echo $org_info['org_id']; ?>" href="<?php echo base_url('index.php/home/vieworganizationinfo/')."/".$org_info['org_id'];?>" class="org_information btn btn-info"> View Info </a></td>
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
		$(document).ready(function() {
			// body...
			$("#tbl_organizations").DataTable();
		})
</script>
