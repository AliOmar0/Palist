<?php 
$id=check_get_id();
$_form_resp=db('countries_1556139283','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('countries_1556139283','view') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<div id="countries_1556139283_view_<?=$id;?>" class="viewActionDiv" data-id="<?=$id;?>" data-module="countries_1556139283"><!--

		--><div class="view_box  countries_1556139283_view_title  ">
<div class="view_label view_label_title"><?=l('Title<>الاسم')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['title'])?></div>
</div><!--

		--><div class="view_box  countries_1556139283_view_active  ">
<div class="view_label view_label_active"><?=l('Active<>فعّال')?></div>
<div class="viewValue  checkboxView "><i><?=$_form_resp[0]['active']?'done':'close'?></i></div>
</div><!--

		--><div class="view_box  countries_1556139283_view_flag  ">
<div class="view_label view_label_flag"><?=l('Flag<>العلم')?></div>
<div class="viewValue  "><?php if($_form_resp[0]['flag']!='')pic($_form_resp[0]['flag'],200,100)?></div>
</div><!--

		--><div class="view_box  countries_1556139283_view_alpha_2_code  ">
<div class="view_label view_label_alpha_2_code"><?=l('alpha_2_code<>كود الفا الثنائي')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['alpha_2_code'])?></div>
</div><!--

		--><div class="view_box  countries_1556139283_view_alpha_3_code  ">
<div class="view_label view_label_alpha_3_code"><?=l('alpha_3_code<>كود الفا الثلاثي')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['alpha_3_code'])?></div>
</div><!--

		--><div class="view_box  countries_1556139283_view_nationality  ">
<div class="view_label view_label_nationality"><?=l('Nationality<>الجنسية')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['nationality'])?></div>
</div><!--

		--><div class="view_box  countries_1556139283_view_phone_code  ">
<div class="view_label view_label_phone_code"><?=l('Phone Code<>المُقدمة الدولية')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['phone_code'])?></div>
</div><!--

		--><div class="view_box  countries_1556139283_view_currency_name  ">
<div class="view_label view_label_currency_name"><?=l('Currency Name<>اسم العملة')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['currency_name'])?></div>
</div><!--

		--><div class="view_box  countries_1556139283_view_currency_shortname  ">
<div class="view_label view_label_currency_shortname"><?=l('Currency Shortname<>اسم العملة المختصر')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['currency_shortname'])?></div>
</div><!--

		--><div class="view_box  countries_1556139283_view_currency_symbol  ">
<div class="view_label view_label_currency_symbol"><?=l('Currency Symbol<>رمز العملة')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['currency_symbol'])?></div>
</div><!--

--></div>
<?php } ?>