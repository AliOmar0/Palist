<?php if(!privilege('majors_8367','add'))echo $noPermission;else{?>
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="majors_8367"/> 
<input type="hidden" name="action" value="add"/>
<!--inputs below --> 
<!--
	

--><div class="form_field majors_8367_title" data-legion-field-type="text">
<label for="for_field_title"><?=l('Title<>العنوان');?></label>
<div class="input_area">
<input id="for_field_title"  type="text"  data-legion-module="majors_8367" name="title" placeholder="" value=""/>
</div>
</div><!--

-->
<!--inputs above -->
<?php } ?>