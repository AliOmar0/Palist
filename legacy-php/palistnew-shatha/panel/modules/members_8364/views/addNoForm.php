<?php if(!privilege('members_8364','add'))echo $noPermission;else{
require_once cms_dir.'plugins/tinymce/backendTinyCall.php';?>
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="members_8364"/> 
<input type="hidden" name="action" value="add"/>
<!--inputs below --> 
<!--
	

--><div class="form_field members_8364_name" data-legion-field-type="text">
<label for="for_field_name"><?=l('Name<>الاسم');?></label>
<div class="input_area">
<input id="for_field_name"  type="text"  data-legion-module="members_8364" name="name" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field members_8364_job_name" data-legion-field-type="text">
<label for="for_field_job_name"><?=l('Job Name<>اسم الوظيفة');?></label>
<div class="input_area">
<input id="for_field_job_name"  type="text"  data-legion-module="members_8364" name="job_name" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field members_8364_photo" data-legion-field-type="file">
<label for="for_field_photo"><?=l('Photo<>صورة');?></label>
<div class="input_area">
<div class="po pvp_chooser" data-filetype="photo" data-multi="false" onclick="pvp_core('members_8364_photo',false,false)"><img src="<?=u?>photo.png"></div>
	<div class="in clearFiles po hidden" onclick="pvp_clear('members_8364_photo')"><i class="md-light">delete</i></div>
	<input type="hidden" name="photo"/>
	<div class="count fileName in"><?=l('Selected<>الملفات المُختارة')?> <span>0</span></div>
	
</div>
</div><!--


	

--><div class="form_field members_8364_summary" data-legion-field-type="textarea">
<label for="for_field_summary"><?=l('Summary<>');?></label>
<div class="input_area">
<textarea   placeholder="" data-max_count="250" class="mceNoEditor " name="summary"></textarea>
</div>
</div><!--


	

--><div class="form_field members_8364_content" data-legion-field-type="textarea">
<label for="for_field_content"><?=l('Content<>المحتوى');?></label>
<div class="input_area">
<textarea   placeholder="" data-max_count="0" class="" name="content"></textarea>
</div>
</div><!--


	

--><div class="form_field members_8364_order_number" data-legion-field-type="text">
<label for="for_field_order_number"><?=l('Order Number<>');?></label>
<div class="input_area">
<input id="for_field_order_number"  type="text"  data-legion-module="members_8364" name="order_number" placeholder="" value=""/>
</div>
</div><!--

-->
<!--inputs above -->
<?php } ?>