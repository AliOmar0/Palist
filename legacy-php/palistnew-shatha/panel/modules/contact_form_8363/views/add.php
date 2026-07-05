<?php if(!privilege('contact_form_8363','add'))echo $noPermission;else{?>
<form id="contact_form_8363" autocomplete="off" action="" onsubmit="return submitter(this,'<?=isset($controllerURL)? $controllerURL:urlPanel?>');" method="post" enctype="multipart/form-data">
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="contact_form_8363"/> 
<input type="hidden" name="action" value="add"/>
<!--inputs below --> 
<!--
	

--><div class="form_field ontwo in contact_form_8363_name" data-legion-field-type="text">
<label for="for_field_name"><?=l('Name<>الاسم');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_name"  required type="text"  data-legion-module="contact_form_8363" name="name" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field ontwo in contact_form_8363_email" data-legion-field-type="email">
<label for="for_field_email"><?=l('Email<>البريد الالكتروني');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_email"  required type="email"  data-legion-module="contact_form_8363" name="email" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field ontwo in contact_form_8363_mobile_number" data-legion-field-type="number">
<label for="for_field_mobile_number"><?=l('Mobile Number<>رقم الجوال');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_mobile_number"  required type="number"  data-legion-module="contact_form_8363" name="mobile_number" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field ontwo in contact_form_8363_telephone" data-legion-field-type="number">
<label for="for_field_telephone"><?=l('Telephone<>رقم الهاتف');?></label>
<div class="input_area">
<input id="for_field_telephone"  type="number"  data-legion-module="contact_form_8363" name="telephone" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field contact_form_8363_message" data-legion-field-type="textarea">
<label for="for_field_message"><?=l('Message<>الرسالة');?> <span class="required_star">*</span></label>
<div class="input_area">
<textarea  required  placeholder="" data-max_count="500" class="mceNoEditor " name="message"></textarea>
</div>
</div><!--

-->
<!--inputs above -->
</form>
<?php } ?>