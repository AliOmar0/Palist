<?php 
$id=check_get_id();
	$_form_resp=db('menu_1564508145','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('menu_1564508145','edit') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="menu_1564508145"/> 
<input type="hidden" name="action" value="edit"/> 
<input type="hidden" name="id" value="<?=$id;?>"/> 

<!--inputs below -->
<!--
	

--><div class="form_field  menu_1564508145_title" data-legion-field-type="text">
<label for="for_field_title"><?=l('Title<>');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_title"  required type="text" name="title" data-l_module="menu_1564508145" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['title']) ?>"/>
</div>
</div><!--

-->
<!--inputs above -->
<?php } ?>