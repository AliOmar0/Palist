<?php
//validate fields if required
$_module='statistics_8324';
validateFields($_module,$action);

if(
		!isset($_POST['title'])||
		!isset($_POST['subline'])||
		!isset($_POST['compared_value'])||
		!isset($_POST['free_where'])||
		!isset($_POST['order_number'])||
		!isset($_POST['icon'])||
		!isset($_POST['dataset_1_label'])||
		!isset($_POST['dataset_1_color'])||
		!isset($_POST['dataset_1_opacity'])||
		!isset($_POST['dataset_1_free_where'])||
		!isset($_POST['dataset_2_label'])||
		!isset($_POST['dataset_2_color'])||
		!isset($_POST['dataset_2_opacity'])||
		!isset($_POST['dataset_2_free_where'])||
		!isset($_POST['dataset_3_label'])||
		!isset($_POST['dataset_3_color'])||
		!isset($_POST['dataset_3_opacity'])||
		!isset($_POST['dataset_3_free_where'])||
		!isset($_POST['dataset_4_label'])||
		!isset($_POST['dataset_4_color'])||
		!isset($_POST['dataset_4_opacity'])||
		!isset($_POST['dataset_4_free_where'])||
		!isset($_POST['dataset_5_label'])||
		!isset($_POST['dataset_5_color'])||
		!isset($_POST['dataset_5_opacity'])||
		!isset($_POST['dataset_5_free_where'])||
		!isset($_POST['days'])||
		!isset($_POST['button_title'])||
		!isset($_POST['button_link'])
		|| !isset($_POST['id']) || $_POST['id']=="" 
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;

//escape parameters
$id=e('id');

$title=e('title');
$type=(isset($_POST['type']) ? e('type') : '');
			
$subline=e('subline');
$live=(isset($_POST['live'])  && $_POST['live']!='0' ? 1 : 0);
			
$module_prefix=e('module_prefix');
$module_field=e('module_field');
$compare_sign=(isset($_POST['compare_sign']) ? e('compare_sign') : '');
			
$compared_value=e('compared_value');
$size=(isset($_POST['size']) ? e('size') : '');
			
$free_where=e('free_where');
$order_number=e('order_number');
$icon=e('icon');
$dataset_1_label=e('dataset_1_label');
$dataset_1_color=e('dataset_1_color');
$dataset_1_opacity=e('dataset_1_opacity');
$dataset_1_free_where=e('dataset_1_free_where');
$dataset_1_state=(isset($_POST['dataset_1_state']) ? e('dataset_1_state') : '');
			
$dataset_2_label=e('dataset_2_label');
$dataset_2_color=e('dataset_2_color');
$dataset_2_opacity=e('dataset_2_opacity');
$dataset_2_free_where=e('dataset_2_free_where');
$dataset_2_state=(isset($_POST['dataset_2_state']) ? e('dataset_2_state') : '');
			
$dataset_3_label=e('dataset_3_label');
$dataset_3_color=e('dataset_3_color');
$dataset_3_opacity=e('dataset_3_opacity');
$dataset_3_free_where=e('dataset_3_free_where');
$dataset_3_state=(isset($_POST['dataset_3_state']) ? e('dataset_3_state') : '');
			
$dataset_4_label=e('dataset_4_label');
$dataset_4_color=e('dataset_4_color');
$dataset_4_opacity=e('dataset_4_opacity');
$dataset_4_free_where=e('dataset_4_free_where');
$dataset_4_state=(isset($_POST['dataset_4_state']) ? e('dataset_4_state') : '');
			
$dataset_5_label=e('dataset_5_label');
$dataset_5_color=e('dataset_5_color');
$dataset_5_opacity=e('dataset_5_opacity');
$dataset_5_free_where=e('dataset_5_free_where');
$dataset_5_state=(isset($_POST['dataset_5_state']) ? e('dataset_5_state') : '');
			
$chart_type=(isset($_POST['chart_type']) ? e('chart_type') : '');
			
$axis=(isset($_POST['axis']) ? e('axis') : '');
			
$colors=(isset($_POST['colors']) ? e('colors') : '');
			
$hide_zeros=(isset($_POST['hide_zeros'])  && $_POST['hide_zeros']!='0' ? 1 : 0);
			
$fill=(isset($_POST['fill'])  && $_POST['fill']!='0' ? 1 : 0);
			
$vs_time=(isset($_POST['vs_time'])  && $_POST['vs_time']!='0' ? 1 : 0);
			
$days=e('days');
$stacked=(isset($_POST['stacked'])  && $_POST['stacked']!='0' ? 1 : 0);
			
$button_title=e('button_title');
$button_link=e('button_link');

//update entry in database
try{
	mysqli_query($conn,"UPDATE $_module SET title='$title',type='$type',subline='$subline',live='$live',module_prefix='$module_prefix',module_field='$module_field',compare_sign='$compare_sign',compared_value='$compared_value',size='$size',free_where='$free_where',order_number='$order_number',icon='$icon',dataset_1_label='$dataset_1_label',dataset_1_color='$dataset_1_color',dataset_1_opacity='$dataset_1_opacity',dataset_1_free_where='$dataset_1_free_where',dataset_1_state='$dataset_1_state',dataset_2_label='$dataset_2_label',dataset_2_color='$dataset_2_color',dataset_2_opacity='$dataset_2_opacity',dataset_2_free_where='$dataset_2_free_where',dataset_2_state='$dataset_2_state',dataset_3_label='$dataset_3_label',dataset_3_color='$dataset_3_color',dataset_3_opacity='$dataset_3_opacity',dataset_3_free_where='$dataset_3_free_where',dataset_3_state='$dataset_3_state',dataset_4_label='$dataset_4_label',dataset_4_color='$dataset_4_color',dataset_4_opacity='$dataset_4_opacity',dataset_4_free_where='$dataset_4_free_where',dataset_4_state='$dataset_4_state',dataset_5_label='$dataset_5_label',dataset_5_color='$dataset_5_color',dataset_5_opacity='$dataset_5_opacity',dataset_5_free_where='$dataset_5_free_where',dataset_5_state='$dataset_5_state',chart_type='$chart_type',axis='$axis',colors='$colors',hide_zeros='$hide_zeros',fill='$fill',vs_time='$vs_time',days='$days',stacked='$stacked',button_title='$button_title',button_link='$button_link',date_modified='$date_modified' WHERE id='$id' LIMIT 1");
}
catch(mysqli_sql_exception $e){
	json(false,3);
}
	
	
if($internal_forced)$_POST['internal']=true;
require core_dir.'preModelResponse.php';	
require custom_dir.'custom_module_response.php';
//ajaxly saved
json(true,2);