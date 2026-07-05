<?php if(!privilege('pages_1478423482','add'))echo $noPermission;else{
require_once cms_dir.'plugins/tinymce/backendTinyCall.php';?>
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="pages_1478423482"/> 
<input type="hidden" name="action" value="add"/>
<!--inputs below --> 
<!--
	

--><div class="form_field pages_1478423482_title" data-legion-field-type="text">
<label for="for_field_title"><?=l('Title<>العنوان');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_title"  required type="text"  data-l_is_ml="true" data-l_module="pages_1478423482" name="title" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field pages_1478423482_slug" data-legion-field-type="text"data-legion-unique="true">
<label for="for_field_slug"><?=l('Slug<>كلمة تمييز الرابط');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_slug"  required type="text" data-l_unique="true" data-l_is_ml="true" data-l_slug="true" data-l_module="pages_1478423482" name="slug" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field pages_1478423482_content" data-legion-field-type="textarea">
<label for="for_field_content"><?=l('Content<>المحتوى');?></label>
<div class="input_area">
<textarea  data-l_is_ml="true"  placeholder="" data-max_count="0" class="" name="content"></textarea>
</div>
</div><!--


	

--><div class="form_field onfour in pages_1478423482_photo" data-legion-field-type="file">
<label for="for_field_photo"><?=l('Photo<>صورة');?></label>
<div class="input_area">
<div class="po pvp_chooser" data-filetype="photo" data-multi="false" onclick="pvp_core('pages_1478423482_photo',false,false)"><img src="<?=u?>photo.png"></div>
	<div class="in clearFiles po h" onclick="pvp_clear('pages_1478423482_photo')"><i class="md-light">delete</i></div>
	<input type="hidden" name="photo"/>
	<div class="count fileName in"><?=l('Selected<>الملفات المُختارة')?> <span>0</span></div>
	
</div>
</div><!--


	

--><div class="form_field onfour in pages_1478423482_files" data-legion-field-type="file">
<label for="for_field_files"><?=l('Files<>الملفات');?></label>
<div class="input_area">
<div class="po pvp_chooser" data-filetype="file" data-multi="true" onclick="pvp_core('pages_1478423482_files',true,true)"><img src="<?=u?>files.png"></div>
	<div class="in clearFiles po h" onclick="pvp_clear('pages_1478423482_files')"><i class="md-light">delete</i></div>
	<input type="hidden" name="files"/>
	<div class="count fileName in"><?=l('Selected<>الملفات المُختارة')?> <span>0</span></div>
	
</div>
</div><!--

--><div class="big_group_wrap pages_1478423482_advancedsettings"><div class="big_group"><?=l('Advanced Settings<>خصائص متقدّمة')?></div></div><!--
	

--><div class="form_field onfour in pages_1478423482_additional_file" data-legion-field-type="text">
<label for="for_field_additional_file"><?=l('Additional File<>ملف إضافي');?>
<div class="help">
	<i>help_outline</i>
	<span><?=l('The file path starts from root, dont add slash at the begining<>مسار الملف من المجلد الرئيسي دون وضع شحطة مائلة في البداية')?></span>
</div>
</label>
<div class="input_area">
<input id="for_field_additional_file"  type="text"  data-l_module="pages_1478423482" name="additional_file" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field onfour in pages_1478423482_signin_required" data-legion-field-type="select">
<label for="for_field_signin_required"><?=l('Signin Required<>يجب ان يكون مسجلاً');?></label>
<div class="input_area">
<select  id="for_field_signin_required" class="l_mc l_white_c" name="signin_required">
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
						<?= select_echo('pages_1478423482','signin_required',$_form_resp[$_i],true);?>
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


	

--><div class="form_field onfour in free_width pages_1478423482_with_share_functionality" data-legion-field-type="checkbox">
<label for="for_field_with_share_functionality"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input   checked  class="css-checkbox" type="checkbox" name="with_share_functionality"  id="<?=$rand='a'.rand(); ?>" />
			<label for="<?=$rand?>"><?=l('With Share Functionality<>مع خاصية المشاركة');?></label></div></div></div>
</div>
</div><!--


	

--><div class="form_field onfour in free_width pages_1478423482_with_messenger" data-legion-field-type="checkbox">
<label for="for_field_with_messenger"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input   checked  class="css-checkbox" type="checkbox" name="with_messenger"  id="<?=$rand='a'.rand(); ?>" />
			<label for="<?=$rand?>"><?=l('With Messenger<>مع صندوق المحادثة');?></label></div></div></div>
</div>
</div><!--

-->
<!--inputs above -->
<?php } ?>