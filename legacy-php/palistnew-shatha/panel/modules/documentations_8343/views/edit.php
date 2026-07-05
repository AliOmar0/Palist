<?php 
$original_edit_id=$id=check_get_id();
	$_form_resp=db('documentations_8343','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('documentations_8343','edit') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{
require_once cms_dir.'plugins/tinymce/backendTinyCall.php';?>
<form id="documentations_8343" autocomplete="off" action="" onsubmit="return submitter(this,'<?=isset($controllerURL)? $controllerURL:urlPanel?>');" method="post" enctype="multipart/form-data">
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="documentations_8343"/> 
<input type="hidden" name="action" value="edit"/> 
<input type="hidden" name="id" value="<?=$id;?>"/> 

<!--inputs below -->
<!--
	

--><div class="form_field  documentations_8343_title" data-legion-field-type="text">
<label for="for_field_title"><?=l('Title<>العنوان');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_title"  required type="text" name="title"   data-legion-module="documentations_8343" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['title']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  documentations_8343_content" data-legion-field-type="textarea">
<label for="for_field_content"><?=l('Content<>');?></label>
<div class="input_area">
<textarea   placeholder="" data-max_count="0"  class="" name="content"><?=$_form_resp[0]['content'] ?></textarea>
</div>
</div><!--


	

--><div class="form_field  documentations_8343_errors" data-legion-field-type="checkbox">
<label for="for_field_errors"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input <?=($_form_resp[0]['errors']==1 ? ' checked ':'');?>
 class=" css-checkbox" name="errors" type="checkbox" id="<?=$rand='a'.rand(); ?>"/>
			<label for="<?=$rand ?>"><?=l('Errors<>');?></label></div></div></div>
</div>
</div><!--

-->
<!--inputs above -->
</form>
<?php } ?>