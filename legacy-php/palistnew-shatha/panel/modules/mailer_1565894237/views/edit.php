<?php 
$original_edit_id=$id=check_get_id();
	$_form_resp=db('mailer_1565894237','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('mailer_1565894237','edit') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{
require_once cms_dir.'plugins/tinymce/backendTinyCall.php';?>
<form id="mailer_1565894237" autocomplete="off" action="" onsubmit="return submitter(this,'<?=isset($controllerURL)? $controllerURL:urlPanel?>');" method="post" enctype="multipart/form-data">
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="mailer_1565894237"/> 
<input type="hidden" name="action" value="edit"/> 
<input type="hidden" name="id" value="<?=$id;?>"/> 

<!--inputs below -->
<!--
	

--><?php if(!isset($mailer_1565894237_email_title)){?><div class="form_field  mailer_1565894237_email_title" data-legion-field-type="text">
<label for="for_field_email_title"><?=l('Email Title<>عنوان البريد');?></label>
<div class="input_area">
<input id="for_field_email_title"  type="text" name="email_title" data-l_is_ml="true" data-l_module="mailer_1565894237" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['email_title']) ?>"/>
</div>
</div><?php }?><!--
	

	

--><?php if(!isset($mailer_1565894237_module_id)){?><div class="form_field ontwo in  mailer_1565894237_module_id" data-legion-field-type="select">
<label for="for_field_module_id"><?=l('Module ID<>رقم البرمجيّة');?></label>
<div class="input_area">
<select  class="l_mc l_white_c" name="module_id" onChange="reloadSelect('module_actions','title','module_id',this.value,'<?=$_form_resp[0]['module_action'] ?>','module_action');">
<?php 
$addition_where=NULL;
	
$_form_sub_resp=db('modules',"WHERE deleted=0    $addition_where",NULL);
			if($_form_sub_resp==0){?><option value="0" selected><?=l('Error<>خطأ')?></option><?php } 
			else if($_form_sub_resp==1){?><option value="0" selected><?=l('Choose<>اختر');?></option><?php } 
				 else { ?>
                 <option value="0" <?=(0==$_form_resp[0]['module_id']?'selected':'')?>><?=l('Choose<>اختر');?></option>
				<?php
					if($_form_sub_resp!=1){
						for($__j=0;$__j<count($_form_sub_resp);$__j++){?>
						<option <?=($_form_sub_resp[$__j]['id']==$_form_resp[0]['module_id'] ? 'selected' : ''); ?> class="l_mc l_white_c" value="<?=$_form_sub_resp[$__j]['id']?>">
						<?= select_echo('mailer_1565894237','module_id',$_form_sub_resp[$__j],true);?></option>
						
				<?php 
						}//for
					}
				}//else 
				unset($_form_sub_resp);
				?>
			</select>
</div>
</div><?php }?><!--
	

	

--><?php if(!isset($mailer_1565894237_module_action)){?><div class="form_field ontwo in  mailer_1565894237_module_action" data-legion-field-type="select">
<label for="for_field_module_action"><?=l('Module Action<>مهمّة البرمجية');?></label>
<div class="input_area">

<select  id="for_field_module_action" class="l_mc l_white_c" name="module_action">
<?php 
$addition_where=NULL;
	
$_form_sub_resp=db('module_actions',"WHERE deleted=0  AND module_id='".$_form_resp[0]['module_id']."'   $addition_where",NULL);
			if($_form_sub_resp==0){?><option value="0" selected><?=l('Error<>خطأ')?></option><?php } 
			else if($_form_sub_resp==1){?><option value="0" selected><?=l('Choose<>اختر');?></option><?php } 
				 else { ?>
                 <option value="0" <?=(0==$_form_resp[0]['module_action']?'selected':'')?>><?=l('Choose<>اختر');?></option>
				<?php
					if($_form_sub_resp!=1){
						for($__j=0;$__j<count($_form_sub_resp);$__j++){?>
						<option <?=($_form_sub_resp[$__j]['id']==$_form_resp[0]['module_action'] ? 'selected' : ''); ?> class="l_mc l_white_c" value="<?=$_form_sub_resp[$__j]['id']?>">
						<?= select_echo('mailer_1565894237','module_action',$_form_sub_resp[$__j],true);?></option>
						
				<?php 
						}//for
					}
				}//else 
				unset($_form_sub_resp);
				?>
			</select>
</div>
</div><?php }?><!--
	

	

