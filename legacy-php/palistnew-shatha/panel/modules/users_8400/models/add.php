<?php
//Validate required fields
$_module='users_8400';
validateFields($_module,$action);

if(
	!isset($_POST['username']) || $_POST['username']==""||
	!isset($_POST['password']) || $_POST['password']==""||
	!isset($_POST['email_address']) || $_POST['email_address']==""||
	!isset($_POST['full_name']) || $_POST['full_name']==""||
	!isset($_POST['full_name_en']) || $_POST['full_name_en']==""||
	!isset($_POST['date_of_birth']) || $_POST['date_of_birth']==""||
	!isset($_POST['province']) || $_POST['province']==""||
	!isset($_POST['id_number']) || $_POST['id_number']==""||
	!isset($_POST['gender']) || $_POST['gender']==""||
	!isset($_POST['specialization']) || $_POST['specialization']==""||
	!isset($_POST['organisation'])||
	!isset($_POST['work_nature'])
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;
//Escape
$username=e('username');
checkPassword($_POST['password']);
$password_unhashed=e('password');
$password=password_hash($password_unhashed, PASSWORD_DEFAULT);

			
$email_address=e('email_address');
if(!isset($_FILES['profile_photo']) || $_FILES['profile_photo']['name'][0]==NULL) $profile_photo='profile_photo';
else {
	 $profile_photo=escape(upload_file('single','profile_photo',$settings['photo'],target_dir,$_module,false));
	 $profile_photo="'$profile_photo'";
	}
			
$active=(isset($_POST['active'])  && $_POST['active']!='0' ? 1 : 0);
			
$full_name=e('full_name');
$full_name_en=e('full_name_en');
$date_of_birth=e('date_of_birth');
$province=e('province');
$id_number=e('id_number');
$gender=e('gender');
$employment_status=e('employment_status');
$organisation=e('organisation');
$business_type=e('business_type');
$work_nature=e('work_nature');


//add to database
try{
	mysqli_query($conn,"INSERT INTO $_module (username,password,email_address,profile_photo,active,full_name,full_name_en,date_of_birth,province,id_number,gender,employment_status,organisation,business_type,work_nature,admin_add_id,date_created) VALUES ('$username','$password','$email_address',$profile_photo,'$active','$full_name','$full_name_en','$date_of_birth','$province','$id_number','$gender','$employment_status','$organisation','$business_type','$work_nature','$admin_add_id','$date_created')");
}
catch(mysqli_sql_exception $e){
	json(false,3);
}
	
$prime_last_id=$last_id=mysqli_insert_id($conn);
ownRelatedFiles($_module,$prime_last_id);
	
//exit model
		
//complementary module
$this_last_id=$last_id;
if(isset($_POST['specialization']) && $_POST['specialization']!=NULL && $_POST['specialization'][0]!=NULL && count($_POST['specialization'])>0 && $_POST['specialization'][0]!='' && $_POST['specialization'][0]!='0'){
	if(isset($internal_forced))$original_internal_forced=$internal_forced;
	$original_prime_last_id=$prime_last_id;
	$_POST['mother_module_prefix']=mid('users_8400');
	$_POST['mother_id']=$this_last_id;
	$_POST['child_module_prefix']=mid('majors_8367');
	foreach($_POST['specialization'] as $donut){
		$_POST['internal']=true;
		$_POST['child_id']=$donut;
		require(modules_dir.'complementary_1614118171/models/add.php');
	}
	$internal_forced=$original_internal_forced;
	$prime_last_id=$original_prime_last_id;
}
if($internal_forced)$_POST['internal']=true;
$last_id=$prime_last_id;
require core_dir.'preModelResponse.php';
require custom_dir.'custom_module_response.php';
json(true,2,NULL,NULL,array('url'=>returnUrl(),'js'=>'redirect'));