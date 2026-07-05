<?php 
$id=check_get_id();
	$_form_resp=db('countries_1556139283','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('countries_1556139283','edit') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="countries_1556139283"/> 
<input type="hidden" name="action" value="edit"/> 
<input type="hidden" name="id" value="<?=$id;?>"/> 

<!--inputs below -->
<!--
	

--><div class="form_field  countries_1556139283_title" data-legion-field-type="text">
<label for="for_field_title"><?=l('Title<>الاسم');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_title"  required type="text" name="title"   data-legion-module="countries_1556139283" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['title']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  countries_1556139283_active" data-legion-field-type="checkbox">
<label for="for_field_active"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input <?=($_form_resp[0]['active']==1 ? ' checked ':'');?>
 class=" css-checkbox" name="active" type="checkbox" id="<?=$rand='a'.rand(); ?>"/>
			<label for="<?=$rand ?>"><?=l('Active<>فعّال');?></label></div></div></div>
</div>
</div><!--


	

--><div class="form_field  countries_1556139283_flag" data-legion-field-type="file">
<label for="for_field_flag"><?=l('Flag<>العلم');?></label>
<div class="input_area">
<div class="po pvp_chooser" data-filetype="photo" data-multi="false" onclick="pvp_core('countries_1556139283_flag',false,false)"><img src="<?=u.($_form_resp[0]['flag']=='' ? 'photo.png' : img($_form_resp[0]['flag'],200,100));  ?>" /></div>
	<div class="in clearFiles po <?=$_form_resp[0]['flag']=='' ? 'h':'' ?>" onclick="pvp_clear('countries_1556139283_flag')"><i class="md-light">delete</i></div>
	
	<input type="hidden" name="flag" value="<?=$_form_resp[0]['flag']?>"/>
	
	<div class="count fileName"><?=l('Selected<>الملفات المُختارة')?> <span><?=$_form_resp[0]['flag']=='' ? 0:count(explode(',',$_form_resp[0]['flag'])) ?></span>
	</div><clear></clear>
	<div class="fileName po"><a target="_blank" href="<?=u.detail('files_1577206823','full_name','full_name',$_form_resp[0]['flag'])?>"><?=detail('files_1577206823','original_name','full_name',$_form_resp[0]['flag'])?></a></div>
	
	
	
</div>
</div><!--


	

--><div class="form_field  countries_1556139283_alpha_2_code" data-legion-field-type="text">
<label for="for_field_alpha_2_code"><?=l('alpha_2_code<>كود الفا الثنائي');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_alpha_2_code"  required type="text" name="alpha_2_code" data-legion-unique="true"  data-legion-module="countries_1556139283" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['alpha_2_code']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  countries_1556139283_alpha_3_code" data-legion-field-type="text">
<label for="for_field_alpha_3_code"><?=l('alpha_3_code<>كود الفا الثلاثي');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_alpha_3_code"  required type="text" name="alpha_3_code" data-legion-unique="true"  data-legion-module="countries_1556139283" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['alpha_3_code']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  countries_1556139283_nationality" data-legion-field-type="text">
<label for="for_field_nationality"><?=l('Nationality<>الجنسية');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_nationality"  required type="text" name="nationality"   data-legion-module="countries_1556139283" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['nationality']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  countries_1556139283_phone_code" data-legion-field-type="number">
<label for="for_field_phone_code"><?=l('Phone Code<>المُقدمة الدولية');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_phone_code"  required type="number" name="phone_code"   data-legion-module="countries_1556139283" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['phone_code']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  countries_1556139283_currency_name" data-legion-field-type="text">
<label for="for_field_currency_name"><?=l('Currency Name<>اسم العملة');?></label>
<div class="input_area">
<input id="for_field_currency_name"  type="text" name="currency_name"   data-legion-module="countries_1556139283" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['currency_name']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  countries_1556139283_currency_shortname" data-legion-field-type="text">
<label for="for_field_currency_shortname"><?=l('Currency Shortname<>اسم العملة المختصر');?></label>
<div class="input_area">
<input id="for_field_currency_shortname"  type="text" name="currency_shortname"   data-legion-module="countries_1556139283" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['currency_shortname']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  countries_1556139283_currency_symbol" data-legion-field-type="text">
<label for="for_field_currency_symbol"><?=l('Currency Symbol<>رمز العملة');?></label>
<div class="input_area">
<input id="for_field_currency_symbol"  type="text" name="currency_symbol"   data-legion-module="countries_1556139283" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['currency_symbol']) ?>"/>
</div>
</div><!--

-->
<!--inputs above -->
<?php } ?>