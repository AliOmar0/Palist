<?php if(!privilege('syndicate_goals_8364','add'))echo $noPermission;else{?>
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
<?php } ?>