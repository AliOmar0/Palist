<?php if(!privilege('access_history','add'))echo $noPermission;else{?>
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="access_history"/> 
<input type="hidden" name="action" value="add"/>
<!--inputs below --> 
<!--
	

--><div class="form_field access_history_module_prefix" data-legion-field-type="select">
<label for="for_field_module_prefix"><?=l('Module Prefix<>');?></label>
<div class="input_area">
<select  id="for_field_module_prefix" class="l_mc l_white_c" name="module_prefix">
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


	

--><div class="form_field access_history_user_id" data-legion-field-type="number">
<label for="for_field_user_id"><?=l('User ID<>');?></label>
<div class="input_area">
<input id="for_field_user_id"  type="number"  data-legion-module="access_history" name="user_id" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field access_history_remark" data-legion-field-type="text">
<label for="for_field_remark"><?=l('Remark<>');?></label>
<div class="input_area">
<input id="for_field_remark"  type="text"  data-legion-module="access_history" name="remark" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field access_history_ip" data-legion-field-type="text">
<label for="for_field_ip"><?=l('IP<>');?></label>
<div class="input_area">
<input id="for_field_ip"  type="text"  data-legion-module="access_history" name="ip" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field access_history_browser" data-legion-field-type="text">
<label for="for_field_browser"><?=l('Browser<>');?></label>
<div class="input_area">
<input id="for_field_browser"  type="text"  data-legion-module="access_history" name="browser" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field access_history_referer" data-legion-field-type="text">
<label for="for_field_referer"><?=l('Referer<>');?></label>
<div class="input_area">
<input id="for_field_referer"  type="text"  data-legion-module="access_history" name="referer" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field access_history_browser_language" data-legion-field-type="text">
<label for="for_field_browser_language"><?=l('Browser Language<>');?></label>
<div class="input_area">
<input id="for_field_browser_language"  type="text"  data-legion-module="access_history" name="browser_language" placeholder="" value=""/>
</div>
</div><!--

-->
<!--inputs above -->
<?php } ?>