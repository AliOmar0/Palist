<?php if(!privilege('social_links_8363','add'))echo $noPermission;else{?>
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="social_links_8363"/> 
<input type="hidden" name="action" value="add"/>
<!--inputs below --> 
<!--
	

--><div class="form_field ontwo in social_links_8363_title" data-legion-field-type="text">
<label for="for_field_title"><?=l('Title<>');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_title"  required type="text"  data-legion-module="social_links_8363" name="title" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field ontwo in social_links_8363_link" data-legion-field-type="url">
<label for="for_field_link"><?=l('Link<>');?></label>
<div class="input_area">
<input id="for_field_link"  type="url"  data-legion-module="social_links_8363" name="link" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field ontwo in social_links_8363_social_font" data-legion-field-type="text">
<label for="for_field_social_font"><?=l('Social Font<>');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_social_font"  required type="text"  data-legion-module="social_links_8363" name="social_font" placeholder="" value=""/>
</div>
</div><!--

-->
<!--inputs above -->
<?php } ?>