<?php 
$original_edit_id=$id=check_get_id();
	$_form_resp=db('apps_1552305519','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('apps_1552305519','edit') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<form id="apps_1552305519" autocomplete="off" action="" onsubmit="return submitter(this,'<?=isset($controllerURL)? $controllerURL:urlPanel?>');" method="post" enctype="multipart/form-data">
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="apps_1552305519"/> 
<input type="hidden" name="action" value="edit"/> 
<input type="hidden" name="id" value="<?=$id;?>"/> 

<!--inputs below -->
<!--
	

--><div class="form_field  apps_1552305519_app_name" data-legion-field-type="text">
<label for="for_field_app_name"><?=l('App Name<>اسم التطبيق');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_app_name"  required type="text" name="app_name"   data-legion-module="apps_1552305519" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['app_name']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  apps_1552305519_app_icon" data-legion-field-type="file">
<label for="for_field_app_icon"><?=l('App Icon<>');?></label>
				<div class="tip"><?=l("Can be used from custom_meta image, more specific for sharing links on apps")?></div>
<div class="input_area">
<div class="po pvp_chooser" data-filetype="photo" data-multi="false" onclick="pvp_core('apps_1552305519_app_icon',false,false)"><img src="<?=u.($_form_resp[0]['app_icon']=='' ? 'photo.png' : img($_form_resp[0]['app_icon'],200,100));  ?>" /></div>
	<div class="in clearFiles po <?=$_form_resp[0]['app_icon']=='' ? 'h':'' ?>" onclick="pvp_clear('apps_1552305519_app_icon')"><i class="md-light">delete</i></div>
	
	<input type="hidden" name="app_icon" value="<?=$_form_resp[0]['app_icon']?>"/>
	
	<div class="count fileName"><?=l('Selected<>الملفات المُختارة')?> <span><?=$_form_resp[0]['app_icon']=='' ? 0:count(explode(',',$_form_resp[0]['app_icon'])) ?></span>
	</div><clear></clear>
	<div class="fileName po"><a target="_blank" href="<?=u.detail('files_1577206823','full_name','full_name',$_form_resp[0]['app_icon'])?>"><?=detail('files_1577206823','original_name','full_name',$_form_resp[0]['app_icon'])?></a></div>
	
	
	
</div>
</div><!--

--><div class="big_group_wrap apps_1552305519_ios"><div class="big_group"><?=l('iOS<>ابل')?></div></div><!--
	

--><div class="form_field onfour in  apps_1552305519_apple_version" data-legion-field-type="text">
<label for="for_field_apple_version"><?=l('Apple Version<>اصدار ابل');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_apple_version"  required type="text" name="apple_version"   data-legion-module="apps_1552305519" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['apple_version']) ?>"/>
</div>
</div><!--


	

--><div class="form_field onfour in  apps_1552305519_apple_store_id" data-legion-field-type="text">
<label for="for_field_apple_store_id"><?=l('Apple Store ID<>رقم التطبيق');?></label>
<div class="input_area">
<input id="for_field_apple_store_id"  type="text" name="apple_store_id"   data-legion-module="apps_1552305519" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['apple_store_id']) ?>"/>
</div>
</div><!--


	

--><div class="form_field onfour in  apps_1552305519_ios_active" data-legion-field-type="checkbox">
<label for="for_field_ios_active"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input required <?=($_form_resp[0]['ios_active']==1 ? ' checked ':'');?>
 class=" css-checkbox" name="ios_active" type="checkbox" id="<?=$rand='a'.rand(); ?>"/>
			<label for="<?=$rand ?>"><?=l('iOS Active<>فعّال');?></label></div></div></div>
</div>
</div><!--


	

