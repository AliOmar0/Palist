<?php
//Validate required fields
$_module='comments';
validateFields($_module,$action);

if(
	!isset($_POST['related_id'])||
	!isset($_POST['commenter_id'])||
	!isset($_POST['comment']) || $_POST['comment']==""||
	!isset($_POST['remark'])
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;
//Escape
$module_prefix=e('module_prefix');
$related_id=e('related_id');
$commenter_module=e('commenter_module');
$commenter_id=e('commenter_id');
$comment=e('comment');
$remark=e('remark');
if(!isset($_FILES['files']) || $_FILES['files']['name'][0]==NULL) $files='files';
else {
	 $files=escape(upload_file('multiple','files',$settings['file'],target_dir,$_module,false));
	 $files="'$files'";
	}
			


//add to database
try{
	mysqli_query($conn,"INSERT INTO $_module (module_prefix,related_id,commenter_module,commenter_id,comment,remark,files,admin_add_id,date_created) VALUES ('$module_prefix','$related_id','$commenter_module','$commenter_id','$comment','$remark',$files,'$admin_add_id','$date_created')");
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