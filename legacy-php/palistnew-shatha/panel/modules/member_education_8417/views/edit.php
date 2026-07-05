<?php 
$original_edit_id=$id=check_get_id();
	$_form_resp=db('member_education_8417','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('member_education_8417','edit') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<form id="member_education_8417" autocomplete="off" action="" onsubmit="return submitter(this,'<?=isset($controllerURL)? $controllerURL:urlPanel?>');" method="post" enctype="multipart/form-data">
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="member_education_8417"/> 
<input type="hidden" name="action" value="edit"/> 
<input type="hidden" name="id" value="<?=$id;?>"/> 

<!--inputs below -->
<!--
	

--><div class="form_field  member_education_8417_related_id" data-legion-field-type="number">
<label for="for_field_related_id"><?=l('Related ID<>');?></label>
<div class="input_area">
<input id="for_field_related_id"  type="number" name="related_id"   data-legion-module="member_education_8417" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['related_id']) ?>"/>
</div>
</div><!--


	

--><div class="form_field onfour in  member_education_8417_name_degree" data-legion-field-type="text">
<label for="for_field_name_degree"><?=l('Name of the university (highest degree)<>');?></label>
<div class="input_area">
<input id="for_field_name_degree"  type="text" name="name_degree"   data-legion-module="member_education_8417" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['name_degree']) ?>"/>
</div>
</div><!--


	

--><div class="form_field onfour in  member_education_8417_college_name" data-legion-field-type="text">
<label for="for_field_college_name"><?=l('College Name<>');?></label>
<div class="input_area">
<input id="for_field_college_name"  type="text" name="college_name"   data-legion-module="member_education_8417" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['college_name']) ?>"/>
</div>
</div><!--


	

--><div class="form_field onfour in  member_education_8417_specializationin_arabic" data-legion-field-type="text">
<label for="for_field_specializationin_arabic"><?=l('Specialization(In Arabic)<>');?></label>
<div class="input_area">
<input id="for_field_specializationin_arabic"  type="text" name="specializationin_arabic"   data-legion-module="member_education_8417" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['specializationin_arabic']) ?>"/>
</div>
</div><!--


	

--><div class="form_field onfour in  member_education_8417_specializationin_english" data-legion-field-type="text">
<label for="for_field_specializationin_english"><?=l('Specialization(In English)<>');?></label>
<div class="input_area">
<input id="for_field_specializationin_english"  type="text" name="specializationin_english"   data-legion-module="member_education_8417" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['specializationin_english']) ?>"/>
</div>
</div><!--


	

--><div class="form_field onfour in  member_education_8417_university_year" data-legion-field-type="number">
<label for="for_field_university_year"><?=l('University Graduation Year<>');?></label>
<div class="input_area">
<input id="for_field_university_year"  type="number" name="university_year"   data-legion-module="member_education_8417" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['university_year']) ?>"/>
</div>
</div><!--


	

--><div class="form_field onfour in  member_education_8417_undergraduate_degree" data-legion-field-type="select">
<label for="for_field_undergraduate_degree"><?=l('Undergraduate degree<>');?></label>
<div class="input_area">

<select  id="for_field_undergraduate_degree" class="main_color_bg whiteFont" name="undergraduate_degree">
<?php 
$addition_where=NULL;
	
$_form_sub_resp=db('undergraduate_degree_8371',"WHERE deleted=0    $addition_where",NULL,NULL);
			if($_form_sub_resp==0){?><option value="0" selected><?=l('Error<>خطأ')?></option><?php } 
			else if($_form_sub_resp==1){?><option value="0" selected><?=l('Choose<>اختر');?></option><?php } 
				 else { ?>
                 <option value="0" <?=(0==$_form_resp[0]['undergraduate_degree']?'selected':'')?>><?=l('Choose<>اختر');?></option>
				<?php
					$echoFields='';
					$x=explode(',',$echoFields);
					if($_form_sub_resp!=1){
						for($j=0;$j<count($_form_sub_resp);$j++){?>
						<option <?=($_form_sub_resp[$j]['id']==$_form_resp[0]['undergraduate_degree'] ? 'selected' : ''); ?> class="main_color_bg whiteFont" value="<?=$_form_sub_resp[$j]['id']?>"><?php 
							for($e=0;$e<count($x);$e++){
								if($x[$e]=='-')echo ' -';
								else {
									if($e!=0)echo ' ';
									echo l($_form_sub_resp[$j][$x[$e]]); 
								}
							}
						?></option>
						
				<?php 
						}//for
					}
				}//else 
				unset($_form_sub_resp);
				?>
			</select>
			
</div>
</div><!--


	

--><div class="form_field onfour in  member_education_8417_appreciation" data-legion-field-type="text">
<label for="for_field_appreciation"><?=l('Appreciation<>');?></label>
<div class="input_area">
<input id="for_field_appreciation"  type="text" name="appreciation"   data-legion-module="member_education_8417" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['appreciation']) ?>"/>
</div>
</div><!--


	

--><div class="form_field onfour in  member_education_8417_university_country" data-legion-field-type="select">
<label for="for_field_university_country"><?=l('University Country<>');?></label>
<div class="input_area">

<select  id="for_field_university_country" class="main_color_bg whiteFont" name="university_country">
<?php 
$addition_where=NULL;
	
$_form_sub_resp=db('countries_1556139283',"WHERE deleted=0    $addition_where",NULL,NULL);
			if($_form_sub_resp==0){?><option value="0" selected><?=l('Error<>خطأ')?></option><?php } 
			else if($_form_sub_resp==1){?><option value="0" selected><?=l('Choose<>اختر');?></option><?php } 
				 else { ?>
                 <option value="0" <?=(0==$_form_resp[0]['university_country']?'selected':'')?>><?=l('Choose<>اختر');?></option>
				<?php
					$echoFields='title';
					$x=explode(',',$echoFields);
					if($_form_sub_resp!=1){
						for($j=0;$j<count($_form_sub_resp);$j++){?>
						<option <?=($_form_sub_resp[$j]['id']==$_form_resp[0]['university_country'] ? 'selected' : ''); ?> class="main_color_bg whiteFont" value="<?=$_form_sub_resp[$j]['id']?>"><?php 
							for($e=0;$e<count($x);$e++){
								if($x[$e]=='-')echo ' -';
								else {
									if($e!=0)echo ' ';
									echo l($_form_sub_resp[$j][$x[$e]]); 
								}
							}
						?></option>
						
				<?php 
						}//for
					}
				}//else 
				unset($_form_sub_resp);
				?>
			</select>
			
</div>
</div><!--

-->
<!--inputs above -->
</form>
<?php } ?>