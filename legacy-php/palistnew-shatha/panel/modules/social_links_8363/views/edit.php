<?php 
$original_edit_id=$id=check_get_id();
	$_form_resp=db('social_links_8363','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('social_links_8363','edit') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<form id="social_links_8363" autocomplete="off" action="" onsubmit="return submitter(this,'<?=isset($controllerURL)? $controllerURL:urlPanel?>');" method="post" enctype="multipart/form-data">
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="social_links_8363"/> 
<input type="hidden" name="action" value="edit"/> 
<input type="hidden" name="id" value="<?=$id;?>"/> 

<!--inputs below -->
<!--
	

--><div class="form_field ontwo in  social_links_8363_title" data-legion-field-type="text">
<label for="for_field_title"><?=l('Title<>');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_title"  required type="text" name="title"   data-legion-module="social_links_8363" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['title']) ?>"/>
</div>
</div><!--


	

--><div class="form_field ontwo in  social_links_8363_link" data-legion-field-type="url">
<label for="for_field_link"><?=l('Link<>');?></label>
<div class="input_area">
<input id="for_field_link"  type="url" name="link"   data-legion-module="social_links_8363" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['link']) ?>"/>
</div>
</div><!--


	

--><div class="form_field ontwo in  social_links_8363_social_font" data-legion-field-type="text">
<label for="for_field_social_font"><?=l('Social Font<>');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_social_font"  required type="text" name="social_font"   data-legion-module="social_links_8363" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['social_font']) ?>"/>
</div>
</div><!--

-->
<!--inputs above -->
</form>
<?php } ?>