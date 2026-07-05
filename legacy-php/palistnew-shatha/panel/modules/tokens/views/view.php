<?php 
$id=check_get_id();
$_form_resp=db('tokens','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('tokens','view') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<div id="tokens_view_<?=$id;?>" class="viewActionDiv" data-id="<?=$id;?>" data-module="tokens"><!--

		--><div class="view_box  tokens_view_user_id  ontwo in ">
<div class="view_label view_label_user_id"><?=l('User ID<>رقم مُعَرّف المستخدم')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['user_id'])?></div>
</div><!--

		--><div class="view_box  tokens_view_module_prefix  ontwo in ">
<div class="view_label view_label_module_prefix"><?=l('Module Prefix<>نوع المستخدم')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['module_prefix'])?></div>
</div><!--

		--><div class="view_box  tokens_view_token  ">
<div class="view_label view_label_token"><?=l('Token<>الشيفرة')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['token'])?></div>
</div><!--

		--><div class="view_box view_group tokens_view_Device Info  ">
<div class="view_label view_label_Device Info"><?=l('<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['Device Info'])?></div>
</div><clear></clear><!--

		--><div class="view_box  tokens_view__d  onfour in ">
<div class="view_label view_label__d"><?=l('Device<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['_d'])?></div>
</div><!--

		--><div class="view_box  tokens_view_app_version  onfour in ">
<div class="view_label view_label_app_version"><?=l('App Version<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['app_version'])?></div>
</div><!--

		--><div class="view_box  tokens_view_device_model  onfour in ">
<div class="view_label view_label_device_model"><?=l('Device Model<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['device_model'])?></div>
</div><!--

		--><div class="view_box  tokens_view_os_version  onfour in ">
<div class="view_label view_label_os_version"><?=l('OS Version<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['os_version'])?></div>
</div><!--

		--><div class="view_box  tokens_view_browser_name  ontwo in ">
<div class="view_label view_label_browser_name"><?=l('Browser Name<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['browser_name'])?></div>
</div><!--

		--><div class="view_box  tokens_view_browser  ontwo in ">
<div class="view_label view_label_browser"><?=l('Browser<>')?></div>
<div class="viewValue  viewText mce "><?=l($_form_resp[0]['browser'])?></div>
</div><!--

		--><div class="view_box  tokens_view_language  ">
<div class="view_label view_label_language"><?=l('Language<>')?></div>
<div class="viewValue  "><?php 
$addition_where=NULL;
$sub_resp=db('languages_1557157519',"WHERE deleted=0  AND id='".$_form_resp[0]['language']."'  $addition_where",NULL,'LIMIT 1');
					echo select_echo('tokens','language',$sub_resp[0],true);
                        ?></div>
</div><!--

		--><div class="view_box view_group tokens_view_Push Notification  ">
<div class="view_label view_label_Push Notification"><?=l('<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['Push Notification'])?></div>
</div><clear></clear><!--

		--><div class="view_box  tokens_view_player_id  ">
<div class="view_label view_label_player_id"><?=l('Player ID<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['player_id'])?></div>
</div><!--

--></div>
<?php } ?>