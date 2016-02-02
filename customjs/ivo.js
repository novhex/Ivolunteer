/*Ivolunteer Custom JS*/

var username;
var password;


	$("#btnLogin").click(function(){

		username = $("#txtUser").val();
		password = $("#txtPass").val();

		if(username!=='' && password!==''){

				validate_login(username,password);
		}	
		else{
			
		}

	});

	$(document).on('click','.join_org',function(){
		//alert("Joining to org"+this.dataset.orgid+" with username id of "+this.dataset.userlogged);
		join_org(this.dataset.orgid,this.dataset.userlogged);
	});




//function(s)

function join_org(org_id,myuserid){

	$.ajax({
		url: window.location.origin+"/ivo/index.php/ajax/join_org",
		type: 'GET',
		data: 'orgid='+org_id+'&userid='+myuserid,
		success:function(response){
			if(response=='join_ok'){
				bootbox.alert("You successfully joined in this group");
				setTimeout("location.href = '"+window.location.origin+"/ivo/index.php/home/dashboard/"+"';",3000);
			}else{
				bootbox.alert("Sorry,you already joined in this group");
			}
		}
	});

}





function validate_login(username,password){

	$.ajax({
		url: window.location.origin+"/ivo/index.php/ajax/login",
		type: 'post',
		cache: false,
		data: 'username='+username+"&password="+password,
		success:function(response){
				if(response==0) {
		
				}else{
					window.location = window.location.origin+"/ivo/index.php/home/dashboard";
				}
		}

	});
}