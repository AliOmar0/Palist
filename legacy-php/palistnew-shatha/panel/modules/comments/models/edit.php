<?php
//validate fields if required
$_module='comments';
validateFields($_module,$action);

if(
		!isset($_POST['related_id'])||
		!isset($_POST['commenter_id'])||
		!isset($_POST['comment']) || $_POST['comment']==""||
		!isset($_POST['remark'])
		|| !isset($_POST['id']) || $_POST['id']=="" 
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;

//escape parameters
$id=e('id');

$module_prefix=e('module_prefix');
$related_id=e('related_id');
$commenter_module=e('commenter_module');
$commenter_id=e('commenter_id');
$comment=e('comment');
$remark=e('remark');
if(isset($_FILES['files']['name'][0]) && $_FILES['files']['name'][0]!=NULL) {
	 $files=escape(upload_file('multiple','files',$settings['file'],target_dir,$_module,false));
	 $files="'$files'";
	}
else if(isset($_POST['del_files']))$files="''";
else if(!isset($_FILES['files']['name'][0]) || $_FILES['files']['name'][0]==NULL) $files='files';

	

//update entry in database
try{
	mysqli_query($conn,"UPDATE $_module SET module_prefix='$module_prefix',related_id='$related_id',commenter_module='$commenter_module',commenter_id='$commenter_id',comment='$comment',remark='$remark',files=$files,date_modified='$date_modified' WHERE id='$id' LIMIT 1");
}
catch(mysqli_sql_exception $e){
	json(false,3);
}
	ownRelatedFiles($_module,$id);
	
if($internal_forced)$_POST['internal']=true;
require core_dir.'preModelResponse.php';	
require custom_dir.'custom_module_response.php';
json(true,2,NULL,NULL,['js'=>'refresh']);