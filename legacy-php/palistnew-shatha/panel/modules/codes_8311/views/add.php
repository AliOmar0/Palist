<?php if(!privilege('codes_8311','add'))echo $noPermission;else{?>
<form id="codes_8311" autocomplete="off" action="" onsubmit="return submitter(this,'<?=isset($controllerURL)? $controllerURL:urlPanel?>');" method="post" enctype="multipart/form-data">
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="codes_8311"/> 
<input type="hidden" name="action" value="add"/>
<!--inputs below --> 
<!--
	

--><div class="form_field codes_8311_title" data-legion-field-type="text">
<label for="for_field_title"><?=l('Title<>');?></label>
<div class="input_area">
<input id="for_field_title"  type="text"  data-legion-module="codes_8311" name="title" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field codes_8311_dimension" data-legion-field-type="number">
<label for="for_field_dimension"><?=l('Dimension<>');?></label>
<div class="input_area">
<input id="for_field_dimension"  type="number"  data-legion-module="codes_8311" name="dimension" placeholder="" value="512"/>
</div>
</div><!--


	

--><div class="form_field codes_8311_value" data-legion-field-type="textarea">
<label for="for_field_value"><?=l('Value<>');?></label>
<div class="input_area">
<textarea   placeholder="" data-max_count="500" class="mceNoEditor " name="value"></textarea>
</div>
</div><!--


	

--><div class="form_field codes_8311_color" data-legion-field-type="color">
<label for="for_field_color"><?=l('Color<>');?></label>
<div class="input_area">
<input id="for_field_color"  type="color"  data-legion-module="codes_8311" name="color" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field codes_8311_hash_origin" data-legion-field-type="textarea">
<label for="for_field_hash_origin"><?=l('Hash Origin<>');?></label>
<div class="input_area">
<textarea   placeholder="" data-max_count="500" class="mceNoEditor " name="hash_origin"></textarea>
</div>
</div><!--


	

--><div class="form_field codes_8311_hash" data-legion-field-type="textarea">
<label for="for_field_hash"><?=l('Hash<>');?></label>
<div class="input_area">
<textarea   placeholder="" data-max_count="500" class="mceNoEditor " name="hash"></textarea>
</div>
</div><!--


	

--><div class="form_field codes_8311_photo" data-legion-field-type="file">
<label for="for_field_photo"><?=l('Photo<>');?></label>
<div class="input_area">
<div class="po pvp_chooser" data-filetype="photo" data-multi="false" onclick="pvp_core('codes_8311_photo',false,false)"><img src="<?=u?>photo.png"></div>
	<div class="in clearFiles po h" onclick="pvp_clear('codes_8311_photo')"><i class="md-light">delete</i></div>
	<input type="hidden" name="photo"/>
	<div class="count fileName in"><?=l('Selected<>الملفات المُختارة')?> <span>0</span></div>
	
</div>
</div><!--

-->
<!--inputs above -->
</form>
<?php } ?>