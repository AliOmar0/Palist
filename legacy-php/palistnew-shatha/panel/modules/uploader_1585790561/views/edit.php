<?php 
$original_edit_id=$id=check_get_id();
	$_form_resp=db('uploader_1585790561','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('uploader_1585790561','edit') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<form id="uploader_1585790561" autocomplete="off" action="" onsubmit="return submitter(this,'<?=isset($controllerURL)? $controllerURL:urlPanel?>');" method="post" enctype="multipart/form-data">
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="uploader_1585790561"/> 
<input type="hidden" name="action" value="edit"/> 
<input type="hidden" name="id" value="<?=$id;?>"/> 

<!--inputs below -->
<!--
	

--><div class="form_field  uploader_1585790561_photo" data-legion-field-type="file">
<label for="for_field_photo"><?=l('Photo<>');?></label>
<div class="input_area">
<div class="po pvp_chooser" data-filetype="photo" data-multi="false" onclick="pvp_core('uploader_1585790561_photo',false,false)"><img src="<?=u.($_form_resp[0]['photo']=='' ? 'photo.png' : img($_form_resp[0]['photo'],200,100));  ?>" /></div>
	<div class="in clearFiles po <?=$_form_resp[0]['photo']=='' ? 'h':'' ?>" onclick="pvp_clear('uploader_1585790561_photo')"><i class="md-light">delete</i></div>
	
	<input type="hidden" name="photo" value="<?=$_form_resp[0]['photo']?>"/>
	
	<div class="count fileName"><?=l('Selected<>الملفات المُختارة')?> <span><?=$_form_resp[0]['photo']=='' ? 0:count(explode(',',$_form_resp[0]['photo'])) ?></span>
	</div><clear></clear>
	<div class="fileName po"><a target="_blank" href="<?=u.detail('files_1577206823','full_name','full_name',$_form_resp[0]['photo'])?>"><?=detail('files_1577206823','original_name','full_name',$_form_resp[0]['photo'])?></a></div>
	
	
	
</div>
</div><!--


	

--><div class="form_field  uploader_1585790561_file" data-legion-field-type="file">
<label for="for_field_file"><?=l('File<>');?></label>
<div class="input_area">
<div class="po pvp_chooser" data-filetype="file" data-multi="false" onclick="pvp_core('uploader_1585790561_file',false,true)"><img src="<?=$_form_resp[0]['file']=='' ? u.'file.png' : fileIcon($_form_resp[0]['file']);  ?>" /></div>
	<div class="in clearFiles po <?=$_form_resp[0]['file']=='' ? 'h':'' ?>" onclick="pvp_clear('uploader_1585790561_file')"><i class="md-light">delete</i></div>
	
	<input type="hidden" name="file" value="<?=$_form_resp[0]['file']?>"/>
	
	<div class="count fileName"><?=l('Selected<>الملفات المُختارة')?> <span><?=$_form_resp[0]['file']=='' ? 0:count(explode(',',$_form_resp[0]['file'])) ?></span>
	</div><clear></clear>
	<div class="fileName po"><a target="_blank" href="<?=u.detail('files_1577206823','full_name','full_name',$_form_resp[0]['file'])?>"><?=detail('files_1577206823','original_name','full_name',$_form_resp[0]['file'])?></a></div>
	
	
	
</div>
</div><!--

-->
<!--inputs above -->
</form>
<?php } ?>