<?php if(!privilege('tester_1565720578','add'))echo $noPermission;else{?>
<form id="tester_1565720578" autocomplete="off" action="" onsubmit="return submitter(this,'<?=isset($controllerURL)? $controllerURL:urlPanel?>');" method="post" enctype="multipart/form-data">
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="tester_1565720578"/> 
<input type="hidden" name="action" value="add"/>
<!--inputs below --> 
<!--
	

--><div class="form_field tester_1565720578_raw_post" data-legion-field-type="textarea">
<label for="for_field_raw_post"><?=l('Raw Post<>المعلومات المُرسلة');?></label>
<div class="input_area">
<textarea   placeholder="" data-max_count="500" class="mceNoEditor " name="raw_post"></textarea>
</div>
</div><!--


	

--><div class="form_field tester_1565720578_specific_data" data-legion-field-type="textarea">
<label for="for_field_specific_data"><?=l('Specific Data<>معلومات محددة');?></label>
<div class="input_area">
<textarea   placeholder="" data-max_count="500" class="mceNoEditor " name="specific_data"></textarea>
</div>
</div><!--

-->
<!--inputs above -->
</form>
<?php } ?>