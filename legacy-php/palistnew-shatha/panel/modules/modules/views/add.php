<?php if(!privilege('modules','add'))echo $noPermission;else{?>
<form id="modules" autocomplete="off" action="" onsubmit="return submitter(this,'<?=isset($controllerURL)? $controllerURL:urlPanel?>');" method="post" enctype="multipart/form-data">
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="modules"/> 
<input type="hidden" name="action" value="add"/>
<!--inputs below --> 
<!--
	

--><div class="form_field modules_module_name" data-legion-field-type="text">
<label for="for_field_module_name"><?=l('Module Name<>');?></label>
<div class="input_area">
<input id="for_field_module_name"  type="text"  data-legion-module="modules" name="module_name" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field modules_module_prefix" data-legion-field-type="text">
<label for="for_field_module_prefix"><?=l('Module Prefix<>');?></label>
<div class="input_area">
<input id="for_field_module_prefix"  type="text"  data-legion-module="modules" name="module_prefix" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field modules_order_by" data-legion-field-type="number">
<label for="for_field_order_by"><?=l('Order By<>');?></label>
<div class="input_area">
<input id="for_field_order_by"  type="number"  data-legion-module="modules" name="order_by" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field modules_version" data-legion-field-type="text">
<label for="for_field_version"><?=l('Version<>');?></label>
<div class="input_area">
<input id="for_field_version"  type="text"  data-legion-module="modules" name="version" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field modules_main_icon" data-legion-field-type="text">
<label for="for_field_main_icon"><?=l('Main Icon<>');?></label>
<div class="input_area">
<input id="for_field_main_icon"  type="text"  data-legion-module="modules" name="main_icon" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field modules_legion_version" data-legion-field-type="number">
<label for="for_field_legion_version"><?=l('Legion Version<>');?></label>
<div class="input_area">
<input id="for_field_legion_version"  type="number"  data-legion-module="modules" name="legion_version" placeholder="" value="1"/>
</div>
</div><!--


	

--><div class="form_field modules_legion_build" data-legion-field-type="number">
<label for="for_field_legion_build"><?=l('Legion Build<>');?></label>
<div class="input_area">
<input id="for_field_legion_build"  type="number"  data-legion-module="modules" name="legion_build" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field modules_is_edit_only" data-legion-field-type="checkbox">
<label for="for_field_is_edit_only"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input   class="css-checkbox" type="checkbox" name="is_edit_only"  id="<?=$rand='a'.rand(); ?>" />
			<label for="<?=$rand?>"><?=l('Is Edit Only<>');?></label></div></div></div>
</div>
</div><!--


	

--><div class="form_field modules_is_complemantary" data-legion-field-type="checkbox">
<label for="for_field_is_complemantary"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input   class="css-checkbox" type="checkbox" name="is_complemantary"  id="<?=$rand='a'.rand(); ?>" />
			<label for="<?=$rand?>"><?=l('Is Complemantary<>');?></label></div></div></div>
</div>
</div><!--


	

--><div class="form_field modules_models" data-legion-field-type="text">
<label for="for_field_models"><?=l('Models<>');?></label>
<div class="input_area">
<input id="for_field_models"  type="text"  data-legion-module="modules" name="models" placeholder="" value="add,edit,delete,list,usage"/>
</div>
</div><!--


	

--><div class="form_field modules_ml" data-legion-field-type="checkbox">
<label for="for_field_ml"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input   class="css-checkbox" type="checkbox" name="ml"  id="<?=$rand='a'.rand(); ?>" />
			<label for="<?=$rand?>"><?=l('ML<>');?></label></div></div></div>
</div>
</div><!--


	

--><div class="form_field modules_core" data-legion-field-type="checkbox">
<label for="for_field_core"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input   class="css-checkbox" type="checkbox" name="core"  id="<?=$rand='a'.rand(); ?>" />
			<label for="<?=$rand?>"><?=l('Core<>');?></label></div></div></div>
</div>
</div><!--


	

--><div class="form_field modules_cluster" data-legion-field-type="checkbox">
<label for="for_field_cluster"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input   class="css-checkbox" type="checkbox" name="cluster"  id="<?=$rand='a'.rand(); ?>" />
			<label for="<?=$rand?>"><?=l('Cluster<>');?></label></div></div></div>
</div>
</div><!--


	

--><div class="form_field modules_external_access" data-legion-field-type="checkbox">
<label for="for_field_external_access"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input   class="css-checkbox" type="checkbox" name="external_access"  id="<?=$rand='a'.rand(); ?>" />
			<label for="<?=$rand?>"><?=l('External Access<>');?></label></div></div></div>
</div>
</div><!--


	

--><div class="form_field modules_commerce" data-legion-field-type="checkbox">
<label for="for_field_commerce"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input   class="css-checkbox" type="checkbox" name="commerce"  id="<?=$rand='a'.rand(); ?>" />
			<label for="<?=$rand?>"><?=l('Commerce<>');?></label></div></div></div>
</div>
</div><!--

-->
<!--inputs above -->
</form>
<?php } ?>