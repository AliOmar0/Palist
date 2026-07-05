<?php if(!privilege('publications_8367','add'))echo $noPermission;else{?>
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="publications_8367"/> 
<input type="hidden" name="action" value="add"/>
<!--inputs below --> 
<!--
	

--><div class="form_field publications_8367_photo" data-legion-field-type="file">
<label for="for_field_photo"><?=l('Photo<>صورة');?></label>
<div class="input_area">
<div class="po pvp_chooser" data-filetype="photo" data-multi="false" onclick="pvp_core('publications_8367_photo',false,false)"><img src="<?=u?>photo.png"></div>
	<div class="in clearFiles po h" onclick="pvp_clear('publications_8367_photo')"><i class="md-light">delete</i></div>
	<input type="hidden" name="photo"/>
	<div class="count fileName in"><?=l('Selected<>الملفات المُختارة')?> <span>0</span></div>
	
</div>
</div><!--


	

--><div class="form_field publications_8367_title" data-legion-field-type="text">
<label for="for_field_title"><?=l('Title<>العنوان');?></label>
<div class="input_area">
<input id="for_field_title"  type="text"  data-legion-module="publications_8367" name="title" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field publications_8367_link" data-legion-field-type="url">
<label for="for_field_link"><?=l('Link<>');?></label>
<div class="input_area">
<input id="for_field_link"  type="url"  data-legion-module="publications_8367" name="link" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field publications_8367_publish_date" data-legion-field-type="date">
<label for="for_field_publish_date"><?=l('Publish Date<>تاريخ البرنامج');?></label>
<div class="input_area">
<input id="for_field_publish_date"  type="date"  data-legion-module="publications_8367" name="publish_date" placeholder="" value=""/>
</div>
</div><!--

-->
<!--inputs above -->
<?php } ?>