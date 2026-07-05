<?php 
$original_edit_id=$id=check_get_id();
	$_form_resp=db('module_settings','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('module_settings','edit') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<form id="module_settings" autocomplete="off" action="" onsubmit="return submitter(this,'<?=isset($controllerURL)? $controllerURL:urlPanel?>');" method="post" enctype="multipart/form-data">
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="module_settings"/> 
<input type="hidden" name="action" value="edit"/> 
<input type="hidden" name="id" value="<?=$id;?>"/> 

<!--inputs below -->
<!--
	

--><div class="form_field  module_settings_module_prefix" data-legion-field-type="text">
<label for="for_field_module_prefix"><?=l('Module Prefix<>');?></label>
<div class="input_area">
<input id="for_field_module_prefix"  type="text" name="module_prefix"   data-legion-module="module_settings" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['module_prefix']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  module_settings_default_column" data-legion-field-type="text">
<label for="for_field_default_column"><?=l('Default Column<>');?></label>
<div class="input_area">
<input id="for_field_default_column"  type="text" name="default_column"   data-legion-module="module_settings" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['default_column']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  module_settings_default_order" data-legion-field-type="text">
<label for="for_field_default_order"><?=l('Default Order<>');?></label>
<div class="input_area">
<input id="for_field_default_order"  type="text" name="default_order"   data-legion-module="module_settings" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['default_order']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  module_settings_items_per_page" data-legion-field-type="number">
<label for="for_field_items_per_page"><?=l('Items Per Page<>');?></label>
<div class="input_area">
<input id="for_field_items_per_page"  type="number" name="items_per_page"   data-legion-module="module_settings" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['items_per_page']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  module_settings_ml_fields" data-legion-field-type="text">
<label for="for_field_ml_fields"><?=l('ML Fields<>');?></label>
<div class="input_area">
<input id="for_field_ml_fields"  type="text" name="ml_fields"   data-legion-module="module_settings" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['ml_fields']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  module_settings_menu_field" data-legion-field-type="text">
<label for="for_field_menu_field"><?=l('Menu Field<>');?></label>
<div class="input_area">
<input id="for_field_menu_field"  type="text" name="menu_field"   data-legion-module="module_settings" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['menu_field']) ?>"/>
</div>
</div><!--

-->
<!--inputs above -->
</form>
<?php } ?>