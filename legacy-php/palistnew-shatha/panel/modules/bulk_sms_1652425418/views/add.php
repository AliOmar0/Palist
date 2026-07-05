<?php if(!privilege('bulk_sms_1652425418','add'))echo $noPermission;else{?>
<form id="bulk_sms_1652425418" autocomplete="off" action="" onsubmit="return submitter(this,'<?=isset($controllerURL)? $controllerURL:urlPanel?>');" method="post" enctype="multipart/form-data">
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="bulk_sms_1652425418"/> 
<input type="hidden" name="action" value="add"/>
<!--inputs below --> 
<!--
	

--><div class="form_field bulk_sms_1652425418_message" data-legion-field-type="textarea">
<label for="for_field_message"><?=l('Message<>الرسالة');?> <span class="required_star">*</span></label>
<div class="input_area">
<textarea  required  placeholder="" data-max_count="250" class="mceNoEditor " name="message"></textarea>
</div>
</div><!--


	

--><div class="form_field ontwo in bulk_sms_1652425418_module_prefix" data-legion-field-type="select">
<label for="for_field_module_prefix"><?=l('Module Prefix<>نوع الحساب');?> <span class="required_star">*</span></label>
<div class="input_area">
<select  required class="l_mc l_white_c" name="module_prefix" onChange="reloadSelect('module_fields','label','module_id',this.value,null,'mobile_field');">
<?php 
$addition_where=NULL;

$_form_resp=db('modules',"WHERE deleted=0   $addition_where",NULL,NULL);
			if($_form_resp==0){?><option value="0" selected><?=l('Error<>خطأ')?></option> <?php } 
			else if($_form_resp==1){?><option value="0" selected><?=l('Choose<>اختر');?></option><?php } 
				else {?>
                    <option value=""><?=l('Choose<>اختر');?></option>
					<?php 
					$echoFields='module_name';
                    $x=explode(',',$echoFields);
					if($_form_resp!=1){
						for($_i=0;$_i<count($_form_resp);$_i++){?>
						<option value="<?=$_form_resp[$_i]['id']?>"><?php
						for($e=0;$e<count($x);$e++){
							if($x[$e]=='-')echo ' -';
							else {
								if($e!=0)echo ' ';
								echo l($_form_resp[$_i][$x[$e]]); 
							}
						 }
						 ?></option>
						
						<?php 
							}//for
						}
					}//else
					
					?>
			</select>
			
</div>
</div><!--


	

--><div class="form_field ontwo in bulk_sms_1652425418_mobile_field" data-legion-field-type="select">
<label for="for_field_mobile_field"><?=l('Mobile Field<>خانة الخلوي');?> <span class="required_star">*</span></label>
<div class="input_area">
<select  required id="for_field_mobile_field" class="l_mc l_white_c" name="mobile_field">
<?php 
$addition_where=NULL;

$_form_resp=db('module_fields',"WHERE deleted=0  AND module_id='".$_form_resp[0]['']."'  $addition_where",NULL,NULL);
			if($_form_resp==0){?><option value="0" selected><?=l('Error<>خطأ')?></option> <?php } 
			else if($_form_resp==1){?><option value="0" selected><?=l('Choose<>اختر');?></option><?php } 
				else {?>
                    <option value=""><?=l('Choose<>اختر');?></option>
					<?php 
					$echoFields='label';
                    $x=explode(',',$echoFields);
					if($_form_resp!=1){
						for($_i=0;$_i<count($_form_resp);$_i++){?>
						<option value="<?=$_form_resp[$_i]['id']?>"><?php
						for($e=0;$e<count($x);$e++){
							if($x[$e]=='-')echo ' -';
							else {
								if($e!=0)echo ' ';
								echo l($_form_resp[$_i][$x[$e]]); 
							}
						 }
						 ?></option>
						
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
</form>
<?php } ?>