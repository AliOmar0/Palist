<?php 
$id=check_get_id();
	$_form_resp=db('error_1528374155','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('error_1528374155','edit') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="error_1528374155"/> 
<input type="hidden" name="action" value="edit"/> 
<input type="hidden" name="id" value="<?=$id;?>"/> 

<!--inputs below -->
<!--
	

--><div class="form_field  error_1528374155_error_desc" data-legion-field-type="textarea">
<label for="for_field_error_desc"><?=l('Error Desc<>وصف الخطأ');?> <span class="required_star">*</span></label>
<div class="input_area">
<textarea  required  placeholder="" data-max_count="250"  class="mceNoEditor " name="error_desc"><?=$_form_resp[0]['error_desc'] ?></textarea>
</div>
</div><!--


	

--><div class="form_field  error_1528374155_icon" data-legion-field-type="radio">
<label for="for_field_icon"><?=l('Icon<>الأيقونة');?> <span class="required_star">*</span></label>
<div class="input_area">
<input required type="radio" name="icon" <?=($_form_resp[0]['icon']=='Logo'?' checked ':'');?> value="Logo" id="radio_icon_0"/><label for="radio_icon_0">Logo</label>
				<input required type="radio" name="icon" <?=($_form_resp[0]['icon']=='Correct'?' checked ':'');?> value="Correct" id="radio_icon_1"/><label for="radio_icon_1">Correct</label>
				<input required type="radio" name="icon" <?=($_form_resp[0]['icon']=='Error'?' checked ':'');?> value="Error" id="radio_icon_2"/><label for="radio_icon_2">Error</label>
				<input required type="radio" name="icon" <?=($_form_resp[0]['icon']=='Warning'?' checked ':'');?> value="Warning" id="radio_icon_3"/><label for="radio_icon_3">Warning</label>
				
</div>
</div><!--


	

--><div class="form_field  error_1528374155_die" data-legion-field-type="checkbox">
<label for="for_field_die"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input <?=($_form_resp[0]['die']==1 ? ' checked ':'');?>
 class=" css-checkbox" name="die" type="checkbox" id="<?=$rand='a'.rand(); ?>"/>
			<label for="<?=$rand ?>"><?=l('Die<>إيقاف إجباري للبرمجية');?></label></div></div></div>
</div>
</div><!--

-->
<!--inputs above -->
<?php } ?>