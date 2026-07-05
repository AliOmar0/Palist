<?php
//validate fields if required
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
		|| !isset($_POST['id']) || $_POST['id']=="" 
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;

//escape parameters
$id=e('id');

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

//update entry in database
try{
	mysqli_query($conn,"UPDATE $_module SET full_name='$full_name',name='$name',original_name='$original_name',protected_file='$protected_file',related_module='$related_module',related_module_id='$related_module_id',uploader_module_prefix='$uploader_module_prefix',uploader_user_id='$uploader_user_id',extension='$extension',height='$height',width='$width',quality='$quality',type='$type',sub_type='$sub_type',size='$size',source_name='$source_name',source_link='$source_link',reference='$reference',average_color='$average_color',credit='$credit',credit_link='$credit_link',caption='$caption',date_modified='$date_modified' WHERE id='$id' LIMIT 1");
}
catch(mysqli_sql_exception $e){
	json(false,3);
}
	
	
if($internal_forced)$_POST['internal']=true;
require core_dir.'preModelResponse.php';	
require custom_dir.'custom_module_response.php';
//ajaxly saved
json(true,2);