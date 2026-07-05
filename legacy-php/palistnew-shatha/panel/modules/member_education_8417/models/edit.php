<?php
//validate fields if required
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
		|| !isset($_POST['id']) || $_POST['id']=="" 
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;

//escape parameters
$id=e('id');

$related_id=e('related_id');
$name_degree=e('name_degree');
$college_name=e('college_name');
$specializationin_arabic=e('specializationin_arabic');
$specializationin_english=e('specializationin_english');
$university_year=e('university_year');
$undergraduate_degree=e('undergraduate_degree');
$appreciation=e('appreciation');
$university_country=e('university_country');

//update entry in database
try{
	mysqli_query($conn,"UPDATE $_module SET related_id='$related_id',name_degree='$name_degree',college_name='$college_name',specializationin_arabic='$specializationin_arabic',specializationin_english='$specializationin_english',university_year='$university_year',undergraduate_degree='$undergraduate_degree',appreciation='$appreciation',university_country='$university_country',date_modified='$date_modified' WHERE id='$id' LIMIT 1");
}
catch(mysqli_sql_exception $e){
	json(false,3);
}
	
	
if($internal_forced)$_POST['internal']=true;
require core_dir.'preModelResponse.php';	
require custom_dir.'custom_module_response.php';
//ajaxly saved
json(true,2);