<?php if(!privilege('menu_1564508145','add'))echo $noPermission;else{?>
<form id="menu_1564508145" autocomplete="off" action="" onsubmit="return submitter(this,'<?=isset($controllerURL)? $controllerURL:urlPanel?>');" method="post" enctype="multipart/form-data">
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="menu_1564508145"/> 
<input type="hidden" name="action" value="add"/>
<!--inputs below --> 
<!--
	

--><div class="form_field menu_1564508145_title" data-legion-field-type="text">
<label for="for_field_title"><?=l('Title<>');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_title"  required type="text"  data-l_module="menu_1564508145" name="title" placeholder="" value=""/>
</div>
</div><!--

-->
<!--inputs above -->
</form>
<?php } ?>