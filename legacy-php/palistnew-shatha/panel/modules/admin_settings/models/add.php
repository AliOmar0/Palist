<?php
//Validate required fields
$_module='admin_settings';
validateFields($_module,$action);

if(true != true
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;
//Escape
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
			


//add to database
try{
	mysqli_query($conn,"INSERT INTO $_module (admin,status_report,storage,datetime,todo,app_links,grid_dashboard,colors_palette,translations,front_control_options,sitemap_info,admin_add_id,date_created) VALUES ('$admin','$status_report','$storage','$datetime','$todo','$app_links','$grid_dashboard','$colors_palette','$translations','$front_control_options','$sitemap_info','$admin_add_id','$date_created')");
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