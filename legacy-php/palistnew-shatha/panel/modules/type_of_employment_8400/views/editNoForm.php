<?php 
$id=check_get_id();
	$_form_resp=db('type_of_employment_8400','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('type_of_employment_8400','edit') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="type_of_employment_8400"/> 
<input type="hidden" name="action" value="edit"/> 
<input type="hidden" name="id" value="<?=$id;?>"/> 

<!--inputs below -->
<!--
	

--><?php if(!isset($type_of_employment_8400_title)){?><div class="form_field  type_of_employment_8400_title" data-legion-field-type="text">
<label for="for_field_title"><?=l('Title<>');?></label>
<div class="input_area">
<input id="for_field_title"  type="text" name="title" data-l_is_ml="true" data-l_module="type_of_employment_8400" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['title']) ?>"/>
</div>
</div><?php }?><!--
	
-->
<!--inputs above -->
<?php } ?>