<?php 
$id=check_get_id();
	$_form_resp=db('users_8400','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('users_8400','edit') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="users_8400"/> 
<input type="hidden" name="action" value="edit"/> 
<input type="hidden" name="id" value="<?=$id;?>"/> 

<!--inputs below -->
<!--
	

--><div class="form_field  users_8400_username" data-legion-field-type="text">
<label for="for_field_username"><?=l('Username<>اسم المستخدم');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_username"  required type="text" name="username" data-legion-unique="true"  data-legion-module="users_8400" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['username']) ?>"/>
</div>
</div><clear></clear><!--


	

--><div class="form_field ontwo in  users_8400_password" data-legion-field-type="password">
<label for="for_field_password"><?=l('Password<>الرقم السري');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_password" type="text" onfocus="this.type='password';this.name='password'" name="<?=rand()?>" data-legion="password_field"    placeholder="" />
</div>
</div><!--


	

--><div class="form_field ontwo in  users_8400_email_address" data-legion-field-type="email">
<label for="for_field_email_address"><?=l('Email Address<>عنوان البريد الالكتروني');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_email_address"  required type="email" name="email_address"   data-legion-module="users_8400" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['email_address']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  users_8400_profile_photo" data-legion-field-type="file">
<label for="for_field_profile_photo"><?=l('Profile Photo<>صورة شخصية');?></label>
<div class="input_area">
<img class="po" onclick="browseFile(this)" src="<?=($_form_resp[0]['profile_photo']==""?u.'photo.png':uimg($_form_resp[0]['profile_photo'],200,100))?>"/>
			<?php $rand_id="profile_photo_".rand();?>
			<input id="input_<?=$rand_id?>" accept="image/*"  type="file" class="hidden" name="profile_photo[]"  legionType="photo" onchange="loadFile(event,this,'<?=$rand_id?>')"/>
<div><label></label><div class="in " id="<?=$rand_id?>">
			
	<?php
		if($_form_resp[0]['profile_photo']!=NULL){
			?>
		<div class="fileName"><a target="_blank" href="<?=u.$_form_resp[0]['profile_photo'];?>"><?=$_form_resp[0]['profile_photo'];?></a></div>
<?php } ?>

</div></div>

	<label></label><div id="clear-input_<?=$rand_id?>" class="<?=($_form_resp[0]['profile_photo']==NULL ? 'hidden':'in')?> clearFiles po" onClick="clearFiles('profile_photo','<?=$rand_id?>')"><i class="md-light">delete</i></div>

			
</div>
</div><!--


	

--><div class="form_field  users_8400_active" data-legion-field-type="checkbox">
<label for="for_field_active"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input <?=($_form_resp[0]['active']==1 ? ' checked ':'');?>
 class=" css-checkbox" name="active" type="checkbox" id="<?=$rand='a'.rand(); ?>"/>
			<label for="<?=$rand ?>"><?=l('Active<>');?></label></div></div></div>
</div>
</div><!--


	

--><div class="form_field ontwo in  users_8400_full_name" data-legion-field-type="text">
<label for="for_field_full_name"><?=l('Full Name(In Arabic)<>الاسم الرباعي');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_full_name"  required type="text" name="full_name"   data-legion-module="users_8400" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['full_name']) ?>"/>
</div>
</div><!--


	

--><div class="form_field ontwo in  users_8400_full_name_en" data-legion-field-type="text">
<label for="for_field_full_name_en"><?=l('Full Name(In English)<>الاسم الرباعي');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_full_name_en"  required type="text" name="full_name_en"   data-legion-module="users_8400" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['full_name_en']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  users_8400_date_of_birth" data-legion-field-type="date">
<label for="for_field_date_of_birth"><?=l('Date of Birth<>');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_date_of_birth"  required type="date" name="date_of_birth"   data-legion-module="users_8400" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['date_of_birth']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  users_8400_province" data-legion-field-type="select">
<label for="for_field_province"><?=l('Province<>المحافظة');?> <span class="required_star">*</span></label>
<div class="input_area">

<select  required id="for_field_province" class="main_color_bg whiteFont" name="province">
<?php 
$addition_where=NULL;
	
$_form_sub_resp=db('provinces_8371',"WHERE deleted=0    $addition_where",NULL,NULL);
			if($_form_sub_resp==0){?><option value="0" selected><?=l('Error<>خطأ')?></option><?php } 
			else if($_form_sub_resp==1){?><option value="0" selected><?=l('Choose<>اختر');?></option><?php } 
				 else { ?>
                 <option value="" <?=(0==$_form_resp[0]['province']?'selected':'')?>><?=l('Choose<>اختر');?></option>
				<?php
					$echoFields='title';
					$x=explode(',',$echoFields);
					if($_form_sub_resp!=1){
						for($j=0;$j<count($_form_sub_resp);$j++){?>
						<option <?=($_form_sub_resp[$j]['id']==$_form_resp[0]['province'] ? 'selected' : ''); ?> class="main_color_bg whiteFont" value="<?=$_form_sub_resp[$j]['id']?>"><?php 
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


	

--><div class="form_field  users_8400_id_number" data-legion-field-type="number">
<label for="for_field_id_number"><?=l('Id Number/passport<>جواز سفر/رقم الهوية');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_id_number"  required type="number" name="id_number"   data-legion-module="users_8400" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['id_number']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  users_8400_gender" data-legion-field-type="select">
<label for="for_field_gender"><?=l('Gender<>الجنس');?> <span class="required_star">*</span></label>
<div class="input_area">

<select  required id="for_field_gender" class="main_color_bg whiteFont" name="gender">
<?php 
$addition_where=NULL;
	
$_form_sub_resp=db('gender_8371',"WHERE deleted=0    $addition_where",NULL,NULL);
			if($_form_sub_resp==0){?><option value="0" selected><?=l('Error<>خطأ')?></option><?php } 
			else if($_form_sub_resp==1){?><option value="0" selected><?=l('Choose<>اختر');?></option><?php } 
				 else { ?>
                 <option value="" <?=(0==$_form_resp[0]['gender']?'selected':'')?>><?=l('Choose<>اختر');?></option>
				<?php
					$echoFields='title';
					$x=explode(',',$echoFields);
					if($_form_sub_resp!=1){
						for($j=0;$j<count($_form_sub_resp);$j++){?>
						<option <?=($_form_sub_resp[$j]['id']==$_form_resp[0]['gender'] ? 'selected' : ''); ?> class="main_color_bg whiteFont" value="<?=$_form_sub_resp[$j]['id']?>"><?php 
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


	

--><div class="form_field  users_8400_specialization" data-legion-field-type="select">
<label for="for_field_specialization"><?=l('Specialization<>التخصص');?> <span class="required_star">*</span></label>
<div class="input_area">

            
<select  required id="for_field_specialization" class="main_color_bg whiteFont" name="specialization[]" multiple>
<?php 
$addition_where=NULL;
	
$_form_sub_resp=db('majors_8367',"WHERE deleted=0    $addition_where",NULL,NULL);
			if($_form_sub_resp==0){?><option value="0" selected><?=l('Error<>خطأ')?></option><?php } 
			 
				 else { ?>
                 
				<?php
					$echoFields='title';
					$x=explode(',',$echoFields);
					if($_form_sub_resp!=1){
						for($j=0;$j<count($_form_sub_resp);$j++){?>
						<option <?=(db('complementary_1614118171',"WHERE mother_module_prefix='".moduleID('users_8400')."' AND mother_id='$id' AND child_module_prefix='".moduleID('majors_8367')."' AND child_id='".$_form_sub_resp[$j]['id']."'",NULL,"LIMIT 1")==1 ? '' : 'selected'); ?> class="main_color_bg whiteFont" value="<?=$_form_sub_resp[$j]['id']?>"><?php 
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


	

--><div class="form_field  users_8400_employment_status" data-legion-field-type="select">
<label for="for_field_employment_status"><?=l('Employment Status<>الحالة الوظيفية');?></label>
<div class="input_area">

<select  id="for_field_employment_status" class="main_color_bg whiteFont" name="employment_status">
<?php 
$addition_where=NULL;
	
$_form_sub_resp=db('employment_status_8368',"WHERE deleted=0    $addition_where",NULL,NULL);
			if($_form_sub_resp==0){?><option value="0" selected><?=l('Error<>خطأ')?></option><?php } 
			else if($_form_sub_resp==1){?><option value="0" selected><?=l('Choose<>اختر');?></option><?php } 
				 else { ?>
                 <option value="0" <?=(0==$_form_resp[0]['employment_status']?'selected':'')?>><?=l('Choose<>اختر');?></option>
				<?php
					$echoFields='title';
					$x=explode(',',$echoFields);
					if($_form_sub_resp!=1){
						for($j=0;$j<count($_form_sub_resp);$j++){?>
						<option <?=($_form_sub_resp[$j]['id']==$_form_resp[0]['employment_status'] ? 'selected' : ''); ?> class="main_color_bg whiteFont" value="<?=$_form_sub_resp[$j]['id']?>"><?php 
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


	

--><div class="form_field onthree in  users_8400_organisation" data-legion-field-type="text">
<label for="for_field_organisation"><?=l('Organisation<>مؤسسة العمل');?></label>
<div class="input_area">
<input id="for_field_organisation"  type="text" name="organisation"   data-legion-module="users_8400" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['organisation']) ?>"/>
</div>
</div><!--


	

--><div class="form_field onthree in  users_8400_business_type" data-legion-field-type="select">
<label for="for_field_business_type"><?=l('Business type<>نوع العمل ');?></label>
<div class="input_area">

<select  id="for_field_business_type" class="main_color_bg whiteFont" name="business_type">
<?php 
$addition_where=NULL;
	
$_form_sub_resp=db('business_type_8368',"WHERE deleted=0    $addition_where",NULL,NULL);
			if($_form_sub_resp==0){?><option value="0" selected><?=l('Error<>خطأ')?></option><?php } 
			else if($_form_sub_resp==1){?><option value="0" selected><?=l('Choose<>اختر');?></option><?php } 
				 else { ?>
                 <option value="0" <?=(0==$_form_resp[0]['business_type']?'selected':'')?>><?=l('Choose<>اختر');?></option>
				<?php
					$echoFields='title';
					$x=explode(',',$echoFields);
					if($_form_sub_resp!=1){
						for($j=0;$j<count($_form_sub_resp);$j++){?>
						<option <?=($_form_sub_resp[$j]['id']==$_form_resp[0]['business_type'] ? 'selected' : ''); ?> class="main_color_bg whiteFont" value="<?=$_form_sub_resp[$j]['id']?>"><?php 
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


	

--><div class="form_field onthree in  users_8400_work_nature" data-legion-field-type="text">
<label for="for_field_work_nature"><?=l('work nature<>طبيعة العمل ');?></label>
<div class="input_area">
<input id="for_field_work_nature"  type="text" name="work_nature"   data-legion-module="users_8400" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['work_nature']) ?>"/>
</div>
</div><!--

-->
<!--inputs above -->
<?php } ?>