<?php require'core/config.php';

$module=escape($_GET['module']);
$action=escape($_GET['action']);
$_POST['id']=$_GET['id'];
//if($action=='add'){
//	mysqli_query();
//	$_GET['id']=mysqli_insert_id($conn);
//	$action='edit';
//}
$clustering=true;
include modules_dir.$module.'/views/'.$action.'.php';

//
//$_GET['id']=2;
//include modules_dir.'income_lines_1567209735/views/edit.php';