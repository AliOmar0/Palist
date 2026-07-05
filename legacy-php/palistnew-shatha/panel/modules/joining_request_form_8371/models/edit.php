<?php
//validate fields if required
$_module='joining_request_form_8371';
validateFields($_module,$action);

if(
		!isset($_POST['email_address']) || $_POST['email_address']==""||
		!isset($_POST['confirm_email_address']) || $_POST['confirm_email_address']==""||
		!isset($_POST['full_name']) || $_POST['full_name']==""||
		!isset($_POST['full_name_en']) || $_POST['full_name_en']==""||
		!isset($_POST['id_number']) || $_POST['id_number']==""||
		!isset($_POST['gender']) || $_POST['gender']==""||
		!isset($_POST['mobile_number']) || $_POST['mobile_number']==""||
		!isset($_POST['palce_of_birth']) || $_POST['palce_of_birth']==""||
		!isset($_POST['date_of_birth']) || $_POST['date_of_birth']==""||
		!isset($_POST['social_situation']) || $_POST['social_situation']==""||
		!isset($_POST['province_residence']) || $_POST['province_residence']==""||
		!isset($_POST['governorate_abroad'])||
		!isset($_POST['mother_province']) || $_POST['mother_province']==""||
		!isset($_POST['home_adress']) || $_POST['home_adress']==""||
		!isset($_POST['branch']) || $_POST['branch']==""||
		!isset($_POST['average']) || $_POST['average']==""||
		!isset($_POST['graduation_year']) || $_POST['graduation_year']==""||
		!isset($_POST['country']) || $_POST['country']==""
		|| !isset($_POST['id']) || $_POST['id']=="" 
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;

//escape parameters
$id=e('id');

$user=e('user');
$active=(isset($_POST['active'])  && $_POST['active']!='0' ? 1 : 0);
			
$submitted=(isset($_POST['submitted'])  && $_POST['submitted']!='0' ? 1 : 0);
			
$email_address=e('email_address');
$confirm_email_address=e('confirm_email_address');
$full_name=e('full_name');
$full_name_en=e('full_name_en');
$id_number=e('id_number');
$gender=e('gender');
$mobile_number=e('mobile_number');
$palce_of_birth=e('palce_of_birth');
$date_of_birth=e('date_of_birth');
$social_situation=e('social_situation');
$province_residence=e('province_residence');
$governorate_abroad=e('governorate_abroad');
$mother_province=e('mother_province');
$home_adress=e('home_adress');
$branch=e('branch');
$average=e('average');
$graduation_year=e('graduation_year');
$country=e('country');
if(isset($_FILES['all_attested']['name'][0]) && $_FILES['all_attested']['name'][0]!=NULL) {
	 $all_attested=escape(upload_file('multiple','all_attested',$settings['file'],target_dir,$_module,false));
	 $all_attested="'$all_attested'";
	}
else if(isset($_POST['del_all_attested']))$all_attested="''";
else if(!isset($_FILES['all_attested']['name'][0]) || $_FILES['all_attested']['name'][0]==NULL) $all_attested='all_attested';

	
if((!isset($_FILES['all_attested']) || $_FILES['all_attested']['name'][0]==NULL) && isset($_POST['del_all_attested']))json(false);
			
if(isset($_FILES['proof_passport']['name'][0]) && $_FILES['proof_passport']['name'][0]!=NULL) {
	 $proof_passport=escape(upload_file('single','proof_passport',$settings['file'],target_dir,$_module,false));
	 $proof_passport="'$proof_passport'";
	}
else if(isset($_POST['del_proof_passport']))$proof_passport="''";
else if(!isset($_FILES['proof_passport']['name'][0]) || $_FILES['proof_passport']['name'][0]==NULL) $proof_passport='proof_passport';

	
if((!isset($_FILES['proof_passport']) || $_FILES['proof_passport']['name'][0]==NULL) && isset($_POST['del_proof_passport']))json(false);
			
if(isset($_FILES['high_attested']['name'][0]) && $_FILES['high_attested']['name'][0]!=NULL) {
	 $high_attested=escape(upload_file('single','high_attested',$settings['file'],target_dir,$_module,false));
	 $high_attested="'$high_attested'";
	}
else if(isset($_POST['del_high_attested']))$high_attested="''";
else if(!isset($_FILES['high_attested']['name'][0]) || $_FILES['high_attested']['name'][0]==NULL) $high_attested='high_attested';

	
if((!isset($_FILES['high_attested']) || $_FILES['high_attested']['name'][0]==NULL) && isset($_POST['del_high_attested']))json(false);
			
if(isset($_FILES['certificate_conduct']['name'][0]) && $_FILES['certificate_conduct']['name'][0]!=NULL) {
	 $certificate_conduct=escape(upload_file('single','certificate_conduct',$settings['file'],target_dir,$_module,false));
	 $certificate_conduct="'$certificate_conduct'";
	}
else if(isset($_POST['del_certificate_conduct']))$certificate_conduct="''";
else if(!isset($_FILES['certificate_conduct']['name'][0]) || $_FILES['certificate_conduct']['name'][0]==NULL) $certificate_conduct='certificate_conduct';

	
if((!isset($_FILES['certificate_conduct']) || $_FILES['certificate_conduct']['name'][0]==NULL) && isset($_POST['del_certificate_conduct']))json(false);
			
if(isset($_FILES['work_proof']['name'][0]) && $_FILES['work_proof']['name'][0]!=NULL) {
	 $work_proof=escape(upload_file('single','work_proof',$settings['file'],target_dir,$_module,false));
	 $work_proof="'$work_proof'";
	}
else if(isset($_POST['del_work_proof']))$work_proof="''";
else if(!isset($_FILES['work_proof']['name'][0]) || $_FILES['work_proof']['name'][0]==NULL) $work_proof='work_proof';

	
if(isset($_FILES['bank_receipt']['name'][0]) && $_FILES['bank_receipt']['name'][0]!=NULL) {
	 $bank_receipt=escape(upload_file('single','bank_receipt',$settings['file'],target_dir,$_module,false));
	 $bank_receipt="'$bank_receipt'";
	}
else if(isset($_POST['del_bank_receipt']))$bank_receipt="''";
else if(!isset($_FILES['bank_receipt']['name'][0]) || $_FILES['bank_receipt']['name'][0]==NULL) $bank_receipt='bank_receipt';

	
if((!isset($_FILES['bank_receipt']) || $_FILES['bank_receipt']['name'][0]==NULL) && isset($_POST['del_bank_receipt']))json(false);
			
$confirm_that=(isset($_POST['confirm_that'])  && $_POST['confirm_that']!='0' ? 1 : 0);
			

//update entry in database
try{
	mysqli_query($conn,"UPDATE $_module SET user='$user',active='$active',submitted='$submitted',email_address='$email_address',confirm_email_address='$confirm_email_address',full_name='$full_name',full_name_en='$full_name_en',id_number='$id_number',gender='$gender',mobile_number='$mobile_number',palce_of_birth='$palce_of_birth',date_of_birth='$date_of_birth',social_situation='$social_situation',province_residence='$province_residence',governorate_abroad='$governorate_abroad',mother_province='$mother_province',home_adress='$home_adress',branch='$branch',average='$average',graduation_year='$graduation_year',country='$country',all_attested=$all_attested,proof_passport=$proof_passport,high_attested=$high_attested,certificate_conduct=$certificate_conduct,work_proof=$work_proof,bank_receipt=$bank_receipt,confirm_that='$confirm_that',date_modified='$date_modified' WHERE id='$id' LIMIT 1");
}
catch(mysqli_sql_exception $e){
	json(false,3);
}
	ownRelatedFiles($_module,$id);
	
if($internal_forced)$_POST['internal']=true;
require core_dir.'preModelResponse.php';	
require custom_dir.'custom_module_response.php';
json(true,2,NULL,NULL,['js'=>'refresh']);