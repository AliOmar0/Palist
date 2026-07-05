<?php 
$id=check_get_id();
	$_form_resp=db('members_8364','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('members_8364','edit') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{
require_once cms_dir.'plugins/tinymce/backendTinyCall.php';?>
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="members_8364"/> 
<input type="hidden" name="action" value="edit"/> 
<input type="hidden" name="id" value="<?=$id;?>"/> 

<!--inputs below -->
<!--
	

--><div class="form_field  members_8364_name" data-legion-field-type="text">
<label for="for_field_name"><?=l('Name<>الاسم');?></label>
<div class="input_area">
<input id="for_field_name"  type="text" name="name"   data-legion-module="members_8364" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['name']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  members_8364_job_name" data-legion-field-type="text">
<label for="for_field_job_name"><?=l('Job Name<>اسم الوظيفة');?></label>
<div class="input_area">
<input id="for_field_job_name"  type="text" name="job_name"   data-legion-module="members_8364" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['job_name']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  members_8364_photo" data-legion-field-type="file">
<label for="for_field_photo"><?=l('Photo<>صورة');?></label>
<div class="input_area">
<div class="po pvp_chooser" data-filetype="photo" data-multi="false" onclick="pvp_core('members_8364_photo',false,false)"><img src="<?=u.($_form_resp[0]['photo']=='' ? 'photo.png' : img($_form_resp[0]['photo'],200,100));  ?>" /></div>
	<div class="in clearFiles po <?=$_form_resp[0]['photo']=='' ? 'hidden':'' ?>" onclick="pvp_clear('members_8364_photo')"><i class="md-light">delete</i></div>
	
	<input type="hidden" name="photo" value="<?=$_form_resp[0]['photo']?>"/>
	
	<div class="count fileName"><?=l('Selected<>الملفات المُختارة')?> <span><?=$_form_resp[0]['photo']=='' ? 0:count(explode(',',$_form_resp[0]['photo'])) ?></span>
	</div><clear></clear>
	<div class="fileName po"><a target="_blank" href="<?=u.detail('files_1577206823','full_name','full_name',$_form_resp[0]['photo'])?>"><?=detail('files_1577206823','original_name','full_name',$_form_resp[0]['photo'])?></a></div>
	
	
	
</div>
</div><!--


	

--><div class="form_field  members_8364_summary" data-legion-field-type="textarea">
<label for="for_field_summary"><?=l('Summary<>');?></label>
<div class="input_area">
<textarea   placeholder="" data-max_count="250"  class="mceNoEditor " name="summary"><?=$_form_resp[0]['summary'] ?></textarea>
</div>
</div><!--


	

--><div class="form_field  members_8364_content" data-legion-field-type="textarea">
<label for="for_field_content"><?=l('Content<>المحتوى');?></label>
<div class="input_area">
<textarea   placeholder="" data-max_count="0"  class="" name="content"><?=$_form_resp[0]['content'] ?></textarea>
</div>
</div><!--


	

--><div class="form_field  members_8364_order_number" data-legion-field-type="text">
<label for="for_field_order_number"><?=l('Order Number<>');?></label>
<div class="input_area">
<input id="for_field_order_number"  type="text" name="order_number"   data-legion-module="members_8364" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['order_number']) ?>"/>
</div>
</div><!--

-->
<!--inputs above -->
<?php } ?>