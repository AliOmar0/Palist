<?php 
$original_edit_id=$id=check_get_id();
	$_form_resp=db('languages_1557157519','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('languages_1557157519','edit') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<form id="languages_1557157519" autocomplete="off" action="" onsubmit="return submitter(this,'<?=isset($controllerURL)? $controllerURL:urlPanel?>');" method="post" enctype="multipart/form-data">
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="languages_1557157519"/> 
<input type="hidden" name="action" value="edit"/> 
<input type="hidden" name="id" value="<?=$id;?>"/> 

<!--inputs below -->
<!--
	

--><div class="form_field  languages_1557157519_title" data-legion-field-type="text">
<label for="for_field_title"><?=l('Title<>العنوان');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_title"  required type="text" name="title" data-l_module="languages_1557157519" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['title']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  languages_1557157519_prefix" data-legion-field-type="text">
<label for="for_field_prefix"><?=l('Prefix<>الدالة');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_prefix"  required type="text" name="prefix" data-l_module="languages_1557157519" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['prefix']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  languages_1557157519_language_name" data-legion-field-type="text">
<label for="for_field_language_name"><?=l('Language Name<>اسم اللغة');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_language_name"  required type="text" name="language_name" data-l_module="languages_1557157519" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['language_name']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  languages_1557157519_direction" data-legion-field-type="text">
<label for="for_field_direction"><?=l('Direction<>اتجاه الكتابة');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_direction"  required type="text" name="direction" data-l_module="languages_1557157519" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['direction']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  languages_1557157519_active" data-legion-field-type="checkbox">
<label for="for_field_active"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input <?=($_form_resp[0]['active']==1 ? ' checked ':'');?>
 class=" css-checkbox" name="active" type="checkbox" id="<?=$rand='a'.rand(); ?>"/>
			<label for="<?=$rand ?>"><?=l('Active<>التفعيل');?></label></div></div></div>
</div>
</div><!--

-->
<!--inputs above -->
</form>
<?php } ?>