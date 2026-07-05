<?php if(!privilege('entries_log_8503','add'))echo $noPermission;else{?>
<form id="entries_log_8503" autocomplete="off" action="" onsubmit="return submitter(this,'<?=isset($controllerURL)? $controllerURL:urlPanel?>');" method="post" enctype="multipart/form-data">
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="entries_log_8503"/> 
<input type="hidden" name="action" value="add"/>
<!--inputs below --> 
<!--
	

--><div class="form_field ontwo in entries_log_8503_entry_module" data-legion-field-type="select">
<label for="for_field_entry_module"><?=l('Entry Module<>');?></label>
<div class="input_area">
<select  id="for_field_entry_module" class="l_mc l_white_c" name="entry_module">
<?php 
$addition_where=NULL;

$_form_resp=db('modules',"WHERE deleted=0   $addition_where",NULL,NULL);
			if($_form_resp==0){?><option value="0" selected><?=l('Error<>خطأ')?></option> <?php } 
			else if($_form_resp==1){?><option value="0" selected><?=l('Choose<>اختر');?></option><?php } 
				else {?>
                    <option value="0"><?=l('Choose<>اختر');?></option>
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
					unset($_form_resp);
					?>
			</select>
			
</div>
</div><!--


	

--><div class="form_field ontwo in entries_log_8503_entry_id" data-legion-field-type="number">
<label for="for_field_entry_id"><?=l('Entry ID<>');?></label>
<div class="input_area">
<input id="for_field_entry_id"  type="number"  data-legion-module="entries_log_8503" name="entry_id" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field entries_log_8503_user_module" data-legion-field-type="select">
<label for="for_field_user_module"><?=l('User Module<>');?></label>
<div class="input_area">
<select  id="for_field_user_module" class="l_mc l_white_c" name="user_module">
<?php 
$addition_where=NULL;

$_form_resp=db('modules',"WHERE deleted=0   $addition_where",NULL,NULL);
			if($_form_resp==0){?><option value="0" selected><?=l('Error<>خطأ')?></option> <?php } 
			else if($_form_resp==1){?><option value="0" selected><?=l('Choose<>اختر');?></option><?php } 
				else {?>
                    <option value="0"><?=l('Choose<>اختر');?></option>
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
					unset($_form_resp);
					?>
			</select>
			
</div>
</div><!--


	

--><div class="form_field ontwo in entries_log_8503_user_id" data-legion-field-type="number">
<label for="for_field_user_id"><?=l('User ID<>');?></label>
<div class="input_area">
<input id="for_field_user_id"  type="number"  data-legion-module="entries_log_8503" name="user_id" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field entries_log_8503_action" data-legion-field-type="text">
<label for="for_field_action"><?=l('Action<>');?></label>
<div class="input_area">
<input id="for_field_action"  type="text"  data-legion-module="entries_log_8503" name="action" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field entries_log_8503_remark" data-legion-field-type="text">
<label for="for_field_remark"><?=l('Remark<>');?></label>
<div class="input_area">
<input id="for_field_remark"  type="text"  data-legion-module="entries_log_8503" name="remark" placeholder="" value=""/>
</div>
</div><!--

-->
<!--inputs above -->
</form>
<?php } ?>