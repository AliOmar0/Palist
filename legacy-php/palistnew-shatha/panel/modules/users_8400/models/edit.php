<?php
//validate fields if required
$_module='users_8400';
validateFields($_module,$action);

if(
		!isset($_POST['username']) || $_POST['username']==""||
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


			
$email_address=e('email_address');
if(isset($_FILES['profile_photo']['name'][0]) && $_FILES['profile_photo']['name'][0]!=NULL) {
	 $profile_photo=escape(upload_file('single','profile_photo',$settings['photo'],target_dir,$_module,false));
	 $profile_photo="'$profile_photo'";
	}
else if(isset($_POST['del_profile_photo']))$profile_photo="''";
else if(!isset($_FILES['profile_photo']['name'][0]) || $_FILES['profile_photo']['name'][0]==NULL) $profile_photo='profile_photo';

	
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

//update entry in database
try{
	mysqli_query($conn,"UPDATE $_module SET username='$username',password=$password,email_address='$email_address',profile_photo=$profile_photo,active='$active',full_name='$full_name',full_name_en='$full_name_en',date_of_birth='$date_of_birth',province='$province',id_number='$id_number',gender='$gender',employment_status='$employment_status',organisation='$organisation',business_type='$business_type',work_nature='$work_nature',date_modified='$date_modified' WHERE id='$id' LIMIT 1");
}
catch(mysqli_sql_exception $e){
	json(false,3);
}
	ownRelatedFiles($_module,$id);
	
		
		
//complementary module
$this_last_id=$id;
#delete all previous entries

mysqli_query($conn,"DELETE FROM complementary_1614118171 WHERE mother_module_prefix='".mid('users_8400')."' AND mother_id='$this_last_id' AND child_module_prefix='".mid('majors_8367')."'");

if(isset($_POST['specialization']) && isset($_POST['specialization']) && $_POST['specialization']!=NULL && $_POST['specialization'][0]!=NULL && count($_POST['specialization'])>0 && $_POST['specialization'][0]!='' && $_POST['specialization'][0]!='0'){
	if(isset($internal_forced))$original_internal_forced=$internal_forced;
	$_POST['mother_module_prefix']=mid('users_8400');
	$_POST['mother_id']=$this_last_id;
	$_POST['child_module_prefix']=mid('majors_8367');
	foreach($_POST['specialization'] as $donut){
		$_POST['internal']=true;
		$_POST['child_id']=$donut;
		require(modules_dir.'complementary_1614118171/models/add.php');
	}
	$internal_forced=$original_internal_forced;
}
if($internal_forced)$_POST['internal']=true;
require core_dir.'preModelResponse.php';	
require custom_dir.'custom_module_response.php';
json(true,2,NULL,NULL,['js'=>'refresh']);