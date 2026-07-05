<?php 
$original_edit_id=$id=check_get_id();
	$_form_resp=db('employment_status_8368','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('employment_status_8368','edit') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<form id="employment_status_8368" autocomplete="off" action="" onsubmit="return submitter(this,'<?=isset($controllerURL)? $controllerURL:urlPanel?>');" method="post" enctype="multipart/form-data">
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="employment_status_8368"/> 
<input type="hidden" name="action" value="edit"/> 
<input type="hidden" name="id" value="<?=$id;?>"/> 

<!--inputs below -->
<!--
	

--><div class="form_field  employment_status_8368_title" data-legion-field-type="text">
<label for="for_field_title"><?=l('Title<>');?></label>
<div class="input_area">
<input id="for_field_title"  type="text" name="title"   data-legion-module="employment_status_8368" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['title']) ?>"/>
</div>
</div><!--

-->
<!--inputs above -->
</form>
<?php } ?>