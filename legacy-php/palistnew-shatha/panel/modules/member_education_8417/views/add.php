<?php if(!privilege('member_education_8417','add'))echo $noPermission;else{?>
<form id="member_education_8417" autocomplete="off" action="" onsubmit="return submitter(this,'<?=isset($controllerURL)? $controllerURL:urlPanel?>');" method="post" enctype="multipart/form-data">
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="member_education_8417"/> 
<input type="hidden" name="action" value="add"/>
<!--inputs below --> 
<!--
	

--><div class="form_field member_education_8417_related_id" data-legion-field-type="number">
<label for="for_field_related_id"><?=l('Related ID<>');?></label>
<div class="input_area">
<input id="for_field_related_id"  type="number"  data-legion-module="member_education_8417" name="related_id" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field onfour in member_education_8417_name_degree" data-legion-field-type="text">
<label for="for_field_name_degree"><?=l('Name of the university (highest degree)<>');?></label>
<div class="input_area">
<input id="for_field_name_degree"  type="text"  data-legion-module="member_education_8417" name="name_degree" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field onfour in member_education_8417_college_name" data-legion-field-type="text">
<label for="for_field_college_name"><?=l('College Name<>');?></label>
<div class="input_area">
<input id="for_field_college_name"  type="text"  data-legion-module="member_education_8417" name="college_name" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field onfour in member_education_8417_specializationin_arabic" data-legion-field-type="text">
<label for="for_field_specializationin_arabic"><?=l('Specialization(In Arabic)<>');?></label>
<div class="input_area">
<input id="for_field_specializationin_arabic"  type="text"  data-legion-module="member_education_8417" name="specializationin_arabic" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field onfour in member_education_8417_specializationin_english" data-legion-field-type="text">
<label for="for_field_specializationin_english"><?=l('Specialization(In English)<>');?></label>
<div class="input_area">
<input id="for_field_specializationin_english"  type="text"  data-legion-module="member_education_8417" name="specializationin_english" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field onfour in member_education_8417_university_year" data-legion-field-type="number">
<label for="for_field_university_year"><?=l('University Graduation Year<>');?></label>
<div class="input_area">
<input id="for_field_university_year"  type="number"  data-legion-module="member_education_8417" name="university_year" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field onfour in member_education_8417_undergraduate_degree" data-legion-field-type="select">
<label for="for_field_undergraduate_degree"><?=l('Undergraduate degree<>');?></label>
<div class="input_area">
<select  id="for_field_undergraduate_degree" class="main_color_bg whiteFont" name="undergraduate_degree">
<?php 
$addition_where=NULL;

$_form_resp=db('undergraduate_degree_8371',"WHERE deleted=0   $addition_where",NULL,NULL);
			if($_form_resp==0){?><option value="0" selected><?=l('Error<>خطأ')?></option> <?php } 
			else if($_form_resp==1){?><option value="0" selected><?=l('Choose<>اختر');?></option><?php } 
				else {?>
                    <option value="0"><?=l('Choose<>اختر');?></option>
					<?php 
					$echoFields='';
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


	

--><div class="form_field onfour in member_education_8417_appreciation" data-legion-field-type="text">
<label for="for_field_appreciation"><?=l('Appreciation<>');?></label>
<div class="input_area">
<input id="for_field_appreciation"  type="text"  data-legion-module="member_education_8417" name="appreciation" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field onfour in member_education_8417_university_country" data-legion-field-type="select">
<label for="for_field_university_country"><?=l('University Country<>');?></label>
<div class="input_area">
<select  id="for_field_university_country" class="main_color_bg whiteFont" name="university_country">
<?php 
$addition_where=NULL;

$_form_resp=db('countries_1556139283',"WHERE deleted=0   $addition_where",NULL,NULL);
			if($_form_resp==0){?><option value="0" selected><?=l('Error<>خطأ')?></option> <?php } 
			else if($_form_resp==1){?><option value="0" selected><?=l('Choose<>اختر');?></option><?php } 
				else {?>
                    <option value="0"><?=l('Choose<>اختر');?></option>
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

-->
<!--inputs above -->
</form>
<?php } ?>