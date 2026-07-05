<?php if(!privilege('type_of_employment_8400','add'))echo $noPermission;else{?>
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="type_of_employment_8400"/> 
<input type="hidden" name="action" value="add"/>
<!--inputs below --> 
<!--
	

--><div class="form_field type_of_employment_8400_title" data-legion-field-type="text">
<label for="for_field_title"><?=l('Title<>');?></label>
<div class="input_area">
<input id="for_field_title"  type="text"  data-l_is_ml="true" data-l_module="type_of_employment_8400" name="title" placeholder="" value=""/>
</div>
</div><!--

-->
<!--inputs above -->
<?php } ?>