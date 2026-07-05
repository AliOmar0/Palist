<?php 
$original_edit_id=$id=check_get_id();
	$_form_resp=db('module_fields','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('module_fields','edit') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<form id="module_fields" autocomplete="off" action="" onsubmit="return submitter(this,'<?=isset($controllerURL)? $controllerURL:urlPanel?>');" method="post" enctype="multipart/form-data">
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="module_fields"/> 
<input type="hidden" name="action" value="edit"/> 
<input type="hidden" name="id" value="<?=$id;?>"/> 

<!--inputs below -->
<!--
	

--><div class="form_field  module_fields_module_id" data-legion-field-type="select">
<label for="for_field_module_id"><?=l('Module ID<>');?></label>
<div class="input_area">

<select  id="for_field_module_id" class="l_mc l_white_c" name="module_id">
<?php 
$addition_where=NULL;
	
$_form_sub_resp=db('modules',"WHERE deleted=0    $addition_where",NULL);
			if($_form_sub_resp==0){?><option value="0" selected><?=l('Error<>خطأ')?></option><?php } 
			else if($_form_sub_resp==1){?><option value="0" selected><?=l('Choose<>اختر');?></option><?php } 
				 else { ?>
                 <option value="0" <?=(0==$_form_resp[0]['module_id']?'selected':'')?>><?=l('Choose<>اختر');?></option>
				<?php
					$echoFields='module_name';
					$x=explode(',',$echoFields);
					if($_form_sub_resp!=1){
						for($j=0;$j<count($_form_sub_resp);$j++){?>
						<option <?=($_form_sub_resp[$j]['id']==$_form_resp[0]['module_id'] ? 'selected' : ''); ?> class="l_mc l_white_c" value="<?=$_form_sub_resp[$j]['id']?>"><?php 
							for($e=0;$e<count($x);$e++){
								if($x[$e]=='-')echo ' -';
								else {
									if($e!=0)echo ' ';
									echo l($_form_sub_resp[$j][$x[$e]]); 
								}
							}
						?></option>
						
				<?php 
						}//for
					}
				}//else 
				unset($_form_sub_resp);
				?>
			</select>
			
</div>
</div><!--


	

--><div class="form_field  module_fields_field_name" data-legion-field-type="text">
<label for="for_field_field_name"><?=l('Field Name<>');?></label>
<div class="input_area">
<input id="for_field_field_name"  type="text" name="field_name"   data-legion-module="module_fields" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['field_name']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  module_fields_label" data-legion-field-type="text">
<label for="for_field_label"><?=l('Label<>');?></label>
<div class="input_area">
<input id="for_field_label"  type="text" name="label"   data-legion-module="module_fields" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['label']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  module_fields_type" data-legion-field-type="text">
<label for="for_field_type"><?=l('Type<>');?></label>
<div class="input_area">
<input id="for_field_type"  type="text" name="type"   data-legion-module="module_fields" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['type']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  module_fields_sub_type" data-legion-field-type="text">
<label for="for_field_sub_type"><?=l('Sub Type<>');?></label>
<div class="input_area">
<input id="for_field_sub_type"  type="text" name="sub_type"   data-legion-module="module_fields" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['sub_type']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  module_fields_sub_sub_type" data-legion-field-type="text">
<label for="for_field_sub_sub_type"><?=l('Sub Sub Type<>');?></label>
<div class="input_area">
<input id="for_field_sub_sub_type"  type="text" name="sub_sub_type"   data-legion-module="module_fields" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['sub_sub_type']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  module_fields_protected_file" data-legion-field-type="checkbox">
<label for="for_field_protected_file"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input <?=($_form_resp[0]['protected_file']==1 ? ' checked ':'');?>
 class=" css-checkbox" name="protected_file" type="checkbox" id="<?=$rand='a'.rand(); ?>"/>
			<label for="<?=$rand ?>"><?=l('Protected File<>');?></label></div></div></div>
</div>
</div><!--


	

--><div class="form_field  module_fields_main" data-legion-field-type="checkbox">
<label for="for_field_main"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input <?=($_form_resp[0]['main']==1 ? ' checked ':'');?>
 class=" css-checkbox" name="main" type="checkbox" id="<?=$rand='a'.rand(); ?>"/>
			<label for="<?=$rand ?>"><?=l('Main<>');?></label></div></div></div>
</div>
</div><!--


	

--><div class="form_field  module_fields_select_table" data-legion-field-type="text">
<label for="for_field_select_table"><?=l('Select Table<>');?></label>
<div class="input_area">
<input id="for_field_select_table"  type="text" name="select_table"   data-legion-module="module_fields" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['select_table']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  module_fields_select_field" data-legion-field-type="text">
<label for="for_field_select_field"><?=l('Select Field<>');?></label>
<div class="input_area">
<input id="for_field_select_field"  type="text" name="select_field"   data-legion-module="module_fields" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['select_field']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  module_fields_parenter_field" data-legion-field-type="checkbox">
<label for="for_field_parenter_field"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input <?=($_form_resp[0]['parenter_field']==1 ? ' checked ':'');?>
 class=" css-checkbox" name="parenter_field" type="checkbox" id="<?=$rand='a'.rand(); ?>"/>
			<label for="<?=$rand ?>"><?=l('Parenter Field<>');?></label></div></div></div>
</div>
</div><!--


	

--><div class="form_field  module_fields_is_ml" data-legion-field-type="checkbox">
<label for="for_field_is_ml"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input <?=($_form_resp[0]['is_ml']==1 ? ' checked ':'');?>
 class=" css-checkbox" name="is_ml" type="checkbox" id="<?=$rand='a'.rand(); ?>"/>
			<label for="<?=$rand ?>"><?=l('Is ML<>');?></label></div></div></div>
</div>
</div><!--


	

--><div class="form_field  module_fields_is_unique" data-legion-field-type="checkbox">
<label for="for_field_is_unique"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input <?=($_form_resp[0]['is_unique']==1 ? ' checked ':'');?>
 class=" css-checkbox" name="is_unique" type="checkbox" id="<?=$rand='a'.rand(); ?>"/>
			<label for="<?=$rand ?>"><?=l('Is Unique<>');?></label></div></div></div>
</div>
</div><!--


	

--><div class="form_field  module_fields_nomce" data-legion-field-type="checkbox">
<label for="for_field_noMCE"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input <?=($_form_resp[0]['noMCE']==1 ? ' checked ':'');?>
 class=" css-checkbox" name="noMCE" type="checkbox" id="<?=$rand='a'.rand(); ?>"/>
			<label for="<?=$rand ?>"><?=l('NoMCE<>');?></label></div></div></div>
</div>
</div><!--


	

--><div class="form_field  module_fields_required" data-legion-field-type="checkbox">
<label for="for_field_required"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input <?=($_form_resp[0]['required']==1 ? ' checked ':'');?>
 class=" css-checkbox" name="required" type="checkbox" id="<?=$rand='a'.rand(); ?>"/>
			<label for="<?=$rand ?>"><?=l('Required<>');?></label></div></div></div>
</div>
</div><!--


	

--><div class="form_field  module_fields_multi_files" data-legion-field-type="checkbox">
<label for="for_field_multi_files"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input <?=($_form_resp[0]['multi_files']==1 ? ' checked ':'');?>
 class=" css-checkbox" name="multi_files" type="checkbox" id="<?=$rand='a'.rand(); ?>"/>
			<label for="<?=$rand ?>"><?=l('Multi Files<>');?></label></div></div></div>
</div>
</div><!--


	

--><div class="form_field  module_fields_visibility_matrix" data-legion-field-type="text">
<label for="for_field_visibility_matrix"><?=l('Visibility Matrix<>');?></label>
<div class="input_area">
<input id="for_field_visibility_matrix"  type="text" name="visibility_matrix"   data-legion-module="module_fields" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['visibility_matrix']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  module_fields_db_default" data-legion-field-type="text">
<label for="for_field_db_default"><?=l('DB Default<>');?></label>
<div class="input_area">
<input id="for_field_db_default"  type="text" name="db_default"   data-legion-module="module_fields" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['db_default']) ?>"/>
</div>
</div><!--

-->
<!--inputs above -->
</form>
<?php } ?>