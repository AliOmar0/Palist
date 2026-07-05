<?php 
$id=check_get_id();
	$_form_resp=db('control_1566842582','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('control_1566842582','edit') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{
require_once cms_dir.'plugins/tinymce/backendTinyCall.php';?>
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="control_1566842582"/> 
<input type="hidden" name="action" value="edit"/> 
<input type="hidden" name="id" value="<?=$id;?>"/> 

<!--inputs below -->
<!--
	

--><?php if(!isset($control_1566842582_title)){?><div class="form_field  control_1566842582_title" data-legion-field-type="text">
<label for="for_field_title"><?=l('Title<>العنوان');?></label>
<div class="input_area">
<input id="for_field_title"  type="text" name="title" data-l_is_ml="true" data-l_module="control_1566842582" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['title']) ?>"/>
</div>
</div><?php }?><!--
	

	

--><?php if(!isset($control_1566842582_code)){?><div class="form_field  control_1566842582_code" data-legion-field-type="text">
<label for="for_field_code"><?=l('Code<>مُعَرِّف خاص');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_code"  required type="text" name="code" data-l_unique="true" data-l_module="control_1566842582" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['code']) ?>"/>
</div>
</div><?php }?><!--
	

	

--><?php if(!isset($control_1566842582_photo)){?><div class="form_field ontwo in  control_1566842582_photo" data-legion-field-type="file">
<label for="for_field_photo"><?=l('Photo<>صورة');?></label>
<div class="input_area">
<div class="po pvp_chooser" data-filetype="photo" data-multi="false" onclick="pvp_core('control_1566842582_photo',false,false)"><img src="<?=u.($_form_resp[0]['photo']=='' ? 'photo.png' : img($_form_resp[0]['photo'],200,100));  ?>" /></div>
	<div class="in clearFiles po <?=$_form_resp[0]['photo']=='' ? 'h':'' ?>" onclick="pvp_clear('control_1566842582_photo')"><i class="md-light">delete</i></div>
	
	<input type="hidden" name="photo" value="<?=$_form_resp[0]['photo']?>"/>
	
	<div class="count fileName"><?=l('Selected<>الملفات المُختارة')?> <span><?=$_form_resp[0]['photo']=='' ? 0:count(explode(',',$_form_resp[0]['photo'])) ?></span>
	</div><clear></clear>
	<div class="fileName po"><a target="_blank" href="<?=u.detail('files_1577206823','full_name','full_name',$_form_resp[0]['photo'])?>"><?=detail('files_1577206823','original_name','full_name',$_form_resp[0]['photo'])?></a></div>
	
	
	
</div>
</div><?php }?><!--
	

	

--><?php if(!isset($control_1566842582_file)){?><div class="form_field ontwo in  control_1566842582_file" data-legion-field-type="file">
<label for="for_field_file"><?=l('File<>');?></label>
<div class="input_area">
<div class="po pvp_chooser" data-filetype="file" data-multi="false" onclick="pvp_core('control_1566842582_file',false,true)"><img src="<?=$_form_resp[0]['file']=='' ? u.'file.png' : fileIcon($_form_resp[0]['file']);  ?>" /></div>
	<div class="in clearFiles po <?=$_form_resp[0]['file']=='' ? 'h':'' ?>" onclick="pvp_clear('control_1566842582_file')"><i class="md-light">delete</i></div>
	
	<input type="hidden" name="file" value="<?=$_form_resp[0]['file']?>"/>
	
	<div class="count fileName"><?=l('Selected<>الملفات المُختارة')?> <span><?=$_form_resp[0]['file']=='' ? 0:count(explode(',',$_form_resp[0]['file'])) ?></span>
	</div><clear></clear>
	<div class="fileName po"><a target="_blank" href="<?=u.detail('files_1577206823','full_name','full_name',$_form_resp[0]['file'])?>"><?=detail('files_1577206823','original_name','full_name',$_form_resp[0]['file'])?></a></div>
	
	
	
</div>
</div><?php }?><!--
	

	

--><?php if(!isset($control_1566842582_color)){?><div class="form_field ontwo in  control_1566842582_color" data-legion-field-type="color">
<label for="for_field_color"><?=l('Color<>');?></label>
<div class="input_area">
<input id="for_field_color"  type="color" name="color" data-l_module="control_1566842582" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['color']) ?>"/>
</div>
</div><?php }?><!--
	

	

--><?php if(!isset($control_1566842582_active)){?><div class="form_field ontwo in  control_1566842582_active" data-legion-field-type="checkbox">
<label for="for_field_active"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input <?=($_form_resp[0]['active']==1 ? ' checked ':'');?>
 class=" css-checkbox" name="active" type="checkbox" id="<?=$rand='a'.rand(); ?>"/>
			<label for="<?=$rand ?>"><?=l('Active<>');?></label></div></div></div>
</div>
</div><?php }?><!--
	

	

--><?php if(!isset($control_1566842582_text)){?><div class="form_field  control_1566842582_text" data-legion-field-type="textarea">
<label for="for_field_text"><?=l('Text<>النص');?></label>
<div class="input_area">
<textarea  data-l_is_ml="true"  placeholder="" data-max_count="250"  class="mceNoEditor " name="text"><?=htmlentities($_form_resp[0]['text'])?></textarea>
</div>
</div><?php }?><!--
	

	

--><?php if(!isset($control_1566842582_formatted_text)){?><div class="form_field  control_1566842582_formatted_text" data-legion-field-type="textarea">
<label for="for_field_formatted_text"><?=l('Formatted Text<>النص الكامل');?></label>
<div class="input_area">
<textarea  data-l_is_ml="true"  placeholder="" data-max_count="0"  class="" name="formatted_text"><?=htmlentities($_form_resp[0]['formatted_text'])?></textarea>
</div>
</div><?php }?><!--
	
-->
<!--inputs above -->
<?php } ?>