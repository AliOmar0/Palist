<?php if(!privilege('notifier_1644648674','add'))echo $noPermission;else{?>
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="notifier_1644648674"/> 
<input type="hidden" name="action" value="add"/>
<!--inputs below --> 
<!--
	

--><div class="form_field notifier_1644648674_module_id" data-legion-field-type="select">
<label for="for_field_module_id"><?=l('Module ID<>البرمجية');?></label>
<div class="input_area">
<select  class="l_mc l_white_c" name="module_id" onChange="reloadSelect('module_actions','title','module_id',this.value,null,'module_action');">
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
					
					?>
			</select>
			
</div>
</div><!--


	

--><div class="form_field notifier_1644648674_module_action" data-legion-field-type="select">
<label for="for_field_module_action"><?=l('Module Action<>الأمر');?></label>
<div class="input_area">
<select  id="for_field_module_action" class="l_mc l_white_c" name="module_action">
<?php 
$addition_where=NULL;

$_form_resp=db('module_actions',"WHERE deleted=0  AND module_id='".$_form_resp[0]['id']."'  $addition_where",NULL,NULL);
			if($_form_resp==0){?><option value="0" selected><?=l('Error<>خطأ')?></option> <?php } 
			else if($_form_resp==1){?><option value="0" selected><?=l('Choose<>اختر');?></option><?php } 
				else {?>
                    <option value="0"><?=l('Choose<>اختر');?></option>
					<?php 
					$echoFields='title';
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


	

--><div class="form_field notifier_1644648674_title" data-legion-field-type="text">
<label for="for_field_title"><?=l('Title<>العنوان');?></label>
<div class="input_area">
<input id="for_field_title"  type="text"  data-legion-module="notifier_1644648674" name="title" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field notifier_1644648674_email_notification" data-legion-field-type="checkbox">
<label for="for_field_email_notification"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input   class="css-checkbox" type="checkbox" name="email_notification"  id="<?=$rand='a'.rand(); ?>" />
			<label for="<?=$rand?>"><?=l('Email Notification<>');?></label></div></div></div>
</div>
</div><!--

-->
<!--inputs above -->
<?php } ?>