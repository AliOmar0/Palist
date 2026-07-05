<?php 
$id=check_get_id();
	$_form_resp=db('menu_items_1564508835','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('menu_items_1564508835','edit') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="menu_items_1564508835"/> 
<input type="hidden" name="action" value="edit"/> 
<input type="hidden" name="id" value="<?=$id;?>"/> 

<!--inputs below -->
<!--
	

--><div class="form_field  menu_items_1564508835_module_prefix" data-legion-field-type="text">
<label for="for_field_module_prefix"><?=l('Module Prefix<>البرمجية');?></label>
<div class="input_area">
<input id="for_field_module_prefix"  type="text" name="module_prefix" data-l_module="menu_items_1564508835" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['module_prefix']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  menu_items_1564508835_item_id" data-legion-field-type="number">
<label for="for_field_item_id"><?=l('Item ID<>رقم المعرف');?></label>
<div class="input_area">
<input id="for_field_item_id"  type="number" name="item_id" data-l_module="menu_items_1564508835" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['item_id']) ?>"/>
</div>
</div><!--


	

--><div class="form_field ontwo in  menu_items_1564508835_custom_title" data-legion-field-type="text">
<label for="for_field_custom_title"><?=l('Custom Title<>عنوان خاص');?></label>
<div class="input_area">
<input id="for_field_custom_title"  type="text" name="custom_title" data-l_is_ml="true" data-l_module="menu_items_1564508835" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['custom_title']) ?>"/>
</div>
</div><!--


	

--><div class="form_field ontwo in  menu_items_1564508835_custom_link" data-legion-field-type="url">
<label for="for_field_custom_link"><?=l('Custom Link<>رابط خاص');?></label>
<div class="input_area">
<input id="for_field_custom_link"  type="url" name="custom_link" data-l_is_ml="true" data-l_module="menu_items_1564508835" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['custom_link']) ?>"/>
</div>
</div><!--


	

--><div class="form_field ontwo in  menu_items_1564508835_open_new_window" data-legion-field-type="checkbox">
<label for="for_field_open_new_window"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input <?=($_form_resp[0]['open_new_window']==1 ? ' checked ':'');?>
 class=" css-checkbox" name="open_new_window" type="checkbox" id="<?=$rand='a'.rand(); ?>"/>
			<label for="<?=$rand ?>"><?=l('Open New Window<>نافذة جديدة');?></label></div></div></div>
</div>
</div><!--


	

--><div class="form_field ontwo in  menu_items_1564508835_points_to_home" data-legion-field-type="checkbox">
<label for="for_field_points_to_home"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input <?=($_form_resp[0]['points_to_home']==1 ? ' checked ':'');?>
 class=" css-checkbox" name="points_to_home" type="checkbox" id="<?=$rand='a'.rand(); ?>"/>
			<label for="<?=$rand ?>"><?=l('Points to Home<>الى الصفحة الرئيسية');?></label></div></div></div>
</div>
</div><!--

--><div class="big_group_wrap menu_items_1564508835_automatic"><div class="big_group"><?=l('Automatic<>')?></div></div><!--
	

--><div class="form_field onfour in  menu_items_1564508835_module_field" data-legion-field-type="text">
<label for="for_field_module_field"><?=l('Module Field<>خانة البرمجية');?></label>
<div class="input_area">
<input id="for_field_module_field"  type="text" name="module_field" data-l_module="menu_items_1564508835" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['module_field']) ?>"/>
</div>
</div><!--


	

--><div class="form_field onfour in  menu_items_1564508835_order_num" data-legion-field-type="number">
<label for="for_field_order_num"><?=l('Order Num<>الترتيب');?></label>
<div class="input_area">
<input id="for_field_order_num"  type="number" name="order_num" data-l_module="menu_items_1564508835" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['order_num']) ?>"/>
</div>
</div><!--


	

--><div class="form_field onfour in  menu_items_1564508835_sub_of" data-legion-field-type="number">
<label for="for_field_sub_of"><?=l('Sub Of<>فرع من');?></label>
<div class="input_area">
<input id="for_field_sub_of"  type="number" name="sub_of" data-l_module="menu_items_1564508835" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['sub_of']) ?>"/>
</div>
</div><!--


	

--><div class="form_field onfour in  menu_items_1564508835_menu_key" data-legion-field-type="select">
<label for="for_field_menu_key"><?=l('Menu Key<>معرف القائمة');?></label>
<div class="input_area">

<select  id="for_field_menu_key" class="l_mc l_white_c" name="menu_key">
<?php 
$addition_where=NULL;
	
$_form_sub_resp=db('menu_1564508145',"WHERE deleted=0    $addition_where",NULL);
			if($_form_sub_resp==0){?><option value="0" selected><?=l('Error<>خطأ')?></option><?php } 
			else if($_form_sub_resp==1){?><option value="0" selected><?=l('Choose<>اختر');?></option><?php } 
				 else { ?>
                 <option value="0" <?=(0==$_form_resp[0]['menu_key']?'selected':'')?>><?=l('Choose<>اختر');?></option>
				<?php
					if($_form_sub_resp!=1){
						for($__j=0;$__j<count($_form_sub_resp);$__j++){?>
						<option <?=($_form_sub_resp[$__j]['id']==$_form_resp[0]['menu_key'] ? 'selected' : ''); ?> class="l_mc l_white_c" value="<?=$_form_sub_resp[$__j]['id']?>">
						<?= select_echo('menu_items_1564508835','menu_key',$_form_sub_resp[$__j],true);?></option>
						
				<?php 
						}//for
					}
				}//else 
				unset($_form_sub_resp);
				?>
			</select>
</div>
</div><!--

-->
<!--inputs above -->
<?php } ?>