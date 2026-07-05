<?php 
$original_edit_id=$id=check_get_id();
	$_form_resp=db('module_actions','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('module_actions','edit') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<form id="module_actions" autocomplete="off" action="" onsubmit="return submitter(this,'<?=isset($controllerURL)? $controllerURL:urlPanel?>');" method="post" enctype="multipart/form-data">
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="module_actions"/> 
<input type="hidden" name="action" value="edit"/> 
<input type="hidden" name="id" value="<?=$id;?>"/> 

<!--inputs below -->
<!--
	

--><div class="form_field  module_actions_module_id" data-legion-field-type="select">
<label for="for_field_module_id"><?=l('Module ID<>');?></label>
<div class="input_area">

<select  id="for_field_module_id" class="l_mc l_white_c" name="module_id">
<?php 
$addition_where=NULL;
	
$_form_sub_resp=db('modules',"WHERE deleted=0    $addition_where",NULL);
			if($_form_sub_resp==0){?><option value="0" selected><?=l('Error<>خطأ')?></option><?php } 
			else if($_form_sub_resp==1){?><option value="0" selected><?=l('Choose<>اختر');?></option><?php } 
				 else { ?>
                 <option value="0" <?=(0==$_form_resp[0]['module_id']?'selected':'')?>><?=l('Choose<>اختر');?></option>
				<?php
					$echoFields='module_name';
					$x=explode(',',$echoFields);
					if($_form_sub_resp!=1){
						for($j=0;$j<count($_form_sub_resp);$j++){?>
						<option <?=($_form_sub_resp[$j]['id']==$_form_resp[0]['module_id'] ? 'selected' : ''); ?> class="l_mc l_white_c" value="<?=$_form_sub_resp[$j]['id']?>"><?php 
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


	

--><div class="form_field  module_actions_title" data-legion-field-type="text">
<label for="for_field_title"><?=l('Title<>');?></label>
<div class="input_area">
<input id="for_field_title"  type="text" name="title"   data-legion-module="module_actions" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['title']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  module_actions_type" data-legion-field-type="text">
<label for="for_field_type"><?=l('Type<>');?></label>
<div class="input_area">
<input id="for_field_type"  type="text" name="type"   data-legion-module="module_actions" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['type']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  module_actions_icon" data-legion-field-type="text">
<label for="for_field_icon"><?=l('Icon<>');?></label>
<div class="input_area">
<input id="for_field_icon"  type="text" name="icon"   data-legion-module="module_actions" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['icon']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  module_actions_private" data-legion-field-type="checkbox">
<label for="for_field_private"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input <?=($_form_resp[0]['private']==1 ? ' checked ':'');?>
 class=" css-checkbox" name="private" type="checkbox" id="<?=$rand='a'.rand(); ?>"/>
			<label for="<?=$rand ?>"><?=l('Private<>');?></label></div></div></div>
</div>
</div><!--

-->
<!--inputs above -->
</form>
<?php } ?>