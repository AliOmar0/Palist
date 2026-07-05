<?php
//validate fields if required
$_module='connections_1565698558';
validateFields($_module,$action);

if(
		!isset($_POST['g_analytics'])||
		!isset($_POST['facebook_page_id'])||
		!isset($_POST['facebook_chat_color'])||
		!isset($_POST['fb_app_id'])||
		!isset($_POST['fb_app_secret_key'])||
		!isset($_POST['fb_app_analytics'])||
		!isset($_POST['fb_pixel'])||
		!isset($_POST['onesignal_app_id'])||
		!isset($_POST['onesignal_app_secret_key'])||
		!isset($_POST['firebase_file_name'])||
		!isset($_POST['sharethis'])||
		!isset($_POST['head_js'])||
		!isset($_POST['footer_js'])
		|| !isset($_POST['id']) || $_POST['id']=="" 
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;

//escape parameters
$id=e('id');

$g_analytics=e('g_analytics');
$facebook_page_id=e('facebook_page_id');
$facebook_chat_color=e('facebook_chat_color');
$fb_app_id=e('fb_app_id');
$fb_app_secret_key=e('fb_app_secret_key');
$fb_app_analytics=e('fb_app_analytics');
$fb_pixel=e('fb_pixel');
$onesignal_app_id=e('onesignal_app_id');
$onesignal_app_secret_key=e('onesignal_app_secret_key');
$firebase_file_name=e('firebase_file_name');
$sharethis=e('sharethis');
$head_js=e('head_js');
$footer_js=e('footer_js');

//update entry in database
try{
	mysqli_query($conn,"UPDATE $_module SET g_analytics='$g_analytics',facebook_page_id='$facebook_page_id',facebook_chat_color='$facebook_chat_color',fb_app_id='$fb_app_id',fb_app_secret_key='$fb_app_secret_key',fb_app_analytics='$fb_app_analytics',fb_pixel='$fb_pixel',onesignal_app_id='$onesignal_app_id',onesignal_app_secret_key='$onesignal_app_secret_key',firebase_file_name='$firebase_file_name',sharethis='$sharethis',head_js='$head_js',footer_js='$footer_js',date_modified='$date_modified' WHERE id='$id' LIMIT 1");
}
catch(mysqli_sql_exception $e){
	json(false,3);
}
	
	
if($internal_forced)$_POST['internal']=true;
require core_dir.'preModelResponse.php';	
require custom_dir.'custom_module_response.php';
//ajaxly saved
json(true,2);