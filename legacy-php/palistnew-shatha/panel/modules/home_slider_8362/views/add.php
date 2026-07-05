<?php if(!privilege('home_slider_8362','add'))echo $noPermission;else{?>
<form id="home_slider_8362" autocomplete="off" action="" onsubmit="return submitter(this,'<?=isset($controllerURL)? $controllerURL:urlPanel?>');" method="post" enctype="multipart/form-data">
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="home_slider_8362"/> 
<input type="hidden" name="action" value="add"/>
<!--inputs below --> 
<!--
	

--><div class="form_field home_slider_8362_title" data-legion-field-type="text">
<label for="for_field_title"><?=l('Title<>العنوان');?></label>
<div class="input_area">
<input id="for_field_title"  type="text"  data-legion-module="home_slider_8362" name="title" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field home_slider_8362_subtitle" data-legion-field-type="text">
<label for="for_field_subtitle"><?=l('Subtitle<>');?></label>
<div class="input_area">
<input id="for_field_subtitle"  type="text"  data-legion-module="home_slider_8362" name="subtitle" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field home_slider_8362_photo" data-legion-field-type="file">
<label for="for_field_photo"><?=l('Photo<>الصورة');?></label>
<div class="input_area">
<div class="po pvp_chooser" data-filetype="photo" data-multi="false" onclick="pvp_core('home_slider_8362_photo',false,false)"><img src="<?=u?>photo.png"></div>
	<div class="in clearFiles po hidden" onclick="pvp_clear('home_slider_8362_photo')"><i class="md-light">delete</i></div>
	<input type="hidden" name="photo"/>
	<div class="count fileName in"><?=l('Selected<>الملفات المُختارة')?> <span>0</span></div>
	
</div>
</div><!--


	

--><div class="form_field home_slider_8362_video" data-legion-field-type="file">
<label for="for_field_video"><?=l('Video<>');?></label>
<div class="input_area">
<div class="po pvp_chooser" data-filetype="file" data-multi="false" onclick="pvp_core('home_slider_8362_video',false,true)"><img src="<?=u?>file.png"></div>
	<div class="in clearFiles po hidden" onclick="pvp_clear('home_slider_8362_video')"><i class="md-light">delete</i></div>
	<input type="hidden" name="video"/>
	<div class="count fileName in"><?=l('Selected<>الملفات المُختارة')?> <span>0</span></div>
	
</div>
</div><!--


	

--><div class="form_field home_slider_8362_link" data-legion-field-type="url">
<label for="for_field_link"><?=l('Link<>الرابط');?></label>
<div class="input_area">
<input id="for_field_link"  type="url"  data-legion-module="home_slider_8362" name="link" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field home_slider_8362_order_number" data-legion-field-type="number">
<label for="for_field_order_number"><?=l('Order Number<>');?></label>
<div class="input_area">
<input id="for_field_order_number"  type="number"  data-legion-module="home_slider_8362" name="order_number" placeholder="" value=""/>
</div>
</div><!--

-->
<!--inputs above -->
</form>
<?php } ?>