<?php 
$original_edit_id=$id=check_get_id();
	$_form_resp=db('codes_8311','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('codes_8311','edit') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<form id="codes_8311" autocomplete="off" action="" onsubmit="return submitter(this,'<?=isset($controllerURL)? $controllerURL:urlPanel?>');" method="post" enctype="multipart/form-data">
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="codes_8311"/> 
<input type="hidden" name="action" value="edit"/> 
<input type="hidden" name="id" value="<?=$id;?>"/> 

<!--inputs below -->
<!--
	

--><div class="form_field  codes_8311_title" data-legion-field-type="text">
<label for="for_field_title"><?=l('Title<>');?></label>
<div class="input_area">
<input id="for_field_title"  type="text" name="title"   data-legion-module="codes_8311" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['title']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  codes_8311_dimension" data-legion-field-type="number">
<label for="for_field_dimension"><?=l('Dimension<>');?></label>
<div class="input_area">
<input id="for_field_dimension"  type="number" name="dimension"   data-legion-module="codes_8311" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['dimension']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  codes_8311_value" data-legion-field-type="textarea">
<label for="for_field_value"><?=l('Value<>');?></label>
<div class="input_area">
<textarea   placeholder="" data-max_count="500"  class="mceNoEditor " name="value"><?=$_form_resp[0]['value'] ?></textarea>
</div>
</div><!--


	

--><div class="form_field  codes_8311_color" data-legion-field-type="color">
<label for="for_field_color"><?=l('Color<>');?></label>
<div class="input_area">
<input id="for_field_color"  type="color" name="color"   data-legion-module="codes_8311" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['color']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  codes_8311_hash_origin" data-legion-field-type="textarea">
<label for="for_field_hash_origin"><?=l('Hash Origin<>');?></label>
<div class="input_area">
<textarea   placeholder="" data-max_count="500"  class="mceNoEditor " name="hash_origin"><?=$_form_resp[0]['hash_origin'] ?></textarea>
</div>
</div><!--


	

--><div class="form_field  codes_8311_hash" data-legion-field-type="textarea">
<label for="for_field_hash"><?=l('Hash<>');?></label>
<div class="input_area">
<textarea   placeholder="" data-max_count="500"  class="mceNoEditor " name="hash"><?=$_form_resp[0]['hash'] ?></textarea>
</div>
</div><!--


	

--><div class="form_field  codes_8311_photo" data-legion-field-type="file">
<label for="for_field_photo"><?=l('Photo<>');?></label>
<div class="input_area">
<div class="po pvp_chooser" data-filetype="photo" data-multi="false" onclick="pvp_core('codes_8311_photo',false,false)"><img src="<?=u.($_form_resp[0]['photo']=='' ? 'photo.png' : img($_form_resp[0]['photo'],200,100));  ?>" /></div>
	<div class="in clearFiles po <?=$_form_resp[0]['photo']=='' ? 'h':'' ?>" onclick="pvp_clear('codes_8311_photo')"><i class="md-light">delete</i></div>
	
	<input type="hidden" name="photo" value="<?=$_form_resp[0]['photo']?>"/>
	
	<div class="count fileName"><?=l('Selected<>الملفات المُختارة')?> <span><?=$_form_resp[0]['photo']=='' ? 0:count(explode(',',$_form_resp[0]['photo'])) ?></span>
	</div><clear></clear>
	<div class="fileName po"><a target="_blank" href="<?=u.detail('files_1577206823','full_name','full_name',$_form_resp[0]['photo'])?>"><?=detail('files_1577206823','original_name','full_name',$_form_resp[0]['photo'])?></a></div>
	
	
	
</div>
</div><!--

-->
<!--inputs above -->
</form>
<?php } ?>