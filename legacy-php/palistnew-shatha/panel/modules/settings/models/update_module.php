<?php

if(    
!isset($_POST['module_folder']) || $_POST['module_folder']=="" ||
!isset($_POST['legion_zip_folder']) || $_POST['legion_zip_folder']==""
) json(false,4);

if(detail('modules','restricted','module_prefix',$_POST['module_folder']))json(false,55);

$module_folder=escape($_POST['module_folder']);//folder name only
$module_path_on_legion=$_POST['legion_zip_folder'].$_POST['module_folder'].'.zip';//with full link

$temp_table=$temp_folder=$module_folder.'_tmp';


if(!dbs("RENAME TABLE $module_folder TO $temp_table")){
	if(!dbs("RENAME TABLE $temp_table TO $temp_table".'_failed_update_backup')){
		json(false,59,NULL,NULL,array('step'=>1));
	}

	//now try again
	if(!dbs("RENAME TABLE $module_folder TO $temp_table")){
		json(false,59,NULL,NULL,array('step'=>1));
	}
	
}

#2
//change old module folder name
	if(file_exists(modules_dir.$temp_folder))trash(modules_dir.$temp_folder);
	if(!rename(modules_dir.$module_folder,modules_dir.$temp_folder)){
		undo_1();json(false,59,NULL,NULL,array('step'=>2));
	}


#3
//copy the zip from Legion server
$zipName=modules_dir.'tmp_'.$module_folder.'.zip';

// if (!copy($module_path_on_legion,$zipName)){
// 	 $errors= error_get_last();
//     echo "COPY ERROR: ".$errors['type'];
//     echo "<br />\n".$errors['message'];
// 	echo 'failed to copy '.$module_path_on_legion.' to '.$zipName;
// 	undo_1();undo_2();json(false,59,NULL,NULL,array('step'=>3));
// }
//CUSTOM STARTS for Almanara coz of SSL error of streaming file from legioncms.com
$arrContextOptions = array(
	"ssl" => array(
	  "verify_peer" => false,
	  "verify_peer_name" => false,
	)
);  

$context = stream_context_create($arrContextOptions);
$contents = file_get_contents($module_path_on_legion,false,$context);


if ($contents==false){
   undo_1();undo_2();json(false,59,NULL,NULL,array('step'=>3));
}

$zip_file=fopen($zipName,'w');
fwrite($zip_file,$contents);
fclose($zip_file);
// error_log('good');

#4
	//extract the copied zip
	$zip = new ZipArchive;
	if ($zip->open($zipName) === TRUE) {
		$zip->extractTo(modules_dir.$module_folder);
		$zip->close();
		trash($zipName);
	}//if copied successfully
	else{
		trash($zipName);undo_1();undo_2();json(false,59,NULL,NULL,array('step'=>4));
	}


#5
//flag delete module settings
if($module_folder!='module_settings')mysqli_query($conn,"UPDATE module_settings SET deleted='1' WHERE module_prefix='$module_folder' LIMIT 1"); 
//execute whats in others folder
	$folder_path= modules_dir.$module_folder.'/';
	if(file_exists($folder_path.'others/TableSQL.php')){
		     if(!dbs(file_get_contents($folder_path.'others/TableSQL.php'))){
				undo_5();undo_4();undo_1();undo_2();json(false,59,NULL,NULL,array('step'=>'5.1'));
			 }
			}//if
	
	
	if($module_folder!='module_settings' && file_exists($folder_path.'others/moduleSettingsSQL.php')){
		$__mod_settingsSQL=file_get_contents($folder_path.'others/moduleSettingsSQL.php');
			if(str_contains($__mod_settingsSQL,'search_phrase')){
				undo_5();undo_4();undo_1();undo_2();json(false,59,NULL,NULL,array('step'=>'5.2.1'));
			}
		     if(!mysqli_query($conn,file_get_contents($folder_path.'others/moduleSettingsSQL.php'))){
				 undo_5();undo_4();undo_1();undo_2();json(false,59,NULL,NULL,array('step'=>'5.2.2'));
			 }
			}//if

	###
	#ingored firstRowSQL.php
	##


#6

//filter matched columns
$old_columns=file_get_contents(modules_dir.$temp_folder.'/others/columnsSQL.php');
$new_columns=file_get_contents(modules_dir.$module_folder.'/others/columnsSQL.php');

if($old_columns==false || $new_columns==false){
	m(mysqli_error($conn));
	undo_5();undo_4();undo_1();undo_2();json(false,59,NULL,NULL,array('step'=>6));
}



