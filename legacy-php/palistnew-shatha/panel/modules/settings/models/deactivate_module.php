<?php
//make sure no empty fields
if(    
!isset($_POST['module_folder']) || $_POST['module_folder']==""
) json(false,4);

	

if(detail('modules','restricted','module_prefix',$_POST['module_folder']) && !super())json(false,10);
/**************************************************/
	$module_folder=mysqli_real_escape_string($conn,$_POST['module_folder']);
	 
	//remove permissions
	mysqli_query($conn,"DELETE FROM privileges_1565709771 WHERE module_name='$module_folder'");
	
	trash(modules_dir.$module_folder);

	$module_id=detail('modules','id','module_prefix',$module_folder);
	mysqli_query($conn,"DELETE FROM module_actions WHERE module_id=".$module_id);
	mysqli_query($conn,"DROP TABLE ".$module_folder);
	mysqli_query($conn,"DELETE FROM modules WHERE module_prefix='$module_folder'");
	mysqli_query($conn,"DELETE FROM module_settings WHERE module_prefix='$module_folder'");
	mysqli_query($conn,"DELETE FROM quick_access_1563567918 WHERE module_prefix='$module_folder'");
	mysqli_query($conn,"DELETE FROM module_fields WHERE module_id='$module_id'");
	
	json(true,2,NULL,NULL,['js'=>'refresh']);