<?php if(!privilege('cookies_1565697908','add'))echo $noPermission;else{?>
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="cookies_1565697908"/> 
<input type="hidden" name="action" value="add"/>
<!--inputs below --> 
<!--
	

--><div class="form_field ontwo in cookies_1565697908_user_id" data-legion-field-type="number">
<label for="for_field_user_id"><?=l('User ID<>رقم مُعرّف المستخدم');?></label>
<div class="input_area">
<input id="for_field_user_id"  type="number"  data-legion-module="cookies_1565697908" name="user_id" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field ontwo in cookies_1565697908_module_id" data-legion-field-type="select">
<label for="for_field_module_id"><?=l('Module ID<>نوع المستخدم');?></label>
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


	

--><div class="form_field cookies_1565697908_token" data-legion-field-type="text">
<label for="for_field_token"><?=l('Token<>الشيفرة');?></label>
<div class="input_area">
<input id="for_field_token"  type="text"  data-legion-module="cookies_1565697908" name="token" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field cookies_1565697908_browser" data-legion-field-type="textarea">
<label for="for_field_browser"><?=l('Browser<>نوع المتصفح');?></label>
<div class="input_area">
<textarea   placeholder="" data-max_count="500" class="mceNoEditor " name="browser"></textarea>
</div>
</div><!--


	

--><div class="form_field cookies_1565697908_browser_name" data-legion-field-type="text">
<label for="for_field_browser_name"><?=l('Browser Name<>اسم المتصفح');?></label>
<div class="input_area">
<input id="for_field_browser_name"  type="text"  data-legion-module="cookies_1565697908" name="browser_name" placeholder="" value=""/>
</div>
</div><!--

-->
<!--inputs above -->
<?php } ?>