<div class="">
<?php foreach($comments as $cmnt): ?>
<p><i class="fa fa-user"></i> <?php echo $cmnt['user_firstname']." ".$cmnt['user_lastname']; ?> </p>
<p><i class="fa fa-calendar"></i> Posted on <?php echo date('F  j, Y',strtotime($cmnt['date_comment'])); ?></p>

<p style="text-align:justify;"><i class="fa fa-comment"></i> Comment: <?php echo $cmnt['message']; ?></p>

<?php 
if($accesstype=='admin'){
echo "<p><a href='#' data-id='".$cmnt['comment_id']."' class='btn btn-warning deletecomment'><i class='fa fa-remove'></i> Delete Comment</a></p>";
}
?>
<hr>
<?php endforeach; ?>
</div>
<script type="text/javascript">
	
	$(document).ready(function(){
			$(document).on('click','.deletecomment',function(){
				var comment_id=this.dataset.id;

				bootbox.confirm("Are you sure you want to delete this comment",function(response){
						if(response==true){
							$.ajax({
								url: "<?php echo base_url('index.php/dashboard/deletecomment')?>",
								type: "POST",
								data: "commentid="+comment_id,
								success:function(data){
									if(data==1){
										bootbox.alert("Comment deleted");
										setInterval(function(){
											window.location="<?php echo base_url('index.php/dashboard/home'); ?>";
										},3000);
									}
								}

							});
						}
				});

			});
	})
</script>