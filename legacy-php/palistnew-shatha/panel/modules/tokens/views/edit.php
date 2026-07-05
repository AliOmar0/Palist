<?php 
$original_edit_id=$id=check_get_id();
	$_form_resp=db('tokens','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('tokens','edit') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<form id="tokens" autocomplete="off" action="" onsubmit="return submitter(this,'<?=isset($controllerURL)? $controllerURL:urlPanel?>');" method="post" enctype="multipart/form-data">
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="tokens"/> 
<input type="hidden" name="action" value="edit"/> 
<input type="hidden" name="id" value="<?=$id;?>"/> 

<!--inputs below -->
<!--
	

--><div class="form_field ontwo in  tokens_user_id" data-legion-field-type="number">
<label for="for_field_user_id"><?=l('User ID<>رقم مُعَرّف المستخدم');?></label>
<div class="input_area">
<input id="for_field_user_id"  type="number" name="user_id" data-l_module="tokens" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['user_id']) ?>"/>
</div>
</div><!--


	

--><div class="form_field ontwo in  tokens_module_prefix" data-legion-field-type="text">
<label for="for_field_module_prefix"><?=l('Module Prefix<>نوع المستخدم');?></label>
<div class="input_area">
<input id="for_field_module_prefix"  type="text" name="module_prefix" data-l_module="tokens" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['module_prefix']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  tokens_token" data-legion-field-type="text">
<label for="for_field_token"><?=l('Token<>الشيفرة');?></label>
<div class="input_area">
<input id="for_field_token"  type="text" name="token" data-l_module="tokens" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['token']) ?>"/>
</div>
</div><!--

--><div class="big_group_wrap tokens_deviceinfo"><div class="big_group"><?=l('Device Info<>')?></div></div><!--
	

--><div class="form_field onfour in  tokens__d" data-legion-field-type="number">
<label for="for_field__d"><?=l('Device<>');?></label>
				<div class="tip"><?=l("0 undetected, 1 web, 2 iOS, 3 Android")?></div>
<div class="input_area">
<input id="for_field__d"  type="number" name="_d" data-l_module="tokens" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['_d']) ?>"/>
</div>
</div><!--


	

--><div class="form_field onfour in  tokens_app_version" data-legion-field-type="text">
<label for="for_field_app_version"><?=l('App Version<>');?></label>
<div class="input_area">
<input id="for_field_app_version"  type="text" name="app_version" data-l_module="tokens" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['app_version']) ?>"/>
</div>
</div><!--


	

--><div class="form_field onfour in  tokens_device_model" data-legion-field-type="text">
<label for="for_field_device_model"><?=l('Device Model<>');?></label>
<div class="input_area">
<input id="for_field_device_model"  type="text" name="device_model" data-l_module="tokens" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['device_model']) ?>"/>
</div>
</div><!--


	

--><div class="form_field onfour in  tokens_os_version" data-legion-field-type="text">
<label for="for_field_os_version"><?=l('OS Version<>');?></label>
<div class="input_area">
<input id="for_field_os_version"  type="text" name="os_version" data-l_module="tokens" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['os_version']) ?>"/>
</div>
</div><!--


	

--><div class="form_field ontwo in  tokens_browser_name" data-legion-field-type="text">
<label for="for_field_browser_name"><?=l('Browser Name<>');?></label>
<div class="input_area">
<input id="for_field_browser_name"  type="text" name="browser_name" data-l_module="tokens" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['browser_name']) ?>"/>
</div>
</div><!--


	

--><div class="form_field ontwo in  tokens_browser" data-legion-field-type="textarea">
<label for="for_field_browser"><?=l('Browser<>');?></label>
<div class="input_area">
<textarea   placeholder="" data-max_count="500"  class="mceNoEditor " name="browser"><?=htmlentities($_form_resp[0]['browser'])?></textarea>
</div>
</div><!--


	

--><div class="form_field  tokens_language" data-legion-field-type="select">
<label for="for_field_language"><?=l('Language<>');?></label>
<div class="input_area">

<select  id="for_field_language" class="l_mc l_white_c" name="language">
<?php 
$addition_where=NULL;
	
$_form_sub_resp=db('languages_1557157519',"WHERE deleted=0    $addition_where",NULL);
			if($_form_sub_resp==0){?><option value="0" selected><?=l('Error<>خطأ')?></option><?php } 
			else if($_form_sub_resp==1){?><option value="0" selected><?=l('Choose<>اختر');?></option><?php } 
				 else { ?>
                 <option value="0" <?=(0==$_form_resp[0]['language']?'selected':'')?>><?=l('Choose<>اختر');?></option>
				<?php
					if($_form_sub_resp!=1){
						for($__j=0;$__j<count($_form_sub_resp);$__j++){?>
						<option <?=($_form_sub_resp[$__j]['id']==$_form_resp[0]['language'] ? 'selected' : ''); ?> class="l_mc l_white_c" value="<?=$_form_sub_resp[$__j]['id']?>">
						<?= select_echo('tokens','language',$_form_sub_resp[$__j],true);?></option>
						
				<?php 
						}//for
					}
				}//else 
				unset($_form_sub_resp);
				?>
			</select>
</div>
</div><!--

--><div class="big_group_wrap tokens_pushnotification"><div class="big_group"><?=l('Push Notification<>')?></div></div><!--
	

--><div class="form_field  tokens_player_id" data-legion-field-type="text">
<label for="for_field_player_id"><?=l('Player ID<>');?></label>
<div class="input_area">
<input id="for_field_player_id"  type="text" name="player_id" data-l_module="tokens" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['player_id']) ?>"/>
</div>
</div><!--

-->
<!--inputs above -->
</form>
<?php } ?>