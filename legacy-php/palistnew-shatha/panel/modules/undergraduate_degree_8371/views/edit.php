<?php 
$original_edit_id=$id=check_get_id();
	$_form_resp=db('undergraduate_degree_8371','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('undergraduate_degree_8371','edit') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<form id="undergraduate_degree_8371" autocomplete="off" action="" onsubmit="return submitter(this,'<?=isset($controllerURL)? $controllerURL:urlPanel?>');" method="post" enctype="multipart/form-data">
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="undergraduate_degree_8371"/> 
<input type="hidden" name="action" value="edit"/> 
<input type="hidden" name="id" value="<?=$id;?>"/> 

<!--inputs below -->
<!--
	

--><?php if(!isset($undergraduate_degree_8371_title)){?><div class="form_field  undergraduate_degree_8371_title" data-legion-field-type="text">
<label for="for_field_title"><?=l('Title<>العنوان');?></label>
<div class="input_area">
<input id="for_field_title"  type="text" name="title" data-l_is_ml="true" data-l_module="undergraduate_degree_8371" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['title']) ?>"/>
</div>
</div><?php }?><!--
	
-->
<!--inputs above -->
</form>
<?php } ?>