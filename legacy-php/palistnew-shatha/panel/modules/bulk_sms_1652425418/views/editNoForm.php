<?php 
$id=check_get_id();
	$_form_resp=db('bulk_sms_1652425418','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('bulk_sms_1652425418','edit') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="bulk_sms_1652425418"/> 
<input type="hidden" name="action" value="edit"/> 
<input type="hidden" name="id" value="<?=$id;?>"/> 

<!--inputs below -->
<!--
	

--><div class="form_field  bulk_sms_1652425418_message" data-legion-field-type="textarea">
<label for="for_field_message"><?=l('Message<>الرسالة');?> <span class="required_star">*</span></label>
<div class="input_area">
<textarea  required  placeholder="" data-max_count="250"  class="mceNoEditor " name="message"><?=$_form_resp[0]['message'] ?></textarea>
</div>
</div><!--


	

--><div class="form_field ontwo in  bulk_sms_1652425418_module_prefix" data-legion-field-type="select">
<label for="for_field_module_prefix"><?=l('Module Prefix<>نوع الحساب');?> <span class="required_star">*</span></label>
<div class="input_area">
<select  required class="l_mc l_white_c" name="module_prefix" onChange="reloadSelect('module_fields','label','module_id',this.value,'<?=$_form_resp[0]['mobile_field'] ?>','mobile_field');">
<?php 
$addition_where=NULL;
	
$_form_sub_resp=db('modules',"WHERE deleted=0    $addition_where",NULL);
			if($_form_sub_resp==0){?><option value="0" selected><?=l('Error<>خطأ')?></option><?php } 
			else if($_form_sub_resp==1){?><option value="0" selected><?=l('Choose<>اختر');?></option><?php } 
				 else { ?>
                 <option value="" <?=(0==$_form_resp[0]['module_prefix']?'selected':'')?>><?=l('Choose<>اختر');?></option>
				<?php
					$echoFields='module_name';
					$x=explode(',',$echoFields);
					if($_form_sub_resp!=1){
						for($j=0;$j<count($_form_sub_resp);$j++){?>
						<option <?=($_form_sub_resp[$j]['id']==$_form_resp[0]['module_prefix'] ? 'selected' : ''); ?> class="l_mc l_white_c" value="<?=$_form_sub_resp[$j]['id']?>"><?php 
							for($e=0;$e<count($x);$e++){
								if($x[$e]=='-')echo ' -';
								else {
									if($e!=0)echo ' ';
									echo l($_form_sub_resp[$j][$x[$e]]); 
								}
							}
						?></option>
						
				<?php 
						}//for
					}
				}//else 
				unset($_form_sub_resp);
				?>
			</select>
			
</div>
</div><!--


	

--><div class="form_field ontwo in  bulk_sms_1652425418_mobile_field" data-legion-field-type="select">
<label for="for_field_mobile_field"><?=l('Mobile Field<>خانة الخلوي');?> <span class="required_star">*</span></label>
<div class="input_area">

<select  required id="for_field_mobile_field" class="l_mc l_white_c" name="mobile_field">
<?php 
$addition_where=NULL;
	
$_form_sub_resp=db('module_fields',"WHERE deleted=0  AND module_id='".$_form_resp[0]['module_prefix']."'   $addition_where",NULL);
			if($_form_sub_resp==0){?><option value="0" selected><?=l('Error<>خطأ')?></option><?php } 
			else if($_form_sub_resp==1){?><option value="0" selected><?=l('Choose<>اختر');?></option><?php } 
				 else { ?>
                 <option value="" <?=(0==$_form_resp[0]['mobile_field']?'selected':'')?>><?=l('Choose<>اختر');?></option>
				<?php
					$echoFields='label';
					$x=explode(',',$echoFields);
					if($_form_sub_resp!=1){
						for($j=0;$j<count($_form_sub_resp);$j++){?>
						<option <?=($_form_sub_resp[$j]['id']==$_form_resp[0]['mobile_field'] ? 'selected' : ''); ?> class="l_mc l_white_c" value="<?=$_form_sub_resp[$j]['id']?>"><?php 
							for($e=0;$e<count($x);$e++){
								if($x[$e]=='-')echo ' -';
								else {
									if($e!=0)echo ' ';
									echo l($_form_sub_resp[$j][$x[$e]]); 
								}
							}
						?></option>
						
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