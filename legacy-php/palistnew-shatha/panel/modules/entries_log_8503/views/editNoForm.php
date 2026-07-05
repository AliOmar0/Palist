<?php 
$id=check_get_id();
	$_form_resp=db('entries_log_8503','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('entries_log_8503','edit') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="entries_log_8503"/> 
<input type="hidden" name="action" value="edit"/> 
<input type="hidden" name="id" value="<?=$id;?>"/> 

<!--inputs below -->
<!--
	

--><div class="form_field ontwo in  entries_log_8503_entry_module" data-legion-field-type="select">
<label for="for_field_entry_module"><?=l('Entry Module<>');?></label>
<div class="input_area">

<select  id="for_field_entry_module" class="l_mc l_white_c" name="entry_module">
<?php 
$addition_where=NULL;
	
$_form_sub_resp=db('modules',"WHERE deleted=0    $addition_where",NULL);
			if($_form_sub_resp==0){?><option value="0" selected><?=l('Error<>خطأ')?></option><?php } 
			else if($_form_sub_resp==1){?><option value="0" selected><?=l('Choose<>اختر');?></option><?php } 
				 else { ?>
                 <option value="0" <?=(0==$_form_resp[0]['entry_module']?'selected':'')?>><?=l('Choose<>اختر');?></option>
				<?php
					$echoFields='module_name';
					$x=explode(',',$echoFields);
					if($_form_sub_resp!=1){
						for($j=0;$j<count($_form_sub_resp);$j++){?>
						<option <?=($_form_sub_resp[$j]['id']==$_form_resp[0]['entry_module'] ? 'selected' : ''); ?> class="l_mc l_white_c" value="<?=$_form_sub_resp[$j]['id']?>"><?php 
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


	

--><div class="form_field ontwo in  entries_log_8503_entry_id" data-legion-field-type="number">
<label for="for_field_entry_id"><?=l('Entry ID<>');?></label>
<div class="input_area">
<input id="for_field_entry_id"  type="number" name="entry_id"   data-legion-module="entries_log_8503" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['entry_id']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  entries_log_8503_user_module" data-legion-field-type="select">
<label for="for_field_user_module"><?=l('User Module<>');?></label>
<div class="input_area">

<select  id="for_field_user_module" class="l_mc l_white_c" name="user_module">
<?php 
$addition_where=NULL;
	
$_form_sub_resp=db('modules',"WHERE deleted=0    $addition_where",NULL);
			if($_form_sub_resp==0){?><option value="0" selected><?=l('Error<>خطأ')?></option><?php } 
			else if($_form_sub_resp==1){?><option value="0" selected><?=l('Choose<>اختر');?></option><?php } 
				 else { ?>
                 <option value="0" <?=(0==$_form_resp[0]['user_module']?'selected':'')?>><?=l('Choose<>اختر');?></option>
				<?php
					$echoFields='module_name';
					$x=explode(',',$echoFields);
					if($_form_sub_resp!=1){
						for($j=0;$j<count($_form_sub_resp);$j++){?>
						<option <?=($_form_sub_resp[$j]['id']==$_form_resp[0]['user_module'] ? 'selected' : ''); ?> class="l_mc l_white_c" value="<?=$_form_sub_resp[$j]['id']?>"><?php 
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


	

--><div class="form_field ontwo in  entries_log_8503_user_id" data-legion-field-type="number">
<label for="for_field_user_id"><?=l('User ID<>');?></label>
<div class="input_area">
<input id="for_field_user_id"  type="number" name="user_id"   data-legion-module="entries_log_8503" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['user_id']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  entries_log_8503_action" data-legion-field-type="text">
<label for="for_field_action"><?=l('Action<>');?></label>
<div class="input_area">
<input id="for_field_action"  type="text" name="action"   data-legion-module="entries_log_8503" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['action']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  entries_log_8503_remark" data-legion-field-type="text">
<label for="for_field_remark"><?=l('Remark<>');?></label>
<div class="input_area">
<input id="for_field_remark"  type="text" name="remark"   data-legion-module="entries_log_8503" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['remark']) ?>"/>
</div>
</div><!--

-->
<!--inputs above -->
<?php } ?>