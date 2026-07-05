<?php 
$id=check_get_id();
	$_form_resp=db('statistics_box_8324','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('statistics_box_8324','edit') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="statistics_box_8324"/> 
<input type="hidden" name="action" value="edit"/> 
<input type="hidden" name="id" value="<?=$id;?>"/> 

<!--inputs below -->
<!--
	

--><div class="form_field  statistics_box_8324_title" data-legion-field-type="text">
<label for="for_field_title"><?=l('Title<>');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_title"  required type="text" name="title"   data-legion-module="statistics_box_8324" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['title']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  h statistics_box_8324_css" data-legion-field-type="textarea">
<label for="for_field_css"><?=l('Css<>');?></label>
<div class="input_area">
<textarea   placeholder="" data-max_count="500"  class="mceNoEditor " name="css"><?=$_form_resp[0]['css'] ?></textarea>
</div>
</div><!--


	

--><div class="form_field  h statistics_box_8324_ids" data-legion-field-type="text">
<label for="for_field_ids"><?=l('IDs<>');?></label>
<div class="input_area">
<input id="for_field_ids"  type="text" name="ids"   data-legion-module="statistics_box_8324" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['ids']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  h statistics_box_8324_order_number" data-legion-field-type="number">
<label for="for_field_order_number"><?=l('Order Number<>');?></label>
<div class="input_area">
<input id="for_field_order_number"  type="number" name="order_number"   data-legion-module="statistics_box_8324" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['order_number']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  statistics_box_8324_shortname" data-legion-field-type="text">
<label for="for_field_shortname"><?=l('Shortname<>');?></label>
<div class="input_area">
<input id="for_field_shortname"  type="text" name="shortname"   data-legion-module="statistics_box_8324" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['shortname']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  statistics_box_8324_dashboard" data-legion-field-type="checkbox">
<label for="for_field_dashboard"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input <?=($_form_resp[0]['dashboard']==1 ? ' checked ':'');?>
 class=" css-checkbox" name="dashboard" type="checkbox" id="<?=$rand='a'.rand(); ?>"/>
			<label for="<?=$rand ?>"><?=l('Dashboard<>');?></label></div></div></div>
</div>
</div><!--

-->
<!--inputs above -->
<?php } ?>