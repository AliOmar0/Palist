<?php
//Validate required fields
$_module='mailer_1565894237';
validateFields($_module,$action);

if(
	!isset($_POST['email_title'])||
	!isset($_POST['from_email'])||
	!isset($_POST['to_email']) || $_POST['to_email']==""||
	!isset($_POST['cc_email'])||
	!isset($_POST['bcc_email'])||
	!isset($_POST['reply_email'])||
	!isset($_POST['content'])||
	!isset($_POST['extra_css'])
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;
//Escape
$email_title=e('email_title');
$module_id=e('module_id');
$module_action=e('module_action');
$from_email=e('from_email');
$include_site_name=(isset($_POST['include_site_name'])  && $_POST['include_site_name']!='0' ? 1 : 0);
			
$to_email=e('to_email');
$cc_email=e('cc_email');
$bcc_email=e('bcc_email');
$reply_email=e('reply_email');
$content=e('content');
$extra_css=e('extra_css');


//add to database
try{
	mysqli_query($conn,"INSERT INTO $_module (email_title,module_id,module_action,from_email,include_site_name,to_email,cc_email,bcc_email,reply_email,content,extra_css,admin_add_id,date_created) VALUES ('$email_title','$module_id','$module_action','$from_email','$include_site_name','$to_email','$cc_email','$bcc_email','$reply_email','$content','$extra_css','$admin_add_id','$date_created')");
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