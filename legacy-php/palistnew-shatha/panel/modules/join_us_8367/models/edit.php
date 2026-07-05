<?php
//validate fields if required
$_module='join_us_8367';
validateFields($_module,$action);

if(
		!isset($_POST['major']) || $_POST['major']==""
		|| !isset($_POST['id']) || $_POST['id']=="" 
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;

//escape parameters
$id=e('id');

$major=e('major');
if(isset($_FILES['cv']['name'][0]) && $_FILES['cv']['name'][0]!=NULL) {
	 $cv=escape(upload_file('single','cv',$settings['file'],target_dir,$_module,false));
	 $cv="'$cv'";
	}
else if(isset($_POST['del_cv']))$cv="''";
else if(!isset($_FILES['cv']['name'][0]) || $_FILES['cv']['name'][0]==NULL) $cv='cv';

	
if((!isset($_FILES['cv']) || $_FILES['cv']['name'][0]==NULL) && isset($_POST['del_cv']))json(false);
			

//update entry in database
try{
	mysqli_query($conn,"UPDATE $_module SET major='$major',cv=$cv,date_modified='$date_modified' WHERE id='$id' LIMIT 1");
}
catch(mysqli_sql_exception $e){
	json(false,3);
}
	ownRelatedFiles($_module,$id);
	
if($internal_forced)$_POST['internal']=true;
require core_dir.'preModelResponse.php';	
require custom_dir.'custom_module_response.php';
json(true,2,NULL,NULL,['js'=>'refresh']);