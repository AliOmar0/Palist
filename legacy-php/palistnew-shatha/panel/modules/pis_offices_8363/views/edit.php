<?php 
$original_edit_id=$id=check_get_id();
	$_form_resp=db('pis_offices_8363','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('pis_offices_8363','edit') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<form id="pis_offices_8363" autocomplete="off" action="" onsubmit="return submitter(this,'<?=isset($controllerURL)? $controllerURL:urlPanel?>');" method="post" enctype="multipart/form-data">
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="pis_offices_8363"/> 
<input type="hidden" name="action" value="edit"/> 
<input type="hidden" name="id" value="<?=$id;?>"/> 

<!--inputs below -->
<!--
	

--><div class="form_field  pis_offices_8363_title" data-legion-field-type="text">
<label for="for_field_title"><?=l('Title<>اسم المحافظة');?></label>
<div class="input_area">
<input id="for_field_title"  type="text" name="title"   data-legion-module="pis_offices_8363" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['title']) ?>"/>
</div>
</div><!--


	

--><div class="form_field location_field  pis_offices_8363_location" data-legion-field-type="location">
<label for="for_field_location"><?=l('Location<>الموقع');?></label>
<div class="input_area">
<input id="for_field_location"  type="text" name="location"   data-legion-module="pis_offices_8363" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['location']) ?>"/>
</div>
</div><!--

-->
<!--inputs above -->
</form>
<?php } ?>