<?php if(!privilege('web_notifications_1644647708','add'))echo $noPermission;else{?>
<form id="web_notifications_1644647708" autocomplete="off" action="" onsubmit="return submitter(this,'<?=isset($controllerURL)? $controllerURL:urlPanel?>');" method="post" enctype="multipart/form-data">
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="web_notifications_1644647708"/> 
<input type="hidden" name="action" value="add"/>
<!--inputs below --> 
<!--
	

--><div class="form_field ontwo in web_notifications_1644647708_user" data-legion-field-type="number">
<label for="for_field_user"><?=l('User<>المستخدم');?></label>
<div class="input_area">
<input id="for_field_user"  type="number"  data-legion-module="web_notifications_1644647708" name="user" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field ontwo in web_notifications_1644647708_user_module" data-legion-field-type="select">
<label for="for_field_user_module"><?=l('User Module<>نوع المستخدم');?></label>
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


	

--><div class="form_field web_notifications_1644647708_module_id" data-legion-field-type="select">
<label for="for_field_module_id"><?=l('Module ID<>البرمجية');?></label>
<div class="input_area">
<select  class="l_mc l_white_c" name="module_id" onChange="reloadSelect('module_actions','title','module_id',this.value,null,'action_id');">
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


	

--><div class="form_field web_notifications_1644647708_action_id" data-legion-field-type="select">
<label for="for_field_action_id"><?=l('Action ID<>الأمر');?></label>
<div class="input_area">
<select  id="for_field_action_id" class="l_mc l_white_c" name="action_id">
<?php 
$addition_where=NULL;

$_form_resp=db('module_actions',"WHERE deleted=0  AND module_id='".$_form_resp[0]['title']."'  $addition_where",NULL,NULL);
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


	

--><div class="form_field web_notifications_1644647708_related_id" data-legion-field-type="number">
<label for="for_field_related_id"><?=l('Related ID<>');?></label>
<div class="input_area">
<input id="for_field_related_id"  type="number"  data-legion-module="web_notifications_1644647708" name="related_id" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field web_notifications_1644647708_custom_title" data-legion-field-type="text">
<label for="for_field_custom_title"><?=l('Custom Title<>عنوان خاص');?></label>
<div class="input_area">
<input id="for_field_custom_title"  type="text"  data-legion-module="web_notifications_1644647708" name="custom_title" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field web_notifications_1644647708_custom_link" data-legion-field-type="text">
<label for="for_field_custom_link"><?=l('Custom Link<>رابط خاص');?></label>
<div class="input_area">
<input id="for_field_custom_link"  type="text"  data-legion-module="web_notifications_1644647708" name="custom_link" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field web_notifications_1644647708_seen" data-legion-field-type="checkbox">
<label for="for_field_seen"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input   class="css-checkbox" type="checkbox" name="seen"  id="<?=$rand='a'.rand(); ?>" />
			<label for="<?=$rand?>"><?=l('Seen<>شوهِد');?></label></div></div></div>
</div>
</div><!--

-->
<!--inputs above -->
</form>
<?php } ?>