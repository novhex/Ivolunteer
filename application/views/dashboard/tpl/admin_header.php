<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('bootstrap/css/bootstrap.min.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('bootstrap/font-awesome/css/font-awesome.min.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('bootstrap/css/dataTable.css'); ?>">

<script type="text/javascript" src="<?php echo base_url('bootstrap/js/jquery.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('bootstrap/js/bootstrap.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('bootstrap/js/bootbox.js'); ?>"></script>
 <script type="text/javascript" src="<?php echo base_url('bootstrap/js/dataTables.js');?>"></script> 
 <script type="text/javascript" src="<?php echo base_url('bootstrap/js/dataTables.buttons.min.js');?>"></script> 
 
<script type="text/javascript">
    
    $(document).ready(function(){

        $("#btn_logout").click(function(){

          bootbox.confirm("Are you sure you want to log-out?",function(answer){
            if(answer==true){
              window.location = "<?php echo base_url('index.php/dashboard/logout'); ?>";
            }
          });

        });

    });

</script>
	<title><?php echo $page_title; ?></title>
</head>

<body>
  <style type="text/css">
  body{
    padding-top: 50px;
  }

</style>
