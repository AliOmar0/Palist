<?php if(!privilege('joining_request_form_8371','add'))echo $noPermission;else{?>
<form id="joining_request_form_8371" autocomplete="off" action="" onsubmit="return submitter(this,'<?=isset($controllerURL)? $controllerURL:urlPanel?>');" method="post" enctype="multipart/form-data">
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="joining_request_form_8371"/> 
<input type="hidden" name="action" value="add"/>
<!--inputs below --> 
<!--
	

--><div class="form_field onfour in joining_request_form_8371_user" data-legion-field-type="select">
<label for="for_field_user"><?=l('User<>');?></label>
<div class="input_area">
<select  id="for_field_user" class="main_color_bg whiteFont" name="user">
<?php 
$addition_where=NULL;

$_form_resp=db('users_8400',"WHERE deleted=0   $addition_where",NULL,NULL);
			if($_form_resp==0){?><option value="0" selected><?=l('Error<>خطأ')?></option> <?php } 
			else if($_form_resp==1){?><option value="0" selected><?=l('Choose<>اختر');?></option><?php } 
				else {?>
                    <option value="0"><?=l('Choose<>اختر');?></option>
					<?php 
					$echoFields='username';
                    $x=explode(',',$echoFields);
					if($_form_resp!=1){
						for($_i=0;$_i<count($_form_resp);$_i++){?>
						<option value="<?=$_form_resp[$_i]['id']?>"><?php
						for($e=0;$e<count($x);$e++){
							if($x[$e]=='-')echo ' -';
							else {
								if($e!=0)echo ' ';
								echo l($_form_resp[$_i][$x[$e]]); 
							}
						 }
						 ?></option>
						
						<?php 
							}//for
						}
					}//else
					unset($_form_resp);
					?>
			</select>
			
</div>
</div><!--


	

--><div class="form_field onfour in joining_request_form_8371_active" data-legion-field-type="checkbox">
<label for="for_field_active"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input   class="css-checkbox" type="checkbox" name="active"  id="<?=$rand='a'.rand(); ?>" />
			<label for="<?=$rand?>"><?=l('Active<>');?></label></div></div></div>
</div>
</div><!--


	

--><div class="form_field onfour in joining_request_form_8371_submitted" data-legion-field-type="checkbox">
<label for="for_field_submitted"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input   class="css-checkbox" type="checkbox" name="submitted"  id="<?=$rand='a'.rand(); ?>" />
			<label for="<?=$rand?>"><?=l('Submitted<>');?></label></div></div></div>
</div>
</div><!--

--><div class="big_group_wrap joining_request_form_8371_personalinformation"><div class="big_group"><?=l('personal information<>المعلومات الشخصية')?></div></div><!--
	

--><div class="form_field onfour in joining_request_form_8371_email_address" data-legion-field-type="email">
<label for="for_field_email_address"><?=l('Email Address<>عنوان البريد الالكتروني');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_email_address"  required type="email"  data-legion-module="joining_request_form_8371" name="email_address" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field onfour in joining_request_form_8371_confirm_email_address" data-legion-field-type="email">
<label for="for_field_confirm_email_address"><?=l('Confirm Email Address<>تأكيد عنوان البريد الالكتروني');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_confirm_email_address"  required type="email"  data-legion-module="joining_request_form_8371" name="confirm_email_address" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field onfour in joining_request_form_8371_full_name" data-legion-field-type="text">
<label for="for_field_full_name"><?=l('Full Name(In Arabic)<>الاسم الرباعي');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_full_name"  required type="text"  data-legion-module="joining_request_form_8371" name="full_name" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field onfour in joining_request_form_8371_full_name_en" data-legion-field-type="text">
<label for="for_field_full_name_en"><?=l('Full Name(In English)<>الاسم الرباعي');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_full_name_en"  required type="text"  data-legion-module="joining_request_form_8371" name="full_name_en" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field onfour in joining_request_form_8371_id_number" data-legion-field-type="number">
<label for="for_field_id_number"><?=l('Id Number<>رقم الهوية');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_id_number"  required type="number"  data-legion-module="joining_request_form_8371" name="id_number" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field onfour in joining_request_form_8371_gender" data-legion-field-type="select">
<label for="for_field_gender"><?=l('Gender<>الجنس');?> <span class="required_star">*</span></label>
<div class="input_area">
<select  required id="for_field_gender" class="main_color_bg whiteFont" name="gender">
<?php 
$addition_where=NULL;

$_form_resp=db('gender_8371',"WHERE deleted=0   $addition_where",NULL,NULL);
			if($_form_resp==0){?><option value="0" selected><?=l('Error<>خطأ')?></option> <?php } 
			else if($_form_resp==1){?><option value="0" selected><?=l('Choose<>اختر');?></option><?php } 
				else {?>
                    <option value=""><?=l('Choose<>اختر');?></option>
					<?php 
					$echoFields='title';
                    $x=explode(',',$echoFields);
					if($_form_resp!=1){
						for($_i=0;$_i<count($_form_resp);$_i++){?>
						<option value="<?=$_form_resp[$_i]['id']?>"><?php
						for($e=0;$e<count($x);$e++){
							if($x[$e]=='-')echo ' -';
							else {
								if($e!=0)echo ' ';
								echo l($_form_resp[$_i][$x[$e]]); 
							}
						 }
						 ?></option>
						
						<?php 
							}//for
						}
					}//else
					unset($_form_resp);
					?>
			</select>
			
</div>
</div><!--


	

--><div class="form_field onfour in joining_request_form_8371_mobile_number" data-legion-field-type="number">
<label for="for_field_mobile_number"><?=l('Mobile Number<>رقم الموبايل');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_mobile_number"  required type="number"  data-legion-module="joining_request_form_8371" name="mobile_number" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field onfour in joining_request_form_8371_palce_of_birth" data-legion-field-type="text">
<label for="for_field_palce_of_birth"><?=l('Place of Birth<>مكان الميلاد');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_palce_of_birth"  required type="text"  data-legion-module="joining_request_form_8371" name="palce_of_birth" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field onfour in joining_request_form_8371_date_of_birth" data-legion-field-type="date">
<label for="for_field_date_of_birth"><?=l('Date of Birth<>تاريخ الميلاد');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_date_of_birth"  required type="date"  data-legion-module="joining_request_form_8371" name="date_of_birth" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field onfour in joining_request_form_8371_social_situation" data-legion-field-type="select">
<label for="for_field_social_situation"><?=l('Social Situation<>الحالة الاجتماعية');?> <span class="required_star">*</span></label>
<div class="input_area">
<select  required id="for_field_social_situation" class="main_color_bg whiteFont" name="social_situation">
<?php 
$addition_where=NULL;

$_form_resp=db('social_situation_8368',"WHERE deleted=0   $addition_where",NULL,NULL);
			if($_form_resp==0){?><option value="0" selected><?=l('Error<>خطأ')?></option> <?php } 
			else if($_form_resp==1){?><option value="0" selected><?=l('Choose<>اختر');?></option><?php } 
				else {?>
                    <option value=""><?=l('Choose<>اختر');?></option>
					<?php 
					$echoFields='title';
                    $x=explode(',',$echoFields);
					if($_form_resp!=1){
						for($_i=0;$_i<count($_form_resp);$_i++){?>
						<option value="<?=$_form_resp[$_i]['id']?>"><?php
						for($e=0;$e<count($x);$e++){
							if($x[$e]=='-')echo ' -';
							else {
								if($e!=0)echo ' ';
								echo l($_form_resp[$_i][$x[$e]]); 
							}
						 }
						 ?></option>
						
						<?php 
							}//for
						}
					}//else
					unset($_form_resp);
					?>
			</select>
			
</div>
</div><!--


	

--><div class="form_field onfour in joining_request_form_8371_province_residence" data-legion-field-type="select">
<label for="for_field_province_residence"><?=l('Province of current residence<> محافظة السكن الحالي');?> <span class="required_star">*</span></label>
<div class="input_area">
<select  required id="for_field_province_residence" class="main_color_bg whiteFont" name="province_residence">
<?php 
$addition_where=NULL;

$_form_resp=db('provinces_8371',"WHERE deleted=0   $addition_where",NULL,NULL);
			if($_form_resp==0){?><option value="0" selected><?=l('Error<>خطأ')?></option> <?php } 
			else if($_form_resp==1){?><option value="0" selected><?=l('Choose<>اختر');?></option><?php } 
				else {?>
                    <option value=""><?=l('Choose<>اختر');?></option>
					<?php 
					$echoFields='title';
                    $x=explode(',',$echoFields);
					if($_form_resp!=1){
						for($_i=0;$_i<count($_form_resp);$_i++){?>
						<option value="<?=$_form_resp[$_i]['id']?>"><?php
						for($e=0;$e<count($x);$e++){
							if($x[$e]=='-')echo ' -';
							else {
								if($e!=0)echo ' ';
								echo l($_form_resp[$_i][$x[$e]]); 
							}
						 }
						 ?></option>
						
						<?php 
							}//for
						}
					}//else
					unset($_form_resp);
					?>
			</select>
			
</div>
</div><!--


	

--><div class="form_field onfour in joining_request_form_8371_governorate_abroad" data-legion-field-type="text">
<label for="for_field_governorate_abroad"><?=l('Governorate in case of residence abroad<>المحافظة في حالة الاقامة بالخارج');?></label>
<div class="input_area">
<input id="for_field_governorate_abroad"  type="text"  data-legion-module="joining_request_form_8371" name="governorate_abroad" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field onfour in joining_request_form_8371_mother_province" data-legion-field-type="select">
<label for="for_field_mother_province"><?=l('Mother province<>المحافظة الأم');?> <span class="required_star">*</span></label>
<div class="input_area">
<select  required id="for_field_mother_province" class="main_color_bg whiteFont" name="mother_province">
<?php 
$addition_where=NULL;

$_form_resp=db('provinces_8371',"WHERE deleted=0   $addition_where",NULL,NULL);
			if($_form_resp==0){?><option value="0" selected><?=l('Error<>خطأ')?></option> <?php } 
			else if($_form_resp==1){?><option value="0" selected><?=l('Choose<>اختر');?></option><?php } 
				else {?>
                    <option value=""><?=l('Choose<>اختر');?></option>
					<?php 
					$echoFields='title';
                    $x=explode(',',$echoFields);
					if($_form_resp!=1){
						for($_i=0;$_i<count($_form_resp);$_i++){?>
						<option value="<?=$_form_resp[$_i]['id']?>"><?php
						for($e=0;$e<count($x);$e++){
							if($x[$e]=='-')echo ' -';
							else {
								if($e!=0)echo ' ';
								echo l($_form_resp[$_i][$x[$e]]); 
							}
						 }
						 ?></option>
						
						<?php 
							}//for
						}
					}//else
					unset($_form_resp);
					?>
			</select>
			
</div>
</div><!--


	

--><div class="form_field onfour in joining_request_form_8371_home_adress" data-legion-field-type="text">
<label for="for_field_home_adress"><?=l('Home Adress<> عنوان السكن');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_home_adress"  required type="text"  data-legion-module="joining_request_form_8371" name="home_adress" placeholder="" value=""/>
</div>
</div><!--

--><div class="big_group_wrap joining_request_form_8371_highschoolcertificate"><div class="big_group"><?=l('High School Certificate<>شهادة الثانوية العامة')?></div></div><!--
	

--><div class="form_field onfour in joining_request_form_8371_branch" data-legion-field-type="select">
<label for="for_field_branch"><?=l('Branch<>الفرع');?> <span class="required_star">*</span></label>
<div class="input_area">
<select  required id="for_field_branch" class="main_color_bg whiteFont" name="branch">
<?php 
$addition_where=NULL;

$_form_resp=db('branch_8371',"WHERE deleted=0   $addition_where",NULL,NULL);
			if($_form_resp==0){?><option value="0" selected><?=l('Error<>خطأ')?></option> <?php } 
			else if($_form_resp==1){?><option value="0" selected><?=l('Choose<>اختر');?></option><?php } 
				else {?>
                    <option value=""><?=l('Choose<>اختر');?></option>
					<?php 
					$echoFields='title';
                    $x=explode(',',$echoFields);
					if($_form_resp!=1){
						for($_i=0;$_i<count($_form_resp);$_i++){?>
						<option value="<?=$_form_resp[$_i]['id']?>"><?php
						for($e=0;$e<count($x);$e++){
							if($x[$e]=='-')echo ' -';
							else {
								if($e!=0)echo ' ';
								echo l($_form_resp[$_i][$x[$e]]); 
							}
						 }
						 ?></option>
						
						<?php 
							}//for
						}
					}//else
					unset($_form_resp);
					?>
			</select>
			
</div>
</div><!--


	

--><div class="form_field onfour in joining_request_form_8371_average" data-legion-field-type="number">
<label for="for_field_average"><?=l('Average<>المعدل');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_average"  required type="number"  data-legion-module="joining_request_form_8371" name="average" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field onfour in joining_request_form_8371_graduation_year" data-legion-field-type="number">
<label for="for_field_graduation_year"><?=l('Graduation Year<>سنة التخرج');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_graduation_year"  required type="number"  data-legion-module="joining_request_form_8371" name="graduation_year" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field onfour in joining_request_form_8371_country" data-legion-field-type="select">
<label for="for_field_country"><?=l('Country<>البلد');?> <span class="required_star">*</span></label>
<div class="input_area">
<select  required id="for_field_country" class="main_color_bg whiteFont" name="country">
<?php 
$addition_where=NULL;

$_form_resp=db('high_school_country_8371',"WHERE deleted=0   $addition_where",NULL,NULL);
			if($_form_resp==0){?><option value="0" selected><?=l('Error<>خطأ')?></option> <?php } 
			else if($_form_resp==1){?><option value="0" selected><?=l('Choose<>اختر');?></option><?php } 
				else {?>
                    <option value=""><?=l('Choose<>اختر');?></option>
					<?php 
					$echoFields='title';
                    $x=explode(',',$echoFields);
					if($_form_resp!=1){
						for($_i=0;$_i<count($_form_resp);$_i++){?>
						<option value="<?=$_form_resp[$_i]['id']?>"><?php
						for($e=0;$e<count($x);$e++){
							if($x[$e]=='-')echo ' -';
							else {
								if($e!=0)echo ' ';
								echo l($_form_resp[$_i][$x[$e]]); 
							}
						 }
						 ?></option>
						
						<?php 
							}//for
						}
					}//else
					unset($_form_resp);
					?>
			</select>
			
</div>
</div><!--

--><div class="big_group_wrap joining_request_form_8371_universitydegrees"><div class="big_group"><?=l('University Degrees<>الشهادات الجامعية')?></div><!----><?php
				$cluster=[
					'action'=>'add',
					'wrapper_class'=>'joining_request_form_8371_universitydegrees',
					'module'=>'member_education_8417',
					'hide_field'=>'related_id',
					'parent_module'=>'joining_request_form_8371'
					];
	include core_dir.'modules/cluster.php';
	?></div><!----><!----><div class="big_group_wrap joining_request_form_8371_theattachments"><div class="big_group"><?=l('The Attachments<>المرفقات')?></div></div><!--
	

--><div class="form_field onfour in joining_request_form_8371_all_attested" data-legion-field-type="file">
<label for="for_field_all_attested"><?=l('All University certificates (attested)<>تحميل الشهادات الجامعية (مصدقه)');?> <span class="required_star">*</span></label>
<div class="input_area">

			<img class="po" onclick="browseFile(this)" src="<?=u.'files.png';  ?>"/> 
			
			<?php $rand_id="all_attested_".rand();?>
			
			<input req id="input_<?=$rand_id?>"   type="file" class="hidden" name="all_attested[]" multiple  legionType="file" onchange="loadFile(event,this,'<?=$rand_id?>')"/>

<div><label></label><div class="in" id="<?=$rand_id?>">
	 
</div></div> 
	<label></label><div id="clear-input_<?=$rand_id?>" class="hidden clearFiles po" onClick="clearFiles('all_attested','<?=$rand_id?>')"><i class="md-light">delete</i></div>

			
</div>
</div><!--


	

--><div class="form_field onfour in joining_request_form_8371_proof_passport" data-legion-field-type="file">
<label for="for_field_proof_passport"><?=l('Proof of identity (identity / passport)<>اثبات شخصية(هوية/جواز سفر)');?> <span class="required_star">*</span></label>
<div class="input_area">

			<img class="po" onclick="browseFile(this)" src="<?=u.'file.png';  ?>"/> 
			
			<?php $rand_id="proof_passport_".rand();?>
			
			<input req id="input_<?=$rand_id?>"   type="file" class="hidden" name="proof_passport[]"  legionType="file" onchange="loadFile(event,this,'<?=$rand_id?>')"/>

<div><label></label><div class="in" id="<?=$rand_id?>">
	 
</div></div> 
	<label></label><div id="clear-input_<?=$rand_id?>" class="hidden clearFiles po" onClick="clearFiles('proof_passport','<?=$rand_id?>')"><i class="md-light">delete</i></div>

			
</div>
</div><!--


	

--><div class="form_field onfour in joining_request_form_8371_high_attested" data-legion-field-type="file">
<label for="for_field_high_attested"><?=l('High school certificate (attested)<>شهادة الثانوية العامة(مصدقة)');?> <span class="required_star">*</span></label>
<div class="input_area">

			<img class="po" onclick="browseFile(this)" src="<?=u.'file.png';  ?>"/> 
			
			<?php $rand_id="high_attested_".rand();?>
			
			<input req id="input_<?=$rand_id?>"   type="file" class="hidden" name="high_attested[]"  legionType="file" onchange="loadFile(event,this,'<?=$rand_id?>')"/>

<div><label></label><div class="in" id="<?=$rand_id?>">
	 
</div></div> 
	<label></label><div id="clear-input_<?=$rand_id?>" class="hidden clearFiles po" onClick="clearFiles('high_attested','<?=$rand_id?>')"><i class="md-light">delete</i></div>

			
</div>
</div><!--


	

--><div class="form_field onfour in joining_request_form_8371_certificate_conduct" data-legion-field-type="file">
<label for="for_field_certificate_conduct"><?=l('Certificate of non-conviction / good conduct<>شهادة عدم محكومية/حسن سير وسلوك');?> <span class="required_star">*</span></label>
<div class="input_area">

			<img class="po" onclick="browseFile(this)" src="<?=u.'file.png';  ?>"/> 
			
			<?php $rand_id="certificate_conduct_".rand();?>
			
			<input req id="input_<?=$rand_id?>"   type="file" class="hidden" name="certificate_conduct[]"  legionType="file" onchange="loadFile(event,this,'<?=$rand_id?>')"/>

<div><label></label><div class="in" id="<?=$rand_id?>">
	 
</div></div> 
	<label></label><div id="clear-input_<?=$rand_id?>" class="hidden clearFiles po" onClick="clearFiles('certificate_conduct','<?=$rand_id?>')"><i class="md-light">delete</i></div>

			
</div>
</div><!--


	

--><div class="form_field onfour in joining_request_form_8371_work_proof" data-legion-field-type="file">
<label for="for_field_work_proof"><?=l('Work Proof<>اثبات عمل');?></label>
<div class="input_area">

			<img class="po" onclick="browseFile(this)" src="<?=u.'file.png';  ?>"/> 
			
			<?php $rand_id="work_proof_".rand();?>
			
			<input id="input_<?=$rand_id?>"   type="file" class="hidden" name="work_proof[]"  legionType="file" onchange="loadFile(event,this,'<?=$rand_id?>')"/>

<div><label></label><div class="in" id="<?=$rand_id?>">
	 
</div></div> 
	<label></label><div id="clear-input_<?=$rand_id?>" class="hidden clearFiles po" onClick="clearFiles('work_proof','<?=$rand_id?>')"><i class="md-light">delete</i></div>

			
</div>
</div><!--


	

--><div class="form_field onfour in joining_request_form_8371_bank_receipt" data-legion-field-type="file">
<label for="for_field_bank_receipt"><?=l('Bank Receipt<>إيصال البنك');?> <span class="required_star">*</span></label>
<div class="input_area">

			<img class="po" onclick="browseFile(this)" src="<?=u.'file.png';  ?>"/> 
			
			<?php $rand_id="bank_receipt_".rand();?>
			
			<input req id="input_<?=$rand_id?>"   type="file" class="hidden" name="bank_receipt[]"  legionType="file" onchange="loadFile(event,this,'<?=$rand_id?>')"/>

<div><label></label><div class="in" id="<?=$rand_id?>">
	 
</div></div> 
	<label></label><div id="clear-input_<?=$rand_id?>" class="hidden clearFiles po" onClick="clearFiles('bank_receipt','<?=$rand_id?>')"><i class="md-light">delete</i></div>

			
</div>
</div><!--


	

--><div class="form_field joining_request_form_8371_confirm_that" data-legion-field-type="checkbox">
<label for="for_field_confirm_that"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input   class="css-checkbox" type="checkbox" name="confirm_that"  id="<?=$rand='a'.rand(); ?>" />
			<label for="<?=$rand?>"><?=l('I declare that all the information including the academic certificates in the application are correct, and in the event that it turns out otherwise, the Association has the right to withdraw its decision to register me as a member, and I also bear the civil and criminal legal responsibility resulting from that.<>أقر بأن جميع المعلومات بما في ذلك الشهادات الأكاديمية في الطلب صحيحة ، وفي حال تبين خلاف ذلك ، يحق للجمعية سحب قرارها بالتسجيل كعضو ، كما أنني أتحمل المسؤولية المدنية والجنائية. المسؤولية القانونية الناتجة عن ذلك.');?></label></div></div></div>
</div>
</div><!--

-->
<!--inputs above -->
</form>
<?php } ?>