<?php if(!privilege('uploader_1585790561','add'))echo $noPermission;else{?>
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="uploader_1585790561"/> 
<input type="hidden" name="action" value="add"/>
<!--inputs below --> 
<!--
	

--><div class="form_field uploader_1585790561_photo" data-legion-field-type="file">
<label for="for_field_photo"><?=l('Photo<>');?></label>
<div class="input_area">
<div class="po pvp_chooser" data-filetype="photo" data-multi="false" onclick="pvp_core('uploader_1585790561_photo',false,false)"><img src="<?=u?>photo.png"></div>
	<div class="in clearFiles po h" onclick="pvp_clear('uploader_1585790561_photo')"><i class="md-light">delete</i></div>
	<input type="hidden" name="photo"/>
	<div class="count fileName in"><?=l('Selected<>الملفات المُختارة')?> <span>0</span></div>
	
</div>
</div><!--


	

--><div class="form_field uploader_1585790561_file" data-legion-field-type="file">
<label for="for_field_file"><?=l('File<>');?></label>
<div class="input_area">
<div class="po pvp_chooser" data-filetype="file" data-multi="false" onclick="pvp_core('uploader_1585790561_file',false,true)"><img src="<?=u?>file.png"></div>
	<div class="in clearFiles po h" onclick="pvp_clear('uploader_1585790561_file')"><i class="md-light">delete</i></div>
	<input type="hidden" name="file"/>
	<div class="count fileName in"><?=l('Selected<>الملفات المُختارة')?> <span>0</span></div>
	
</div>
</div><!--

-->
<!--inputs above -->
<?php } ?>