<?php
//Validate required fields
$_module='module_fields';
validateFields($_module,$action);

if(
	!isset($_POST['field_name'])||
	!isset($_POST['label'])||
	!isset($_POST['type'])||
	!isset($_POST['sub_type'])||
	!isset($_POST['sub_sub_type'])||
	!isset($_POST['select_table'])||
	!isset($_POST['select_field'])||
	!isset($_POST['visibility_matrix'])||
	!isset($_POST['db_default'])
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;
//Escape
$module_id=e('module_id');
$field_name=e('field_name');
$label=e('label');
$type=e('type');
$sub_type=e('sub_type');
$sub_sub_type=e('sub_sub_type');
$protected_file=(isset($_POST['protected_file'])  && $_POST['protected_file']!='0' ? 1 : 0);
			
$main=(isset($_POST['main'])  && $_POST['main']!='0' ? 1 : 0);
			
$select_table=e('select_table');
$select_field=e('select_field');
$parenter_field=(isset($_POST['parenter_field'])  && $_POST['parenter_field']!='0' ? 1 : 0);
			
$is_ml=(isset($_POST['is_ml'])  && $_POST['is_ml']!='0' ? 1 : 0);
			
$is_unique=(isset($_POST['is_unique'])  && $_POST['is_unique']!='0' ? 1 : 0);
			
$noMCE=(isset($_POST['noMCE'])  && $_POST['noMCE']!='0' ? 1 : 0);
			
$required=(isset($_POST['required'])  && $_POST['required']!='0' ? 1 : 0);
			
$multi_files=(isset($_POST['multi_files'])  && $_POST['multi_files']!='0' ? 1 : 0);
			
$visibility_matrix=e('visibility_matrix');
$db_default=e('db_default');


//add to database
try{
	mysqli_query($conn,"INSERT INTO $_module (module_id,field_name,label,type,sub_type,sub_sub_type,protected_file,main,select_table,select_field,parenter_field,is_ml,is_unique,noMCE,required,multi_files,visibility_matrix,db_default,admin_add_id,date_created) VALUES ('$module_id','$field_name','$label','$type','$sub_type','$sub_sub_type','$protected_file','$main','$select_table','$select_field','$parenter_field','$is_ml','$is_unique','$noMCE','$required','$multi_files','$visibility_matrix','$db_default','$admin_add_id','$date_created')");
}
catch(mysqli_sql_exception $e){
	json(false,3);
}
	
$prime_last_id=$last_id=mysqli_insert_id($conn);

	
//exit model
if($internal_forced)$_POST['internal']=true;
$last_id=$prime_last_id;
require core_dir.'preModelResponse.php';
require custom_dir.'custom_module_response.php';
json(true,2,NULL,NULL,array('url'=>returnUrl(),'js'=>'redirect'));