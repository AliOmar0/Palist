<?php 
$original_edit_id=$id=check_get_id();
	$_form_resp=db('access_history','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('access_history','edit') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<form id="access_history" autocomplete="off" action="" onsubmit="return submitter(this,'<?=isset($controllerURL)? $controllerURL:urlPanel?>');" method="post" enctype="multipart/form-data">
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="access_history"/> 
<input type="hidden" name="action" value="edit"/> 
<input type="hidden" name="id" value="<?=$id;?>"/> 

<!--inputs below -->
<!--
	

--><div class="form_field  access_history_module_prefix" data-legion-field-type="select">
<label for="for_field_module_prefix"><?=l('Module Prefix<>');?></label>
<div class="input_area">

<select  id="for_field_module_prefix" class="l_mc l_white_c" name="module_prefix">
<?php 
$addition_where=NULL;
	
$_form_sub_resp=db('modules',"WHERE deleted=0    $addition_where",NULL);
			if($_form_sub_resp==0){?><option value="0" selected><?=l('Error<>خطأ')?></option><?php } 
			else if($_form_sub_resp==1){?><option value="0" selected><?=l('Choose<>اختر');?></option><?php } 
				 else { ?>
                 <option value="0" <?=(0==$_form_resp[0]['module_prefix']?'selected':'')?>><?=l('Choose<>اختر');?></option>
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


	

--><div class="form_field  access_history_user_id" data-legion-field-type="number">
<label for="for_field_user_id"><?=l('User ID<>');?></label>
<div class="input_area">
<input id="for_field_user_id"  type="number" name="user_id"   data-legion-module="access_history" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['user_id']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  access_history_remark" data-legion-field-type="text">
<label for="for_field_remark"><?=l('Remark<>');?></label>
<div class="input_area">
<input id="for_field_remark"  type="text" name="remark"   data-legion-module="access_history" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['remark']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  access_history_ip" data-legion-field-type="text">
<label for="for_field_ip"><?=l('IP<>');?></label>
<div class="input_area">
<input id="for_field_ip"  type="text" name="ip"   data-legion-module="access_history" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['ip']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  access_history_browser" data-legion-field-type="text">
<label for="for_field_browser"><?=l('Browser<>');?></label>
<div class="input_area">
<input id="for_field_browser"  type="text" name="browser"   data-legion-module="access_history" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['browser']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  access_history_referer" data-legion-field-type="text">
<label for="for_field_referer"><?=l('Referer<>');?></label>
<div class="input_area">
<input id="for_field_referer"  type="text" name="referer"   data-legion-module="access_history" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['referer']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  access_history_browser_language" data-legion-field-type="text">
<label for="for_field_browser_language"><?=l('Browser Language<>');?></label>
<div class="input_area">
<input id="for_field_browser_language"  type="text" name="browser_language"   data-legion-module="access_history" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['browser_language']) ?>"/>
</div>
</div><!--

-->
<!--inputs above -->
</form>
<?php } ?>