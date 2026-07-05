<?php if(!privilege('social_situation_8368','add'))echo $noPermission;else{?>
<form id="social_situation_8368" autocomplete="off" action="" onsubmit="return submitter(this,'<?=isset($controllerURL)? $controllerURL:urlPanel?>');" method="post" enctype="multipart/form-data">
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="social_situation_8368"/> 
<input type="hidden" name="action" value="add"/>
<!--inputs below --> 
<!--
	

--><div class="form_field social_situation_8368_title" data-legion-field-type="text">
<label for="for_field_title"><?=l('Title<>');?></label>
<div class="input_area">
<input id="for_field_title"  type="text"  data-legion-module="social_situation_8368" name="title" placeholder="" value=""/>
</div>
</div><!--

-->
<!--inputs above -->
</form>
<?php } ?>