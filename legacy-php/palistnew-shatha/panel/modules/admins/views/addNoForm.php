<?php if(!privilege('admins','add'))echo $noPermission;else{?>
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="admins"/> 
<input type="hidden" name="action" value="add"/>
<!--inputs below --> 
<!--
	

--><div class="form_field ontwo in admins_username" data-legion-field-type="text">
<label for="for_field_username"><?=l('Username<>اسم المستخدم');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_username"  required type="text" data-legion-unique="true" data-legion-module="admins" name="username" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field ontwo in admins_password" data-legion-field-type="password">
<label for="for_field_password"><?=l('Password<>الكلمة السرية');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_password" type="text" data-legion="password_field" onfocus="this.type='password';this.name='password'" name="<?=rand()?>"  required     placeholder=""  value=""/>
</div>
</div><!--


	

--><div class="form_field ontwo in admins_email" data-legion-field-type="email">
<label for="for_field_email"><?=l('Email<>البريد الالكتروني');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_email"  required type="email" data-legion-unique="true" data-legion-module="admins" name="email" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field ontwo in admins_phone" data-legion-field-type="text">
<label for="for_field_phone"><?=l('Phone<>الخلوي');?></label>
<div class="input_area">
<input id="for_field_phone"  type="text"  data-legion-module="admins" name="phone" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field ontwo in admins_first_name" data-legion-field-type="text">
<label for="for_field_first_name"><?=l('First Name<>الاسم الأوّل');?></label>
<div class="input_area">
<input id="for_field_first_name"  type="text"  data-legion-module="admins" name="first_name" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field ontwo in admins_last_name" data-legion-field-type="text">
<label for="for_field_last_name"><?=l('Last Name<>اسم العائلة');?></label>
<div class="input_area">
<input id="for_field_last_name"  type="text"  data-legion-module="admins" name="last_name" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field ontwo in admins_position" data-legion-field-type="text">
<label for="for_field_position"><?=l('Position<>المنصب');?></label>
<div class="input_area">
<input id="for_field_position"  type="text"  data-legion-module="admins" name="position" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field ontwo in admins_language_id" data-legion-field-type="select">
<label for="for_field_language_id"><?=l('Language<>اللّغة');?> <span class="required_star">*</span></label>
<div class="input_area">
<select  required id="for_field_language_id" class="l_mc l_white_c" name="language_id">
<?php 
$addition_where=NULL;

$_form_resp=db('languages_1557157519',"WHERE deleted=0   $addition_where",NULL,NULL);
			if($_form_resp==0){?><option value="0" selected><?=l('Error<>خطأ')?></option> <?php } 
			else if($_form_resp==1){?><option value="0" selected><?=l('Choose<>اختر');?></option><?php } 
				else {?>
                    <option value=""><?=l('Choose<>اختر');?></option>
					<?php 
					$echoFields='language_name';
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


	

--><div class="form_field ontwo in admins_country" data-legion-field-type="select">
<label for="for_field_country"><?=l('Country<>الدولة');?></label>
<div class="input_area">
<select  id="for_field_country" class="l_mc l_white_c" name="country">
<?php 
$addition_where="AND active";

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


	

--><div class="form_field ontwo in admins_menu_style" data-legion-field-type="radio">
<label for="for_field_menu_style"><?=l('Menu Style<>شكل القائمة');?></label>
<div class="input_area">
<input type="radio" name="menu_style" value="List" id="radio_menu_style_0"/><label for="radio_menu_style_0">List</label>
			
			<input type="radio" name="menu_style" value="Icon" id="radio_menu_style_1"/><label for="radio_menu_style_1">Icon</label>
			
			
</div>
</div><!--


	

--><div class="form_field onfour in admins_photo" data-legion-field-type="file">
<label for="for_field_photo"><?=l('Photo<>صورة شخصية');?></label>
<div class="input_area">

			<img class="po" onclick="browseFile(this)" src="<?=u.'photo.png';  ?>"/> 
			
			<?php $rand_id="photo_".rand();?>
			
			<input id="input_<?=$rand_id?>" accept="image/*"  type="file" class="h" name="photo[]"  legionType="photo" onchange="loadFile(event,this,'<?=$rand_id?>')"/>

<div><label></label><div class="in" id="<?=$rand_id?>">
	 
</div></div> 
	<label></label><div id="clear-input_<?=$rand_id?>" class="h clearFiles po" onClick="clearFiles('photo','<?=$rand_id?>')"><i class="md-light">delete</i></div>

			
</div>
</div><!--


	

--><div class="form_field onfour in admins_dark_mode" data-legion-field-type="checkbox">
<label for="for_field_dark_mode"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input   class="css-checkbox" type="checkbox" name="dark_mode"  id="<?=$rand='a'.rand(); ?>" />
			<label for="<?=$rand?>"><?=l('Dark Mode<>');?></label></div></div></div>
</div>
</div><!--

-->
<!--inputs above -->
<?php } ?>