<?php 
$id=check_get_id();
	$_form_resp=db('syndicate_goals_8364','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('syndicate_goals_8364','edit') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="syndicate_goals_8364"/> 
<input type="hidden" name="action" value="edit"/> 
<input type="hidden" name="id" value="<?=$id;?>"/> 

<!--inputs below -->
<!--
	

--><div class="form_field  syndicate_goals_8364_title" data-legion-field-type="textarea">
<label for="for_field_title"><?=l('Title<>');?></label>
<div class="input_area">
<textarea   placeholder="" data-max_count="250"  class="mceNoEditor " name="title"><?=$_form_resp[0]['title'] ?></textarea>
</div>
</div><!--

-->
<!--inputs above -->
<?php } ?>