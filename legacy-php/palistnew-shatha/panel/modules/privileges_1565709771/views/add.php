<?php if(!privilege('privileges_1565709771','add'))echo $noPermission;else{?>
<form id="privileges_1565709771" autocomplete="off" action="" onsubmit="return submitter(this,'<?=isset($controllerURL)? $controllerURL:urlPanel?>');" method="post" enctype="multipart/form-data">
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="privileges_1565709771"/> 
<input type="hidden" name="action" value="add"/>
<!--inputs below --> 
<!--
	

--><div class="form_field privileges_1565709771_user_id" data-legion-field-type="select">
<label for="for_field_user_id"><?=l('User ID<>رقم مُعرّف المستخدم');?> <span class="required_star">*</span></label>
<div class="input_area">
<select  required id="for_field_user_id" class="l_mc l_white_c" name="user_id">
<?php 
$addition_where=NULL;

$_form_resp=db('admins',"WHERE deleted=0   $addition_where",NULL,NULL);
			if($_form_resp==0){?><option value="0" selected><?=l('Error<>خطأ')?></option> <?php } 
			else if($_form_resp==1){?><option value="0" selected><?=l('Choose<>اختر');?></option><?php } 
				else {?>
                    <option value=""><?=l('Choose<>اختر');?></option>
					<?php 
					$echoFields='username';
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


	

--><div class="form_field privileges_1565709771_module_name" data-legion-field-type="text">
<label for="for_field_module_name"><?=l('Module Name<>نوع المستخدم');?></label>
<div class="input_area">
<input id="for_field_module_name"  type="text"  data-legion-module="privileges_1565709771" name="module_name" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field privileges_1565709771_type_name" data-legion-field-type="text">
<label for="for_field_type_name"><?=l('Type Name<>الأمر');?></label>
<div class="input_area">
<input id="for_field_type_name"  type="text"  data-legion-module="privileges_1565709771" name="type_name" placeholder="" value=""/>
</div>
</div><!--

-->
<!--inputs above -->
</form>
<?php } ?>