$old_columns=explode(",",$old_columns);
$new_columns=explode(",",$new_columns);

$matchedColumns=array();
for($i=0;$i<count($old_columns);$i++){
if(in_array($old_columns[$i],$new_columns))$matchedColumns[]=$old_columns[$i];
	}
$matchedColumns=implode(",",$matchedColumns);

	 
//fix for upgrade pages module
//$matchedColumns='title,photo,slug,content,files,id,date_modified,admin_add_id,date_created,time_stamp,deleted,restricted';

//fix for upgrade files module
//$matchedColumns='full_name,name,original_name,extension,height,width,quality,type,size,source_name,source_link,reference,average_color,credit,credit_link,caption,id,date_modified,admin_add_id,date_created,time_stamp,deleted,restricted';


//fix for upgrade control module
//$matchedColumns='title,code,photo,text,formatted_text,id,date_modified,admin_add_id,date_created,time_stamp,deleted,restricted';


#7
//insert previous rows from current table to the new table
if(!dbs("INSERT INTO $module_folder ($matchedColumns)
SELECT $matchedColumns FROM $temp_table")){
//	d($matchedColumns);
	undo_5();undo_4();undo_1();undo_2();json(false,59,NULL,NULL,array('step'=>7));
}


#8
//update version
$module_id=detail('modules','id','module_prefix',$module_folder);
$info=unserialize(file_get_contents(modules_dir.$module_folder.'/others/info.php'));
if(!dbs("UPDATE modules SET version='".$info['version']."',module_name='".$info['module_name']."',main_icon='".$info['main_icon']."',legion_version='".$info['legion_version']."',legion_build='".$info['legion_build']."',is_edit_only='".$info['is_edit_only']."',ml='".$info['ml']."',cluster='".$info['cluster']."',core='".$info['core']."',commerce='".$info['commerce']."' WHERE id='$module_id' LIMIT 1")){
	undo_5();undo_4();undo_1();undo_2();json(false,59,NULL,NULL,array('step'=>8));
}



#9
//delete tmp old table
if(!dbs("DROP TABLE $temp_table")){
	undo_5();undo_4();undo_1();undo_2();json(false,59,NULL,NULL,array('step'=>9));
}


#13
#delete=0 for the old 
dbs("UPDATE module_fields SET deleted=1 WHERE module_id='$module_id'");
	
#14
$fields=json_decode(file_get_contents(modules_dir.$module_folder.'/others/fieldsArray.php'),true);

for($i=0;$i<count($fields);$i++){
	$resp=db('module_fields',"WHERE module_id='$module_id' AND deleted=1 AND field_name='".$fields[$i]['field_name']."'");
	if($resp!=1)$fields[$i]['id']=$resp[0]['id'];
	else $fields[$i]['id']='';
}

foreach($fields as $field){
//	echo $field['field_name'];d($field['id']);
	if($field['id']!=''){
		$a="`id`,";
		$b="'".$field['id']."',";
		dbs("DELETE FROM module_fields WHERE id='".$field['id']."'");
	}else{
		$a=$b='';
	}
	

		dbs("INSERT INTO `module_fields` ($a`module_id`,`field_name`,`label`,`type`,`sub_type`,`main`,`select_table`,`select_field`,`parenter_field`,`is_unique`,`is_ml`,`noMCE`,`required`,`multi_files`,`deleted`,`sub_sub_type`,`protected_file`,`visibility_matrix`,`db_default`) VALUES ($b'$module_id','".$field['field_name']."','".$field['label']."','".$field['type']."','".$field['sub_type']."','".$field['main']."','".$field['select_table']."','".$field['select_field']."','".$field['parenter_field']."','".$field['is_unique']."','".$field['is_ml']."','".$field['noMCE']."','".$field['required']."','".$field['multi_files']."','0','".(isset($field['sub_sub_type'])?$field['sub_sub_type']:NULL)."','".(isset($field['protected_file'])?$field['protected_file']:'0')."','".(isset($field['visibility_matrix'])?$field['visibility_matrix']:NULL)."','".$field['db_default']."')");
	
//	d($_error);

}


#15
//remove fields old
dbs("DELETE FROM module_fields WHERE module_id='$module_id' AND deleted='1'");

#10
//delete tmp old folder
trash(modules_dir.$temp_folder);

#11
modules_action_inserter($module_id,$info['submenu_items_serial']);

#12
//delete old settings 
if($module_folder!='module_settings')dbs("DELETE FROM module_settings WHERE module_prefix='$module_folder' AND deleted='1'");


j();