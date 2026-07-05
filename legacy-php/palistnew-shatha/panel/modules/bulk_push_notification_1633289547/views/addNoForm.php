<?php if(!privilege('bulk_push_notification_1633289547','add'))echo $noPermission;else{?>
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="bulk_push_notification_1633289547"/> 
<input type="hidden" name="action" value="add"/>
<!--inputs below --> 
<!--
	

--><div class="form_field bulk_push_notification_1633289547_title" data-legion-field-type="text">
<label for="for_field_title"><?=l('Title<>العنوان');?> <span class="required_star">*</span></label>
				<div class="tip"><?=l("Do NOT use enter<>لا تضع سطر جديد (انتر)")?></div>
<div class="input_area">
<input id="for_field_title"  required type="text"  data-legion-module="bulk_push_notification_1633289547" name="title" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field bulk_push_notification_1633289547_message" data-legion-field-type="textarea">
<label for="for_field_message"><?=l('Message<>الرسالة');?> <span class="required_star">*</span></label>
				<div class="tip"><?=l("Do NOT use enter<>لا تضع سطر جديد (انتر)")?></div>
<div class="input_area">
<textarea  required  placeholder="" data-max_count="250" class="mceNoEditor " name="message"></textarea>
</div>
</div><!--


	

--><div class="form_field bulk_push_notification_1633289547_specific_users_module" data-legion-field-type="select">
<label for="for_field_specific_users_module"><?=l('Specific Users Module<>');?> <span class="required_star">*</span></label>
<div class="input_area">
<select  required id="for_field_specific_users_module" class="l_mc l_white_c" name="specific_users_module">
<?php 
$addition_where=NULL;

$_form_resp=db('modules',"WHERE deleted=0   $addition_where",NULL,NULL);
			if($_form_resp==0){?><option value="0" selected><?=l('Error<>خطأ')?></option> <?php } 
			else if($_form_resp==1){?><option value="0" selected><?=l('Choose<>اختر');?></option><?php } 
				else {?>
                    <option value=""><?=l('Choose<>اختر');?></option>
					<?php 
					if($_form_resp!=1){
						for($_i=0;$_i<count($_form_resp);$_i++){?>
						<option value="<?=$_form_resp[$_i]['id']?>">
						<?= select_echo('bulk_push_notification_1633289547','specific_users_module',$_form_resp[$_i],true);?>
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

-->
<!--inputs above -->
<?php } ?>