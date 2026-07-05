<?php if(!privilege('documentations_8343','add'))echo $noPermission;else{
require_once cms_dir.'plugins/tinymce/backendTinyCall.php';?>
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="documentations_8343"/> 
<input type="hidden" name="action" value="add"/>
<!--inputs below --> 
<!--
	

--><div class="form_field documentations_8343_title" data-legion-field-type="text">
<label for="for_field_title"><?=l('Title<>العنوان');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_title"  required type="text"  data-legion-module="documentations_8343" name="title" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field documentations_8343_content" data-legion-field-type="textarea">
<label for="for_field_content"><?=l('Content<>');?></label>
<div class="input_area">
<textarea   placeholder="" data-max_count="0" class="" name="content"></textarea>
</div>
</div><!--


	

--><div class="form_field documentations_8343_errors" data-legion-field-type="checkbox">
<label for="for_field_errors"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input   class="css-checkbox" type="checkbox" name="errors"  id="<?=$rand='a'.rand(); ?>" />
			<label for="<?=$rand?>"><?=l('Errors<>');?></label></div></div></div>
</div>
</div><!--

-->
<!--inputs above -->
<?php } ?>