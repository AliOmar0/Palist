<?php
//validate fields if required
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
		|| !isset($_POST['id']) || $_POST['id']=="" 
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;

//escape parameters
$id=e('id');

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

//update entry in database
try{
	mysqli_query($conn,"UPDATE $_module SET email_title='$email_title',module_id='$module_id',module_action='$module_action',from_email='$from_email',include_site_name='$include_site_name',to_email='$to_email',cc_email='$cc_email',bcc_email='$bcc_email',reply_email='$reply_email',content='$content',extra_css='$extra_css',date_modified='$date_modified' WHERE id='$id' LIMIT 1");
}
catch(mysqli_sql_exception $e){
	json(false,3);
}
	
	
if($internal_forced)$_POST['internal']=true;
require core_dir.'preModelResponse.php';	
require custom_dir.'custom_module_response.php';
//ajaxly saved
json(true,2);