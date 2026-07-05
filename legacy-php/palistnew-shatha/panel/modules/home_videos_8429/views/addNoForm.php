<?php if(!privilege('home_videos_8429','add'))echo $noPermission;else{?>
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="home_videos_8429"/> 
<input type="hidden" name="action" value="add"/>
<!--inputs below --> 
<!--
	

--><div class="form_field home_videos_8429_video" data-legion-field-type="file">
<label for="for_field_video"><?=l('Video<>');?></label>
<div class="input_area">
<div class="po pvp_chooser" data-filetype="file" data-multi="false" onclick="pvp_core('home_videos_8429_video',false,true)"><img src="<?=u?>file.png"></div>
	<div class="in clearFiles po hidden" onclick="pvp_clear('home_videos_8429_video')"><i class="md-light">delete</i></div>
	<input type="hidden" name="video"/>
	<div class="count fileName in"><?=l('Selected<>الملفات المُختارة')?> <span>0</span></div>
	
</div>
</div><!--


	

--><div class="form_field home_videos_8429_title" data-legion-field-type="text">
<label for="for_field_title"><?=l('Title<>');?></label>
<div class="input_area">
<input id="for_field_title"  type="text"  data-legion-module="home_videos_8429" name="title" placeholder="" value=""/>
</div>
</div><!--

-->
<!--inputs above -->
<?php } ?>