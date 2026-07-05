<?php if(!privilege('module_settings','add'))echo $noPermission;else{?>
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="module_settings"/> 
<input type="hidden" name="action" value="add"/>
<!--inputs below --> 
<!--
	

--><div class="form_field module_settings_module_prefix" data-legion-field-type="text">
<label for="for_field_module_prefix"><?=l('Module Prefix<>');?></label>
<div class="input_area">
<input id="for_field_module_prefix"  type="text"  data-legion-module="module_settings" name="module_prefix" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field module_settings_default_column" data-legion-field-type="text">
<label for="for_field_default_column"><?=l('Default Column<>');?></label>
<div class="input_area">
<input id="for_field_default_column"  type="text"  data-legion-module="module_settings" name="default_column" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field module_settings_default_order" data-legion-field-type="text">
<label for="for_field_default_order"><?=l('Default Order<>');?></label>
<div class="input_area">
<input id="for_field_default_order"  type="text"  data-legion-module="module_settings" name="default_order" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field module_settings_items_per_page" data-legion-field-type="number">
<label for="for_field_items_per_page"><?=l('Items Per Page<>');?></label>
<div class="input_area">
<input id="for_field_items_per_page"  type="number"  data-legion-module="module_settings" name="items_per_page" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field module_settings_ml_fields" data-legion-field-type="text">
<label for="for_field_ml_fields"><?=l('ML Fields<>');?></label>
<div class="input_area">
<input id="for_field_ml_fields"  type="text"  data-legion-module="module_settings" name="ml_fields" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field module_settings_menu_field" data-legion-field-type="text">
<label for="for_field_menu_field"><?=l('Menu Field<>');?></label>
<div class="input_area">
<input id="for_field_menu_field"  type="text"  data-legion-module="module_settings" name="menu_field" placeholder="" value=""/>
</div>
</div><!--

-->
<!--inputs above -->
<?php } ?>