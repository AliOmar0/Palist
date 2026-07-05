<?php 
$original_edit_id=$id=check_get_id();
	$_form_resp=db('quick_access_1563567918','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('quick_access_1563567918','edit') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<form id="quick_access_1563567918" autocomplete="off" action="" onsubmit="return submitter(this,'<?=isset($controllerURL)? $controllerURL:urlPanel?>');" method="post" enctype="multipart/form-data">
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="quick_access_1563567918"/> 
<input type="hidden" name="action" value="edit"/> 
<input type="hidden" name="id" value="<?=$id;?>"/> 

<!--inputs below -->
<!--
	

--><div class="form_field  quick_access_1563567918_module_prefix" data-legion-field-type="text">
<label for="for_field_module_prefix"><?=l('Module Prefix<>البرمجية');?></label>
<div class="input_area">
<input id="for_field_module_prefix"  type="text" name="module_prefix"   data-legion-module="quick_access_1563567918" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['module_prefix']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  quick_access_1563567918_action_of_module" data-legion-field-type="text">
<label for="for_field_action_of_module"><?=l('Action of Module<>الأمر');?></label>
<div class="input_area">
<input id="for_field_action_of_module"  type="text" name="action_of_module"   data-legion-module="quick_access_1563567918" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['action_of_module']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  quick_access_1563567918_title_of_link" data-legion-field-type="text">
<label for="for_field_title_of_link"><?=l('Title of link<>عنوان الرابط');?></label>
<div class="input_area">
<input id="for_field_title_of_link"  type="text" name="title_of_link"   data-legion-module="quick_access_1563567918" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['title_of_link']) ?>"/>
</div>
</div><!--

--><div class="big_group_wrap quick_access_1563567918_custom"><div class="big_group"><?=l('Custom<>')?></div></div><!--
	

--><div class="form_field  quick_access_1563567918_custom_link" data-legion-field-type="text">
<label for="for_field_custom_link"><?=l('Custom Link<>');?>
<div class="help">
	<i>help_outline</i>
	<span><?=l('after urlPanel')?></span>
</div>
</label>
<div class="input_area">
<input id="for_field_custom_link"  type="text" name="custom_link"   data-legion-module="quick_access_1563567918" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['custom_link']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  quick_access_1563567918_icon" data-legion-field-type="material-icon">
<label for="for_field_icon"><?=l('Icon<>');?></label>
<div class="input_area">
<input class="use-material-icon-picker" id="for_field_icon"  type="text" name="icon" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['icon']) ?>"/>
</div>
</div><!--

-->
<!--inputs above -->
</form>
<?php } ?>