<?php
//Validate required fields
$_module='files_1577206823';
validateFields($_module,$action);

if(
	!isset($_POST['full_name'])||
	!isset($_POST['name'])||
	!isset($_POST['original_name'])||
	!isset($_POST['related_module_id'])||
	!isset($_POST['uploader_user_id'])||
	!isset($_POST['extension'])||
	!isset($_POST['height'])||
	!isset($_POST['width'])||
	!isset($_POST['quality'])||
	!isset($_POST['type'])||
	!isset($_POST['sub_type'])||
	!isset($_POST['size'])||
	!isset($_POST['source_name'])||
	!isset($_POST['source_link'])||
	!isset($_POST['reference'])||
	!isset($_POST['average_color'])||
	!isset($_POST['credit'])||
	!isset($_POST['credit_link'])||
	!isset($_POST['caption'])
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;
//Escape
$full_name=e('full_name');
$name=e('name');
$original_name=e('original_name');
$protected_file=(isset($_POST['protected_file'])  && $_POST['protected_file']!='0' ? 1 : 0);
			
$related_module=e('related_module');
$related_module_id=e('related_module_id');
$uploader_module_prefix=e('uploader_module_prefix');
$uploader_user_id=e('uploader_user_id');
$extension=e('extension');
$height=e('height');
$width=e('width');
$quality=e('quality');
$type=e('type');
$sub_type=e('sub_type');
$size=e('size');
$source_name=e('source_name');
$source_link=e('source_link');
$reference=e('reference');
$average_color=e('average_color');
$credit=e('credit');
$credit_link=e('credit_link');
$caption=e('caption');


//add to database
try{
	mysqli_query($conn,"INSERT INTO $_module (full_name,name,original_name,protected_file,related_module,related_module_id,uploader_module_prefix,uploader_user_id,extension,height,width,quality,type,sub_type,size,source_name,source_link,reference,average_color,credit,credit_link,caption,admin_add_id,date_created) VALUES ('$full_name','$name','$original_name','$protected_file','$related_module','$related_module_id','$uploader_module_prefix','$uploader_user_id','$extension','$height','$width','$quality','$type','$sub_type','$size','$source_name','$source_link','$reference','$average_color','$credit','$credit_link','$caption','$admin_add_id','$date_created')");
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