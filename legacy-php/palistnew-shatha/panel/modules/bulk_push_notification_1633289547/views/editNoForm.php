<?php 
$id=check_get_id();
	$_form_resp=db('bulk_push_notification_1633289547','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('bulk_push_notification_1633289547','edit') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="bulk_push_notification_1633289547"/> 
<input type="hidden" name="action" value="edit"/> 
<input type="hidden" name="id" value="<?=$id;?>"/> 

<!--inputs below -->
<!--
	

--><div class="form_field  bulk_push_notification_1633289547_title" data-legion-field-type="text">
<label for="for_field_title"><?=l('Title<>العنوان');?> <span class="required_star">*</span></label>
				<div class="tip"><?=l("Do NOT use enter<>لا تضع سطر جديد (انتر)")?></div>
<div class="input_area">
<input id="for_field_title"  required type="text" name="title"   data-legion-module="bulk_push_notification_1633289547" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['title']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  bulk_push_notification_1633289547_message" data-legion-field-type="textarea">
<label for="for_field_message"><?=l('Message<>الرسالة');?> <span class="required_star">*</span></label>
				<div class="tip"><?=l("Do NOT use enter<>لا تضع سطر جديد (انتر)")?></div>
<div class="input_area">
<textarea  required  placeholder="" data-max_count="250"  class="mceNoEditor " name="message"><?=$_form_resp[0]['message'] ?></textarea>
</div>
</div><!--


	

--><div class="form_field  bulk_push_notification_1633289547_specific_users_module" data-legion-field-type="select">
<label for="for_field_specific_users_module"><?=l('Specific Users Module<>');?> <span class="required_star">*</span></label>
<div class="input_area">

<select  required id="for_field_specific_users_module" class="l_mc l_white_c" name="specific_users_module">
<?php 
$addition_where=NULL;
	
$_form_sub_resp=db('modules',"WHERE deleted=0    $addition_where",NULL);
			if($_form_sub_resp==0){?><option value="0" selected><?=l('Error<>خطأ')?></option><?php } 
			else if($_form_sub_resp==1){?><option value="0" selected><?=l('Choose<>اختر');?></option><?php } 
				 else { ?>
                 <option value="" <?=(0==$_form_resp[0]['specific_users_module']?'selected':'')?>><?=l('Choose<>اختر');?></option>
				<?php
					if($_form_sub_resp!=1){
						for($__j=0;$__j<count($_form_sub_resp);$__j++){?>
						<option <?=($_form_sub_resp[$__j]['id']==$_form_resp[0]['specific_users_module'] ? 'selected' : ''); ?> class="l_mc l_white_c" value="<?=$_form_sub_resp[$__j]['id']?>">
						<?= select_echo('bulk_push_notification_1633289547','specific_users_module',$_form_sub_resp[$__j],true);?></option>
						
				<?php 
						}//for
					}
				}//else 
				unset($_form_sub_resp);
				?>
			</select>
</div>
</div><!--

-->
<!--inputs above -->
<?php } ?>