<?php 
$id=check_get_id();
$_form_resp=db('menu_items_1564508835','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('menu_items_1564508835','view') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<div id="menu_items_1564508835_view_<?=$id;?>" class="viewActionDiv" data-id="<?=$id;?>" data-module="menu_items_1564508835"><!--

		--><div class="view_box  menu_items_1564508835_view_module_prefix  ">
<div class="view_label view_label_module_prefix"><?=l('Module Prefix<>البرمجية')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['module_prefix'])?></div>
</div><!--

		--><div class="view_box  menu_items_1564508835_view_item_id  ">
<div class="view_label view_label_item_id"><?=l('Item ID<>رقم المعرف')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['item_id'])?></div>
</div><!--

		--><div class="view_box  menu_items_1564508835_view_custom_title  ontwo in ">
<div class="view_label view_label_custom_title"><?=l('Custom Title<>عنوان خاص')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['custom_title'])?></div>
</div><!--

		--><div class="view_box  menu_items_1564508835_view_custom_link  ontwo in ">
<div class="view_label view_label_custom_link"><?=l('Custom Link<>رابط خاص')?></div>
<div class="viewValue  "><a href="<?=$_form_resp[0]['custom_link'] ?>" target="_blank"><i>link</i></a></div>
</div><!--

		--><div class="view_box  menu_items_1564508835_view_open_new_window  ontwo in ">
<div class="view_label view_label_open_new_window"><?=l('Open New Window<>نافذة جديدة')?></div>
<div class="viewValue  checkboxView "><i><?=$_form_resp[0]['open_new_window']?'done':'close'?></i></div>
</div><!--

		--><div class="view_box  menu_items_1564508835_view_points_to_home  ontwo in ">
<div class="view_label view_label_points_to_home"><?=l('Points to Home<>الى الصفحة الرئيسية')?></div>
<div class="viewValue  checkboxView "><i><?=$_form_resp[0]['points_to_home']?'done':'close'?></i></div>
</div><!--

		--><div class="view_box view_group menu_items_1564508835_view_Automatic  ">
<div class="view_label view_label_Automatic"><?=l('<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['Automatic'])?></div>
</div><clear></clear><!--

		--><div class="view_box  menu_items_1564508835_view_module_field  onfour in ">
<div class="view_label view_label_module_field"><?=l('Module Field<>خانة البرمجية')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['module_field'])?></div>
</div><!--

		--><div class="view_box  menu_items_1564508835_view_order_num  onfour in ">
<div class="view_label view_label_order_num"><?=l('Order Num<>الترتيب')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['order_num'])?></div>
</div><!--

		--><div class="view_box  menu_items_1564508835_view_sub_of  onfour in ">
<div class="view_label view_label_sub_of"><?=l('Sub Of<>فرع من')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['sub_of'])?></div>
</div><!--

		--><div class="view_box  menu_items_1564508835_view_menu_key  onfour in ">
<div class="view_label view_label_menu_key"><?=l('Menu Key<>معرف القائمة')?></div>
<div class="viewValue  "><?php 
$addition_where=NULL;
$sub_resp=db('menu_1564508145',"WHERE deleted=0  AND id='".$_form_resp[0]['menu_key']."'  $addition_where",NULL,'LIMIT 1');
					echo select_echo('menu_items_1564508835','menu_key',$sub_resp[0],true);
                        ?></div>
</div><!--

--></div>
<?php } ?>