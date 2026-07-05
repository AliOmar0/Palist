<?php
//validate fields if required
$_module='admin_settings';
validateFields($_module,$action);

if(true != true
		|| !isset($_POST['id']) || $_POST['id']=="" 
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;

//escape parameters
$id=e('id');

$admin=e('admin');
$status_report=(isset($_POST['status_report'])  && $_POST['status_report']!='0' ? 1 : 0);
			
$storage=(isset($_POST['storage'])  && $_POST['storage']!='0' ? 1 : 0);
			
$datetime=(isset($_POST['datetime'])  && $_POST['datetime']!='0' ? 1 : 0);
			
$todo=(isset($_POST['todo'])  && $_POST['todo']!='0' ? 1 : 0);
			
$app_links=(isset($_POST['app_links'])  && $_POST['app_links']!='0' ? 1 : 0);
			
$grid_dashboard=(isset($_POST['grid_dashboard'])  && $_POST['grid_dashboard']!='0' ? 1 : 0);
			
$colors_palette=(isset($_POST['colors_palette'])  && $_POST['colors_palette']!='0' ? 1 : 0);
			
$translations=(isset($_POST['translations'])  && $_POST['translations']!='0' ? 1 : 0);
			
$front_control_options=(isset($_POST['front_control_options'])  && $_POST['front_control_options']!='0' ? 1 : 0);
			
$sitemap_info=(isset($_POST['sitemap_info'])  && $_POST['sitemap_info']!='0' ? 1 : 0);
			

//update entry in database
try{
	mysqli_query($conn,"UPDATE $_module SET admin='$admin',status_report='$status_report',storage='$storage',datetime='$datetime',todo='$todo',app_links='$app_links',grid_dashboard='$grid_dashboard',colors_palette='$colors_palette',translations='$translations',front_control_options='$front_control_options',sitemap_info='$sitemap_info',date_modified='$date_modified' WHERE id='$id' LIMIT 1");
}
catch(mysqli_sql_exception $e){
	json(false,3);
}
	
	
if($internal_forced)$_POST['internal']=true;
require core_dir.'preModelResponse.php';	
require custom_dir.'custom_module_response.php';
//ajaxly saved
json(true,2);