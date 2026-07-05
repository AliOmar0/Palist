<?php 
$id=check_get_id();
	$_form_resp=db('contact_form_8363','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('contact_form_8363','edit') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="contact_form_8363"/> 
<input type="hidden" name="action" value="edit"/> 
<input type="hidden" name="id" value="<?=$id;?>"/> 

<!--inputs below -->
<!--
	

--><div class="form_field ontwo in  contact_form_8363_name" data-legion-field-type="text">
<label for="for_field_name"><?=l('Name<>الاسم');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_name"  required type="text" name="name"   data-legion-module="contact_form_8363" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['name']) ?>"/>
</div>
</div><!--


	

--><div class="form_field ontwo in  contact_form_8363_email" data-legion-field-type="email">
<label for="for_field_email"><?=l('Email<>البريد الالكتروني');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_email"  required type="email" name="email"   data-legion-module="contact_form_8363" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['email']) ?>"/>
</div>
</div><!--


	

--><div class="form_field ontwo in  contact_form_8363_mobile_number" data-legion-field-type="number">
<label for="for_field_mobile_number"><?=l('Mobile Number<>رقم الجوال');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_mobile_number"  required type="number" name="mobile_number"   data-legion-module="contact_form_8363" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['mobile_number']) ?>"/>
</div>
</div><!--


	

--><div class="form_field ontwo in  contact_form_8363_telephone" data-legion-field-type="number">
<label for="for_field_telephone"><?=l('Telephone<>رقم الهاتف');?></label>
<div class="input_area">
<input id="for_field_telephone"  type="number" name="telephone"   data-legion-module="contact_form_8363" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['telephone']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  contact_form_8363_message" data-legion-field-type="textarea">
<label for="for_field_message"><?=l('Message<>الرسالة');?> <span class="required_star">*</span></label>
<div class="input_area">
<textarea  required  placeholder="" data-max_count="500"  class="mceNoEditor " name="message"><?=$_form_resp[0]['message'] ?></textarea>
</div>
</div><!--

-->
<!--inputs above -->
<?php } ?>