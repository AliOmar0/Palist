<?php
//Validate required fields
$_module='countries_1556139283';
validateFields($_module,$action);

if(
	!isset($_POST['title']) || $_POST['title']==""||
	!isset($_POST['flag'])||
	!isset($_POST['alpha_2_code']) || $_POST['alpha_2_code']==""||
	!isset($_POST['alpha_3_code']) || $_POST['alpha_3_code']==""||
	!isset($_POST['nationality']) || $_POST['nationality']==""||
	!isset($_POST['phone_code']) || $_POST['phone_code']==""||
	!isset($_POST['currency_name'])||
	!isset($_POST['currency_shortname'])||
	!isset($_POST['currency_symbol'])
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;
//Escape
$title=e('title');
$active=(isset($_POST['active'])  && $_POST['active']!='0' ? 1 : 0);
			
$flag=e('flag');
$alpha_2_code=e('alpha_2_code');
$alpha_3_code=e('alpha_3_code');
$nationality=e('nationality');
$phone_code=e('phone_code');
$currency_name=e('currency_name');
$currency_shortname=e('currency_shortname');
$currency_symbol=e('currency_symbol');


//add to database
try{
	mysqli_query($conn,"INSERT INTO $_module (title,active,flag,alpha_2_code,alpha_3_code,nationality,phone_code,currency_name,currency_shortname,currency_symbol,admin_add_id,date_created) VALUES ('$title','$active','$flag','$alpha_2_code','$alpha_3_code','$nationality','$phone_code','$currency_name','$currency_shortname','$currency_symbol','$admin_add_id','$date_created')");
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