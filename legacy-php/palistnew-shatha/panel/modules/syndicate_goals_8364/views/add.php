<?php if(!privilege('syndicate_goals_8364','add'))echo $noPermission;else{?>
<form id="syndicate_goals_8364" autocomplete="off" action="" onsubmit="return submitter(this,'<?=isset($controllerURL)? $controllerURL:urlPanel?>');" method="post" enctype="multipart/form-data">
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="syndicate_goals_8364"/> 
<input type="hidden" name="action" value="add"/>
<!--inputs below --> 
<!--
	

--><div class="form_field syndicate_goals_8364_title" data-legion-field-type="textarea">
<label for="for_field_title"><?=l('Title<>');?></label>
<div class="input_area">
<textarea   placeholder="" data-max_count="250" class="mceNoEditor " name="title"></textarea>
</div>
</div><!--

-->
<!--inputs above -->
</form>
<?php } ?>