--><?php if(!isset($mailer_1565894237_from_email)){?><div class="form_field takeThree in  mailer_1565894237_from_email" data-legion-field-type="text">
<label for="for_field_from_email"><?=l('From Email<>');?></label>
<div class="input_area">
<input id="for_field_from_email"  type="text" name="from_email" data-l_module="mailer_1565894237" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['from_email']) ?>"/>
</div>
</div><?php }?><!--
	

	

--><?php if(!isset($mailer_1565894237_include_site_name)){?><div class="form_field onfour in  mailer_1565894237_include_site_name" data-legion-field-type="checkbox">
<label for="for_field_include_site_name"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input <?=($_form_resp[0]['include_site_name']==1 ? ' checked ':'');?>
 class=" css-checkbox" name="include_site_name" type="checkbox" id="<?=$rand='a'.rand(); ?>"/>
			<label for="<?=$rand ?>"><?=l('Include Site Name<>');?></label></div></div></div>
</div>
</div><?php }?><!--
	

	

--><?php if(!isset($mailer_1565894237_to_email)){?><div class="form_field onfour in  mailer_1565894237_to_email" data-legion-field-type="email">
<label for="for_field_to_email"><?=l('To Email<>الى البريد الالكتروني');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_to_email"  required type="email" name="to_email" data-l_module="mailer_1565894237" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['to_email']) ?>"/>
</div>
</div><?php }?><!--
	

	

--><?php if(!isset($mailer_1565894237_cc_email)){?><div class="form_field onfour in  mailer_1565894237_cc_email" data-legion-field-type="text">
<label for="for_field_cc_email"><?=l('CC Email<>نسخة الى البريد الالكتروني');?></label>
<div class="input_area">
<input id="for_field_cc_email"  type="text" name="cc_email" data-l_module="mailer_1565894237" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['cc_email']) ?>"/>
</div>
</div><?php }?><!--
	

	

--><?php if(!isset($mailer_1565894237_bcc_email)){?><div class="form_field onfour in  mailer_1565894237_bcc_email" data-legion-field-type="text">
<label for="for_field_bcc_email"><?=l('BCC Email<>');?></label>
<div class="input_area">
<input id="for_field_bcc_email"  type="text" name="bcc_email" data-l_module="mailer_1565894237" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['bcc_email']) ?>"/>
</div>
</div><?php }?><!--
	

	

--><?php if(!isset($mailer_1565894237_reply_email)){?><div class="form_field onfour in  mailer_1565894237_reply_email" data-legion-field-type="text">
<label for="for_field_reply_email"><?=l('Reply Email<>البريد الالكتروني للرد');?></label>
<div class="input_area">
<input id="for_field_reply_email"  type="text" name="reply_email" data-l_module="mailer_1565894237" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['reply_email']) ?>"/>
</div>
</div><?php }?><!--
	

	

--><?php if(!isset($mailer_1565894237_content)){?><div class="form_field  mailer_1565894237_content" data-legion-field-type="textarea">
<label for="for_field_content"><?=l('Content<>المحتوى');?></label>
<div class="input_area">
<textarea  data-l_is_ml="true"  placeholder="" data-max_count="0"  class="" name="content"><?=htmlentities($_form_resp[0]['content'])?></textarea>
</div>
</div><?php }?><!--
	

	

--><?php if(!isset($mailer_1565894237_extra_css)){?><div class="form_field  mailer_1565894237_extra_css" data-legion-field-type="textarea">
<label for="for_field_extra_css"><?=l('Extra CSS<>تخصيص الشكل');?></label>
<div class="input_area">
<textarea   placeholder="" data-max_count="500"  class="mceNoEditor " name="extra_css"><?=htmlentities($_form_resp[0]['extra_css'])?></textarea>
</div>
</div><?php }?><!--
	
-->
<!--inputs above -->
</form>
<?php } ?>