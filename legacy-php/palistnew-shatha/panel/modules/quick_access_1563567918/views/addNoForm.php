<?php if(!privilege('quick_access_1563567918','add'))echo $noPermission;else{?>
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="quick_access_1563567918"/> 
<input type="hidden" name="action" value="add"/>
<!--inputs below --> 
<!--
	

--><div class="form_field quick_access_1563567918_module_prefix" data-legion-field-type="text">
<label for="for_field_module_prefix"><?=l('Module Prefix<>البرمجية');?></label>
<div class="input_area">
<input id="for_field_module_prefix"  type="text"  data-legion-module="quick_access_1563567918" name="module_prefix" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field quick_access_1563567918_action_of_module" data-legion-field-type="text">
<label for="for_field_action_of_module"><?=l('Action of Module<>الأمر');?></label>
<div class="input_area">
<input id="for_field_action_of_module"  type="text"  data-legion-module="quick_access_1563567918" name="action_of_module" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field quick_access_1563567918_title_of_link" data-legion-field-type="text">
<label for="for_field_title_of_link"><?=l('Title of link<>عنوان الرابط');?></label>
<div class="input_area">
<input id="for_field_title_of_link"  type="text"  data-legion-module="quick_access_1563567918" name="title_of_link" placeholder="" value=""/>
</div>
</div><!--

--><div class="big_group_wrap quick_access_1563567918_custom"><div class="big_group"><?=l('Custom<>')?></div></div><!--
	

--><div class="form_field quick_access_1563567918_custom_link" data-legion-field-type="text">
<label for="for_field_custom_link"><?=l('Custom Link<>');?>
<div class="help">
	<i>help_outline</i>
	<span><?=l('after urlPanel')?></span>
</div>
</label>
<div class="input_area">
<input id="for_field_custom_link"  type="text"  data-legion-module="quick_access_1563567918" name="custom_link" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field quick_access_1563567918_icon" data-legion-field-type="material-icon">
<label for="for_field_icon"><?=l('Icon<>');?></label>
<div class="input_area">
<input class="use-material-icon-picker" id="for_field_icon"  type="text" name="icon" placeholder="" value=""/>
</div>
</div><!--

-->
<!--inputs above -->
<?php } ?>