<div class="container" style="margin-top:70px;">

<div class="row">
<div class="col-md-12">

<div class="well">
	<h1> Your Dashboard </h1>
	<hr>
	<label class="label label-danger"> You have 0 notification(s)</label>



</div>
	
</div>

</div>
	

</div>

<script type="text/javascript">
	
	$(document).ready(function(){
			<?php if($this->session->flashdata('has_joined')!=''){?>
					bootbox.alert("Access Forbidden");
			<?php }?>
	});
</script>