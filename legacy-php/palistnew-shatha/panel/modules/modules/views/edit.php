<?php 
$original_edit_id=$id=check_get_id();
	$_form_resp=db('modules','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('modules','edit') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<form id="modules" autocomplete="off" action="" onsubmit="return submitter(this,'<?=isset($controllerURL)? $controllerURL:urlPanel?>');" method="post" enctype="multipart/form-data">
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="modules"/> 
<input type="hidden" name="action" value="edit"/> 
<input type="hidden" name="id" value="<?=$id;?>"/> 

<!--inputs below -->
<!--
	

--><div class="form_field  modules_module_name" data-legion-field-type="text">
<label for="for_field_module_name"><?=l('Module Name<>');?></label>
<div class="input_area">
<input id="for_field_module_name"  type="text" name="module_name"   data-legion-module="modules" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['module_name']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  modules_module_prefix" data-legion-field-type="text">
<label for="for_field_module_prefix"><?=l('Module Prefix<>');?></label>
<div class="input_area">
<input id="for_field_module_prefix"  type="text" name="module_prefix"   data-legion-module="modules" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['module_prefix']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  modules_order_by" data-legion-field-type="number">
<label for="for_field_order_by"><?=l('Order By<>');?></label>
<div class="input_area">
<input id="for_field_order_by"  type="number" name="order_by"   data-legion-module="modules" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['order_by']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  modules_version" data-legion-field-type="text">
<label for="for_field_version"><?=l('Version<>');?></label>
<div class="input_area">
<input id="for_field_version"  type="text" name="version"   data-legion-module="modules" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['version']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  modules_main_icon" data-legion-field-type="text">
<label for="for_field_main_icon"><?=l('Main Icon<>');?></label>
<div class="input_area">
<input id="for_field_main_icon"  type="text" name="main_icon"   data-legion-module="modules" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['main_icon']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  modules_legion_version" data-legion-field-type="number">
<label for="for_field_legion_version"><?=l('Legion Version<>');?></label>
<div class="input_area">
<input id="for_field_legion_version"  type="number" name="legion_version"   data-legion-module="modules" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['legion_version']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  modules_legion_build" data-legion-field-type="number">
<label for="for_field_legion_build"><?=l('Legion Build<>');?></label>
<div class="input_area">
<input id="for_field_legion_build"  type="number" name="legion_build"   data-legion-module="modules" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['legion_build']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  modules_is_edit_only" data-legion-field-type="checkbox">
<label for="for_field_is_edit_only"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input <?=($_form_resp[0]['is_edit_only']==1 ? ' checked ':'');?>
 class=" css-checkbox" name="is_edit_only" type="checkbox" id="<?=$rand='a'.rand(); ?>"/>
			<label for="<?=$rand ?>"><?=l('Is Edit Only<>');?></label></div></div></div>
</div>
</div><!--


	

--><div class="form_field  modules_is_complemantary" data-legion-field-type="checkbox">
<label for="for_field_is_complemantary"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input <?=($_form_resp[0]['is_complemantary']==1 ? ' checked ':'');?>
 class=" css-checkbox" name="is_complemantary" type="checkbox" id="<?=$rand='a'.rand(); ?>"/>
			<label for="<?=$rand ?>"><?=l('Is Complemantary<>');?></label></div></div></div>
</div>
</div><!--


	

--><div class="form_field  modules_models" data-legion-field-type="text">
<label for="for_field_models"><?=l('Models<>');?></label>
<div class="input_area">
<input id="for_field_models"  type="text" name="models"   data-legion-module="modules" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['models']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  modules_ml" data-legion-field-type="checkbox">
<label for="for_field_ml"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input <?=($_form_resp[0]['ml']==1 ? ' checked ':'');?>
 class=" css-checkbox" name="ml" type="checkbox" id="<?=$rand='a'.rand(); ?>"/>
			<label for="<?=$rand ?>"><?=l('ML<>');?></label></div></div></div>
</div>
</div><!--


	

--><div class="form_field  modules_core" data-legion-field-type="checkbox">
<label for="for_field_core"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input <?=($_form_resp[0]['core']==1 ? ' checked ':'');?>
 class=" css-checkbox" name="core" type="checkbox" id="<?=$rand='a'.rand(); ?>"/>
			<label for="<?=$rand ?>"><?=l('Core<>');?></label></div></div></div>
</div>
</div><!--


	

--><div class="form_field  modules_cluster" data-legion-field-type="checkbox">
<label for="for_field_cluster"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input <?=($_form_resp[0]['cluster']==1 ? ' checked ':'');?>
 class=" css-checkbox" name="cluster" type="checkbox" id="<?=$rand='a'.rand(); ?>"/>
			<label for="<?=$rand ?>"><?=l('Cluster<>');?></label></div></div></div>
</div>
</div><!--


	

--><div class="form_field  modules_external_access" data-legion-field-type="checkbox">
<label for="for_field_external_access"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input <?=($_form_resp[0]['external_access']==1 ? ' checked ':'');?>
 class=" css-checkbox" name="external_access" type="checkbox" id="<?=$rand='a'.rand(); ?>"/>
			<label for="<?=$rand ?>"><?=l('External Access<>');?></label></div></div></div>
</div>
</div><!--


	

--><div class="form_field  modules_commerce" data-legion-field-type="checkbox">
<label for="for_field_commerce"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input <?=($_form_resp[0]['commerce']==1 ? ' checked ':'');?>
 class=" css-checkbox" name="commerce" type="checkbox" id="<?=$rand='a'.rand(); ?>"/>
			<label for="<?=$rand ?>"><?=l('Commerce<>');?></label></div></div></div>
</div>
</div><!--

-->
<!--inputs above -->
</form>
<?php } ?>