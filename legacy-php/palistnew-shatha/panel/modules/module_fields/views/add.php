<?php if(!privilege('module_fields','add'))echo $noPermission;else{?>
<form id="module_fields" autocomplete="off" action="" onsubmit="return submitter(this,'<?=isset($controllerURL)? $controllerURL:urlPanel?>');" method="post" enctype="multipart/form-data">
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="module_fields"/> 
<input type="hidden" name="action" value="add"/>
<!--inputs below --> 
<!--
	

--><div class="form_field module_fields_module_id" data-legion-field-type="select">
<label for="for_field_module_id"><?=l('Module ID<>');?></label>
<div class="input_area">
<select  id="for_field_module_id" class="l_mc l_white_c" name="module_id">
<?php 
$addition_where=NULL;

$_form_resp=db('modules',"WHERE deleted=0   $addition_where",NULL,NULL);
			if($_form_resp==0){?><option value="0" selected><?=l('Error<>خطأ')?></option> <?php } 
			else if($_form_resp==1){?><option value="0" selected><?=l('Choose<>اختر');?></option><?php } 
				else {?>
                    <option value="0"><?=l('Choose<>اختر');?></option>
					<?php 
					$echoFields='module_name';
                    $x=explode(',',$echoFields);
					if($_form_resp!=1){
						for($_i=0;$_i<count($_form_resp);$_i++){?>
						<option value="<?=$_form_resp[$_i]['id']?>"><?php
						for($e=0;$e<count($x);$e++){
							if($x[$e]=='-')echo ' -';
							else {
								if($e!=0)echo ' ';
								echo l($_form_resp[$_i][$x[$e]]); 
							}
						 }
						 ?></option>
						
						<?php 
							}//for
						}
					}//else
					unset($_form_resp);
					?>
			</select>
			
</div>
</div><!--


	

--><div class="form_field module_fields_field_name" data-legion-field-type="text">
<label for="for_field_field_name"><?=l('Field Name<>');?></label>
<div class="input_area">
<input id="for_field_field_name"  type="text"  data-legion-module="module_fields" name="field_name" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field module_fields_label" data-legion-field-type="text">
<label for="for_field_label"><?=l('Label<>');?></label>
<div class="input_area">
<input id="for_field_label"  type="text"  data-legion-module="module_fields" name="label" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field module_fields_type" data-legion-field-type="text">
<label for="for_field_type"><?=l('Type<>');?></label>
<div class="input_area">
<input id="for_field_type"  type="text"  data-legion-module="module_fields" name="type" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field module_fields_sub_type" data-legion-field-type="text">
<label for="for_field_sub_type"><?=l('Sub Type<>');?></label>
<div class="input_area">
<input id="for_field_sub_type"  type="text"  data-legion-module="module_fields" name="sub_type" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field module_fields_sub_sub_type" data-legion-field-type="text">
<label for="for_field_sub_sub_type"><?=l('Sub Sub Type<>');?></label>
<div class="input_area">
<input id="for_field_sub_sub_type"  type="text"  data-legion-module="module_fields" name="sub_sub_type" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field module_fields_protected_file" data-legion-field-type="checkbox">
<label for="for_field_protected_file"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input   class="css-checkbox" type="checkbox" name="protected_file"  id="<?=$rand='a'.rand(); ?>" />
			<label for="<?=$rand?>"><?=l('Protected File<>');?></label></div></div></div>
</div>
</div><!--


	

--><div class="form_field module_fields_main" data-legion-field-type="checkbox">
<label for="for_field_main"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input   class="css-checkbox" type="checkbox" name="main"  id="<?=$rand='a'.rand(); ?>" />
			<label for="<?=$rand?>"><?=l('Main<>');?></label></div></div></div>
</div>
</div><!--


	

--><div class="form_field module_fields_select_table" data-legion-field-type="text">
<label for="for_field_select_table"><?=l('Select Table<>');?></label>
<div class="input_area">
<input id="for_field_select_table"  type="text"  data-legion-module="module_fields" name="select_table" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field module_fields_select_field" data-legion-field-type="text">
<label for="for_field_select_field"><?=l('Select Field<>');?></label>
<div class="input_area">
<input id="for_field_select_field"  type="text"  data-legion-module="module_fields" name="select_field" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field module_fields_parenter_field" data-legion-field-type="checkbox">
<label for="for_field_parenter_field"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input   class="css-checkbox" type="checkbox" name="parenter_field"  id="<?=$rand='a'.rand(); ?>" />
			<label for="<?=$rand?>"><?=l('Parenter Field<>');?></label></div></div></div>
</div>
</div><!--


	

--><div class="form_field module_fields_is_ml" data-legion-field-type="checkbox">
<label for="for_field_is_ml"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input   class="css-checkbox" type="checkbox" name="is_ml"  id="<?=$rand='a'.rand(); ?>" />
			<label for="<?=$rand?>"><?=l('Is ML<>');?></label></div></div></div>
</div>
</div><!--


	

--><div class="form_field module_fields_is_unique" data-legion-field-type="checkbox">
<label for="for_field_is_unique"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input   class="css-checkbox" type="checkbox" name="is_unique"  id="<?=$rand='a'.rand(); ?>" />
			<label for="<?=$rand?>"><?=l('Is Unique<>');?></label></div></div></div>
</div>
</div><!--


	

--><div class="form_field module_fields_nomce" data-legion-field-type="checkbox">
<label for="for_field_noMCE"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input   class="css-checkbox" type="checkbox" name="noMCE"  id="<?=$rand='a'.rand(); ?>" />
			<label for="<?=$rand?>"><?=l('NoMCE<>');?></label></div></div></div>
</div>
</div><!--


	

--><div class="form_field module_fields_required" data-legion-field-type="checkbox">
<label for="for_field_required"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input   class="css-checkbox" type="checkbox" name="required"  id="<?=$rand='a'.rand(); ?>" />
			<label for="<?=$rand?>"><?=l('Required<>');?></label></div></div></div>
</div>
</div><!--


	

--><div class="form_field module_fields_multi_files" data-legion-field-type="checkbox">
<label for="for_field_multi_files"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input   class="css-checkbox" type="checkbox" name="multi_files"  id="<?=$rand='a'.rand(); ?>" />
			<label for="<?=$rand?>"><?=l('Multi Files<>');?></label></div></div></div>
</div>
</div><!--


	

--><div class="form_field module_fields_visibility_matrix" data-legion-field-type="text">
<label for="for_field_visibility_matrix"><?=l('Visibility Matrix<>');?></label>
<div class="input_area">
<input id="for_field_visibility_matrix"  type="text"  data-legion-module="module_fields" name="visibility_matrix" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field module_fields_db_default" data-legion-field-type="text">
<label for="for_field_db_default"><?=l('DB Default<>');?></label>
<div class="input_area">
<input id="for_field_db_default"  type="text"  data-legion-module="module_fields" name="db_default" placeholder="" value=""/>
</div>
</div><!--

-->
<!--inputs above -->
</form>
<?php } ?>