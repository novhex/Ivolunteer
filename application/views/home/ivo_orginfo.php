<div class="container" style="margin-top:70px;">

	<div class="row">
			<div class="col-md-12 well">
			<button id="btnPrintMemb" class="btn btn-success btn-lg"><i class="fa fa-print"></i> Print Members</button>
			<br>

				
				<?php 
				foreach($org_info as $org_information){?>
				<h1 style="text-align:center;"><?php echo  $org_information['org_name']; ?></h1>
				<hr>
				<strong>Organization ID: <?php echo $org_information['org_id']; ?></strong>
				<hr>
				<strong>In Charge: <?php echo $org_information['org_incharge'];?></strong>
				<hr>
				<strong>Email: <?php echo $org_information['org_email'];?></strong>
				<hr>
				<strong>Contact No: <?php echo $org_information['org_contactno'];?></strong>
				<?php } ?>
			<h1 style="text-align:center;">Joined Members</h1>

			<div class="table-responsive">
				<table id="tbl_organization_members" class="" cellspacing="0" width="100%">
			        <thead>
			            <tr>
			                <th>#</th>
			                <th>Name</th>
			            </tr>
			        </thead>
			        <tbody>
			<?php
			$i=1;
				foreach($org_members as $members){
					
						echo "<tr>";
						echo "<td>".$i++."</td>";
						echo "<td>".$members['user_firstname']." ".$members['user_lastname']."</td>";
						echo "</tr>";
				}

				?>
			        </tbody>
			       </table>
			  </div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$("#tbl_organization_members").DataTable();

		$("#btnPrintMemb").click(function(){
			window.location="<?php echo base_url('index.php/reports/org_member_report').'/'.$this->uri->segment(3); ?>"
		});
	});

</script>