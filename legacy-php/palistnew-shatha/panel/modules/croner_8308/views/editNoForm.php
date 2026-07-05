<?php 
$id=check_get_id();
	$_form_resp=db('croner_8308','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('croner_8308','edit') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="croner_8308"/> 
<input type="hidden" name="action" value="edit"/> 
<input type="hidden" name="id" value="<?=$id;?>"/> 

<!--inputs below -->
<!--
	

--><div class="form_field  croner_8308_module_prefix" data-legion-field-type="select">
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


	

--><div class="form_field  croner_8308_item_id" data-legion-field-type="number">
<label for="for_field_item_id"><?=l('Item ID<>');?></label>
<div class="input_area">
<input id="for_field_item_id"  type="number" name="item_id"   data-legion-module="croner_8308" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['item_id']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  croner_8308_remark" data-legion-field-type="text">
<label for="for_field_remark"><?=l('Remark<>');?></label>
<div class="input_area">
<input id="for_field_remark"  type="text" name="remark"   data-legion-module="croner_8308" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['remark']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  croner_8308_emails" data-legion-field-type="text">
<label for="for_field_emails"><?=l('Emails<>');?></label>
<div class="input_area">
<input id="for_field_emails"  type="text" name="emails"   data-legion-module="croner_8308" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['emails']) ?>"/>
</div>
</div><!--

-->
<!--inputs above -->
<?php } ?>