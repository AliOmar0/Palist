<?php 
$id=check_get_id();
	$_form_resp=db('admins','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('admins','edit') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="admins"/> 
<input type="hidden" name="action" value="edit"/> 
<input type="hidden" name="id" value="<?=$id;?>"/> 

<!--inputs below -->
<!--
	

--><div class="form_field ontwo in  admins_username" data-legion-field-type="text">
<label for="for_field_username"><?=l('Username<>اسم المستخدم');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_username"  required type="text" name="username" data-legion-unique="true"  data-legion-module="admins" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['username']) ?>"/>
</div>
</div><!--


	

--><div class="form_field ontwo in  admins_password" data-legion-field-type="password">
<label for="for_field_password"><?=l('Password<>الكلمة السرية');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_password" type="text" onfocus="this.type='password';this.name='password'" name="<?=rand()?>" data-legion="password_field"    placeholder="" />
</div>
</div><!--


	

--><div class="form_field ontwo in  admins_email" data-legion-field-type="email">
<label for="for_field_email"><?=l('Email<>البريد الالكتروني');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_email"  required type="email" name="email" data-legion-unique="true"  data-legion-module="admins" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['email']) ?>"/>
</div>
</div><!--


	

--><div class="form_field ontwo in  admins_phone" data-legion-field-type="text">
<label for="for_field_phone"><?=l('Phone<>الخلوي');?></label>
<div class="input_area">
<input id="for_field_phone"  type="text" name="phone"   data-legion-module="admins" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['phone']) ?>"/>
</div>
</div><!--


	

--><div class="form_field ontwo in  admins_first_name" data-legion-field-type="text">
<label for="for_field_first_name"><?=l('First Name<>الاسم الأوّل');?></label>
<div class="input_area">
<input id="for_field_first_name"  type="text" name="first_name"   data-legion-module="admins" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['first_name']) ?>"/>
</div>
</div><!--


	

--><div class="form_field ontwo in  admins_last_name" data-legion-field-type="text">
<label for="for_field_last_name"><?=l('Last Name<>اسم العائلة');?></label>
<div class="input_area">
<input id="for_field_last_name"  type="text" name="last_name"   data-legion-module="admins" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['last_name']) ?>"/>
</div>
</div><!--


	

--><div class="form_field ontwo in  admins_position" data-legion-field-type="text">
<label for="for_field_position"><?=l('Position<>المنصب');?></label>
<div class="input_area">
<input id="for_field_position"  type="text" name="position"   data-legion-module="admins" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['position']) ?>"/>
</div>
</div><!--


	

--><div class="form_field ontwo in  admins_language_id" data-legion-field-type="select">
<label for="for_field_language_id"><?=l('Language<>اللّغة');?> <span class="required_star">*</span></label>
<div class="input_area">

<select  required id="for_field_language_id" class="l_mc l_white_c" name="language_id">
<?php 
$addition_where=NULL;
	
$_form_sub_resp=db('languages_1557157519',"WHERE deleted=0    $addition_where",NULL);
			if($_form_sub_resp==0){?><option value="0" selected><?=l('Error<>خطأ')?></option><?php } 
			else if($_form_sub_resp==1){?><option value="0" selected><?=l('Choose<>اختر');?></option><?php } 
				 else { ?>
                 <option value="" <?=(0==$_form_resp[0]['language_id']?'selected':'')?>><?=l('Choose<>اختر');?></option>
				<?php
					$echoFields='language_name';
					$x=explode(',',$echoFields);
					if($_form_sub_resp!=1){
						for($j=0;$j<count($_form_sub_resp);$j++){?>
						<option <?=($_form_sub_resp[$j]['id']==$_form_resp[0]['language_id'] ? 'selected' : ''); ?> class="l_mc l_white_c" value="<?=$_form_sub_resp[$j]['id']?>"><?php 
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


	

--><div class="form_field ontwo in  admins_country" data-legion-field-type="select">
<label for="for_field_country"><?=l('Country<>الدولة');?></label>
<div class="input_area">

<select  id="for_field_country" class="l_mc l_white_c" name="country">
<?php 
$addition_where="AND active";
	
$_form_sub_resp=db('countries_1556139283',"WHERE deleted=0    $addition_where",NULL);
			if($_form_sub_resp==0){?><option value="0" selected><?=l('Error<>خطأ')?></option><?php } 
			else if($_form_sub_resp==1){?><option value="0" selected><?=l('Choose<>اختر');?></option><?php } 
				 else { ?>
                 <option value="0" <?=(0==$_form_resp[0]['country']?'selected':'')?>><?=l('Choose<>اختر');?></option>
				<?php
					$echoFields='title';
					$x=explode(',',$echoFields);
					if($_form_sub_resp!=1){
						for($j=0;$j<count($_form_sub_resp);$j++){?>
						<option <?=($_form_sub_resp[$j]['id']==$_form_resp[0]['country'] ? 'selected' : ''); ?> class="l_mc l_white_c" value="<?=$_form_sub_resp[$j]['id']?>"><?php 
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


	

--><div class="form_field ontwo in  admins_menu_style" data-legion-field-type="radio">
<label for="for_field_menu_style"><?=l('Menu Style<>شكل القائمة');?></label>
<div class="input_area">
<input type="radio" name="menu_style" <?=($_form_resp[0]['menu_style']=='List'?' checked ':'');?> value="List" id="radio_menu_style_0"/><label for="radio_menu_style_0">List</label>
				<input type="radio" name="menu_style" <?=($_form_resp[0]['menu_style']=='Icon'?' checked ':'');?> value="Icon" id="radio_menu_style_1"/><label for="radio_menu_style_1">Icon</label>
				
</div>
</div><!--


	

--><div class="form_field onfour in  admins_photo" data-legion-field-type="file">
<label for="for_field_photo"><?=l('Photo<>صورة شخصية');?></label>
<div class="input_area">
<img class="po" onclick="browseFile(this)" src="<?=($_form_resp[0]['photo']==""?u.'photo.png':uimg($_form_resp[0]['photo'],200,100))?>"/>
			<?php $rand_id="photo_".rand();?>
			<input id="input_<?=$rand_id?>" accept="image/*"  type="file" class="h" name="photo[]"  legionType="photo" onchange="loadFile(event,this,'<?=$rand_id?>')"/>
<div><label></label><div class="in " id="<?=$rand_id?>">
			
	<?php
		if($_form_resp[0]['photo']!=NULL){
			?>
		<div class="fileName"><a target="_blank" href="<?=u.$_form_resp[0]['photo'];?>"><?=$_form_resp[0]['photo'];?></a></div>
<?php } ?>

</div></div>

	<label></label><div id="clear-input_<?=$rand_id?>" class="<?=($_form_resp[0]['photo']==NULL ? 'h':'in')?> clearFiles po" onClick="clearFiles('photo','<?=$rand_id?>')"><i class="md-light">delete</i></div>

			
</div>
</div><!--


	

--><div class="form_field onfour in  admins_dark_mode" data-legion-field-type="checkbox">
<label for="for_field_dark_mode"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input <?=($_form_resp[0]['dark_mode']==1 ? ' checked ':'');?>
 class=" css-checkbox" name="dark_mode" type="checkbox" id="<?=$rand='a'.rand(); ?>"/>
			<label for="<?=$rand ?>"><?=l('Dark Mode<>');?></label></div></div></div>
</div>
</div><!--

-->
<!--inputs above -->
<?php } ?>