<?php 
$id=check_get_id();
	$_form_resp=db('business_type_8368','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('business_type_8368','edit') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="business_type_8368"/> 
<input type="hidden" name="action" value="edit"/> 
<input type="hidden" name="id" value="<?=$id;?>"/> 

<!--inputs below -->
<!--
	

--><div class="form_field  business_type_8368_title" data-legion-field-type="text">
<label for="for_field_title"><?=l('Title<>');?></label>
<div class="input_area">
<input id="for_field_title"  type="text" name="title"   data-legion-module="business_type_8368" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['title']) ?>"/>
</div>
</div><!--

-->
<!--inputs above -->
<?php } ?>