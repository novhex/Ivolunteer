<div class="container" style="margin-top:70px;">

<div class="row">
<div class="col-md-12">
	<div class="well">
		
		<h1> Notifications </h1>
		<hr>
			<div class="table-responsive">
					<table id="tbl_notif">
						<thead>
							<tr>
							<th> # </th>
							<th> From </th>
							<th> Option </th>
							</tr>
						</thead>
						<tbody>
							
							<?php $i=1; foreach($notifications as $notif): ?>
							<tr>
							<td><?php echo $i++;?></td>
							<td><?php echo $notif['notify_by']; ?></td>
							<td><a href="#" class="btn btn-success readmsg"><i class="fa fa-zoom"></i> Read</a></td>
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
		$("#tbl_notif").DataTable();
	});
</script>