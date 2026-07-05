<?php 
$original_edit_id=$id=check_get_id();
	$_form_resp=db('admin_settings','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('admin_settings','edit') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<form id="admin_settings" autocomplete="off" action="" onsubmit="return submitter(this,'<?=isset($controllerURL)? $controllerURL:urlPanel?>');" method="post" enctype="multipart/form-data">
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="admin_settings"/> 
<input type="hidden" name="action" value="edit"/> 
<input type="hidden" name="id" value="<?=$id;?>"/> 

<!--inputs below -->
<!--
	

--><div class="form_field  admin_settings_admin" data-legion-field-type="select">
<label for="for_field_admin"><?=l('Admin<>المدير');?></label>
<div class="input_area">

<select  id="for_field_admin" class="l_mc l_white_c" name="admin">
<?php 
$addition_where=NULL;
	
$_form_sub_resp=db('admins',"WHERE deleted=0    $addition_where",NULL);
			if($_form_sub_resp==0){?><option value="0" selected><?=l('Error<>خطأ')?></option><?php } 
			else if($_form_sub_resp==1){?><option value="0" selected><?=l('Choose<>اختر');?></option><?php } 
				 else { ?>
                 <option value="0" <?=(0==$_form_resp[0]['admin']?'selected':'')?>><?=l('Choose<>اختر');?></option>
				<?php
					if($_form_sub_resp!=1){
						for($__j=0;$__j<count($_form_sub_resp);$__j++){?>
						<option <?=($_form_sub_resp[$__j]['id']==$_form_resp[0]['admin'] ? 'selected' : ''); ?> class="l_mc l_white_c" value="<?=$_form_sub_resp[$__j]['id']?>">
						<?= select_echo('admin_settings','admin',$_form_sub_resp[$__j],true);?></option>
						
				<?php 
						}//for
					}
				}//else 
				unset($_form_sub_resp);
				?>
			</select>
</div>
</div><!--


	

--><div class="form_field  admin_settings_status_report" data-legion-field-type="checkbox">
<label for="for_field_status_report"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input <?=($_form_resp[0]['status_report']==1 ? ' checked ':'');?>
 class=" css-checkbox" name="status_report" type="checkbox" id="<?=$rand='a'.rand(); ?>"/>
			<label for="<?=$rand ?>"><?=l('Status Report<>');?></label></div></div></div>
</div>
</div><!--


	

--><div class="form_field  admin_settings_storage" data-legion-field-type="checkbox">
<label for="for_field_storage"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input <?=($_form_resp[0]['storage']==1 ? ' checked ':'');?>
 class=" css-checkbox" name="storage" type="checkbox" id="<?=$rand='a'.rand(); ?>"/>
			<label for="<?=$rand ?>"><?=l('Storage<>');?></label></div></div></div>
</div>
</div><!--


	

--><div class="form_field  admin_settings_datetime" data-legion-field-type="checkbox">
<label for="for_field_datetime"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input <?=($_form_resp[0]['datetime']==1 ? ' checked ':'');?>
 class=" css-checkbox" name="datetime" type="checkbox" id="<?=$rand='a'.rand(); ?>"/>
			<label for="<?=$rand ?>"><?=l('Datetime<>');?></label></div></div></div>
</div>
</div><!--


	

--><div class="form_field  admin_settings_todo" data-legion-field-type="checkbox">
<label for="for_field_todo"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input <?=($_form_resp[0]['todo']==1 ? ' checked ':'');?>
 class=" css-checkbox" name="todo" type="checkbox" id="<?=$rand='a'.rand(); ?>"/>
			<label for="<?=$rand ?>"><?=l('Todo<>');?></label></div></div></div>
</div>
</div><!--


	

--><div class="form_field  admin_settings_app_links" data-legion-field-type="checkbox">
<label for="for_field_app_links"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input <?=($_form_resp[0]['app_links']==1 ? ' checked ':'');?>
 class=" css-checkbox" name="app_links" type="checkbox" id="<?=$rand='a'.rand(); ?>"/>
			<label for="<?=$rand ?>"><?=l('App Links<>');?></label></div></div></div>
</div>
</div><!--


	

--><div class="form_field  admin_settings_grid_dashboard" data-legion-field-type="checkbox">
<label for="for_field_grid_dashboard"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input <?=($_form_resp[0]['grid_dashboard']==1 ? ' checked ':'');?>
 class=" css-checkbox" name="grid_dashboard" type="checkbox" id="<?=$rand='a'.rand(); ?>"/>
			<label for="<?=$rand ?>"><?=l('Grid Dashboard<>');?></label></div></div></div>
</div>
</div><!--


	

--><div class="form_field  admin_settings_colors_palette" data-legion-field-type="checkbox">
<label for="for_field_colors_palette"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input <?=($_form_resp[0]['colors_palette']==1 ? ' checked ':'');?>
 class=" css-checkbox" name="colors_palette" type="checkbox" id="<?=$rand='a'.rand(); ?>"/>
			<label for="<?=$rand ?>"><?=l('Colors Palette<>');?></label></div></div></div>
</div>
</div><!--


	

--><div class="form_field  admin_settings_translations" data-legion-field-type="checkbox">
<label for="for_field_translations"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input <?=($_form_resp[0]['translations']==1 ? ' checked ':'');?>
 class=" css-checkbox" name="translations" type="checkbox" id="<?=$rand='a'.rand(); ?>"/>
			<label for="<?=$rand ?>"><?=l('Translations<>');?></label></div></div></div>
</div>
</div><!--


	

--><div class="form_field  admin_settings_front_control_options" data-legion-field-type="checkbox">
<label for="for_field_front_control_options"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input <?=($_form_resp[0]['front_control_options']==1 ? ' checked ':'');?>
 class=" css-checkbox" name="front_control_options" type="checkbox" id="<?=$rand='a'.rand(); ?>"/>
			<label for="<?=$rand ?>"><?=l('Front Control Options<>');?></label></div></div></div>
</div>
</div><!--


	

--><div class="form_field  admin_settings_sitemap_info" data-legion-field-type="checkbox">
<label for="for_field_sitemap_info"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input <?=($_form_resp[0]['sitemap_info']==1 ? ' checked ':'');?>
 class=" css-checkbox" name="sitemap_info" type="checkbox" id="<?=$rand='a'.rand(); ?>"/>
			<label for="<?=$rand ?>"><?=l('Sitemap Info<>');?></label></div></div></div>
</div>
</div><!--

-->
<!--inputs above -->
</form>
<?php } ?>