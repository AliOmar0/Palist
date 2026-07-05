<?php if(!privilege('menu_items_1564508835','add'))echo $noPermission;else{?>
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="menu_items_1564508835"/> 
<input type="hidden" name="action" value="add"/>
<!--inputs below --> 
<!--
	

--><div class="form_field menu_items_1564508835_module_prefix" data-legion-field-type="text">
<label for="for_field_module_prefix"><?=l('Module Prefix<>البرمجية');?></label>
<div class="input_area">
<input id="for_field_module_prefix"  type="text"  data-l_module="menu_items_1564508835" name="module_prefix" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field menu_items_1564508835_item_id" data-legion-field-type="number">
<label for="for_field_item_id"><?=l('Item ID<>رقم المعرف');?></label>
<div class="input_area">
<input id="for_field_item_id"  type="number"  data-l_module="menu_items_1564508835" name="item_id" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field ontwo in menu_items_1564508835_custom_title" data-legion-field-type="text">
<label for="for_field_custom_title"><?=l('Custom Title<>عنوان خاص');?></label>
<div class="input_area">
<input id="for_field_custom_title"  type="text"  data-l_is_ml="true" data-l_module="menu_items_1564508835" name="custom_title" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field ontwo in menu_items_1564508835_custom_link" data-legion-field-type="url">
<label for="for_field_custom_link"><?=l('Custom Link<>رابط خاص');?></label>
<div class="input_area">
<input id="for_field_custom_link"  type="url"  data-l_is_ml="true" data-l_module="menu_items_1564508835" name="custom_link" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field ontwo in menu_items_1564508835_open_new_window" data-legion-field-type="checkbox">
<label for="for_field_open_new_window"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input   class="css-checkbox" type="checkbox" name="open_new_window"  id="<?=$rand='a'.rand(); ?>" />
			<label for="<?=$rand?>"><?=l('Open New Window<>نافذة جديدة');?></label></div></div></div>
</div>
</div><!--


	

--><div class="form_field ontwo in menu_items_1564508835_points_to_home" data-legion-field-type="checkbox">
<label for="for_field_points_to_home"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input   class="css-checkbox" type="checkbox" name="points_to_home"  id="<?=$rand='a'.rand(); ?>" />
			<label for="<?=$rand?>"><?=l('Points to Home<>الى الصفحة الرئيسية');?></label></div></div></div>
</div>
</div><!--

--><div class="big_group_wrap menu_items_1564508835_automatic"><div class="big_group"><?=l('Automatic<>')?></div></div><!--
	

--><div class="form_field onfour in menu_items_1564508835_module_field" data-legion-field-type="text">
<label for="for_field_module_field"><?=l('Module Field<>خانة البرمجية');?></label>
<div class="input_area">
<input id="for_field_module_field"  type="text"  data-l_module="menu_items_1564508835" name="module_field" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field onfour in menu_items_1564508835_order_num" data-legion-field-type="number">
<label for="for_field_order_num"><?=l('Order Num<>الترتيب');?></label>
<div class="input_area">
<input id="for_field_order_num"  type="number"  data-l_module="menu_items_1564508835" name="order_num" placeholder="" value="100"/>
</div>
</div><!--


	

--><div class="form_field onfour in menu_items_1564508835_sub_of" data-legion-field-type="number">
<label for="for_field_sub_of"><?=l('Sub Of<>فرع من');?></label>
<div class="input_area">
<input id="for_field_sub_of"  type="number"  data-l_module="menu_items_1564508835" name="sub_of" placeholder="" value="0"/>
</div>
</div><!--


	

--><div class="form_field onfour in menu_items_1564508835_menu_key" data-legion-field-type="select">
<label for="for_field_menu_key"><?=l('Menu Key<>معرف القائمة');?></label>
<div class="input_area">
<select  id="for_field_menu_key" class="l_mc l_white_c" name="menu_key">
<?php 
$addition_where=NULL;

$_form_resp=db('menu_1564508145',"WHERE deleted=0   $addition_where",NULL,NULL);
			if($_form_resp==0){?><option value="0" selected><?=l('Error<>خطأ')?></option> <?php } 
			else if($_form_resp==1){?><option value="0" selected><?=l('Choose<>اختر');?></option><?php } 
				else {?>
                    <option value="0"><?=l('Choose<>اختر');?></option>
					<?php 
					if($_form_resp!=1){
						for($_i=0;$_i<count($_form_resp);$_i++){?>
						<option value="<?=$_form_resp[$_i]['id']?>">
						<?= select_echo('menu_items_1564508835','menu_key',$_form_resp[$_i],true);?>
						</option>
						
						<?php 
							}//for
						}
					}//else
					unset($_form_resp);
					?>
			</select>
</div>
</div><!--

-->
<!--inputs above -->
<?php } ?>