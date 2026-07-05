<?php
//Validate required fields
$_module='menu_items_1564508835';
validateFields($_module,$action);

if(
	!isset($_POST['module_prefix'])||
	!isset($_POST['item_id'])||
	!isset($_POST['custom_title'])||
	!isset($_POST['custom_link'])||
	!isset($_POST['module_field'])||
	!isset($_POST['order_num'])||
	!isset($_POST['sub_of'])
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;
//Escape
$module_prefix=e('module_prefix');
$item_id=e('item_id');
$custom_title=e('custom_title');
$custom_link=e('custom_link');
$open_new_window=(isset($_POST['open_new_window'])  && $_POST['open_new_window']!='0' ? 1 : 0);
			
$points_to_home=(isset($_POST['points_to_home'])  && $_POST['points_to_home']!='0' ? 1 : 0);
			
$module_field=e('module_field');
$order_num=e('order_num');
$sub_of=e('sub_of');
$menu_key=e('menu_key');


//add to database
try{
	mysqli_query($conn,"INSERT INTO $_module (module_prefix,item_id,custom_title,custom_link,open_new_window,points_to_home,module_field,order_num,sub_of,menu_key,admin_add_id,date_created) VALUES ('$module_prefix','$item_id','$custom_title','$custom_link','$open_new_window','$points_to_home','$module_field','$order_num','$sub_of','$menu_key','$admin_add_id','$date_created')");
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