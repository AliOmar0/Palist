<?php
//Validate required fields
$_module='join_us_8367';
validateFields($_module,$action);

if(
	!isset($_POST['major']) || $_POST['major']==""
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;
//Escape
$major=e('major');
if(!isset($_FILES['cv']) || $_FILES['cv']['name'][0]==NULL) $cv='cv';
else {
	 $cv=escape(upload_file('single','cv',$settings['file'],target_dir,$_module,false));
	 $cv="'$cv'";
	}
			


//add to database
try{
	mysqli_query($conn,"INSERT INTO $_module (major,cv,admin_add_id,date_created) VALUES ('$major',$cv,'$admin_add_id','$date_created')");
}
catch(mysqli_sql_exception $e){
	json(false,3);
}
	
$prime_last_id=$last_id=mysqli_insert_id($conn);
ownRelatedFiles($_module,$prime_last_id);
	
//exit model
if($internal_forced)$_POST['internal']=true;
$last_id=$prime_last_id;
require core_dir.'preModelResponse.php';
require custom_dir.'custom_module_response.php';
json(true,2,NULL,NULL,array('url'=>returnUrl(),'js'=>'redirect'));