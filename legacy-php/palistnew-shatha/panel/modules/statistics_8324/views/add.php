<?php if(!privilege('statistics_8324','add'))echo $noPermission;else{?>
<form id="statistics_8324" autocomplete="off" action="" onsubmit="return submitter(this,'<?=isset($controllerURL)? $controllerURL:urlPanel?>');" method="post" enctype="multipart/form-data">
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="statistics_8324"/> 
<input type="hidden" name="action" value="add"/>
<!--inputs below --> 
<div class="l_tabs l_mb20 l_white_c"><!--
--><div id="l_tab_0_btn" class="l_tab_toggler l_in l_po l_pad10 l_radtr5 l_radtl5 l_center l_dark l_active_tab" onClick="massToggle(this.id,'l_tab_toggler','l_active_tab','l_tab_0','l_tab');">

	<div class="l_in"><?=l('Base<>')?></div>
</div><!--

--><div id="l_tab_50_btn" class="l_tab_toggler l_in l_po l_pad10 l_radtr5 l_radtl5 l_center l_dark" onClick="massToggle(this.id,'l_tab_toggler','l_active_tab','l_tab_50','l_tab');">

	<div class="l_in"><?=l('Button Preferences<>')?></div>
</div><!--
--></div><!--
				
				
Tab Starts
--><div id="l_tab_0" class="l_tab "><!--
	

--><div class="form_field onfour in free_width statistics_8324_title" data-legion-field-type="text">
<label for="for_field_title"><?=l('Title<>');?></label>
<div class="input_area">
<input id="for_field_title"  type="text"  data-l_is_ml="true" data-l_module="statistics_8324" name="title" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field onfour in free_width statistics_8324_type" data-legion-field-type="radio">
<label for="for_field_type"><?=l('Type<>');?></label>
<div class="input_area">
<input type="radio" name="type" value="Count" id="radio_type_0"/><label for="radio_type_0">Count</label>
			
			<input type="radio" name="type" value="Chart" id="radio_type_1"/><label for="radio_type_1">Chart</label>
			
			
</div>
</div><!--


	

--><div class="form_field ontwo in free_width statistics_8324_subline" data-legion-field-type="text">
<label for="for_field_subline"><?=l('Subline<>');?></label>
<div class="input_area">
<input id="for_field_subline"  type="text"  data-l_is_ml="true" data-l_module="statistics_8324" name="subline" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field onfour in free_width statistics_8324_live" data-legion-field-type="checkbox">
<label for="for_field_live"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input   class="css-checkbox" type="checkbox" name="live"  id="<?=$rand='a'.rand(); ?>" />
			<label for="<?=$rand?>"><?=l('Live<>');?></label></div></div></div>
</div>
</div><clear></clear><!--

--><div class="big_group_wrap statistics_8324_primecondition"><div class="big_group"><?=l('Prime Condition<>')?></div></div><!--
	

--><div class="form_field onfour in free_width statistics_8324_module_prefix" data-legion-field-type="select">
<label for="for_field_module_prefix"><?=l('Module Prefix<>');?></label>
<div class="input_area">
<select  class="l_mc l_white_c" name="module_prefix" onChange="reloadSelect('module_fields','label','module_id',this.value,null,'module_field');">
<?php 
$addition_where=NULL;

$_form_resp=db('modules',"WHERE deleted=0   $addition_where",NULL,NULL);
			if($_form_resp==0){?><option value="0" selected><?=l('Error<>خطأ')?></option> <?php } 
			else if($_form_resp==1){?><option value="0" selected><?=l('Choose<>اختر');?></option><?php } 
				else {?>
                    <option value="0"><?=l('Choose<>اختر');?></option>
					<?php 
					if($_form_resp!=1){
						for($_i=0;$_i<count($_form_resp);$_i++){?>
						<option value="<?=$_form_resp[$_i]['id']?>">
						<?= select_echo('statistics_8324','module_prefix',$_form_resp[$_i],true);?>
						</option>
						
						<?php 
							}//for
						}
					}//else
					
					?>
			</select>
</div>
</div><!--


	

--><div class="form_field onfour in free_width statistics_8324_module_field" data-legion-field-type="select">
<label for="for_field_module_field"><?=l('Module Field<>');?></label>
<div class="input_area">
<select  id="for_field_module_field" class="l_mc l_white_c" name="module_field">
<?php 
$addition_where=NULL;

$_form_resp=db('module_fields',"WHERE deleted=0  AND module_id='".$_form_resp[0]['label']."'  $addition_where",NULL,NULL);
			if($_form_resp==0){?><option value="0" selected><?=l('Error<>خطأ')?></option> <?php } 
			else if($_form_resp==1){?><option value="0" selected><?=l('Choose<>اختر');?></option><?php } 
				else {?>
                    <option value="0"><?=l('Choose<>اختر');?></option>
					<?php 
					if($_form_resp!=1){
						for($_i=0;$_i<count($_form_resp);$_i++){?>
						<option value="<?=$_form_resp[$_i]['id']?>">
						<?= select_echo('statistics_8324','module_field',$_form_resp[$_i],true);?>
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


	

--><div class="form_field onfour in free_width statistics_8324_compare_sign" data-legion-field-type="radio">
<label for="for_field_compare_sign"><?=l('Compare Sign<>');?></label>
<div class="input_area">
<input type="radio" name="compare_sign" value="=" id="radio_compare_sign_0"/><label for="radio_compare_sign_0">=</label>
			
			<input type="radio" name="compare_sign" value=">" id="radio_compare_sign_1"/><label for="radio_compare_sign_1">></label>
			
			<input type="radio" name="compare_sign" value=">=" id="radio_compare_sign_2"/><label for="radio_compare_sign_2">>=</label>
			
			<input type="radio" name="compare_sign" value="<" id="radio_compare_sign_3"/><label for="radio_compare_sign_3"><</label>
			
			<input type="radio" name="compare_sign" value="<=" id="radio_compare_sign_4"/><label for="radio_compare_sign_4"><=</label>
			
			<input type="radio" name="compare_sign" value="!=" id="radio_compare_sign_5"/><label for="radio_compare_sign_5">!=</label>
			
			
</div>
</div><!--


	

--><div class="form_field onfour in free_width statistics_8324_compared_value" data-legion-field-type="text">
<label for="for_field_compared_value"><?=l('Compared Value<>');?></label>
<div class="input_area">
<input id="for_field_compared_value"  type="text"  data-l_module="statistics_8324" name="compared_value" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field onfour in statistics_8324_size" data-legion-field-type="radio">
<label for="for_field_size"><?=l('Size<>');?>
<div class="help">
	<i>help_outline</i>
	<span><?=l('no usage in grid')?></span>
</div>
</label>
<div class="input_area">
<input type="radio" name="size" value="full" id="radio_size_0"/><label for="radio_size_0">full</label>
			
			<input type="radio" name="size" value="ontwo" id="radio_size_1"/><label for="radio_size_1">ontwo</label>
			
			<input type="radio" name="size" value="onthree" id="radio_size_2"/><label for="radio_size_2">onthree</label>
			
			<input type="radio" name="size" value="onfour" id="radio_size_3"/><label for="radio_size_3">onfour</label>
			
			<input type="radio" name="size" value="free" id="radio_size_4"/><label for="radio_size_4">free</label>
			
			
</div>
</div><!--


	

--><div class="form_field statistics_8324_free_where" data-legion-field-type="text">
<label for="for_field_free_where"><?=l('Free Where<>');?></label>
				<div class="tip"><?=l("for variables put forward slash after dollar sign: $\\")?></div>
<div class="input_area">
<input id="for_field_free_where"  type="text"  data-l_module="statistics_8324" name="free_where" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field onfour in h statistics_8324_order_number" data-legion-field-type="number">
<label for="for_field_order_number"><?=l('Order Number<>');?></label>
<div class="input_area">
<input id="for_field_order_number"  type="number"  data-l_module="statistics_8324" name="order_number" placeholder="" value=""/>
</div>
</div><!--

--><div class="big_group_wrap statistics_8324_countsettings"><div class="big_group"><?=l('Count Settings<>')?></div></div><!--
	

--><div class="form_field free_width in statistics_8324_icon" data-legion-field-type="material-icon">
<label for="for_field_icon"><?=l('Icon<>');?></label>
<div class="input_area">
<input class="use-material-icon-picker" id="for_field_icon"  type="text" name="icon" placeholder="" value=""/>
</div>
</div><clear></clear><!--

--><div class="big_group_wrap statistics_8324_chartsettings"><div class="big_group"><?=l('Chart Settings<>')?></div></div><!--
	

--><div class="form_field onfour in free_width statistics_8324_dataset_1_label" data-legion-field-type="text">
<label for="for_field_dataset_1_label"><?=l('Dataset 1 Label<>');?></label>
<div class="input_area">
<input id="for_field_dataset_1_label"  type="text"  data-l_module="statistics_8324" name="dataset_1_label" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field onfour in free_width statistics_8324_dataset_1_color" data-legion-field-type="color">
<label for="for_field_dataset_1_color"><?=l('Dataset 1 Color<>');?></label>
<div class="input_area">
<input id="for_field_dataset_1_color"  type="color"  data-l_module="statistics_8324" name="dataset_1_color" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field onfour in free_width statistics_8324_dataset_1_opacity" data-legion-field-type="number">
<label for="for_field_dataset_1_opacity"><?=l('Dataset 1 Opacity<>');?></label>
<div class="input_area">
<input id="for_field_dataset_1_opacity"  type="number"  data-l_module="statistics_8324" name="dataset_1_opacity" placeholder="" value="100"/>
</div>
</div><!--


	

--><div class="form_field onfour in free_width statistics_8324_dataset_1_free_where" data-legion-field-type="text">
<label for="for_field_dataset_1_free_where"><?=l('Dataset 1 Free Where<>');?></label>
<div class="input_area">
<input id="for_field_dataset_1_free_where"  type="text"  data-l_module="statistics_8324" name="dataset_1_free_where" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field onfour in free_width statistics_8324_dataset_1_state" data-legion-field-type="radio">
<label for="for_field_dataset_1_state"><?=l('Dataset 1 State<>');?></label>
<div class="input_area">
<input type="radio" name="dataset_1_state" value="Not Deleted" id="radio_dataset_1_state_0"/><label for="radio_dataset_1_state_0">Not Deleted</label>
			
			<input type="radio" name="dataset_1_state" value="Deleted" id="radio_dataset_1_state_1"/><label for="radio_dataset_1_state_1">Deleted</label>
			
			<input type="radio" name="dataset_1_state" value="Both" id="radio_dataset_1_state_2"/><label for="radio_dataset_1_state_2">Both</label>
			
			
</div>
</div><clear></clear><!--


	

--><div class="form_field onfour in free_width statistics_8324_dataset_2_label" data-legion-field-type="text">
<label for="for_field_dataset_2_label"><?=l('Dataset 2 Label<>');?></label>
<div class="input_area">
<input id="for_field_dataset_2_label"  type="text"  data-l_module="statistics_8324" name="dataset_2_label" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field onfour in free_width statistics_8324_dataset_2_color" data-legion-field-type="color">
<label for="for_field_dataset_2_color"><?=l('Dataset 2 Color<>');?></label>
<div class="input_area">
<input id="for_field_dataset_2_color"  type="color"  data-l_module="statistics_8324" name="dataset_2_color" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field onfour in free_width statistics_8324_dataset_2_opacity" data-legion-field-type="number">
<label for="for_field_dataset_2_opacity"><?=l('Dataset 2 Opacity<>');?></label>
<div class="input_area">
<input id="for_field_dataset_2_opacity"  type="number"  data-l_module="statistics_8324" name="dataset_2_opacity" placeholder="" value="100"/>
</div>
</div><!--


	

--><div class="form_field onfour in free_width statistics_8324_dataset_2_free_where" data-legion-field-type="text">
<label for="for_field_dataset_2_free_where"><?=l('Dataset 2 Free Where<>');?></label>
<div class="input_area">
<input id="for_field_dataset_2_free_where"  type="text"  data-l_module="statistics_8324" name="dataset_2_free_where" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field onfour in free_width statistics_8324_dataset_2_state" data-legion-field-type="radio">
<label for="for_field_dataset_2_state"><?=l('Dataset 2 State<>');?></label>
<div class="input_area">
<input type="radio" name="dataset_2_state" value="Not Deleted" id="radio_dataset_2_state_0"/><label for="radio_dataset_2_state_0">Not Deleted</label>
			
			<input type="radio" name="dataset_2_state" value="Deleted" id="radio_dataset_2_state_1"/><label for="radio_dataset_2_state_1">Deleted</label>
			
			<input type="radio" name="dataset_2_state" value="Both" id="radio_dataset_2_state_2"/><label for="radio_dataset_2_state_2">Both</label>
			
			
</div>
</div><clear></clear><!--


	

--><div class="form_field onfour in free_width statistics_8324_dataset_3_label" data-legion-field-type="text">
<label for="for_field_dataset_3_label"><?=l('Dataset 3 Label<>');?></label>
<div class="input_area">
<input id="for_field_dataset_3_label"  type="text"  data-l_module="statistics_8324" name="dataset_3_label" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field onfour in free_width statistics_8324_dataset_3_color" data-legion-field-type="color">
<label for="for_field_dataset_3_color"><?=l('Dataset 3 Color<>');?></label>
<div class="input_area">
<input id="for_field_dataset_3_color"  type="color"  data-l_module="statistics_8324" name="dataset_3_color" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field onfour in free_width statistics_8324_dataset_3_opacity" data-legion-field-type="number">
<label for="for_field_dataset_3_opacity"><?=l('Dataset 3 Opacity<>');?></label>
<div class="input_area">
<input id="for_field_dataset_3_opacity"  type="number"  data-l_module="statistics_8324" name="dataset_3_opacity" placeholder="" value="100"/>
</div>
</div><!--


	

--><div class="form_field onfour in free_width statistics_8324_dataset_3_free_where" data-legion-field-type="text">
<label for="for_field_dataset_3_free_where"><?=l('Dataset 3 Free Where<>');?></label>
<div class="input_area">
<input id="for_field_dataset_3_free_where"  type="text"  data-l_module="statistics_8324" name="dataset_3_free_where" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field onfour in free_width statistics_8324_dataset_3_state" data-legion-field-type="radio">
<label for="for_field_dataset_3_state"><?=l('Dataset 3 State<>');?></label>
<div class="input_area">
<input type="radio" name="dataset_3_state" value="Not Deleted" id="radio_dataset_3_state_0"/><label for="radio_dataset_3_state_0">Not Deleted</label>
			
			<input type="radio" name="dataset_3_state" value="Deleted" id="radio_dataset_3_state_1"/><label for="radio_dataset_3_state_1">Deleted</label>
			
			<input type="radio" name="dataset_3_state" value="Both" id="radio_dataset_3_state_2"/><label for="radio_dataset_3_state_2">Both</label>
			
			
</div>
</div><clear></clear><!--


	

--><div class="form_field onfour in free_width statistics_8324_dataset_4_label" data-legion-field-type="text">
<label for="for_field_dataset_4_label"><?=l('Dataset 4 Label<>');?></label>
<div class="input_area">
<input id="for_field_dataset_4_label"  type="text"  data-l_module="statistics_8324" name="dataset_4_label" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field onfour in free_width statistics_8324_dataset_4_color" data-legion-field-type="color">
<label for="for_field_dataset_4_color"><?=l('Dataset 4 Color<>');?></label>
<div class="input_area">
<input id="for_field_dataset_4_color"  type="color"  data-l_module="statistics_8324" name="dataset_4_color" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field onfour in free_width statistics_8324_dataset_4_opacity" data-legion-field-type="number">
<label for="for_field_dataset_4_opacity"><?=l('Dataset 4 Opacity<>');?></label>
<div class="input_area">
<input id="for_field_dataset_4_opacity"  type="number"  data-l_module="statistics_8324" name="dataset_4_opacity" placeholder="" value="100"/>
</div>
</div><!--


	

--><div class="form_field onfour in free_width statistics_8324_dataset_4_free_where" data-legion-field-type="text">
<label for="for_field_dataset_4_free_where"><?=l('Dataset 4 Free Where<>');?></label>
<div class="input_area">
<input id="for_field_dataset_4_free_where"  type="text"  data-l_module="statistics_8324" name="dataset_4_free_where" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field onfour in free_width statistics_8324_dataset_4_state" data-legion-field-type="radio">
<label for="for_field_dataset_4_state"><?=l('Dataset 4 State<>');?></label>
<div class="input_area">
<input type="radio" name="dataset_4_state" value="Not Deleted" id="radio_dataset_4_state_0"/><label for="radio_dataset_4_state_0">Not Deleted</label>
			
			<input type="radio" name="dataset_4_state" value="Deleted" id="radio_dataset_4_state_1"/><label for="radio_dataset_4_state_1">Deleted</label>
			
			<input type="radio" name="dataset_4_state" value="Both" id="radio_dataset_4_state_2"/><label for="radio_dataset_4_state_2">Both</label>
			
			
</div>
</div><clear></clear><!--


	

--><div class="form_field onfour in free_width statistics_8324_dataset_5_label" data-legion-field-type="text">
<label for="for_field_dataset_5_label"><?=l('Dataset 5 Label<>');?></label>
<div class="input_area">
<input id="for_field_dataset_5_label"  type="text"  data-l_module="statistics_8324" name="dataset_5_label" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field onfour in free_width statistics_8324_dataset_5_color" data-legion-field-type="color">
<label for="for_field_dataset_5_color"><?=l('Dataset 5 Color<>');?></label>
<div class="input_area">
<input id="for_field_dataset_5_color"  type="color"  data-l_module="statistics_8324" name="dataset_5_color" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field onfour in free_width statistics_8324_dataset_5_opacity" data-legion-field-type="number">
<label for="for_field_dataset_5_opacity"><?=l('Dataset 5 Opacity<>');?></label>
<div class="input_area">
<input id="for_field_dataset_5_opacity"  type="number"  data-l_module="statistics_8324" name="dataset_5_opacity" placeholder="" value="100"/>
</div>
</div><!--


	

--><div class="form_field onfour in free_width statistics_8324_dataset_5_free_where" data-legion-field-type="text">
<label for="for_field_dataset_5_free_where"><?=l('Dataset 5 Free Where<>');?></label>
<div class="input_area">
<input id="for_field_dataset_5_free_where"  type="text"  data-l_module="statistics_8324" name="dataset_5_free_where" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field onfour in free_width statistics_8324_dataset_5_state" data-legion-field-type="radio">
<label for="for_field_dataset_5_state"><?=l('Dataset 5 State<>');?></label>
<div class="input_area">
<input type="radio" name="dataset_5_state" value="Not Deleted" id="radio_dataset_5_state_0"/><label for="radio_dataset_5_state_0">Not Deleted</label>
			
			<input type="radio" name="dataset_5_state" value="Deleted" id="radio_dataset_5_state_1"/><label for="radio_dataset_5_state_1">Deleted</label>
			
			<input type="radio" name="dataset_5_state" value="Both" id="radio_dataset_5_state_2"/><label for="radio_dataset_5_state_2">Both</label>
			
			
</div>
</div><clear></clear><!--


	

--><div class="form_field ontwo in free_width statistics_8324_chart_type" data-legion-field-type="radio">
<label for="for_field_chart_type"><?=l('Chart Type<>');?></label>
<div class="input_area">
<input type="radio" name="chart_type" value="bar" id="radio_chart_type_0"/><label for="radio_chart_type_0">bar</label>
			
			<input type="radio" name="chart_type" value="pie" id="radio_chart_type_1"/><label for="radio_chart_type_1">pie</label>
			
			<input type="radio" name="chart_type" value="doughnut" id="radio_chart_type_2"/><label for="radio_chart_type_2">doughnut</label>
			
			<input type="radio" name="chart_type" value="bubble" id="radio_chart_type_3"/><label for="radio_chart_type_3">bubble</label>
			
			<input type="radio" name="chart_type" value="line" id="radio_chart_type_4"/><label for="radio_chart_type_4">line</label>
			
			<input type="radio" name="chart_type" value="polarArea" id="radio_chart_type_5"/><label for="radio_chart_type_5">polarArea</label>
			
			<input type="radio" name="chart_type" value="radar" id="radio_chart_type_6"/><label for="radio_chart_type_6">radar</label>
			
			<input type="radio" name="chart_type" value="scatter" id="radio_chart_type_7"/><label for="radio_chart_type_7">scatter</label>
			
			
</div>
</div><!--


	

--><div class="form_field onfour in free_width statistics_8324_axis" data-legion-field-type="radio">
<label for="for_field_axis"><?=l('Axis<>');?></label>
<div class="input_area">
<input type="radio" name="axis" value="x" id="radio_axis_0"/><label for="radio_axis_0">x</label>
			
			<input type="radio" name="axis" value="y" id="radio_axis_1"/><label for="radio_axis_1">y</label>
			
			
</div>
</div><!--


	

--><div class="form_field onfour in free_width statistics_8324_colors" data-legion-field-type="radio">
<label for="for_field_colors"><?=l('Colors<>');?></label>
<div class="input_area">
<input type="radio" name="colors" value="Colourful" id="radio_colors_0"/><label for="radio_colors_0">Colourful</label>
			
			<input type="radio" name="colors" value="Mono" id="radio_colors_1"/><label for="radio_colors_1">Mono</label>
			
			
</div>
</div><!--


	

--><div class="form_field onfour in free_width statistics_8324_hide_zeros" data-legion-field-type="checkbox">
<label for="for_field_hide_zeros"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input   checked  class="css-checkbox" type="checkbox" name="hide_zeros"  id="<?=$rand='a'.rand(); ?>" />
			<label for="<?=$rand?>"><?=l('Hide Zeros<>');?></label></div></div></div>
</div>
</div><!--


	

--><div class="form_field free_width in statistics_8324_fill" data-legion-field-type="checkbox">
<label for="for_field_fill"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input   class="css-checkbox" type="checkbox" name="fill"  id="<?=$rand='a'.rand(); ?>" />
			<label for="<?=$rand?>"><?=l('Fill<>');?></label></div></div></div>
</div>
</div><!--


	

--><div class="form_field free_width in statistics_8324_vs_time" data-legion-field-type="checkbox">
<label for="for_field_vs_time"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input  onChange="hideFields(new Array('statistics_8324_days'))"  class="css-checkbox" type="checkbox" name="vs_time"  id="<?=$rand='a'.rand(); ?>" />
			<label for="<?=$rand?>"><?=l('Vs Time<>');?></label></div></div></div>
</div>
</div><!--


	

--><div class="form_field free_width in hidden statistics_8324_days" data-legion-field-type="number">
<label for="for_field_days"><?=l('Days<>');?></label>
<div class="input_area">
<input id="for_field_days"  type="number"  data-l_module="statistics_8324" name="days" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field free_width in statistics_8324_stacked" data-legion-field-type="checkbox">
<label for="for_field_stacked"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input   class="css-checkbox" type="checkbox" name="stacked"  id="<?=$rand='a'.rand(); ?>" />
			<label for="<?=$rand?>"><?=l('Stacked<>');?></label></div></div></div>
</div>
</div><!--


				
				
--></div><!--
Tab Ends
				
				
Tab Starts
--><div id="l_tab_50" class="l_tab hidden"><!--
	

--><div class="form_field statistics_8324_button_title" data-legion-field-type="text">
<label for="for_field_button_title"><?=l('Button Title<>');?></label>
<div class="input_area">
<input id="for_field_button_title"  type="text"  data-l_module="statistics_8324" name="button_title" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field statistics_8324_button_link" data-legion-field-type="url">
<label for="for_field_button_link"><?=l('Button Link<>');?></label>
<div class="input_area">
<input id="for_field_button_link"  type="url"  data-l_module="statistics_8324" name="button_link" placeholder="" value=""/>
</div>
</div><!--


				
				
--></div><!--
Tab Ends-->
<!--inputs above -->
</form>
<?php } ?>