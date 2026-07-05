<?php if(!privilege('apps_1552305519','add'))echo $noPermission;else{?>
<form id="apps_1552305519" autocomplete="off" action="" onsubmit="return submitter(this,'<?=isset($controllerURL)? $controllerURL:urlPanel?>');" method="post" enctype="multipart/form-data">
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="apps_1552305519"/> 
<input type="hidden" name="action" value="add"/>
<!--inputs below --> 
<!--
	

--><div class="form_field apps_1552305519_app_name" data-legion-field-type="text">
<label for="for_field_app_name"><?=l('App Name<>اسم التطبيق');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_app_name"  required type="text"  data-legion-module="apps_1552305519" name="app_name" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field apps_1552305519_app_icon" data-legion-field-type="file">
<label for="for_field_app_icon"><?=l('App Icon<>');?></label>
				<div class="tip"><?=l("Can be used from custom_meta image, more specific for sharing links on apps")?></div>
<div class="input_area">
<div class="po pvp_chooser" data-filetype="photo" data-multi="false" onclick="pvp_core('apps_1552305519_app_icon',false,false)"><img src="<?=u?>photo.png"></div>
	<div class="in clearFiles po h" onclick="pvp_clear('apps_1552305519_app_icon')"><i class="md-light">delete</i></div>
	<input type="hidden" name="app_icon"/>
	<div class="count fileName in"><?=l('Selected<>الملفات المُختارة')?> <span>0</span></div>
	
</div>
</div><!--

--><div class="big_group_wrap apps_1552305519_ios"><div class="big_group"><?=l('iOS<>ابل')?></div></div><!--
	

--><div class="form_field onfour in apps_1552305519_apple_version" data-legion-field-type="text">
<label for="for_field_apple_version"><?=l('Apple Version<>اصدار ابل');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_apple_version"  required type="text"  data-legion-module="apps_1552305519" name="apple_version" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field onfour in apps_1552305519_apple_store_id" data-legion-field-type="text">
<label for="for_field_apple_store_id"><?=l('Apple Store ID<>رقم التطبيق');?></label>
<div class="input_area">
<input id="for_field_apple_store_id"  type="text"  data-legion-module="apps_1552305519" name="apple_store_id" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field onfour in apps_1552305519_ios_active" data-legion-field-type="checkbox">
<label for="for_field_ios_active"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input   checked  class="css-checkbox" type="checkbox" name="ios_active"  id="<?=$rand='a'.rand(); ?>" />
			<label for="<?=$rand?>"><?=l('iOS Active<>فعّال');?></label></div></div></div>
</div>
</div><!--


	

--><div class="form_field onfour in apps_1552305519_ios_download_image" data-legion-field-type="file">
<label for="for_field_ios_download_image"><?=l('iOS Download Image<>');?></label>
<div class="input_area">
<div class="po pvp_chooser" data-filetype="photo" data-multi="false" onclick="pvp_core('apps_1552305519_ios_download_image',false,false)"><img src="<?=u?>photo.png"></div>
	<div class="in clearFiles po h" onclick="pvp_clear('apps_1552305519_ios_download_image')"><i class="md-light">delete</i></div>
	<input type="hidden" name="ios_download_image"/>
	<div class="count fileName in"><?=l('Selected<>الملفات المُختارة')?> <span>0</span></div>
	
</div>
</div><!--

--><div class="big_group_wrap apps_1552305519_android"><div class="big_group"><?=l('Android<>الاندرويد')?></div></div><!--
	

--><div class="form_field onfour in apps_1552305519_android_version" data-legion-field-type="text">
<label for="for_field_android_version"><?=l('Android Version<>إصدار الاندرويد');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_android_version"  required type="text"  data-legion-module="apps_1552305519" name="android_version" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field onfour in apps_1552305519_android_store_id" data-legion-field-type="text">
<label for="for_field_android_store_id"><?=l('Android Store ID<>رقم التطبيق');?></label>
<div class="input_area">
<input id="for_field_android_store_id"  type="text"  data-legion-module="apps_1552305519" name="android_store_id" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field onfour in apps_1552305519_android_active" data-legion-field-type="checkbox">
<label for="for_field_android_active"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input   checked  class="css-checkbox" type="checkbox" name="android_active"  id="<?=$rand='a'.rand(); ?>" />
			<label for="<?=$rand?>"><?=l('Android Active<>فعّال');?></label></div></div></div>
</div>
</div><!--


	

--><div class="form_field onfour in apps_1552305519_android_download_image" data-legion-field-type="file">
<label for="for_field_android_download_image"><?=l('Android Download Image<>');?></label>
<div class="input_area">
<div class="po pvp_chooser" data-filetype="photo" data-multi="false" onclick="pvp_core('apps_1552305519_android_download_image',false,false)"><img src="<?=u?>photo.png"></div>
	<div class="in clearFiles po h" onclick="pvp_clear('apps_1552305519_android_download_image')"><i class="md-light">delete</i></div>
	<input type="hidden" name="android_download_image"/>
	<div class="count fileName in"><?=l('Selected<>الملفات المُختارة')?> <span>0</span></div>
	
</div>
</div><!--

-->
<!--inputs above -->
</form>
<?php } ?>