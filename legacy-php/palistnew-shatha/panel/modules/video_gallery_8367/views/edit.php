<?php 
$original_edit_id=$id=check_get_id();
	$_form_resp=db('video_gallery_8367','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('video_gallery_8367','edit') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<form id="video_gallery_8367" autocomplete="off" action="" onsubmit="return submitter(this,'<?=isset($controllerURL)? $controllerURL:urlPanel?>');" method="post" enctype="multipart/form-data">
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="video_gallery_8367"/> 
<input type="hidden" name="action" value="edit"/> 
<input type="hidden" name="id" value="<?=$id;?>"/> 

<!--inputs below -->
<!--
	

--><div class="form_field  video_gallery_8367_title" data-legion-field-type="text">
<label for="for_field_title"><?=l('Title<>العنوان');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_title"  required type="text" name="title"   data-legion-module="video_gallery_8367" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['title']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  video_gallery_8367_youtube_link" data-legion-field-type="url">
<label for="for_field_youtube_link"><?=l('Youtube Link<>رابط اليوتيوب');?></label>
<div class="input_area">
<input id="for_field_youtube_link"  type="url" name="youtube_link"   data-legion-module="video_gallery_8367" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['youtube_link']) ?>"/>
</div>
</div><!--

-->
<!--inputs above -->
</form>
<?php } ?>