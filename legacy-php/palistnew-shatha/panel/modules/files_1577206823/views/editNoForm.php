<?php 
$id=check_get_id();
	$_form_resp=db('files_1577206823','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('files_1577206823','edit') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="files_1577206823"/> 
<input type="hidden" name="action" value="edit"/> 
<input type="hidden" name="id" value="<?=$id;?>"/> 

<!--inputs below -->
<!--
	

--><div class="form_field ontwo in  files_1577206823_full_name" data-legion-field-type="text">
<label for="for_field_full_name"><?=l('Full Name<>اسم الملف الكامل');?></label>
<div class="input_area">
<input id="for_field_full_name"  type="text" name="full_name"   data-legion-module="files_1577206823" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['full_name']) ?>"/>
</div>
</div><!--


	

--><div class="form_field ontwo in  files_1577206823_name" data-legion-field-type="text">
<label for="for_field_name"><?=l('Name<>الاسم');?></label>
<div class="input_area">
<input id="for_field_name"  type="text" name="name"   data-legion-module="files_1577206823" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['name']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  files_1577206823_original_name" data-legion-field-type="text">
<label for="for_field_original_name"><?=l('Original Name<>الاسم الأصلي');?></label>
<div class="input_area">
<input id="for_field_original_name"  type="text" name="original_name"   data-legion-module="files_1577206823" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['original_name']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  files_1577206823_protected_file" data-legion-field-type="checkbox">
<label for="for_field_protected_file"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input <?=($_form_resp[0]['protected_file']==1 ? ' checked ':'');?>
 class=" css-checkbox" name="protected_file" type="checkbox" id="<?=$rand='a'.rand(); ?>"/>
			<label for="<?=$rand ?>"><?=l('Protected File<>محمي');?></label></div></div></div>
</div>
</div><!--


	

--><div class="form_field  files_1577206823_related_module" data-legion-field-type="select">
<label for="for_field_related_module"><?=l('Related Module<>البرمجية المرتبطة');?></label>
<div class="input_area">

<select  id="for_field_related_module" class="l_mc l_white_c" name="related_module">
<?php 
$addition_where=NULL;
	
