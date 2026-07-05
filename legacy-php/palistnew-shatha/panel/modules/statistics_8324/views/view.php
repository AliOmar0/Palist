<?php 
$id=check_get_id();
$_form_resp=db('statistics_8324','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('statistics_8324','view') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<div id="statistics_8324_view_<?=$id;?>" class="viewActionDiv" data-id="<?=$id;?>" data-module="statistics_8324"><!--

		--><div class="view_box view_group statistics_8324_view_Base  ">
<div class="view_label view_label_Base"><?=l('<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['Base'])?></div>
</div><clear></clear><!--

		--><div class="view_box  statistics_8324_view_title  onfour in free_width ">
<div class="view_label view_label_title"><?=l('Title<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['title'])?></div>
</div><!--

		--><div class="view_box  statistics_8324_view_type  onfour in free_width ">
<div class="view_label view_label_type"><?=l('Type<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['type'])?></div>
</div><!--

		--><div class="view_box  statistics_8324_view_subline  ontwo in free_width ">
<div class="view_label view_label_subline"><?=l('Subline<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['subline'])?></div>
</div><!--

		--><div class="view_box  statistics_8324_view_live  onfour in free_width ">
<div class="view_label view_label_live"><?=l('Live<>')?></div>
<div class="viewValue  checkboxView "><i><?=$_form_resp[0]['live']?'done':'close'?></i></div>
</div><clear></clear><!--

		--><div class="view_box view_group statistics_8324_view_Prime Condition  ">
<div class="view_label view_label_Prime Condition"><?=l('<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['Prime Condition'])?></div>
</div><clear></clear><!--

		--><div class="view_box  statistics_8324_view_module_prefix  onfour in free_width ">
<div class="view_label view_label_module_prefix"><?=l('Module Prefix<>')?></div>
<div class="viewValue  "><?php 
$addition_where=NULL;
$sub_resp=db('modules',"WHERE deleted=0  AND id='".$_form_resp[0]['module_prefix']."'  $addition_where",NULL,'LIMIT 1');
					echo select_echo('statistics_8324','module_prefix',$sub_resp[0],true);
                        ?></div>
</div><!--

		--><div class="view_box  statistics_8324_view_module_field  onfour in free_width ">
<div class="view_label view_label_module_field"><?=l('Module Field<>')?></div>
<div class="viewValue  "><?php 
$addition_where=NULL;
$sub_resp=db('module_fields',"WHERE deleted=0  AND id='".$_form_resp[0]['module_field']."'  $addition_where",NULL,'LIMIT 1');
					echo select_echo('statistics_8324','module_field',$sub_resp[0],true);
                        ?></div>
</div><!--

		--><div class="view_box  statistics_8324_view_compare_sign  onfour in free_width ">
<div class="view_label view_label_compare_sign"><?=l('Compare Sign<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['compare_sign'])?></div>
</div><!--

		--><div class="view_box  statistics_8324_view_compared_value  onfour in free_width ">
<div class="view_label view_label_compared_value"><?=l('Compared Value<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['compared_value'])?></div>
</div><!--

		--><div class="view_box  statistics_8324_view_size  onfour in ">
<div class="view_label view_label_size"><?=l('Size<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['size'])?></div>
</div><!--

		--><div class="view_box  statistics_8324_view_free_where  ">
<div class="view_label view_label_free_where"><?=l('Free Where<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['free_where'])?></div>
</div><!--

		--><div class="view_box  statistics_8324_view_order_number  onfour in ">
<div class="view_label view_label_order_number"><?=l('Order Number<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['order_number'])?></div>
</div><!--

		--><div class="view_box view_group statistics_8324_view_Count Settings  ">
<div class="view_label view_label_Count Settings"><?=l('<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['Count Settings'])?></div>
</div><clear></clear><!--

		--><div class="view_box  statistics_8324_view_icon  free_width in ">
<div class="view_label view_label_icon"><?=l('Icon<>')?></div>
<div class="viewValue  "><i><?=$_form_resp[0]['icon']?></i></div>
</div><clear></clear><!--

		--><div class="view_box view_group statistics_8324_view_Chart Settings  ">
<div class="view_label view_label_Chart Settings"><?=l('<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['Chart Settings'])?></div>
</div><clear></clear><!--

		--><div class="view_box  statistics_8324_view_dataset_1_label  onfour in free_width ">
<div class="view_label view_label_dataset_1_label"><?=l('Dataset 1 Label<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['dataset_1_label'])?></div>
</div><!--

		--><div class="view_box  statistics_8324_view_dataset_1_color  onfour in free_width ">
<div class="view_label view_label_dataset_1_color"><?=l('Dataset 1 Color<>')?></div>
<div class="viewValue  colorView style="background:<?=$_form_resp[0]['dataset_1_color']?>""></div>
</div><!--

		--><div class="view_box  statistics_8324_view_dataset_1_opacity  onfour in free_width ">
<div class="view_label view_label_dataset_1_opacity"><?=l('Dataset 1 Opacity<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['dataset_1_opacity'])?></div>
</div><!--

		--><div class="view_box  statistics_8324_view_dataset_1_free_where  onfour in free_width ">
<div class="view_label view_label_dataset_1_free_where"><?=l('Dataset 1 Free Where<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['dataset_1_free_where'])?></div>
</div><!--

		--><div class="view_box  statistics_8324_view_dataset_1_state  onfour in free_width ">
<div class="view_label view_label_dataset_1_state"><?=l('Dataset 1 State<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['dataset_1_state'])?></div>
</div><clear></clear><!--

		--><div class="view_box  statistics_8324_view_dataset_2_label  onfour in free_width ">
<div class="view_label view_label_dataset_2_label"><?=l('Dataset 2 Label<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['dataset_2_label'])?></div>
</div><!--

		--><div class="view_box  statistics_8324_view_dataset_2_color  onfour in free_width ">
<div class="view_label view_label_dataset_2_color"><?=l('Dataset 2 Color<>')?></div>
<div class="viewValue  colorView style="background:<?=$_form_resp[0]['dataset_2_color']?>""></div>
</div><!--

		--><div class="view_box  statistics_8324_view_dataset_2_opacity  onfour in free_width ">
<div class="view_label view_label_dataset_2_opacity"><?=l('Dataset 2 Opacity<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['dataset_2_opacity'])?></div>
</div><!--

		--><div class="view_box  statistics_8324_view_dataset_2_free_where  onfour in free_width ">
<div class="view_label view_label_dataset_2_free_where"><?=l('Dataset 2 Free Where<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['dataset_2_free_where'])?></div>
</div><!--

		--><div class="view_box  statistics_8324_view_dataset_2_state  onfour in free_width ">
<div class="view_label view_label_dataset_2_state"><?=l('Dataset 2 State<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['dataset_2_state'])?></div>
</div><clear></clear><!--

		--><div class="view_box  statistics_8324_view_dataset_3_label  onfour in free_width ">
<div class="view_label view_label_dataset_3_label"><?=l('Dataset 3 Label<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['dataset_3_label'])?></div>
</div><!--

		--><div class="view_box  statistics_8324_view_dataset_3_color  onfour in free_width ">
<div class="view_label view_label_dataset_3_color"><?=l('Dataset 3 Color<>')?></div>
<div class="viewValue  colorView style="background:<?=$_form_resp[0]['dataset_3_color']?>""></div>
</div><!--

		--><div class="view_box  statistics_8324_view_dataset_3_opacity  onfour in free_width ">
<div class="view_label view_label_dataset_3_opacity"><?=l('Dataset 3 Opacity<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['dataset_3_opacity'])?></div>
</div><!--

		--><div class="view_box  statistics_8324_view_dataset_3_free_where  onfour in free_width ">
<div class="view_label view_label_dataset_3_free_where"><?=l('Dataset 3 Free Where<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['dataset_3_free_where'])?></div>
</div><!--

		--><div class="view_box  statistics_8324_view_dataset_3_state  onfour in free_width ">
<div class="view_label view_label_dataset_3_state"><?=l('Dataset 3 State<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['dataset_3_state'])?></div>
</div><clear></clear><!--

		--><div class="view_box  statistics_8324_view_dataset_4_label  onfour in free_width ">
<div class="view_label view_label_dataset_4_label"><?=l('Dataset 4 Label<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['dataset_4_label'])?></div>
</div><!--

		--><div class="view_box  statistics_8324_view_dataset_4_color  onfour in free_width ">
<div class="view_label view_label_dataset_4_color"><?=l('Dataset 4 Color<>')?></div>
<div class="viewValue  colorView style="background:<?=$_form_resp[0]['dataset_4_color']?>""></div>
</div><!--

		--><div class="view_box  statistics_8324_view_dataset_4_opacity  onfour in free_width ">
<div class="view_label view_label_dataset_4_opacity"><?=l('Dataset 4 Opacity<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['dataset_4_opacity'])?></div>
</div><!--

		--><div class="view_box  statistics_8324_view_dataset_4_free_where  onfour in free_width ">
<div class="view_label view_label_dataset_4_free_where"><?=l('Dataset 4 Free Where<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['dataset_4_free_where'])?></div>
</div><!--

		--><div class="view_box  statistics_8324_view_dataset_4_state  onfour in free_width ">
<div class="view_label view_label_dataset_4_state"><?=l('Dataset 4 State<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['dataset_4_state'])?></div>
</div><clear></clear><!--

		--><div class="view_box  statistics_8324_view_dataset_5_label  onfour in free_width ">
<div class="view_label view_label_dataset_5_label"><?=l('Dataset 5 Label<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['dataset_5_label'])?></div>
</div><!--

		--><div class="view_box  statistics_8324_view_dataset_5_color  onfour in free_width ">
<div class="view_label view_label_dataset_5_color"><?=l('Dataset 5 Color<>')?></div>
<div class="viewValue  colorView style="background:<?=$_form_resp[0]['dataset_5_color']?>""></div>
</div><!--

		--><div class="view_box  statistics_8324_view_dataset_5_opacity  onfour in free_width ">
<div class="view_label view_label_dataset_5_opacity"><?=l('Dataset 5 Opacity<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['dataset_5_opacity'])?></div>
</div><!--

		--><div class="view_box  statistics_8324_view_dataset_5_free_where  onfour in free_width ">
<div class="view_label view_label_dataset_5_free_where"><?=l('Dataset 5 Free Where<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['dataset_5_free_where'])?></div>
</div><!--

		--><div class="view_box  statistics_8324_view_dataset_5_state  onfour in free_width ">
<div class="view_label view_label_dataset_5_state"><?=l('Dataset 5 State<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['dataset_5_state'])?></div>
</div><clear></clear><!--

		--><div class="view_box  statistics_8324_view_chart_type  ontwo in free_width ">
<div class="view_label view_label_chart_type"><?=l('Chart Type<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['chart_type'])?></div>
</div><!--

		--><div class="view_box  statistics_8324_view_axis  onfour in free_width ">
<div class="view_label view_label_axis"><?=l('Axis<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['axis'])?></div>
</div><!--

		--><div class="view_box  statistics_8324_view_colors  onfour in free_width ">
<div class="view_label view_label_colors"><?=l('Colors<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['colors'])?></div>
</div><!--

		--><div class="view_box  statistics_8324_view_hide_zeros  onfour in free_width ">
<div class="view_label view_label_hide_zeros"><?=l('Hide Zeros<>')?></div>
<div class="viewValue  checkboxView "><i><?=$_form_resp[0]['hide_zeros']?'done':'close'?></i></div>
</div><!--

		--><div class="view_box  statistics_8324_view_fill  free_width in ">
<div class="view_label view_label_fill"><?=l('Fill<>')?></div>
<div class="viewValue  checkboxView "><i><?=$_form_resp[0]['fill']?'done':'close'?></i></div>
</div><!--

		--><div class="view_box  statistics_8324_view_vs_time  free_width in ">
<div class="view_label view_label_vs_time"><?=l('Vs Time<>')?></div>
<div class="viewValue  checkboxView "><i><?=$_form_resp[0]['vs_time']?'done':'close'?></i></div>
</div><!--

		--><div class="view_box  statistics_8324_view_days  free_width in ">
<div class="view_label view_label_days"><?=l('Days<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['days'])?></div>
</div><!--

		--><div class="view_box  statistics_8324_view_stacked  free_width in ">
<div class="view_label view_label_stacked"><?=l('Stacked<>')?></div>
<div class="viewValue  checkboxView "><i><?=$_form_resp[0]['stacked']?'done':'close'?></i></div>
</div><!--

		--><div class="view_box view_group statistics_8324_view_Base   ">
<div class="view_label view_label_Base "><?=l('<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['Base '])?></div>
</div><clear></clear><!--

		--><div class="view_box view_group statistics_8324_view_Button Preferences  ">
<div class="view_label view_label_Button Preferences"><?=l('<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['Button Preferences'])?></div>
</div><clear></clear><!--

		--><div class="view_box  statistics_8324_view_button_title  ">
<div class="view_label view_label_button_title"><?=l('Button Title<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['button_title'])?></div>
</div><!--

		--><div class="view_box  statistics_8324_view_button_link  ">
<div class="view_label view_label_button_link"><?=l('Button Link<>')?></div>
<div class="viewValue  "><a href="<?=$_form_resp[0]['button_link'] ?>" target="_blank"><i>link</i></a></div>
</div><!--

		--><div class="view_box view_group statistics_8324_view_btn  ">
<div class="view_label view_label_btn"><?=l('<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['btn'])?></div>
</div><clear></clear><!--

--></div>
<?php } ?>