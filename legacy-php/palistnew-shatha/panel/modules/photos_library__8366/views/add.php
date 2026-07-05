<?php if(!privilege('photos_library__8366','add'))echo $noPermission;else{?>
<form id="photos_library__8366" autocomplete="off" action="" onsubmit="return submitter(this,'<?=isset($controllerURL)? $controllerURL:urlPanel?>');" method="post" enctype="multipart/form-data">
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="photos_library__8366"/> 
<input type="hidden" name="action" value="add"/>
<!--inputs below --> 
<!--
	

--><div class="form_field photos_library__8366_title" data-legion-field-type="text">
<label for="for_field_title"><?=l('Title<>العنوان');?></label>
<div class="input_area">
<input id="for_field_title"  type="text"  data-legion-module="photos_library__8366" name="title" placeholder="<?=l('Title<>العنوان');?>" value=""/>
</div>
</div><!--


	

--><div class="form_field photos_library__8366_cover_photo" data-legion-field-type="file">
<label for="for_field_cover_photo"><?=l('Cover Photo<>');?></label>
<div class="input_area">
<div class="po pvp_chooser" data-filetype="photo" data-multi="false" onclick="pvp_core('photos_library__8366_cover_photo',false,false)"><img src="<?=u?>photo.png"></div>
	<div class="in clearFiles po hidden" onclick="pvp_clear('photos_library__8366_cover_photo')"><i class="md-light">delete</i></div>
	<input type="hidden" name="cover_photo"/>
	<div class="count fileName in"><?=l('Selected<>الملفات المُختارة')?> <span>0</span></div>
	
</div>
</div><!--

-->
<!--inputs above -->
</form>
<?php } ?>