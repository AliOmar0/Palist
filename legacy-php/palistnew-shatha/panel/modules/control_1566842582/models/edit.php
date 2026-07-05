<?php
//validate fields if required
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
		|| !isset($_POST['id']) || $_POST['id']=="" 
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;

//escape parameters
$id=e('id');

$title=e('title');
$code=e('code');
$photo=e('photo');
$file=e('file');
$color=e('color');
$active=(isset($_POST['active'])  && $_POST['active']!='0' ? 1 : 0);
			
$text=e('text');
$formatted_text=e('formatted_text');

//update entry in database
try{
	mysqli_query($conn,"UPDATE $_module SET title='$title',code='$code',photo='$photo',file='$file',color='$color',active='$active',text='$text',formatted_text='$formatted_text',date_modified='$date_modified' WHERE id='$id' LIMIT 1");
}
catch(mysqli_sql_exception $e){
	json(false,3);
}
	
	
if($internal_forced)$_POST['internal']=true;
require core_dir.'preModelResponse.php';	
require custom_dir.'custom_module_response.php';
//ajaxly saved
json(true,2);