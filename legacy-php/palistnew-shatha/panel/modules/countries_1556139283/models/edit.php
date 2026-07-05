<?php
//validate fields if required
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
		|| !isset($_POST['id']) || $_POST['id']=="" 
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;

//escape parameters
$id=e('id');

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

//update entry in database
try{
	mysqli_query($conn,"UPDATE $_module SET title='$title',active='$active',flag='$flag',alpha_2_code='$alpha_2_code',alpha_3_code='$alpha_3_code',nationality='$nationality',phone_code='$phone_code',currency_name='$currency_name',currency_shortname='$currency_shortname',currency_symbol='$currency_symbol',date_modified='$date_modified' WHERE id='$id' LIMIT 1");
}
catch(mysqli_sql_exception $e){
	json(false,3);
}
	
	
if($internal_forced)$_POST['internal']=true;
require core_dir.'preModelResponse.php';	
require custom_dir.'custom_module_response.php';
//ajaxly saved
json(true,2);