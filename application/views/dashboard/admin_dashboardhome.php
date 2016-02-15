 <div class="col-md-12"><center><img src="<?php echo base_url('img/logo.jpg');?>"></center></div>
    

<div class="container" style="margin-top:70px;">

<div id="modalAddComment" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
      <input type="hidden" id="dist_ID" />
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"> Post Comment </h4>
      </div>
      <div class="modal-body">
          <textarea id="dist_comments" maxlength="50" class="form-control"></textarea>
          <br>
          <button data-dismiss="modal" type="button" class="btn btn-success" id="btncomment" name="btncomment"><i class="fa fa-pencil"></i> Submit Comment</button>
      </div>
      <div class="modal-footer">
     
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>

          
    </div>

  </div>
</div>

<div class="row">
	<div class="col-md-12 well">
	<div class="col-sm-6">
		   <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title"> <i class="fa fa-user"></i> Newly Registered Volunteers </h3>
            </div>
            <div class="panel-body">
         	  <?php echo "<ol>"; foreach($volunteers as $vlntrs): ?>
            <?php echo "<li>".$vlntrs['user_firstname']." ".$vlntrs['user_lastname']."</li>"; ?>
          <?php endforeach; echo "</ol>";?>
            </div>
          </div>

	</div>

<div class="col-sm-6">
   <div class="panel panel-warning">
            <div class="panel-heading">
              <h3 class="panel-title"> <i class="fa fa-life-saver"></i> Latest Disaster(s) </h3>
            </div>
            <div class="panel-body">
            <?php $i=1; foreach($disasters as $dstrs):?>
            <h3><?php echo $dstrs['type']; ?></h3>
            
            <p><i class="fa fa-comment"></i> <a href="#" data-did="<?php echo $dstrs['disaster_type_id'];?>" class="viewcomment">View Comments</a></p>
            <p><i class="fa fa-pencil"></i> <a data-did="<?php echo $dstrs['disaster_type_id'];?>" href="#" class="writecomment" data-toggle="modal" data-target="#modalAddComment">Write Comment</a> </p>

            <hr>
            <?php endforeach; ?>
            </div>
          </div>
</div>



</div>

	</div>
</div>

<script type="text/javascript">
		
		$(document).ready(function(){

      $(document).on('click','.writecomment',function(){
        $("#dist_ID").val(this.dataset.did);
      });

      $("#btncomment").click(function(){
        if($("#dist_comments").val()==''){
          bootbox.alert("Please enter a comment!");
        }else{
          $.ajax({
            url: "<?php echo base_url('index.php/dashboard/postcomment');?>",
            type: "POST",
            data: "dis_id="+$("#dist_ID").val()+"&comment="+$("#dist_comments").val(),
            success:function(data){
              if(data==1){
                bootbox.alert("Comment submitted");
              }else{
                bootbox.alert("Comment wasnt submitted");
              }
            }
          });
        }
      })


            $(document).on('click','.viewcomment',function(){

        var disaster_id=this.dataset.did;

      
        box = bootbox.dialog({
          title: '<i class="fa fa-comment fa-2x"></i> Disaster Comments',
          message: "Comments",
          size: 'large',
          onEscape: function(){
           
          }

        });

        $.ajax({

              url: "<?php echo base_url('index.php/dashboard/getcomments')?>",
              type: 'GET',
              data: 'dist_id='+disaster_id,
              success: function(response){
                box.contents().find('.bootbox-body').html(response);
              }
        });


   });
		});

</script>