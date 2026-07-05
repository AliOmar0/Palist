<?php 
$id=check_get_id();
	$_form_resp=db('provinces_8371','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('provinces_8371','edit') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="provinces_8371"/> 
<input type="hidden" name="action" value="edit"/> 
<input type="hidden" name="id" value="<?=$id;?>"/> 

<!--inputs below -->
<!--
	

--><div class="form_field  provinces_8371_title" data-legion-field-type="text">
<label for="for_field_title"><?=l('Title<>العنوان');?></label>
<div class="input_area">
<input id="for_field_title"  type="text" name="title"   data-legion-module="provinces_8371" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['title']) ?>"/>
</div>
</div><!--

-->
<!--inputs above -->
<?php } ?>