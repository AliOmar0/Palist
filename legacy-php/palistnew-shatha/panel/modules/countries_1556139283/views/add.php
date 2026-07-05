<?php if(!privilege('countries_1556139283','add'))echo $noPermission;else{?>
<form id="countries_1556139283" autocomplete="off" action="" onsubmit="return submitter(this,'<?=isset($controllerURL)? $controllerURL:urlPanel?>');" method="post" enctype="multipart/form-data">
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="countries_1556139283"/> 
<input type="hidden" name="action" value="add"/>
<!--inputs below --> 
<!--
	

--><div class="form_field countries_1556139283_title" data-legion-field-type="text">
<label for="for_field_title"><?=l('Title<>الاسم');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_title"  required type="text"  data-legion-module="countries_1556139283" name="title" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field countries_1556139283_active" data-legion-field-type="checkbox">
<label for="for_field_active"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input   class="css-checkbox" type="checkbox" name="active"  id="<?=$rand='a'.rand(); ?>" />
			<label for="<?=$rand?>"><?=l('Active<>فعّال');?></label></div></div></div>
</div>
</div><!--


	

--><div class="form_field countries_1556139283_flag" data-legion-field-type="file">
<label for="for_field_flag"><?=l('Flag<>العلم');?></label>
<div class="input_area">
<div class="po pvp_chooser" data-filetype="photo" data-multi="false" onclick="pvp_core('countries_1556139283_flag',false,false)"><img src="<?=u?>photo.png"></div>
	<div class="in clearFiles po h" onclick="pvp_clear('countries_1556139283_flag')"><i class="md-light">delete</i></div>
	<input type="hidden" name="flag"/>
	<div class="count fileName in"><?=l('Selected<>الملفات المُختارة')?> <span>0</span></div>
	
</div>
</div><!--


	

--><div class="form_field countries_1556139283_alpha_2_code" data-legion-field-type="text">
<label for="for_field_alpha_2_code"><?=l('alpha_2_code<>كود الفا الثنائي');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_alpha_2_code"  required type="text" data-legion-unique="true" data-legion-module="countries_1556139283" name="alpha_2_code" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field countries_1556139283_alpha_3_code" data-legion-field-type="text">
<label for="for_field_alpha_3_code"><?=l('alpha_3_code<>كود الفا الثلاثي');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_alpha_3_code"  required type="text" data-legion-unique="true" data-legion-module="countries_1556139283" name="alpha_3_code" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field countries_1556139283_nationality" data-legion-field-type="text">
<label for="for_field_nationality"><?=l('Nationality<>الجنسية');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_nationality"  required type="text"  data-legion-module="countries_1556139283" name="nationality" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field countries_1556139283_phone_code" data-legion-field-type="number">
<label for="for_field_phone_code"><?=l('Phone Code<>المُقدمة الدولية');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_phone_code"  required type="number"  data-legion-module="countries_1556139283" name="phone_code" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field countries_1556139283_currency_name" data-legion-field-type="text">
<label for="for_field_currency_name"><?=l('Currency Name<>اسم العملة');?></label>
<div class="input_area">
<input id="for_field_currency_name"  type="text"  data-legion-module="countries_1556139283" name="currency_name" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field countries_1556139283_currency_shortname" data-legion-field-type="text">
<label for="for_field_currency_shortname"><?=l('Currency Shortname<>اسم العملة المختصر');?></label>
<div class="input_area">
<input id="for_field_currency_shortname"  type="text"  data-legion-module="countries_1556139283" name="currency_shortname" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field countries_1556139283_currency_symbol" data-legion-field-type="text">
<label for="for_field_currency_symbol"><?=l('Currency Symbol<>رمز العملة');?></label>
<div class="input_area">
<input id="for_field_currency_symbol"  type="text"  data-legion-module="countries_1556139283" name="currency_symbol" placeholder="" value=""/>
</div>
</div><!--

-->
<!--inputs above -->
</form>
<?php } ?>