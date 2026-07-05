<?php if(!privilege('sms_1583164170','add'))echo $noPermission;else{?>
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="sms_1583164170"/> 
<input type="hidden" name="action" value="add"/>
<!--inputs below --> 
<!--
	

--><div class="form_field ontwo in sms_1583164170_country_code" data-legion-field-type="number">
<label for="for_field_country_code"><?=l('Country Code<>المقدمة الدولية');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_country_code"  required type="number"  data-legion-module="sms_1583164170" name="country_code" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field ontwo in sms_1583164170_phone_number" data-legion-field-type="number">
<label for="for_field_phone_number"><?=l('Phone Number<>رقم الخلوي');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_phone_number"  required type="number"  data-legion-module="sms_1583164170" name="phone_number" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field sms_1583164170_message" data-legion-field-type="textarea">
<label for="for_field_message"><?=l('Message<>الرسالة');?> <span class="required_star">*</span></label>
<div class="input_area">
<textarea  required  placeholder="" data-max_count="500" class="mceNoEditor " name="message"></textarea>
</div>
</div><!--

-->
<!--inputs above -->
<?php } ?>