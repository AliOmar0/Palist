<?php 
$original_edit_id=$id=check_get_id();
	$_form_resp=db('psn_1627841195','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('psn_1627841195','edit') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<form id="psn_1627841195" autocomplete="off" action="" onsubmit="return submitter(this,'<?=isset($controllerURL)? $controllerURL:urlPanel?>');" method="post" enctype="multipart/form-data">
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="psn_1627841195"/> 
<input type="hidden" name="action" value="edit"/> 
<input type="hidden" name="id" value="<?=$id;?>"/> 

<!--inputs below -->
<!--
	

--><div class="form_field  psn_1627841195_user" data-legion-field-type="text">
<label for="for_field_user"><?=l('User<>المستخدم');?></label>
<div class="input_area">
<input id="for_field_user"  type="text" name="user" data-l_module="psn_1627841195" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['user']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  psn_1627841195_module_prefix" data-legion-field-type="select">
<label for="for_field_module_prefix"><?=l('Module Prefix<>نوع المستخدم');?></label>
<div class="input_area">

<select  id="for_field_module_prefix" class="l_mc l_white_c" name="module_prefix">
<?php 
$addition_where=NULL;
	
$_form_sub_resp=db('modules',"WHERE deleted=0    $addition_where",NULL);
			if($_form_sub_resp==0){?><option value="0" selected><?=l('Error<>خطأ')?></option><?php } 
			else if($_form_sub_resp==1){?><option value="0" selected><?=l('Choose<>اختر');?></option><?php } 
				 else { ?>
                 <option value="0" <?=(0==$_form_resp[0]['module_prefix']?'selected':'')?>><?=l('Choose<>اختر');?></option>
				<?php
					if($_form_sub_resp!=1){
						for($__j=0;$__j<count($_form_sub_resp);$__j++){?>
						<option <?=($_form_sub_resp[$__j]['id']==$_form_resp[0]['module_prefix'] ? 'selected' : ''); ?> class="l_mc l_white_c" value="<?=$_form_sub_resp[$__j]['id']?>">
						<?= select_echo('psn_1627841195','module_prefix',$_form_sub_resp[$__j],true);?></option>
						
				<?php 
						}//for
					}
				}//else 
				unset($_form_sub_resp);
				?>
			</select>
</div>
</div><!--


	

--><div class="form_field  psn_1627841195_title" data-legion-field-type="text">
<label for="for_field_title"><?=l('Title<>العنوان');?></label>
<div class="input_area">
<input id="for_field_title"  type="text" name="title" data-l_is_ml="true" data-l_module="psn_1627841195" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['title']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  psn_1627841195_message" data-legion-field-type="text">
<label for="for_field_message"><?=l('Message<>الرسالة');?></label>
<div class="input_area">
<input id="for_field_message"  type="text" name="message" data-l_is_ml="true" data-l_module="psn_1627841195" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['message']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  psn_1627841195_seen" data-legion-field-type="checkbox">
<label for="for_field_seen"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input <?=($_form_resp[0]['seen']==1 ? ' checked ':'');?>
 class=" css-checkbox" name="seen" type="checkbox" id="<?=$rand='a'.rand(); ?>"/>
			<label for="<?=$rand ?>"><?=l('Seen<>');?></label></div></div></div>
</div>
</div><!--


	

--><div class="form_field  psn_1627841195_extra" data-legion-field-type="text">
<label for="for_field_extra"><?=l('Extra<>اضافات');?></label>
<div class="input_area">
<input id="for_field_extra"  type="text" name="extra" data-l_module="psn_1627841195" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['extra']) ?>"/>
</div>
</div><!--

-->
<!--inputs above -->
</form>
<?php } ?>