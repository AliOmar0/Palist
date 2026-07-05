<?php if(!privilege('undergraduate_degree_8371','add'))echo $noPermission;else{?>
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="undergraduate_degree_8371"/> 
<input type="hidden" name="action" value="add"/>
<!--inputs below --> 
<!--
	

--><div class="form_field undergraduate_degree_8371_title" data-legion-field-type="text">
<label for="for_field_title"><?=l('Title<>العنوان');?></label>
<div class="input_area">
<input id="for_field_title"  type="text"  data-l_is_ml="true" data-l_module="undergraduate_degree_8371" name="title" placeholder="" value=""/>
</div>
</div><!--

-->
<!--inputs above -->
<?php } ?>