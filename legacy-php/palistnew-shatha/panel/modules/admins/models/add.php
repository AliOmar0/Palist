<?php
//Validate required fields
$_module='admins';
validateFields($_module,$action);

if(
	!isset($_POST['username']) || $_POST['username']==""||
	!isset($_POST['password']) || $_POST['password']==""||
	!isset($_POST['email']) || $_POST['email']==""||
	!isset($_POST['phone'])||
	!isset($_POST['first_name'])||
	!isset($_POST['last_name'])||
	!isset($_POST['position'])||
	!isset($_POST['language_id']) || $_POST['language_id']==""
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;
//Escape
$username=e('username');
checkPassword($_POST['password']);
$password_unhashed=e('password');
$password=password_hash($password_unhashed, PASSWORD_DEFAULT);

			
$email=e('email');
$phone=e('phone');
$first_name=e('first_name');
$last_name=e('last_name');
$position=e('position');
$language_id=e('language_id');
$country=e('country');
$menu_style=(isset($_POST['menu_style']) ? e('menu_style') : '');
			
if(!isset($_FILES['photo']) || $_FILES['photo']['name'][0]==NULL) $photo='photo';
else {
	 $photo=escape(upload_file('single','photo',$settings['photo'],target_dir,$_module,false));
	 $photo="'$photo'";
	}
			
$dark_mode=(isset($_POST['dark_mode'])  && $_POST['dark_mode']!='0' ? 1 : 0);
			


//add to database
try{
	mysqli_query($conn,"INSERT INTO $_module (username,password,email,phone,first_name,last_name,position,language_id,country,menu_style,photo,dark_mode,admin_add_id,date_created) VALUES ('$username','$password','$email','$phone','$first_name','$last_name','$position','$language_id','$country','$menu_style',$photo,'$dark_mode','$admin_add_id','$date_created')");
}
catch(mysqli_sql_exception $e){
	json(false,3);
}
	
$prime_last_id=$last_id=mysqli_insert_id($conn);
ownRelatedFiles($_module,$prime_last_id);
	
//exit model
if($internal_forced)$_POST['internal']=true;
$last_id=$prime_last_id;
require core_dir.'preModelResponse.php';
require custom_dir.'custom_module_response.php';
json(true,2,NULL,NULL,array('url'=>returnUrl(),'js'=>'redirect'));