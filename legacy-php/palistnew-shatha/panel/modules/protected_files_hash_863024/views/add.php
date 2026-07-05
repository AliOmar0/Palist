<?php if(!privilege('protected_files_hash_863024','add'))echo $noPermission;else{?>
<form id="protected_files_hash_863024" autocomplete="off" action="" onsubmit="return submitter(this,'<?=isset($controllerURL)? $controllerURL:urlPanel?>');" method="post" enctype="multipart/form-data">
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="protected_files_hash_863024"/> 
<input type="hidden" name="action" value="add"/>
<!--inputs below --> 
<!--
	

--><div class="form_field protected_files_hash_863024_file_name" data-legion-field-type="text">
<label for="for_field_file_name"><?=l('File Name<>');?></label>
<div class="input_area">
<input id="for_field_file_name"  type="text"  data-l_module="protected_files_hash_863024" name="file_name" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field protected_files_hash_863024_requested_file_version" data-legion-field-type="text">
<label for="for_field_requested_file_version"><?=l('Requested File Version<>');?></label>
<div class="input_area">
<input id="for_field_requested_file_version"  type="text"  data-l_module="protected_files_hash_863024" name="requested_file_version" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field protected_files_hash_863024_ip" data-legion-field-type="text">
<label for="for_field_ip"><?=l('IP<>');?></label>
<div class="input_area">
<input id="for_field_ip"  type="text"  data-l_module="protected_files_hash_863024" name="ip" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field protected_files_hash_863024_device" data-legion-field-type="number">
<label for="for_field_device"><?=l('Device<>');?></label>
<div class="input_area">
<input id="for_field_device"  type="number"  data-l_module="protected_files_hash_863024" name="device" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field protected_files_hash_863024_version" data-legion-field-type="text">
<label for="for_field_version"><?=l('Version<>');?></label>
<div class="input_area">
<input id="for_field_version"  type="text"  data-l_module="protected_files_hash_863024" name="version" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field protected_files_hash_863024_user" data-legion-field-type="number">
<label for="for_field_user"><?=l('User<>');?></label>
<div class="input_area">
<input id="for_field_user"  type="number"  data-l_module="protected_files_hash_863024" name="user" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field protected_files_hash_863024_user_module" data-legion-field-type="number">
<label for="for_field_user_module"><?=l('User Module<>');?></label>
<div class="input_area">
<input id="for_field_user_module"  type="number"  data-l_module="protected_files_hash_863024" name="user_module" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field protected_files_hash_863024_hash" data-legion-field-type="text">
<label for="for_field_hash"><?=l('Hash<>');?></label>
<div class="input_area">
<input id="for_field_hash"  type="text"  data-l_module="protected_files_hash_863024" name="hash" placeholder="" value=""/>
</div>
</div><!--

-->
<!--inputs above -->
</form>
<?php } ?>