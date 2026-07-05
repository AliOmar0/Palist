<?php if(!privilege('trainings_and_workshops_8419','add'))echo $noPermission;else{
require_once cms_dir.'plugins/tinymce/backendTinyCall.php';?>
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="trainings_and_workshops_8419"/> 
<input type="hidden" name="action" value="add"/>
<!--inputs below --> 
<!--
	

--><div class="form_field trainings_and_workshops_8419_title" data-legion-field-type="text">
<label for="for_field_title"><?=l('Title<>');?></label>
<div class="input_area">
<input id="for_field_title"  type="text"  data-legion-module="trainings_and_workshops_8419" name="title" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field trainings_and_workshops_8419_summary" data-legion-field-type="textarea">
<label for="for_field_summary"><?=l('Summary<>');?></label>
<div class="input_area">
<textarea   placeholder="" data-max_count="250" class="mceNoEditor " name="summary"></textarea>
</div>
</div><!--


	

--><div class="form_field trainings_and_workshops_8419_content" data-legion-field-type="textarea">
<label for="for_field_content"><?=l('Content<>');?></label>
<div class="input_area">
<textarea   placeholder="" data-max_count="0" class="" name="content"></textarea>
</div>
</div><!--


	

--><div class="form_field trainings_and_workshops_8419_photo" data-legion-field-type="file">
<label for="for_field_photo"><?=l('Photo<>');?></label>
<div class="input_area">
<div class="po pvp_chooser" data-filetype="photo" data-multi="false" onclick="pvp_core('trainings_and_workshops_8419_photo',false,false)"><img src="<?=u?>photo.png"></div>
	<div class="in clearFiles po h" onclick="pvp_clear('trainings_and_workshops_8419_photo')"><i class="md-light">delete</i></div>
	<input type="hidden" name="photo"/>
	<div class="count fileName in"><?=l('Selected<>الملفات المُختارة')?> <span>0</span></div>
	
</div>
</div><!--


	

--><div class="form_field trainings_and_workshops_8419_publish_date" data-legion-field-type="date">
<label for="for_field_publish_date"><?=l('Publish Date<>');?></label>
<div class="input_area">
<input id="for_field_publish_date"  type="date" name="publish_date" placeholder="" value="<?=date('Y-m-d', time()); ?>"/>
</div>
</div><!--

-->
<!--inputs above -->
<?php } ?>