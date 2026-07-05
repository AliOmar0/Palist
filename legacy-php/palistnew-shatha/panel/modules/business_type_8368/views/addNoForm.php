<?php if(!privilege('business_type_8368','add'))echo $noPermission;else{?>
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="business_type_8368"/> 
<input type="hidden" name="action" value="add"/>
<!--inputs below --> 
<!--
	

--><div class="form_field business_type_8368_title" data-legion-field-type="text">
<label for="for_field_title"><?=l('Title<>');?></label>
<div class="input_area">
<input id="for_field_title"  type="text"  data-legion-module="business_type_8368" name="title" placeholder="" value=""/>
</div>
</div><!--

-->
<!--inputs above -->
<?php } ?>