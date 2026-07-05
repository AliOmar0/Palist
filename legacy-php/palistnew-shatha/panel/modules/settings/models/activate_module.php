<?php
//make sure no empty fields
if(    
!isset($_POST['module_folder']) || $_POST['module_folder']=="" ||
!isset($_POST['legion_zip_folder']) || $_POST['legion_zip_folder']==""
) json(false,4);

$_POST['module_folder']=$_POST['legion_zip_folder'].$_POST['module_folder'].'.zip';
$new_folder_path=explode('/',$_POST['module_folder']);
$new_folder_name=array_pop((array_slice($new_folder_path, -1)));
$new_folder_name=str_replace('.zip','',$new_folder_name);

$file=$_POST['module_folder'];
$newfile=panel_dir.'tmp_'.$new_folder_name.'.zip';

// if(!copy($file,$newfile))json(true,6);
//CUSTOM STARTS for Almanara coz of SSL error of streaming file from legioncms.com
$arrContextOptions = array(
	"ssl" => array(
	  "verify_peer" => false,
	  "verify_peer_name" => false,
	)
);  

$context = stream_context_create($arrContextOptions);
$contents = file_get_contents($file,false,$context);
$file=fopen($newfile,'w');
fwrite($file,$contents);
fclose($file);

$zip = new ZipArchive;
if($zip->open($newfile)===TRUE){
	#1
	$zip->extractTo(modules_dir.$new_folder_name);
	$zip->close();
	//delete the tmp 
	trash($newfile);

	$new_folder_path= modules_dir.$new_folder_name.'/';
	
	
	#2
	#create table
	if(file_exists($new_folder_path.'others/TableSQL.php')){
		if(!dbs(file_get_contents($new_folder_path.'others/TableSQL.php'))){
			undo1();json(false,61,NULL,NULL,array('step'=>'2'));
		}
	}
	
	
	#3
	#insert first row if its edit only module
	if(file_exists($new_folder_path.'others/firstRowSQL.php')){
		if(!dbs(file_get_contents( $new_folder_path.'others/firstRowSQL.php'))){
			undo1();undo2();json(false,61,NULL,NULL,array('step'=>'3'));
		}
	}	
	

	#4
	#insert in module settings
	if(file_exists($new_folder_path.'others/moduleSettingsSQL.php')){
		$__mod_settingsSQL=file_get_contents($new_folder_path.'others/moduleSettingsSQL.php');
		if(str_contains($__mod_settingsSQL,'search_phrase')){
			undo1();undo2();json(false,61,NULL,NULL,array('step'=>'4.1'));
		}

		if(!dbs(file_get_contents($new_folder_path.'others/moduleSettingsSQL.php'))){
			undo1();undo2();json(false,61,NULL,NULL,array('step'=>'4.2'));
		}
	}
	
		
	
//get info
$info=unserialize(file_get_contents(modules_dir.$new_folder_name.'/others/info.php'));
	
	if($info['is_edit_only']=='1')$models='edit';
	else $models='add,edit,delete,list,usage,view';
	
	$tmp=db('modules',"WHERE core=1",'ORDER BY order_by DESC','LIMIT 1','order_by');
	if($info['core']==1 && $tmp!=1)
		$new_order_by=((int)$tmp[0]['order_by'])+1;
	elseif($tmp!=1)
		$new_order_by=((int)db('modules',NULL,'ORDER BY order_by DESC','LIMIT 1','order_by')[0]['order_by'])+1;
	else
		$new_order_by=100;
	
	#5
	if(!dbs("INSERT INTO modules (module_name,module_prefix,version,order_by,main_icon,legion_version,legion_build,is_edit_only,is_complemantary,models,ml,cluster,core,commerce,admin_add_id) VALUES ('".$info['module_name']."','$new_folder_name','".$info['version']."','$new_order_by','".$info['main_icon']."','".$info['legion_version']."','".$info['legion_build']."','".$info['is_edit_only']."','".$info['is_complemantary']."','$models','".$info['ml']."','".$info['cluster']."','".$info['core']."','".$info['commerce']."','1')")){
		undo1();undo2();undo4();json(false,61,NULL,NULL,array('step'=>'5'));
	}
	
	$new_module_id=mysqli_insert_id($conn);

	modules_action_inserter(mysqli_insert_id($conn),$info['submenu_items_serial']);
	
	
	#6
	#insert in module fields
	$fields=json_decode(file_get_contents(modules_dir.$new_folder_name.'/others/fieldsArray.php'),true);
	foreach($fields as $field){
		if(!dbs("INSERT INTO `module_fields` (`module_id`,`field_name`,`label`,`type`,`sub_type`,`main`,`select_table`,`select_field`,`parenter_field`,`is_unique`,`is_ml`,`noMCE`,`required`,`multi_files`,`deleted`,`sub_sub_type`,`protected_file`,`visibility_matrix`,`db_default`) VALUES ('$new_module_id','".$field['field_name']."','".$field['label']."','".$field['type']."','".$field['sub_type']."','".$field['main']."','".$field['select_table']."','".$field['select_field']."','".$field['parenter_field']."','".$field['is_unique']."','".$field['is_ml']."','".$field['noMCE']."','".$field['required']."','".$field['multi_files']."','0','".(isset($field['sub_sub_type'])?$field['sub_sub_type']:NULL)."','".(isset($field['protected_file'])?$field['protected_file']:'0')."','".(isset($field['visibility_matrix'])?$field['visibility_matrix']:NULL)."','".$field['db_default']."')")){
			undo1();undo2();undo4();undo5();json(false,61,NULL,NULL,array('step'=>'6'));
		};
	}

	if(isset($_POST['and_go']))json(true,2,NULL,NULL,['js'=>'redirect','url'=>urlPanel.'?module='.$new_folder_name.'&action=add']);
	
j();
}else json(false,61,NULL,NULL,array('step'=>'1')); //that zip didnt opened 