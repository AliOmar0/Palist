<?php if(!privilege('control_1566842582','add'))echo $noPermission;else{
require_once cms_dir.'plugins/tinymce/backendTinyCall.php';?>
<form id="control_1566842582" autocomplete="off" action="" onsubmit="return submitter(this,'<?=isset($controllerURL)? $controllerURL:urlPanel?>');" method="post" enctype="multipart/form-data">
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="control_1566842582"/> 
<input type="hidden" name="action" value="add"/>
<!--inputs below --> 
<!--
	

--><div class="form_field control_1566842582_title" data-legion-field-type="text">
<label for="for_field_title"><?=l('Title<>العنوان');?></label>
<div class="input_area">
<input id="for_field_title"  type="text"  data-l_is_ml="true" data-l_module="control_1566842582" name="title" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field control_1566842582_code" data-legion-field-type="text">
<label for="for_field_code"><?=l('Code<>مُعَرِّف خاص');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_code"  required type="text" data-l_unique="true" data-l_module="control_1566842582" name="code" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field ontwo in control_1566842582_photo" data-legion-field-type="file">
<label for="for_field_photo"><?=l('Photo<>صورة');?></label>
<div class="input_area">
<div class="po pvp_chooser" data-filetype="photo" data-multi="false" onclick="pvp_core('control_1566842582_photo',false,false)"><img src="<?=u?>photo.png"></div>
	<div class="in clearFiles po h" onclick="pvp_clear('control_1566842582_photo')"><i class="md-light">delete</i></div>
	<input type="hidden" name="photo"/>
	<div class="count fileName in"><?=l('Selected<>الملفات المُختارة')?> <span>0</span></div>
	
</div>
</div><!--


	

--><div class="form_field ontwo in control_1566842582_file" data-legion-field-type="file">
<label for="for_field_file"><?=l('File<>');?></label>
<div class="input_area">
<div class="po pvp_chooser" data-filetype="file" data-multi="false" onclick="pvp_core('control_1566842582_file',false,true)"><img src="<?=u?>file.png"></div>
	<div class="in clearFiles po h" onclick="pvp_clear('control_1566842582_file')"><i class="md-light">delete</i></div>
	<input type="hidden" name="file"/>
	<div class="count fileName in"><?=l('Selected<>الملفات المُختارة')?> <span>0</span></div>
	
</div>
</div><!--


	

--><div class="form_field ontwo in control_1566842582_color" data-legion-field-type="color">
<label for="for_field_color"><?=l('Color<>');?></label>
<div class="input_area">
<input id="for_field_color"  type="color"  data-l_module="control_1566842582" name="color" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field ontwo in control_1566842582_active" data-legion-field-type="checkbox">
<label for="for_field_active"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input   checked  class="css-checkbox" type="checkbox" name="active"  id="<?=$rand='a'.rand(); ?>" />
			<label for="<?=$rand?>"><?=l('Active<>');?></label></div></div></div>
</div>
</div><!--


	

--><div class="form_field control_1566842582_text" data-legion-field-type="textarea">
<label for="for_field_text"><?=l('Text<>النص');?></label>
<div class="input_area">
<textarea  data-l_is_ml="true"  placeholder="" data-max_count="250" class="mceNoEditor " name="text"></textarea>
</div>
</div><!--


	

--><div class="form_field control_1566842582_formatted_text" data-legion-field-type="textarea">
<label for="for_field_formatted_text"><?=l('Formatted Text<>النص الكامل');?></label>
<div class="input_area">
<textarea  data-l_is_ml="true"  placeholder="" data-max_count="0" class="" name="formatted_text"></textarea>
</div>
</div><!--

-->
<!--inputs above -->
</form>
<?php } ?>