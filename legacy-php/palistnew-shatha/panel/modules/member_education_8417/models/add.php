<?php
//Validate required fields
$_module='member_education_8417';
validateFields($_module,$action);

if(
	!isset($_POST['related_id'])||
	!isset($_POST['name_degree'])||
	!isset($_POST['college_name'])||
	!isset($_POST['specializationin_arabic'])||
	!isset($_POST['specializationin_english'])||
	!isset($_POST['university_year'])||
	!isset($_POST['appreciation'])
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;
//Escape
$related_id=e('related_id');
$name_degree=e('name_degree');
$college_name=e('college_name');
$specializationin_arabic=e('specializationin_arabic');
$specializationin_english=e('specializationin_english');
$university_year=e('university_year');
$undergraduate_degree=e('undergraduate_degree');
$appreciation=e('appreciation');
$university_country=e('university_country');


//add to database
try{
	mysqli_query($conn,"INSERT INTO $_module (related_id,name_degree,college_name,specializationin_arabic,specializationin_english,university_year,undergraduate_degree,appreciation,university_country,admin_add_id,date_created) VALUES ('$related_id','$name_degree','$college_name','$specializationin_arabic','$specializationin_english','$university_year','$undergraduate_degree','$appreciation','$university_country','$admin_add_id','$date_created')");
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