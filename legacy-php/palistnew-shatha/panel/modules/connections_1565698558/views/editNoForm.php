<?php 
$id=check_get_id();
	$_form_resp=db('connections_1565698558','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('connections_1565698558','edit') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="connections_1565698558"/> 
<input type="hidden" name="action" value="edit"/> 
<input type="hidden" name="id" value="<?=$id;?>"/> 

<!--inputs below -->
<!--
	

--><div class="form_field  connections_1565698558_g_analytics" data-legion-field-type="textarea">
<label for="for_field_g_analytics"><?=l('G Analytics<>احصائيات جووجل');?></label>
<div class="input_area">
<textarea   placeholder="" data-max_count="500"  class="mceNoEditor " name="g_analytics"><?=htmlentities($_form_resp[0]['g_analytics'])?></textarea>
</div>
</div><!--


	

--><div class="form_field ontwo in  connections_1565698558_facebook_page_id" data-legion-field-type="text">
<label for="for_field_facebook_page_id"><?=l('Facebook Page ID<>رقم معرف صفحة الفيسبوك');?></label>
<div class="input_area">
<input id="for_field_facebook_page_id"  type="text" name="facebook_page_id" data-l_module="connections_1565698558" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['facebook_page_id']) ?>"/>
</div>
</div><!--


	

--><div class="form_field ontwo in  connections_1565698558_facebook_chat_color" data-legion-field-type="color">
<label for="for_field_facebook_chat_color"><?=l('Facebook Chat Color<>لون محادثات الفيسبوك');?></label>
<div class="input_area">
<input id="for_field_facebook_chat_color"  type="color" name="facebook_chat_color" data-l_module="connections_1565698558" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['facebook_chat_color']) ?>"/>
</div>
</div><!--


	

--><div class="form_field ontwo in  connections_1565698558_fb_app_id" data-legion-field-type="text">
<label for="for_field_fb_app_id"><?=l('FB App ID<>رقم التطبيق على الفيسبوك');?></label>
<div class="input_area">
<input id="for_field_fb_app_id"  type="text" name="fb_app_id" data-l_module="connections_1565698558" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['fb_app_id']) ?>"/>
</div>
</div><!--


	

--><div class="form_field ontwo in  connections_1565698558_fb_app_secret_key" data-legion-field-type="text">
<label for="for_field_fb_app_secret_key"><?=l('FB App Secret Key<>المفتاح السرّي لتطبيق الفيسبوك');?></label>
<div class="input_area">
<input id="for_field_fb_app_secret_key"  type="text" name="fb_app_secret_key" data-l_module="connections_1565698558" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['fb_app_secret_key']) ?>"/>
</div>
</div><!--


	

--><div class="form_field ontwo in  connections_1565698558_fb_app_analytics" data-legion-field-type="textarea">
<label for="for_field_fb_app_analytics"><?=l('FB App Analytics<>احصائيات تطبيق الفيسبوك');?></label>
<div class="input_area">
<textarea   placeholder="" data-max_count="500"  class="mceNoEditor " name="fb_app_analytics"><?=htmlentities($_form_resp[0]['fb_app_analytics'])?></textarea>
</div>
</div><!--


	

--><div class="form_field ontwo in  connections_1565698558_fb_pixel" data-legion-field-type="textarea">
<label for="for_field_fb_pixel"><?=l('FB Pixel<>فيسبوك بكسل');?></label>
<div class="input_area">
<textarea   placeholder="" data-max_count="500"  class="mceNoEditor " name="fb_pixel"><?=htmlentities($_form_resp[0]['fb_pixel'])?></textarea>
</div>
</div><!--


	

--><div class="form_field ontwo in  connections_1565698558_onesignal_app_id" data-legion-field-type="text">
<label for="for_field_onesignal_app_id"><?=l('OneSignal App ID<>رقم المعرف للونسجنال');?></label>
<div class="input_area">
<input id="for_field_onesignal_app_id"  type="text" name="onesignal_app_id" data-l_module="connections_1565698558" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['onesignal_app_id']) ?>"/>
</div>
</div><!--


	

--><div class="form_field ontwo in  connections_1565698558_onesignal_app_secret_key" data-legion-field-type="text">
<label for="for_field_onesignal_app_secret_key"><?=l('OneSignal App Secret Key<>المفتاح السرّي لتطبيق الونسجنال');?></label>
<div class="input_area">
<input id="for_field_onesignal_app_secret_key"  type="text" name="onesignal_app_secret_key" data-l_module="connections_1565698558" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['onesignal_app_secret_key']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  connections_1565698558_firebase_file_name" data-legion-field-type="text">
<label for="for_field_firebase_file_name"><?=l('Firebase File Name<>');?></label>
<div class="input_area">
<input id="for_field_firebase_file_name"  type="text" name="firebase_file_name" data-l_module="connections_1565698558" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['firebase_file_name']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  connections_1565698558_sharethis" data-legion-field-type="textarea">
<label for="for_field_sharethis"><?=l('Sharethis<>كود المشاركة على صفحات التواصل الاجتماعي');?></label>
<div class="input_area">
<textarea   placeholder="" data-max_count="500"  class="mceNoEditor " name="sharethis"><?=htmlentities($_form_resp[0]['sharethis'])?></textarea>
</div>
</div><!--


	

--><div class="form_field ontwo in  connections_1565698558_head_js" data-legion-field-type="textarea">
<label for="for_field_head_js"><?=l('Head JS<>كود جافاسكربت مقدمة الصفحة');?></label>
<div class="input_area">
<textarea   placeholder="" data-max_count="500"  class="mceNoEditor " name="head_js"><?=htmlentities($_form_resp[0]['head_js'])?></textarea>
</div>
</div><!--


	

--><div class="form_field ontwo in  connections_1565698558_footer_js" data-legion-field-type="textarea">
<label for="for_field_footer_js"><?=l('Footer JS<>كود جافاسكربت أسفل الصفحة');?></label>
<div class="input_area">
<textarea   placeholder="" data-max_count="500"  class="mceNoEditor " name="footer_js"><?=htmlentities($_form_resp[0]['footer_js'])?></textarea>
</div>
</div><!--

-->
<!--inputs above -->
<?php } ?>