$_form_sub_resp=db('modules',"WHERE deleted=0    $addition_where",NULL);
			if($_form_sub_resp==0){?><option value="0" selected><?=l('Error<>خطأ')?></option><?php } 
			else if($_form_sub_resp==1){?><option value="0" selected><?=l('Choose<>اختر');?></option><?php } 
				 else { ?>
                 <option value="0" <?=(0==$_form_resp[0]['related_module']?'selected':'')?>><?=l('Choose<>اختر');?></option>
				<?php
					$echoFields='module_name';
					$x=explode(',',$echoFields);
					if($_form_sub_resp!=1){
						for($j=0;$j<count($_form_sub_resp);$j++){?>
						<option <?=($_form_sub_resp[$j]['id']==$_form_resp[0]['related_module'] ? 'selected' : ''); ?> class="l_mc l_white_c" value="<?=$_form_sub_resp[$j]['id']?>"><?php 
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


	

--><div class="form_field  files_1577206823_related_module_id" data-legion-field-type="number">
<label for="for_field_related_module_id"><?=l('Related Module ID<>معرّف البرمجية المرتبطة');?></label>
<div class="input_area">
<input id="for_field_related_module_id"  type="number" name="related_module_id"   data-legion-module="files_1577206823" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['related_module_id']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  files_1577206823_uploader_module_prefix" data-legion-field-type="select">
<label for="for_field_uploader_module_prefix"><?=l('Uploader Module Prefix<>نوع المستخدم الرافع للملف');?></label>
<div class="input_area">

<select  id="for_field_uploader_module_prefix" class="l_mc l_white_c" name="uploader_module_prefix">
<?php 
$addition_where=NULL;
	
$_form_sub_resp=db('modules',"WHERE deleted=0    $addition_where",NULL);
			if($_form_sub_resp==0){?><option value="0" selected><?=l('Error<>خطأ')?></option><?php } 
			else if($_form_sub_resp==1){?><option value="0" selected><?=l('Choose<>اختر');?></option><?php } 
				 else { ?>
                 <option value="0" <?=(0==$_form_resp[0]['uploader_module_prefix']?'selected':'')?>><?=l('Choose<>اختر');?></option>
				<?php
					$echoFields='module_name';
					$x=explode(',',$echoFields);
					if($_form_sub_resp!=1){
						for($j=0;$j<count($_form_sub_resp);$j++){?>
						<option <?=($_form_sub_resp[$j]['id']==$_form_resp[0]['uploader_module_prefix'] ? 'selected' : ''); ?> class="l_mc l_white_c" value="<?=$_form_sub_resp[$j]['id']?>"><?php 
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


	

--><div class="form_field  files_1577206823_uploader_user_id" data-legion-field-type="number">
<label for="for_field_uploader_user_id"><?=l('Uploader User ID<>المستخدم الرافع للملف');?></label>
<div class="input_area">
<input id="for_field_uploader_user_id"  type="number" name="uploader_user_id"   data-legion-module="files_1577206823" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['uploader_user_id']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  files_1577206823_extension" data-legion-field-type="text">
<label for="for_field_extension"><?=l('Extension<>الامتداد');?></label>
<div class="input_area">
<input id="for_field_extension"  type="text" name="extension"   data-legion-module="files_1577206823" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['extension']) ?>"/>
</div>
</div><!--


	

--><div class="form_field ontwo in  files_1577206823_height" data-legion-field-type="number">
<label for="for_field_height"><?=l('Height<>الطول');?></label>
<div class="input_area">
<input id="for_field_height"  type="number" name="height"   data-legion-module="files_1577206823" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['height']) ?>"/>
</div>
</div><!--


	

--><div class="form_field ontwo in  files_1577206823_width" data-legion-field-type="number">
<label for="for_field_width"><?=l('Width<>العرض');?></label>
<div class="input_area">
<input id="for_field_width"  type="number" name="width"   data-legion-module="files_1577206823" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['width']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  files_1577206823_quality" data-legion-field-type="number">
<label for="for_field_quality"><?=l('Quality<>الجودة');?></label>
<div class="input_area">
<input id="for_field_quality"  type="number" name="quality"   data-legion-module="files_1577206823" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['quality']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  files_1577206823_type" data-legion-field-type="text">
<label for="for_field_type"><?=l('Type<>النوع');?></label>
<div class="input_area">
<input id="for_field_type"  type="text" name="type"   data-legion-module="files_1577206823" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['type']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  files_1577206823_sub_type" data-legion-field-type="text">
<label for="for_field_sub_type"><?=l('Sub Type<>');?></label>
<div class="input_area">
<input id="for_field_sub_type"  type="text" name="sub_type"   data-legion-module="files_1577206823" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['sub_type']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  files_1577206823_size" data-legion-field-type="number">
<label for="for_field_size"><?=l('Size<>الحجم');?></label>
<div class="input_area">
<input id="for_field_size"  type="number" name="size" placeholder="" value="<?=$_form_resp[0]['size'] ?>" step="any"/>
</div>
</div><!--


	

--><div class="form_field  files_1577206823_source_name" data-legion-field-type="text">
<label for="for_field_source_name"><?=l('Source Name<>المصدر');?></label>
<div class="input_area">
<input id="for_field_source_name"  type="text" name="source_name"   data-legion-module="files_1577206823" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['source_name']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  files_1577206823_source_link" data-legion-field-type="url">
<label for="for_field_source_link"><?=l('Source Link<>رابط مصدر الملف');?></label>
<div class="input_area">
<input id="for_field_source_link"  type="url" name="source_link"   data-legion-module="files_1577206823" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['source_link']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  files_1577206823_reference" data-legion-field-type="text">
<label for="for_field_reference"><?=l('Reference<>رقم مرجعي');?></label>
<div class="input_area">
<input id="for_field_reference"  type="text" name="reference"   data-legion-module="files_1577206823" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['reference']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  files_1577206823_average_color" data-legion-field-type="color">
<label for="for_field_average_color"><?=l('Average Color<>اللّون المتوسط');?></label>
<div class="input_area">
<input id="for_field_average_color"  type="color" name="average_color"   data-legion-module="files_1577206823" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['average_color']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  files_1577206823_credit" data-legion-field-type="text">
<label for="for_field_credit"><?=l('Credit<>مالك الملف');?></label>
<div class="input_area">
<input id="for_field_credit"  type="text" name="credit"   data-legion-module="files_1577206823" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['credit']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  files_1577206823_credit_link" data-legion-field-type="url">
<label for="for_field_credit_link"><?=l('Credit Link<>رابط مالك الملف');?></label>
<div class="input_area">
<input id="for_field_credit_link"  type="url" name="credit_link"   data-legion-module="files_1577206823" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['credit_link']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  files_1577206823_caption" data-legion-field-type="textarea">
<label for="for_field_caption"><?=l('Caption<>وصف');?></label>
<div class="input_area">
<textarea   placeholder="" data-max_count="500"  class="mceNoEditor " name="caption"><?=$_form_resp[0]['caption'] ?></textarea>
</div>
</div><!--

-->
<!--inputs above -->
<?php } ?>