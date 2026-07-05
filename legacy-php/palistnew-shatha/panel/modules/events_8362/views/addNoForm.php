<?php if(!privilege('events_8362','add'))echo $noPermission;else{
require_once cms_dir.'plugins/tinymce/backendTinyCall.php';?>
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="events_8362"/> 
<input type="hidden" name="action" value="add"/>
<!--inputs below --> 
<!--
	

--><div class="form_field events_8362_title" data-legion-field-type="text">
<label for="for_field_title"><?=l('Title<>العنوان');?></label>
<div class="input_area">
<input id="for_field_title"  type="text"  data-legion-module="events_8362" name="title" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field events_8362_event_date" data-legion-field-type="date">
<label for="for_field_event_date"><?=l('Event Date<>تاريخ المناسبة');?></label>
<div class="input_area">
<input id="for_field_event_date"  type="date"  data-legion-module="events_8362" name="event_date" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field events_8362_events_description" data-legion-field-type="textarea">
<label for="for_field_events_description"><?=l('Events Description<>وصف المناسبة');?></label>
<div class="input_area">
<textarea   placeholder="" data-max_count="0" class="" name="events_description"></textarea>
</div>
</div><!--


	

--><div class="form_field events_8362_photo" data-legion-field-type="file">
<label for="for_field_photo"><?=l('Photo<>صورة');?></label>
<div class="input_area">
<div class="po pvp_chooser" data-filetype="photo" data-multi="false" onclick="pvp_core('events_8362_photo',false,false)"><img src="<?=u?>photo.png"></div>
	<div class="in clearFiles po hidden" onclick="pvp_clear('events_8362_photo')"><i class="md-light">delete</i></div>
	<input type="hidden" name="photo"/>
	<div class="count fileName in"><?=l('Selected<>الملفات المُختارة')?> <span>0</span></div>
	
</div>
</div><!--

-->
<!--inputs above -->
<?php } ?>