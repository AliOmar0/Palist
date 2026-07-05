<?php if(!privilege('video_gallery_8367','add'))echo $noPermission;else{?>
<form id="video_gallery_8367" autocomplete="off" action="" onsubmit="return submitter(this,'<?=isset($controllerURL)? $controllerURL:urlPanel?>');" method="post" enctype="multipart/form-data">
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="video_gallery_8367"/> 
<input type="hidden" name="action" value="add"/>
<!--inputs below --> 
<!--
	

--><div class="form_field video_gallery_8367_title" data-legion-field-type="text">
<label for="for_field_title"><?=l('Title<>العنوان');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_title"  required type="text"  data-legion-module="video_gallery_8367" name="title" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field video_gallery_8367_youtube_link" data-legion-field-type="url">
<label for="for_field_youtube_link"><?=l('Youtube Link<>رابط اليوتيوب');?></label>
<div class="input_area">
<input id="for_field_youtube_link"  type="url"  data-legion-module="video_gallery_8367" name="youtube_link" placeholder="" value=""/>
</div>
</div><!--

-->
<!--inputs above -->
</form>
<?php } ?>