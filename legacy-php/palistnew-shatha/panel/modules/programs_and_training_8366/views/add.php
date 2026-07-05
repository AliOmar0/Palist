<?php if(!privilege('programs_and_training_8366','add'))echo $noPermission;else{
require_once cms_dir.'plugins/tinymce/backendTinyCall.php';?>
<form id="programs_and_training_8366" autocomplete="off" action="" onsubmit="return submitter(this,'<?=isset($controllerURL)? $controllerURL:urlPanel?>');" method="post" enctype="multipart/form-data">
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="programs_and_training_8366"/> 
<input type="hidden" name="action" value="add"/>
<!--inputs below --> 
<!--
	

--><div class="form_field programs_and_training_8366_photo" data-legion-field-type="file">
<label for="for_field_photo"><?=l('Photo<>صورة');?></label>
<div class="input_area">
<div class="po pvp_chooser" data-filetype="photo" data-multi="false" onclick="pvp_core('programs_and_training_8366_photo',false,false)"><img src="<?=u?>photo.png"></div>
	<div class="in clearFiles po hidden" onclick="pvp_clear('programs_and_training_8366_photo')"><i class="md-light">delete</i></div>
	<input type="hidden" name="photo"/>
	<div class="count fileName in"><?=l('Selected<>الملفات المُختارة')?> <span>0</span></div>
	
</div>
</div><!--


	

--><div class="form_field programs_and_training_8366_title" data-legion-field-type="text">
<label for="for_field_title"><?=l('Title<>العنوان');?></label>
<div class="input_area">
<input id="for_field_title"  type="text"  data-legion-module="programs_and_training_8366" name="title" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field programs_and_training_8366_content" data-legion-field-type="textarea">
<label for="for_field_content"><?=l('Content<>المحتوى');?></label>
<div class="input_area">
<textarea   placeholder="" data-max_count="0" class="" name="content"></textarea>
</div>
</div><!--


	

--><div class="form_field programs_and_training_8366_publish_date" data-legion-field-type="date">
<label for="for_field_publish_date"><?=l('Publish Date<>تاريخ البرنامج');?></label>
<div class="input_area">
<input id="for_field_publish_date"  type="date"  data-legion-module="programs_and_training_8366" name="publish_date" placeholder="" value=""/>
</div>
</div><!--

-->
<!--inputs above -->
</form>
<?php } ?>