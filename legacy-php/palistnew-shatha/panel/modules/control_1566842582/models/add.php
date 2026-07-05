<?php
//Validate required fields
$_module='control_1566842582';
validateFields($_module,$action);

if(
	!isset($_POST['title'])||
	!isset($_POST['code']) || $_POST['code']==""||
	!isset($_POST['photo'])||
	!isset($_POST['file'])||
	!isset($_POST['color'])||
	!isset($_POST['text'])||
	!isset($_POST['formatted_text'])
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;
//Escape
$title=e('title');
$code=e('code');
$photo=e('photo');
$file=e('file');
$color=e('color');
$active=(isset($_POST['active'])  && $_POST['active']!='0' ? 1 : 0);
			
$text=e('text');
$formatted_text=e('formatted_text');


//add to database
try{
	mysqli_query($conn,"INSERT INTO $_module (title,code,photo,file,color,active,text,formatted_text,admin_add_id,date_created) VALUES ('$title','$code','$photo','$file','$color','$active','$text','$formatted_text','$admin_add_id','$date_created')");
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