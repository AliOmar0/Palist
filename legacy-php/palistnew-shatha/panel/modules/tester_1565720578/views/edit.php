<?php 
$original_edit_id=$id=check_get_id();
	$_form_resp=db('tester_1565720578','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('tester_1565720578','edit') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<form id="tester_1565720578" autocomplete="off" action="" onsubmit="return submitter(this,'<?=isset($controllerURL)? $controllerURL:urlPanel?>');" method="post" enctype="multipart/form-data">
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="tester_1565720578"/> 
<input type="hidden" name="action" value="edit"/> 
<input type="hidden" name="id" value="<?=$id;?>"/> 

<!--inputs below -->
<!--
	

--><div class="form_field  tester_1565720578_raw_post" data-legion-field-type="textarea">
<label for="for_field_raw_post"><?=l('Raw Post<>المعلومات المُرسلة');?></label>
<div class="input_area">
<textarea   placeholder="" data-max_count="500"  class="mceNoEditor " name="raw_post"><?=$_form_resp[0]['raw_post'] ?></textarea>
</div>
</div><!--


	

--><div class="form_field  tester_1565720578_specific_data" data-legion-field-type="textarea">
<label for="for_field_specific_data"><?=l('Specific Data<>معلومات محددة');?></label>
<div class="input_area">
<textarea   placeholder="" data-max_count="500"  class="mceNoEditor " name="specific_data"><?=$_form_resp[0]['specific_data'] ?></textarea>
</div>
</div><!--

-->
<!--inputs above -->
</form>
<?php } ?>