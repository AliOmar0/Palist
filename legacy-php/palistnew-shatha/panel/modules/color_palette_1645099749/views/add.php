<?php if(!privilege('color_palette_1645099749','add'))echo $noPermission;else{?>
<form id="color_palette_1645099749" autocomplete="off" action="" onsubmit="return submitter(this,'<?=isset($controllerURL)? $controllerURL:urlPanel?>');" method="post" enctype="multipart/form-data">
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="color_palette_1645099749"/> 
<input type="hidden" name="action" value="add"/>
<!--inputs below --> 
<!--
	

--><div class="form_field color_palette_1645099749_name" data-legion-field-type="text">
<label for="for_field_name"><?=l('Name<>الاسم');?></label>
<div class="input_area">
<input id="for_field_name"  type="text"  data-legion-module="color_palette_1645099749" name="name" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field color_palette_1645099749_color" data-legion-field-type="color">
<label for="for_field_color"><?=l('Color<>اللون');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_color"  required type="color"  data-legion-module="color_palette_1645099749" name="color" placeholder="" value=""/>
</div>
</div><!--

-->
<!--inputs above -->
</form>
<?php } ?>