<?php if(!privilege('tokens','add'))echo $noPermission;else{?>
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="tokens"/> 
<input type="hidden" name="action" value="add"/>
<!--inputs below --> 
<!--
	

--><div class="form_field ontwo in tokens_user_id" data-legion-field-type="number">
<label for="for_field_user_id"><?=l('User ID<>رقم مُعَرّف المستخدم');?></label>
<div class="input_area">
<input id="for_field_user_id"  type="number"  data-l_module="tokens" name="user_id" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field ontwo in tokens_module_prefix" data-legion-field-type="text">
<label for="for_field_module_prefix"><?=l('Module Prefix<>نوع المستخدم');?></label>
<div class="input_area">
<input id="for_field_module_prefix"  type="text"  data-l_module="tokens" name="module_prefix" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field tokens_token" data-legion-field-type="text">
<label for="for_field_token"><?=l('Token<>الشيفرة');?></label>
<div class="input_area">
<input id="for_field_token"  type="text"  data-l_module="tokens" name="token" placeholder="" value=""/>
</div>
</div><!--

--><div class="big_group_wrap tokens_deviceinfo"><div class="big_group"><?=l('Device Info<>')?></div></div><!--
	

--><div class="form_field onfour in tokens__d" data-legion-field-type="number">
<label for="for_field__d"><?=l('Device<>');?></label>
				<div class="tip"><?=l("0 undetected, 1 web, 2 iOS, 3 Android")?></div>
<div class="input_area">
<input id="for_field__d"  type="number"  data-l_module="tokens" name="_d" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field onfour in tokens_app_version" data-legion-field-type="text">
<label for="for_field_app_version"><?=l('App Version<>');?></label>
<div class="input_area">
<input id="for_field_app_version"  type="text"  data-l_module="tokens" name="app_version" placeholder="" value="0"/>
</div>
</div><!--


	

--><div class="form_field onfour in tokens_device_model" data-legion-field-type="text">
<label for="for_field_device_model"><?=l('Device Model<>');?></label>
<div class="input_area">
<input id="for_field_device_model"  type="text"  data-l_module="tokens" name="device_model" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field onfour in tokens_os_version" data-legion-field-type="text">
<label for="for_field_os_version"><?=l('OS Version<>');?></label>
<div class="input_area">
<input id="for_field_os_version"  type="text"  data-l_module="tokens" name="os_version" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field ontwo in tokens_browser_name" data-legion-field-type="text">
<label for="for_field_browser_name"><?=l('Browser Name<>');?></label>
<div class="input_area">
<input id="for_field_browser_name"  type="text"  data-l_module="tokens" name="browser_name" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field ontwo in tokens_browser" data-legion-field-type="textarea">
<label for="for_field_browser"><?=l('Browser<>');?></label>
<div class="input_area">
<textarea   placeholder="" data-max_count="500" class="mceNoEditor " name="browser"></textarea>
</div>
</div><!--


	

--><div class="form_field tokens_language" data-legion-field-type="select">
<label for="for_field_language"><?=l('Language<>');?></label>
<div class="input_area">
<select  id="for_field_language" class="l_mc l_white_c" name="language">
<?php 
$addition_where=NULL;

$_form_resp=db('languages_1557157519',"WHERE deleted=0   $addition_where",NULL,NULL);
			if($_form_resp==0){?><option value="0" selected><?=l('Error<>خطأ')?></option> <?php } 
			else if($_form_resp==1){?><option value="0" selected><?=l('Choose<>اختر');?></option><?php } 
				else {?>
                    <option value="0"><?=l('Choose<>اختر');?></option>
					<?php 
					if($_form_resp!=1){
						for($_i=0;$_i<count($_form_resp);$_i++){?>
						<option value="<?=$_form_resp[$_i]['id']?>">
						<?= select_echo('tokens','language',$_form_resp[$_i],true);?>
						</option>
						
						<?php 
							}//for
						}
					}//else
					unset($_form_resp);
					?>
			</select>
</div>
</div><!--

--><div class="big_group_wrap tokens_pushnotification"><div class="big_group"><?=l('Push Notification<>')?></div></div><!--
	

--><div class="form_field tokens_player_id" data-legion-field-type="text">
<label for="for_field_player_id"><?=l('Player ID<>');?></label>
<div class="input_area">
<input id="for_field_player_id"  type="text"  data-l_module="tokens" name="player_id" placeholder="" value=""/>
</div>
</div><!--

-->
<!--inputs above -->
<?php } ?>