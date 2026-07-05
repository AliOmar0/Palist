<?php if(!privilege('error_1528374155','add'))echo $noPermission;else{?>
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="error_1528374155"/> 
<input type="hidden" name="action" value="add"/>
<!--inputs below --> 
<!--
	

--><div class="form_field error_1528374155_error_desc" data-legion-field-type="textarea">
<label for="for_field_error_desc"><?=l('Error Desc<>وصف الخطأ');?> <span class="required_star">*</span></label>
<div class="input_area">
<textarea  required  placeholder="" data-max_count="250" class="mceNoEditor " name="error_desc"></textarea>
</div>
</div><!--


	

--><div class="form_field error_1528374155_icon" data-legion-field-type="radio">
<label for="for_field_icon"><?=l('Icon<>الأيقونة');?> <span class="required_star">*</span></label>
<div class="input_area">
<input required type="radio" name="icon" value="Logo" id="radio_icon_0"/><label for="radio_icon_0">Logo</label>
			
			<input required type="radio" name="icon" value="Correct" id="radio_icon_1"/><label for="radio_icon_1">Correct</label>
			
			<input required type="radio" name="icon" value="Error" id="radio_icon_2"/><label for="radio_icon_2">Error</label>
			
			<input required type="radio" name="icon" value="Warning" id="radio_icon_3"/><label for="radio_icon_3">Warning</label>
			
			
</div>
</div><!--


	

--><div class="form_field error_1528374155_die" data-legion-field-type="checkbox">
<label for="for_field_die"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input   class="css-checkbox" type="checkbox" name="die"  id="<?=$rand='a'.rand(); ?>" />
			<label for="<?=$rand?>"><?=l('Die<>إيقاف إجباري للبرمجية');?></label></div></div></div>
</div>
</div><!--

-->
<!--inputs above -->
<?php } ?>