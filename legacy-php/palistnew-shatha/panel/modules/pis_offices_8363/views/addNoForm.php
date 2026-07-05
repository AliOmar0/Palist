<?php if(!privilege('pis_offices_8363','add'))echo $noPermission;else{?>
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="pis_offices_8363"/> 
<input type="hidden" name="action" value="add"/>
<!--inputs below --> 
<!--
	

--><div class="form_field pis_offices_8363_title" data-legion-field-type="text">
<label for="for_field_title"><?=l('Title<>اسم المحافظة');?></label>
<div class="input_area">
<input id="for_field_title"  type="text"  data-legion-module="pis_offices_8363" name="title" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field location_field pis_offices_8363_location" data-legion-field-type="location">
<label for="for_field_location"><?=l('Location<>الموقع');?></label>
<div class="input_area">
<input id="for_field_location"  type="text"  data-legion-module="pis_offices_8363" name="location" placeholder="" value=""/>
</div>
</div><!--

-->
<!--inputs above -->
<?php } ?>