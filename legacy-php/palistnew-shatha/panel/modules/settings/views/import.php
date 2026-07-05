<?php
if($module=='')echo'No module selected';
elseif(privilege($module,'add')){
	include core_dir.'configList.php';
	$target_module=$module;
	$mod=db('modules',"WHERE module_prefix='$target_module'");
	if($mod==1)echo'Module does not exist';
	else{
		$module_id=mid($target_module);
		$fields=db('module_fields',"WHERE module_id='".$mod[0]['id']."'");
//		$fields[]=array('field_name'=>'id','is_ml'=>0,'type'=>'number','sub_type'=>NULL);
		?>
<div id="importer_help">
	<div id="importer_help_title"><?=l('Instructions<>تعليمات')?></div>
	<div class="l_grass l_white_c l_mtb10 l_pad10 l_r5">This is an advanced importing tool, that has many functions the client can choose. You can ignore all options and just use the minimum ones based on the training you got from ProVision team.</div>
	<ul>
		
		<li>
	For combining location if its seperated into two columns, write in the "spec" field the value "location", and in the "field index" write the longtitude index then comma then latitude, for example: 2,3
		</li>

		<li>
		For combining two fields together with "&", in the spec field put "combine_and" and in the "field index", put the two columns, for example: 2,3
		</li>

		<li>
		For combining two fields together with language seperator mark "<>", in the spec field put "combine_and" and in the "field index", put the two columns, for example: 2,3. Note that this will work if only the module chosen field is set as multilingual (ml) by ProVision
		</li>

		<li>

		For file from link, in spec field "photo_link", and in the "field index" put the index,the url for ex: 3,https://xxx.com/uploads/

		</li>
		
		<li>
		For putting alternating an empty column with another if the first column is empty, in the spec field put "alternative_if_empty" and in the "field index", put the two columns, for example: 2,3, where 2 will be the primary column, if empty, it will fill it from column 3
		</li>

		<li>
		For putting alternative of empty field value as "NA", in the spec field put "na_if_empty" and in the "field index"
		</li>


		<li>
			Maximum rows in a file is 10,000 rows
		</li>
		
		<li>
			File importing is NOT supported yet
		</li>
	</ul>
</div>

<form  id="import" autocomplete="off" action="" onsubmit="return submitter(this,urlPanel);" method="post" enctype="multipart/form-data">

<table id="import_table" class="filling">
	<thead>
		<tr>
			<th colspan="4">Module Name: <?=l($mod[0]['module_name'])?>  /   ID#: <?=l($mod[0]['id'])?></th>
		</tr>

		<tr>
			<th>Field</th>
			<th>Correspondant Field index (0,1..etc)</th>
			<th>Spec</th>
			<th>Force Value</th>
		</tr>
	</thead>

	<tbody>
		<?php foreach($fields as $field){?>
			<tr>
				<td>
					<div class="import_field_label "><?=l($field['label'])?></div>
					<div class="import_field_name "><?=$field['field_name']?></div>
					
					<input  name="original_field[]" type="hidden" value="<?=$field['field_name']?>"/>
					<input  name="is_ml[]" type="hidden" value="<?=$field['is_ml']?>"/>
					<?php /*
					<input  name="_type[]" type="hidden" value="<?=$field['type']?>"/>
					<input  name="_sub_type[]" type="hidden" value="<?=$field['sub_type']?>"/>
					*/?>
				</td>
					
				<td>
					<input name="file_index_column[]" type="text" value=""/>
				</td>
				<td>
					<input name="spec[]" type="text" value=""/>
				</td>
				<td>
					<?=table_search_field($field['field_name'],[$field['field_name']=>$field],true)?>
				</td>
			</tr>
		<?php }?>
	</tbody>
</table>

	<input type="hidden" name="action" value="<?=$action?>"/>
	<input type="hidden" name="module" value="<?=$module?>"/>
	<input type="hidden" value="" name="e"/>
	
	
	<m20></m20>
	<div class="form_field ">
		<label class="l_mb10">CSV File <span class="mid l_lava_c l_f10">(ONLY CSV files, but you can convert excel file to CSV via many tools, one of them is MS Excel)</span></label>
<!--		<div class="input_area">-->
			<input type="file" required name="file"/>
<!--		</div>-->
	</div><!--
	
	
--><div class="form_field  in onfour">
<label>Action</label>
<div class="input_area">
	<select name="importer_action">
		<option selected value="check_file">Check File</option>
		<option value="compare_file">Compare File & Inputs</option>
		<option  value="import_file">Import File</option>
	</select>
	</div>
</div><!--
	
	
	
--><div class="form_field  in onfour">
<label>Avoid Column Index If Empty</label>
<div class="input_area">
		<input type="number" name="dont_import_if_this_index_null"/>

</div>
</div><!--
	
	
	
--><div class="form_field  in onfour">
<label>Skip Rows (<= this index)</label>
<div class="input_area">
	<input type="number" name="dont_import_up_to_row_index"/>
	</div>
</div>
	
	<clear></clear>
	<input type="submit" class="b po" value="Execute"/>
	
</form>
<m20></m20>



<div id="excel_note" class="hidden"></div>
<div id="excel_good" class="hidden"></div>

<script>
function excel_note(data,params){
	show('excel_note')
	hide('excel_good');;
	$('#excel_note').html(params['error']);
}
function excel_good(data,params){
	show('excel_good');
	hide('excel_note');
	$('#excel_good').html(params['note']);
}
</script>


<?php
	}
}else echo $noPermission;