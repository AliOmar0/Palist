<?php if(!privilege('fonts_1582219344','add'))echo $noPermission;else{?>
<form id="fonts_1582219344" autocomplete="off" action="" onsubmit="return submitter(this,'<?=isset($controllerURL)? $controllerURL:urlPanel?>');" method="post" enctype="multipart/form-data">
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="fonts_1582219344"/> 
<input type="hidden" name="action" value="add"/>
<!--inputs below --> 
<!--
	

--><div class="form_field fonts_1582219344_css_name" data-legion-field-type="text">
<label for="for_field_css_name"><?=l('CSS Name<>اسم الخط');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_css_name"  required type="text" data-legion-unique="true" data-legion-module="fonts_1582219344" name="css_name" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field fonts_1582219344_file" data-legion-field-type="file">
<label for="for_field_file"><?=l('File<>الملف');?> <span class="required_star">*</span></label>
<div class="input_area">
<div class="po pvp_chooser" data-filetype="file" data-multi="false" onclick="pvp_core('fonts_1582219344_file',false,true)"><img src="<?=u?>file.png"></div>
	<div class="in clearFiles po h" onclick="pvp_clear('fonts_1582219344_file')"><i class="md-light">delete</i></div>
	<input type="hidden" name="file"/>
	<div class="count fileName in"><?=l('Selected<>الملفات المُختارة')?> <span>0</span></div>
	
</div>
</div><!--

-->
<!--inputs above -->
</form>
<?php } ?>