--><div class="form_field onfour in  apps_1552305519_ios_download_image" data-legion-field-type="file">
<label for="for_field_ios_download_image"><?=l('iOS Download Image<>');?></label>
<div class="input_area">
<div class="po pvp_chooser" data-filetype="photo" data-multi="false" onclick="pvp_core('apps_1552305519_ios_download_image',false,false)"><img src="<?=u.($_form_resp[0]['ios_download_image']=='' ? 'photo.png' : img($_form_resp[0]['ios_download_image'],200,100));  ?>" /></div>
	<div class="in clearFiles po <?=$_form_resp[0]['ios_download_image']=='' ? 'h':'' ?>" onclick="pvp_clear('apps_1552305519_ios_download_image')"><i class="md-light">delete</i></div>
	
	<input type="hidden" name="ios_download_image" value="<?=$_form_resp[0]['ios_download_image']?>"/>
	
	<div class="count fileName"><?=l('Selected<>الملفات المُختارة')?> <span><?=$_form_resp[0]['ios_download_image']=='' ? 0:count(explode(',',$_form_resp[0]['ios_download_image'])) ?></span>
	</div><clear></clear>
	<div class="fileName po"><a target="_blank" href="<?=u.detail('files_1577206823','full_name','full_name',$_form_resp[0]['ios_download_image'])?>"><?=detail('files_1577206823','original_name','full_name',$_form_resp[0]['ios_download_image'])?></a></div>
	
	
	
</div>
</div><!--

--><div class="big_group_wrap apps_1552305519_android"><div class="big_group"><?=l('Android<>الاندرويد')?></div></div><!--
	

--><div class="form_field onfour in  apps_1552305519_android_version" data-legion-field-type="text">
<label for="for_field_android_version"><?=l('Android Version<>إصدار الاندرويد');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_android_version"  required type="text" name="android_version"   data-legion-module="apps_1552305519" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['android_version']) ?>"/>
</div>
</div><!--


	

--><div class="form_field onfour in  apps_1552305519_android_store_id" data-legion-field-type="text">
<label for="for_field_android_store_id"><?=l('Android Store ID<>رقم التطبيق');?></label>
<div class="input_area">
<input id="for_field_android_store_id"  type="text" name="android_store_id"   data-legion-module="apps_1552305519" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['android_store_id']) ?>"/>
</div>
</div><!--


	

--><div class="form_field onfour in  apps_1552305519_android_active" data-legion-field-type="checkbox">
<label for="for_field_android_active"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input <?=($_form_resp[0]['android_active']==1 ? ' checked ':'');?>
 class=" css-checkbox" name="android_active" type="checkbox" id="<?=$rand='a'.rand(); ?>"/>
			<label for="<?=$rand ?>"><?=l('Android Active<>فعّال');?></label></div></div></div>
</div>
</div><!--


	

--><div class="form_field onfour in  apps_1552305519_android_download_image" data-legion-field-type="file">
<label for="for_field_android_download_image"><?=l('Android Download Image<>');?></label>
<div class="input_area">
<div class="po pvp_chooser" data-filetype="photo" data-multi="false" onclick="pvp_core('apps_1552305519_android_download_image',false,false)"><img src="<?=u.($_form_resp[0]['android_download_image']=='' ? 'photo.png' : img($_form_resp[0]['android_download_image'],200,100));  ?>" /></div>
	<div class="in clearFiles po <?=$_form_resp[0]['android_download_image']=='' ? 'h':'' ?>" onclick="pvp_clear('apps_1552305519_android_download_image')"><i class="md-light">delete</i></div>
	
	<input type="hidden" name="android_download_image" value="<?=$_form_resp[0]['android_download_image']?>"/>
	
	<div class="count fileName"><?=l('Selected<>الملفات المُختارة')?> <span><?=$_form_resp[0]['android_download_image']=='' ? 0:count(explode(',',$_form_resp[0]['android_download_image'])) ?></span>
	</div><clear></clear>
	<div class="fileName po"><a target="_blank" href="<?=u.detail('files_1577206823','full_name','full_name',$_form_resp[0]['android_download_image'])?>"><?=detail('files_1577206823','original_name','full_name',$_form_resp[0]['android_download_image'])?></a></div>
	
	
	
</div>
</div><!--

-->
<!--inputs above -->
</form>
<?php } ?>