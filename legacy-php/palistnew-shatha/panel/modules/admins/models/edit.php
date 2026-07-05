<?php
//validate fields if required
$_module='admins';
validateFields($_module,$action);

if(
		!isset($_POST['username']) || $_POST['username']==""||
		!isset($_POST['email']) || $_POST['email']==""||
		!isset($_POST['phone'])||
		!isset($_POST['first_name'])||
		!isset($_POST['last_name'])||
		!isset($_POST['position'])||
		!isset($_POST['language_id']) || $_POST['language_id']==""
		|| !isset($_POST['id']) || $_POST['id']=="" 
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;

//escape parameters
$id=e('id');

$username=e('username');
if(isset($_POST['password']) && $_POST['password']!=""){
checkPassword($_POST['password']);
$password=e('password');
$password=password_hash($password, PASSWORD_DEFAULT);
$password="'$password'";
}
else $password='password';


			
$email=e('email');
$phone=e('phone');
$first_name=e('first_name');
$last_name=e('last_name');
$position=e('position');
$language_id=e('language_id');
$country=e('country');
$menu_style=(isset($_POST['menu_style']) ? e('menu_style') : '');
			
if(isset($_FILES['photo']['name'][0]) && $_FILES['photo']['name'][0]!=NULL) {
	 $photo=escape(upload_file('single','photo',$settings['photo'],target_dir,$_module,false));
	 $photo="'$photo'";
	}
else if(isset($_POST['del_photo']))$photo="''";
else if(!isset($_FILES['photo']['name'][0]) || $_FILES['photo']['name'][0]==NULL) $photo='photo';

	
$dark_mode=(isset($_POST['dark_mode'])  && $_POST['dark_mode']!='0' ? 1 : 0);
			

//update entry in database
try{
	mysqli_query($conn,"UPDATE $_module SET username='$username',password=$password,email='$email',phone='$phone',first_name='$first_name',last_name='$last_name',position='$position',language_id='$language_id',country='$country',menu_style='$menu_style',photo=$photo,dark_mode='$dark_mode',date_modified='$date_modified' WHERE id='$id' LIMIT 1");
}
catch(mysqli_sql_exception $e){
	json(false,3);
}
	ownRelatedFiles($_module,$id);
	
if($internal_forced)$_POST['internal']=true;
require core_dir.'preModelResponse.php';	
require custom_dir.'custom_module_response.php';
json(true,2,NULL,NULL,['js'=>'refresh']);