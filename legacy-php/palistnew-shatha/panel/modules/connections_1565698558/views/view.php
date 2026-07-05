<?php 
$id=check_get_id();
$_form_resp=db('connections_1565698558','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('connections_1565698558','view') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<div id="connections_1565698558_view_<?=$id;?>" class="viewActionDiv" data-id="<?=$id;?>" data-module="connections_1565698558"><!--

		--><div class="view_box  connections_1565698558_view_g_analytics  ">
<div class="view_label view_label_g_analytics"><?=l('G Analytics<>احصائيات جووجل')?></div>
<div class="viewValue  viewText mce "><?=l($_form_resp[0]['g_analytics'])?></div>
</div><!--

		--><div class="view_box  connections_1565698558_view_facebook_page_id  ontwo in ">
<div class="view_label view_label_facebook_page_id"><?=l('Facebook Page ID<>رقم معرف صفحة الفيسبوك')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['facebook_page_id'])?></div>
</div><!--

		--><div class="view_box  connections_1565698558_view_facebook_chat_color  ontwo in ">
<div class="view_label view_label_facebook_chat_color"><?=l('Facebook Chat Color<>لون محادثات الفيسبوك')?></div>
<div class="viewValue  colorView style="background:<?=$_form_resp[0]['facebook_chat_color']?>""></div>
</div><!--

		--><div class="view_box  connections_1565698558_view_fb_app_id  ontwo in ">
<div class="view_label view_label_fb_app_id"><?=l('FB App ID<>رقم التطبيق على الفيسبوك')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['fb_app_id'])?></div>
</div><!--

		--><div class="view_box  connections_1565698558_view_fb_app_secret_key  ontwo in ">
<div class="view_label view_label_fb_app_secret_key"><?=l('FB App Secret Key<>المفتاح السرّي لتطبيق الفيسبوك')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['fb_app_secret_key'])?></div>
</div><!--

		--><div class="view_box  connections_1565698558_view_fb_app_analytics  ontwo in ">
<div class="view_label view_label_fb_app_analytics"><?=l('FB App Analytics<>احصائيات تطبيق الفيسبوك')?></div>
<div class="viewValue  viewText mce "><?=l($_form_resp[0]['fb_app_analytics'])?></div>
</div><!--

		--><div class="view_box  connections_1565698558_view_fb_pixel  ontwo in ">
<div class="view_label view_label_fb_pixel"><?=l('FB Pixel<>فيسبوك بكسل')?></div>
<div class="viewValue  viewText mce "><?=l($_form_resp[0]['fb_pixel'])?></div>
</div><!--

		--><div class="view_box  connections_1565698558_view_onesignal_app_id  ontwo in ">
<div class="view_label view_label_onesignal_app_id"><?=l('OneSignal App ID<>رقم المعرف للونسجنال')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['onesignal_app_id'])?></div>
</div><!--

		--><div class="view_box  connections_1565698558_view_onesignal_app_secret_key  ontwo in ">
<div class="view_label view_label_onesignal_app_secret_key"><?=l('OneSignal App Secret Key<>المفتاح السرّي لتطبيق الونسجنال')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['onesignal_app_secret_key'])?></div>
</div><!--

		--><div class="view_box  connections_1565698558_view_firebase_file_name  ">
<div class="view_label view_label_firebase_file_name"><?=l('Firebase File Name<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['firebase_file_name'])?></div>
</div><!--

		--><div class="view_box  connections_1565698558_view_sharethis  ">
<div class="view_label view_label_sharethis"><?=l('Sharethis<>كود المشاركة على صفحات التواصل الاجتماعي')?></div>
<div class="viewValue  viewText mce "><?=l($_form_resp[0]['sharethis'])?></div>
</div><!--

		--><div class="view_box  connections_1565698558_view_head_js  ontwo in ">
<div class="view_label view_label_head_js"><?=l('Head JS<>كود جافاسكربت مقدمة الصفحة')?></div>
<div class="viewValue  viewText mce "><?=l($_form_resp[0]['head_js'])?></div>
</div><!--

		--><div class="view_box  connections_1565698558_view_footer_js  ontwo in ">
<div class="view_label view_label_footer_js"><?=l('Footer JS<>كود جافاسكربت أسفل الصفحة')?></div>
<div class="viewValue  viewText mce "><?=l($_form_resp[0]['footer_js'])?></div>
</div><!--

--></div>
<?php } ?>