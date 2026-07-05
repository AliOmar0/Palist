<?php 
$id=check_get_id();
	$_form_resp=db('trainings_and_workshops_8419','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('trainings_and_workshops_8419','edit') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{
require_once cms_dir.'plugins/tinymce/backendTinyCall.php';?>
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="trainings_and_workshops_8419"/> 
<input type="hidden" name="action" value="edit"/> 
<input type="hidden" name="id" value="<?=$id;?>"/> 

<!--inputs below -->
<!--
	

--><div class="form_field  trainings_and_workshops_8419_title" data-legion-field-type="text">
<label for="for_field_title"><?=l('Title<>');?></label>
<div class="input_area">
<input id="for_field_title"  type="text" name="title"   data-legion-module="trainings_and_workshops_8419" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['title']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  trainings_and_workshops_8419_summary" data-legion-field-type="textarea">
<label for="for_field_summary"><?=l('Summary<>');?></label>
<div class="input_area">
<textarea   placeholder="" data-max_count="250"  class="mceNoEditor " name="summary"><?=$_form_resp[0]['summary'] ?></textarea>
</div>
</div><!--


	

--><div class="form_field  trainings_and_workshops_8419_content" data-legion-field-type="textarea">
<label for="for_field_content"><?=l('Content<>');?></label>
<div class="input_area">
<textarea   placeholder="" data-max_count="0"  class="" name="content"><?=$_form_resp[0]['content'] ?></textarea>
</div>
</div><!--


	

--><div class="form_field  trainings_and_workshops_8419_photo" data-legion-field-type="file">
<label for="for_field_photo"><?=l('Photo<>');?></label>
<div class="input_area">
<div class="po pvp_chooser" data-filetype="photo" data-multi="false" onclick="pvp_core('trainings_and_workshops_8419_photo',false,false)"><img src="<?=u.($_form_resp[0]['photo']=='' ? 'photo.png' : img($_form_resp[0]['photo'],200,100));  ?>" /></div>
	<div class="in clearFiles po <?=$_form_resp[0]['photo']=='' ? 'h':'' ?>" onclick="pvp_clear('trainings_and_workshops_8419_photo')"><i class="md-light">delete</i></div>
	
	<input type="hidden" name="photo" value="<?=$_form_resp[0]['photo']?>"/>
	
	<div class="count fileName"><?=l('Selected<>الملفات المُختارة')?> <span><?=$_form_resp[0]['photo']=='' ? 0:count(explode(',',$_form_resp[0]['photo'])) ?></span>
	</div><clear></clear>
	<div class="fileName po"><a target="_blank" href="<?=u.detail('files_1577206823','full_name','full_name',$_form_resp[0]['photo'])?>"><?=detail('files_1577206823','original_name','full_name',$_form_resp[0]['photo'])?></a></div>
	
	
	
</div>
</div><!--


	

--><div class="form_field  trainings_and_workshops_8419_publish_date" data-legion-field-type="date">
<label for="for_field_publish_date"><?=l('Publish Date<>');?></label>
<div class="input_area">
<input id="for_field_publish_date"  type="date" name="publish_date"   data-legion-module="trainings_and_workshops_8419" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['publish_date']) ?>"/>
</div>
</div><!--

-->
<!--inputs above -->
<?php } ?>