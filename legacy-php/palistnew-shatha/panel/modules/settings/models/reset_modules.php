<?php



	$r=db('modules',"WHERE core!='1'");
	if($r!=1){
		for($i=0;$i<count($r);$i++){
			$module_folder=$r[$i]['module_prefix'];
			$folder_path=modules_dir.$module_folder;
			trash($folder_path);
			$module_id=module_id($module_folder);
			mysqli_query($conn,"DROP TABLE ".$module_folder);
			mysqli_query($conn,"DELETE FROM modules WHERE module_prefix='$module_folder'");
			mysqli_query($conn,"DELETE FROM privileges_1565709771 WHERE module_name='$module_folder'");
			mysqli_query($conn,"DELETE FROM module_actions WHERE module_id='$module_id'");
			mysqli_query($conn,"DELETE FROM module_fields WHERE module_id='$module_id'");
			mysqli_query($conn,"DELETE FROM module_settings WHERE module_prefix='$module_folder'");
			}
		
	}



	$resp=db('modules',NULL,NULL,NULL,'module_prefix');
	$res=array();
	for($i=0;$i<count($resp);$i++){
		$res[]=modules_dir.$resp[$i]['module_prefix'];
	}
	
	
	$dirs = array_filter(glob(modules_dir.'*'));
	for($j=0;$j<count($dirs);$j++){
		if(!in_array($dirs[$j],$res))trash($dirs[$j]);
		}
	
	indexer(modules_dir);
	json(true,2,NULL,'Reset Completed in MySQL and folders');







