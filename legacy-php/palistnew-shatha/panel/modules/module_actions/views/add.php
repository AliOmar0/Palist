<?php if(!privilege('module_actions','add'))echo $noPermission;else{?>
<form id="module_actions" autocomplete="off" action="" onsubmit="return submitter(this,'<?=isset($controllerURL)? $controllerURL:urlPanel?>');" method="post" enctype="multipart/form-data">
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="module_actions"/> 
<input type="hidden" name="action" value="add"/>
<!--inputs below --> 
<!--
	

--><div class="form_field module_actions_module_id" data-legion-field-type="select">
<label for="for_field_module_id"><?=l('Module ID<>');?></label>
<div class="input_area">
<select  id="for_field_module_id" class="l_mc l_white_c" name="module_id">
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


	

--><div class="form_field module_actions_title" data-legion-field-type="text">
<label for="for_field_title"><?=l('Title<>');?></label>
<div class="input_area">
<input id="for_field_title"  type="text"  data-legion-module="module_actions" name="title" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field module_actions_type" data-legion-field-type="text">
<label for="for_field_type"><?=l('Type<>');?></label>
<div class="input_area">
<input id="for_field_type"  type="text"  data-legion-module="module_actions" name="type" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field module_actions_icon" data-legion-field-type="text">
<label for="for_field_icon"><?=l('Icon<>');?></label>
<div class="input_area">
<input id="for_field_icon"  type="text"  data-legion-module="module_actions" name="icon" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field module_actions_private" data-legion-field-type="checkbox">
<label for="for_field_private"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input   class="css-checkbox" type="checkbox" name="private"  id="<?=$rand='a'.rand(); ?>" />
			<label for="<?=$rand?>"><?=l('Private<>');?></label></div></div></div>
</div>
</div><!--

-->
<!--inputs above -->
</form>
<?php } ?>