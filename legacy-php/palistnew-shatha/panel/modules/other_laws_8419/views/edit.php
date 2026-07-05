<?php 
$original_edit_id=$id=check_get_id();
	$_form_resp=db('other_laws_8419','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('other_laws_8419','edit') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{
require_once cms_dir.'plugins/tinymce/backendTinyCall.php';?>
<form id="other_laws_8419" autocomplete="off" action="" onsubmit="return submitter(this,'<?=isset($controllerURL)? $controllerURL:urlPanel?>');" method="post" enctype="multipart/form-data">
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="other_laws_8419"/> 
<input type="hidden" name="action" value="edit"/> 
<input type="hidden" name="id" value="<?=$id;?>"/> 

<!--inputs below -->
<!--
	

--><div class="form_field  other_laws_8419_title" data-legion-field-type="text">
<label for="for_field_title"><?=l('Title<>');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_title"  required type="text" name="title"   data-legion-module="other_laws_8419" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['title']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  other_laws_8419_summary" data-legion-field-type="textarea">
<label for="for_field_summary"><?=l('Summary<>');?></label>
<div class="input_area">
<textarea   placeholder="" data-max_count="5,000"  class="" name="summary"><?=$_form_resp[0]['summary'] ?></textarea>
</div>
</div><!--


	

--><div class="form_field  other_laws_8419_content" data-legion-field-type="textarea">
<label for="for_field_content"><?=l('Content<>');?></label>
<div class="input_area">
<textarea   placeholder="" data-max_count="0"  class="" name="content"><?=$_form_resp[0]['content'] ?></textarea>
</div>
</div><!--

-->
<!--inputs above -->
</form>
<?php } ?>