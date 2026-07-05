<?php 
$id=check_get_id();
$_form_resp=db('apps_1552305519','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('apps_1552305519','view') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<div id="apps_1552305519_view_<?=$id;?>" class="viewActionDiv" data-id="<?=$id;?>" data-module="apps_1552305519"><!--

		--><div class="view_box  apps_1552305519_view_app_name  ">
<div class="view_label view_label_app_name"><?=l('App Name<>اسم التطبيق')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['app_name'])?></div>
</div><!--

		--><div class="view_box  apps_1552305519_view_app_icon  ">
<div class="view_label view_label_app_icon"><?=l('App Icon<>')?></div>
<div class="viewValue  "><?php if($_form_resp[0]['app_icon']!='')pic($_form_resp[0]['app_icon'],200,100)?></div>
</div><!--

		--><div class="view_box view_group apps_1552305519_view_iOS  ">
<div class="view_label view_label_iOS"><?=l('<>ابل')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['iOS'])?></div>
</div><clear></clear><!--

		--><div class="view_box  apps_1552305519_view_apple_version  onfour in ">
<div class="view_label view_label_apple_version"><?=l('Apple Version<>اصدار ابل')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['apple_version'])?></div>
</div><!--

		--><div class="view_box  apps_1552305519_view_apple_store_id  onfour in ">
<div class="view_label view_label_apple_store_id"><?=l('Apple Store ID<>رقم التطبيق')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['apple_store_id'])?></div>
</div><!--

		--><div class="view_box  apps_1552305519_view_ios_active  onfour in ">
<div class="view_label view_label_ios_active"><?=l('iOS Active<>فعّال')?></div>
<div class="viewValue  checkboxView "><i><?=$_form_resp[0]['ios_active']?'done':'close'?></i></div>
</div><!--

		--><div class="view_box  apps_1552305519_view_ios_download_image  onfour in ">
<div class="view_label view_label_ios_download_image"><?=l('iOS Download Image<>')?></div>
<div class="viewValue  "><?php if($_form_resp[0]['ios_download_image']!='')pic($_form_resp[0]['ios_download_image'],200,100)?></div>
</div><!--

		--><div class="view_box view_group apps_1552305519_view_Android  ">
<div class="view_label view_label_Android"><?=l('<>الاندرويد')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['Android'])?></div>
</div><clear></clear><!--

		--><div class="view_box  apps_1552305519_view_android_version  onfour in ">
<div class="view_label view_label_android_version"><?=l('Android Version<>إصدار الاندرويد')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['android_version'])?></div>
</div><!--

		--><div class="view_box  apps_1552305519_view_android_store_id  onfour in ">
<div class="view_label view_label_android_store_id"><?=l('Android Store ID<>رقم التطبيق')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['android_store_id'])?></div>
</div><!--

		--><div class="view_box  apps_1552305519_view_android_active  onfour in ">
<div class="view_label view_label_android_active"><?=l('Android Active<>فعّال')?></div>
<div class="viewValue  checkboxView "><i><?=$_form_resp[0]['android_active']?'done':'close'?></i></div>
</div><!--

		--><div class="view_box  apps_1552305519_view_android_download_image  onfour in ">
<div class="view_label view_label_android_download_image"><?=l('Android Download Image<>')?></div>
<div class="viewValue  "><?php if($_form_resp[0]['android_download_image']!='')pic($_form_resp[0]['android_download_image'],200,100)?></div>
</div><!--

--></div>
<?php } ?>