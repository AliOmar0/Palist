<?php if(!privilege('statistics_box_8324','add'))echo $noPermission;else{?>
<form id="statistics_box_8324" autocomplete="off" action="" onsubmit="return submitter(this,'<?=isset($controllerURL)? $controllerURL:urlPanel?>');" method="post" enctype="multipart/form-data">
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="statistics_box_8324"/> 
<input type="hidden" name="action" value="add"/>
<!--inputs below --> 
<!--
	

--><div class="form_field statistics_box_8324_title" data-legion-field-type="text">
<label for="for_field_title"><?=l('Title<>');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_title"  required type="text"  data-legion-module="statistics_box_8324" name="title" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field h statistics_box_8324_css" data-legion-field-type="textarea">
<label for="for_field_css"><?=l('Css<>');?></label>
<div class="input_area">
<textarea   placeholder="" data-max_count="500" class="mceNoEditor " name="css"></textarea>
</div>
</div><!--


	

--><div class="form_field h statistics_box_8324_ids" data-legion-field-type="text">
<label for="for_field_ids"><?=l('IDs<>');?></label>
<div class="input_area">
<input id="for_field_ids"  type="text"  data-legion-module="statistics_box_8324" name="ids" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field h statistics_box_8324_order_number" data-legion-field-type="number">
<label for="for_field_order_number"><?=l('Order Number<>');?></label>
<div class="input_area">
<input id="for_field_order_number"  type="number"  data-legion-module="statistics_box_8324" name="order_number" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field statistics_box_8324_shortname" data-legion-field-type="text">
<label for="for_field_shortname"><?=l('Shortname<>');?></label>
<div class="input_area">
<input id="for_field_shortname"  type="text"  data-legion-module="statistics_box_8324" name="shortname" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field statistics_box_8324_dashboard" data-legion-field-type="checkbox">
<label for="for_field_dashboard"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input   class="css-checkbox" type="checkbox" name="dashboard"  id="<?=$rand='a'.rand(); ?>" />
			<label for="<?=$rand?>"><?=l('Dashboard<>');?></label></div></div></div>
</div>
</div><!--

-->
<!--inputs above -->
</form>
<?php } ?>