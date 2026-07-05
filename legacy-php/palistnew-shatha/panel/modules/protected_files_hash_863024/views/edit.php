<?php 
$original_edit_id=$id=check_get_id();
	$_form_resp=db('protected_files_hash_863024','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('protected_files_hash_863024','edit') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<form id="protected_files_hash_863024" autocomplete="off" action="" onsubmit="return submitter(this,'<?=isset($controllerURL)? $controllerURL:urlPanel?>');" method="post" enctype="multipart/form-data">
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="protected_files_hash_863024"/> 
<input type="hidden" name="action" value="edit"/> 
<input type="hidden" name="id" value="<?=$id;?>"/> 

<!--inputs below -->
<!--
	

--><div class="form_field  protected_files_hash_863024_file_name" data-legion-field-type="text">
<label for="for_field_file_name"><?=l('File Name<>');?></label>
<div class="input_area">
<input id="for_field_file_name"  type="text" name="file_name" data-l_module="protected_files_hash_863024" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['file_name']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  protected_files_hash_863024_requested_file_version" data-legion-field-type="text">
<label for="for_field_requested_file_version"><?=l('Requested File Version<>');?></label>
<div class="input_area">
<input id="for_field_requested_file_version"  type="text" name="requested_file_version" data-l_module="protected_files_hash_863024" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['requested_file_version']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  protected_files_hash_863024_ip" data-legion-field-type="text">
<label for="for_field_ip"><?=l('IP<>');?></label>
<div class="input_area">
<input id="for_field_ip"  type="text" name="ip" data-l_module="protected_files_hash_863024" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['ip']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  protected_files_hash_863024_device" data-legion-field-type="number">
<label for="for_field_device"><?=l('Device<>');?></label>
<div class="input_area">
<input id="for_field_device"  type="number" name="device" data-l_module="protected_files_hash_863024" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['device']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  protected_files_hash_863024_version" data-legion-field-type="text">
<label for="for_field_version"><?=l('Version<>');?></label>
<div class="input_area">
<input id="for_field_version"  type="text" name="version" data-l_module="protected_files_hash_863024" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['version']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  protected_files_hash_863024_user" data-legion-field-type="number">
<label for="for_field_user"><?=l('User<>');?></label>
<div class="input_area">
<input id="for_field_user"  type="number" name="user" data-l_module="protected_files_hash_863024" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['user']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  protected_files_hash_863024_user_module" data-legion-field-type="number">
<label for="for_field_user_module"><?=l('User Module<>');?></label>
<div class="input_area">
<input id="for_field_user_module"  type="number" name="user_module" data-l_module="protected_files_hash_863024" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['user_module']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  protected_files_hash_863024_hash" data-legion-field-type="text">
<label for="for_field_hash"><?=l('Hash<>');?></label>
<div class="input_area">
<input id="for_field_hash"  type="text" name="hash" data-l_module="protected_files_hash_863024" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['hash']) ?>"/>
</div>
</div><!--

-->
<!--inputs above -->
</form>
<?php } ?>