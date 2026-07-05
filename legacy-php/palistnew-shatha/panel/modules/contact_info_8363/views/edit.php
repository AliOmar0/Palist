<?php 
$original_edit_id=$id=check_get_id();
	$_form_resp=db('contact_info_8363','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('contact_info_8363','edit') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<form id="contact_info_8363" autocomplete="off" action="" onsubmit="return submitter(this,'<?=isset($controllerURL)? $controllerURL:urlPanel?>');" method="post" enctype="multipart/form-data">
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="contact_info_8363"/> 
<input type="hidden" name="action" value="edit"/> 
<input type="hidden" name="id" value="<?=$id;?>"/> 

<!--inputs below -->
<!--
	

--><div class="form_field  contact_info_8363_phone" data-legion-field-type="text">
<label for="for_field_phone"><?=l('Phone<>');?></label>
<div class="input_area">
<input id="for_field_phone"  type="text" name="phone"   data-legion-module="contact_info_8363" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['phone']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  contact_info_8363_email" data-legion-field-type="email">
<label for="for_field_email"><?=l('Email<>');?></label>
<div class="input_area">
<input id="for_field_email"  type="email" name="email"   data-legion-module="contact_info_8363" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['email']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  contact_info_8363_location" data-legion-field-type="text">
<label for="for_field_location"><?=l('Location<>الموقع');?></label>
<div class="input_area">
<input id="for_field_location"  type="text" name="location"   data-legion-module="contact_info_8363" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['location']) ?>"/>
</div>
</div><!--

-->
<!--inputs above -->
</form>
<?php } ?>