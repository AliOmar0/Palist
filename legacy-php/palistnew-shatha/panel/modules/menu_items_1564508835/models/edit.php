<?php
//validate fields if required
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
		|| !isset($_POST['id']) || $_POST['id']=="" 
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;

//escape parameters
$id=e('id');

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

//update entry in database
try{
	mysqli_query($conn,"UPDATE $_module SET module_prefix='$module_prefix',item_id='$item_id',custom_title='$custom_title',custom_link='$custom_link',open_new_window='$open_new_window',points_to_home='$points_to_home',module_field='$module_field',order_num='$order_num',sub_of='$sub_of',menu_key='$menu_key',date_modified='$date_modified' WHERE id='$id' LIMIT 1");
}
catch(mysqli_sql_exception $e){
	json(false,3);
}
	
	
if($internal_forced)$_POST['internal']=true;
require core_dir.'preModelResponse.php';	
require custom_dir.'custom_module_response.php';
//ajaxly saved
json(true,2);