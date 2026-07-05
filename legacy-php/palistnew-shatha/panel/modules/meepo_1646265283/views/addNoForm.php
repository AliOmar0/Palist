<?php if(!privilege('meepo_1646265283','add'))echo $noPermission;else{?>
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="meepo_1646265283"/> 
<input type="hidden" name="action" value="add"/>
<!--inputs below --> 
<!--
	

--><div class="form_field meepo_1646265283_title" data-legion-field-type="text">
<label for="for_field_title"><?=l('Title<>');?></label>
<div class="input_area">
<input id="for_field_title"  type="text"  data-legion-module="meepo_1646265283" name="title" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field meepo_1646265283_html" data-legion-field-type="textarea">
<label for="for_field_html"><?=l('HTML<>');?></label>
<div class="input_area">
<textarea   placeholder="" data-max_count="500" class="mceNoEditor " name="html"></textarea>
</div>
</div><!--

-->
<!--inputs above -->
<?php } ?>