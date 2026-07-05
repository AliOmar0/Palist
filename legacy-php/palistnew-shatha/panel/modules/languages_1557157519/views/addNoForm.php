<?php if(!privilege('languages_1557157519','add'))echo $noPermission;else{?>
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="languages_1557157519"/> 
<input type="hidden" name="action" value="add"/>
<!--inputs below --> 
<!--
	

--><div class="form_field languages_1557157519_title" data-legion-field-type="text">
<label for="for_field_title"><?=l('Title<>العنوان');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_title"  required type="text"  data-l_module="languages_1557157519" name="title" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field languages_1557157519_prefix" data-legion-field-type="text">
<label for="for_field_prefix"><?=l('Prefix<>الدالة');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_prefix"  required type="text"  data-l_module="languages_1557157519" name="prefix" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field languages_1557157519_language_name" data-legion-field-type="text">
<label for="for_field_language_name"><?=l('Language Name<>اسم اللغة');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_language_name"  required type="text"  data-l_module="languages_1557157519" name="language_name" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field languages_1557157519_direction" data-legion-field-type="text">
<label for="for_field_direction"><?=l('Direction<>اتجاه الكتابة');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_direction"  required type="text"  data-l_module="languages_1557157519" name="direction" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field languages_1557157519_active" data-legion-field-type="checkbox">
<label for="for_field_active"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input   checked  class="css-checkbox" type="checkbox" name="active"  id="<?=$rand='a'.rand(); ?>" />
			<label for="<?=$rand?>"><?=l('Active<>التفعيل');?></label></div></div></div>
</div>
</div><!--

-->
<!--inputs above -->
<?php } ?>