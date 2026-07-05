<?php
//Validate required fields
$_module='news_8362';
validateFields($_module,$action);

if(
	!isset($_POST['title'])||
	!isset($_POST['photo']) || $_POST['photo']==""||
	!isset($_POST['summary'])||
	!isset($_POST['content'])||
	!isset($_POST['publish_date'])
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;
//Escape
$title=e('title');
$photo=e('photo');
$summary=e('summary');
$content=e('content');
$publish_date=e('publish_date');


//add to database
try{
	mysqli_query($conn,"INSERT INTO $_module (title,photo,summary,content,publish_date,admin_add_id,date_created) VALUES ('$title','$photo','$summary','$content','$publish_date','$admin_add_id','$date_created')");
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