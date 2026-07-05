<?php if(!privilege('university_country_8371','add'))echo $noPermission;else{?>
<form id="university_country_8371" autocomplete="off" action="" onsubmit="return submitter(this,'<?=isset($controllerURL)? $controllerURL:urlPanel?>');" method="post" enctype="multipart/form-data">
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="university_country_8371"/> 
<input type="hidden" name="action" value="add"/>
<!--inputs below --> 
<!--
	

--><div class="form_field university_country_8371_title" data-legion-field-type="text">
<label for="for_field_title"><?=l('Title<>العنوان');?></label>
<div class="input_area">
<input id="for_field_title"  type="text"  data-legion-module="university_country_8371" name="title" placeholder="" value=""/>
</div>
</div><!--

-->
<!--inputs above -->
</form>
<?php } ?>