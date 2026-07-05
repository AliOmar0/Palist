<?php if(!privilege('files_1577206823','add'))echo $noPermission;else{?>
<form id="files_1577206823" autocomplete="off" action="" onsubmit="return submitter(this,'<?=isset($controllerURL)? $controllerURL:urlPanel?>');" method="post" enctype="multipart/form-data">
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="files_1577206823"/> 
<input type="hidden" name="action" value="add"/>
<!--inputs below --> 
<!--
	

--><div class="form_field ontwo in files_1577206823_full_name" data-legion-field-type="text">
<label for="for_field_full_name"><?=l('Full Name<>اسم الملف الكامل');?></label>
<div class="input_area">
<input id="for_field_full_name"  type="text"  data-legion-module="files_1577206823" name="full_name" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field ontwo in files_1577206823_name" data-legion-field-type="text">
<label for="for_field_name"><?=l('Name<>الاسم');?></label>
<div class="input_area">
<input id="for_field_name"  type="text"  data-legion-module="files_1577206823" name="name" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field files_1577206823_original_name" data-legion-field-type="text">
<label for="for_field_original_name"><?=l('Original Name<>الاسم الأصلي');?></label>
<div class="input_area">
<input id="for_field_original_name"  type="text"  data-legion-module="files_1577206823" name="original_name" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field files_1577206823_protected_file" data-legion-field-type="checkbox">
<label for="for_field_protected_file"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input   class="css-checkbox" type="checkbox" name="protected_file"  id="<?=$rand='a'.rand(); ?>" />
			<label for="<?=$rand?>"><?=l('Protected File<>محمي');?></label></div></div></div>
</div>
</div><!--


	

--><div class="form_field files_1577206823_related_module" data-legion-field-type="select">
<label for="for_field_related_module"><?=l('Related Module<>البرمجية المرتبطة');?></label>
<div class="input_area">
<select  id="for_field_related_module" class="l_mc l_white_c" name="related_module">
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


	

--><div class="form_field files_1577206823_related_module_id" data-legion-field-type="number">
<label for="for_field_related_module_id"><?=l('Related Module ID<>معرّف البرمجية المرتبطة');?></label>
<div class="input_area">
<input id="for_field_related_module_id"  type="number"  data-legion-module="files_1577206823" name="related_module_id" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field files_1577206823_uploader_module_prefix" data-legion-field-type="select">
<label for="for_field_uploader_module_prefix"><?=l('Uploader Module Prefix<>نوع المستخدم الرافع للملف');?></label>
<div class="input_area">
<select  id="for_field_uploader_module_prefix" class="l_mc l_white_c" name="uploader_module_prefix">
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


	

--><div class="form_field files_1577206823_uploader_user_id" data-legion-field-type="number">
<label for="for_field_uploader_user_id"><?=l('Uploader User ID<>المستخدم الرافع للملف');?></label>
<div class="input_area">
<input id="for_field_uploader_user_id"  type="number"  data-legion-module="files_1577206823" name="uploader_user_id" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field files_1577206823_extension" data-legion-field-type="text">
<label for="for_field_extension"><?=l('Extension<>الامتداد');?></label>
<div class="input_area">
<input id="for_field_extension"  type="text"  data-legion-module="files_1577206823" name="extension" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field ontwo in files_1577206823_height" data-legion-field-type="number">
<label for="for_field_height"><?=l('Height<>الطول');?></label>
<div class="input_area">
<input id="for_field_height"  type="number"  data-legion-module="files_1577206823" name="height" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field ontwo in files_1577206823_width" data-legion-field-type="number">
<label for="for_field_width"><?=l('Width<>العرض');?></label>
<div class="input_area">
<input id="for_field_width"  type="number"  data-legion-module="files_1577206823" name="width" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field files_1577206823_quality" data-legion-field-type="number">
<label for="for_field_quality"><?=l('Quality<>الجودة');?></label>
<div class="input_area">
<input id="for_field_quality"  type="number"  data-legion-module="files_1577206823" name="quality" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field files_1577206823_type" data-legion-field-type="text">
<label for="for_field_type"><?=l('Type<>النوع');?></label>
<div class="input_area">
<input id="for_field_type"  type="text"  data-legion-module="files_1577206823" name="type" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field files_1577206823_sub_type" data-legion-field-type="text">
<label for="for_field_sub_type"><?=l('Sub Type<>');?></label>
<div class="input_area">
<input id="for_field_sub_type"  type="text"  data-legion-module="files_1577206823" name="sub_type" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field files_1577206823_size" data-legion-field-type="number">
<label for="for_field_size"><?=l('Size<>الحجم');?></label>
<div class="input_area">
<input id="for_field_size"  type="number" name="size" placeholder="" value="" step="any"/>
</div>
</div><!--


	

--><div class="form_field files_1577206823_source_name" data-legion-field-type="text">
<label for="for_field_source_name"><?=l('Source Name<>المصدر');?></label>
<div class="input_area">
<input id="for_field_source_name"  type="text"  data-legion-module="files_1577206823" name="source_name" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field files_1577206823_source_link" data-legion-field-type="url">
<label for="for_field_source_link"><?=l('Source Link<>رابط مصدر الملف');?></label>
<div class="input_area">
<input id="for_field_source_link"  type="url"  data-legion-module="files_1577206823" name="source_link" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field files_1577206823_reference" data-legion-field-type="text">
<label for="for_field_reference"><?=l('Reference<>رقم مرجعي');?></label>
<div class="input_area">
<input id="for_field_reference"  type="text"  data-legion-module="files_1577206823" name="reference" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field files_1577206823_average_color" data-legion-field-type="color">
<label for="for_field_average_color"><?=l('Average Color<>اللّون المتوسط');?></label>
<div class="input_area">
<input id="for_field_average_color"  type="color"  data-legion-module="files_1577206823" name="average_color" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field files_1577206823_credit" data-legion-field-type="text">
<label for="for_field_credit"><?=l('Credit<>مالك الملف');?></label>
<div class="input_area">
<input id="for_field_credit"  type="text"  data-legion-module="files_1577206823" name="credit" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field files_1577206823_credit_link" data-legion-field-type="url">
<label for="for_field_credit_link"><?=l('Credit Link<>رابط مالك الملف');?></label>
<div class="input_area">
<input id="for_field_credit_link"  type="url"  data-legion-module="files_1577206823" name="credit_link" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field files_1577206823_caption" data-legion-field-type="textarea">
<label for="for_field_caption"><?=l('Caption<>وصف');?></label>
<div class="input_area">
<textarea   placeholder="" data-max_count="500" class="mceNoEditor " name="caption"></textarea>
</div>
</div><!--

-->
<!--inputs above -->
</form>
<?php } ?>