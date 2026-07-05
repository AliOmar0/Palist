<?php 
$original_edit_id=$id=check_get_id();
	$_form_resp=db('about_the_syndicate_8362','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('about_the_syndicate_8362','edit') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{
require_once cms_dir.'plugins/tinymce/backendTinyCall.php';?>
<form id="about_the_syndicate_8362" autocomplete="off" action="" onsubmit="return submitter(this,'<?=isset($controllerURL)? $controllerURL:urlPanel?>');" method="post" enctype="multipart/form-data">
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="about_the_syndicate_8362"/> 
<input type="hidden" name="action" value="edit"/> 
<input type="hidden" name="id" value="<?=$id;?>"/> 

<!--inputs below -->
<!--
	

--><div class="form_field  about_the_syndicate_8362_title" data-legion-field-type="text">
<label for="for_field_title"><?=l('Title<>العنوان');?></label>
<div class="input_area">
<input id="for_field_title"  type="text" name="title"   data-legion-module="about_the_syndicate_8362" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['title']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  about_the_syndicate_8362_photo" data-legion-field-type="file">
<label for="for_field_photo"><?=l('Photo<>الصورة');?></label>
<div class="input_area">
<div class="po pvp_chooser" data-filetype="photo" data-multi="false" onclick="pvp_core('about_the_syndicate_8362_photo',false,false)"><img src="<?=u.($_form_resp[0]['photo']=='' ? 'photo.png' : img($_form_resp[0]['photo'],200,100));  ?>" /></div>
	<div class="in clearFiles po <?=$_form_resp[0]['photo']=='' ? 'hidden':'' ?>" onclick="pvp_clear('about_the_syndicate_8362_photo')"><i class="md-light">delete</i></div>
	
	<input type="hidden" name="photo" value="<?=$_form_resp[0]['photo']?>"/>
	
	<div class="count fileName"><?=l('Selected<>الملفات المُختارة')?> <span><?=$_form_resp[0]['photo']=='' ? 0:count(explode(',',$_form_resp[0]['photo'])) ?></span>
	</div><clear></clear>
	<div class="fileName po"><a target="_blank" href="<?=u.detail('files_1577206823','full_name','full_name',$_form_resp[0]['photo'])?>"><?=detail('files_1577206823','original_name','full_name',$_form_resp[0]['photo'])?></a></div>
	
	
	
</div>
</div><!--


	

--><div class="form_field  about_the_syndicate_8362_photo_in_single" data-legion-field-type="file">
<label for="for_field_photo_in_single"><?=l('Photo_in_single<>');?></label>
<div class="input_area">
<div class="po pvp_chooser" data-filetype="photo" data-multi="false" onclick="pvp_core('about_the_syndicate_8362_photo_in_single',false,false)"><img src="<?=u.($_form_resp[0]['photo_in_single']=='' ? 'photo.png' : img($_form_resp[0]['photo_in_single'],200,100));  ?>" /></div>
	<div class="in clearFiles po <?=$_form_resp[0]['photo_in_single']=='' ? 'hidden':'' ?>" onclick="pvp_clear('about_the_syndicate_8362_photo_in_single')"><i class="md-light">delete</i></div>
	
	<input type="hidden" name="photo_in_single" value="<?=$_form_resp[0]['photo_in_single']?>"/>
	
	<div class="count fileName"><?=l('Selected<>الملفات المُختارة')?> <span><?=$_form_resp[0]['photo_in_single']=='' ? 0:count(explode(',',$_form_resp[0]['photo_in_single'])) ?></span>
	</div><clear></clear>
	<div class="fileName po"><a target="_blank" href="<?=u.detail('files_1577206823','full_name','full_name',$_form_resp[0]['photo_in_single'])?>"><?=detail('files_1577206823','original_name','full_name',$_form_resp[0]['photo_in_single'])?></a></div>
	
	
	
</div>
</div><!--


	

--><div class="form_field  about_the_syndicate_8362_summary" data-legion-field-type="textarea">
<label for="for_field_summary"><?=l('Summary<>ملخص');?></label>
<div class="input_area">
<textarea   placeholder="" data-max_count="250"  class="mceNoEditor " name="summary"><?=$_form_resp[0]['summary'] ?></textarea>
</div>
</div><!--


	

--><div class="form_field  about_the_syndicate_8362_content" data-legion-field-type="textarea">
<label for="for_field_content"><?=l('Content<>المحتوى');?></label>
<div class="input_area">
<textarea   placeholder="" data-max_count="0"  class="" name="content"><?=$_form_resp[0]['content'] ?></textarea>
</div>
</div><!--


	

--><div class="form_field  about_the_syndicate_8362_mission_icon" data-legion-field-type="file">
<label for="for_field_mission_icon"><?=l('Mission Icon<>ايقونة الرسالة');?></label>
<div class="input_area">
<div class="po pvp_chooser" data-filetype="photo" data-multi="false" onclick="pvp_core('about_the_syndicate_8362_mission_icon',false,false)"><img src="<?=u.($_form_resp[0]['mission_icon']=='' ? 'photo.png' : img($_form_resp[0]['mission_icon'],200,100));  ?>" /></div>
	<div class="in clearFiles po <?=$_form_resp[0]['mission_icon']=='' ? 'hidden':'' ?>" onclick="pvp_clear('about_the_syndicate_8362_mission_icon')"><i class="md-light">delete</i></div>
	
	<input type="hidden" name="mission_icon" value="<?=$_form_resp[0]['mission_icon']?>"/>
	
	<div class="count fileName"><?=l('Selected<>الملفات المُختارة')?> <span><?=$_form_resp[0]['mission_icon']=='' ? 0:count(explode(',',$_form_resp[0]['mission_icon'])) ?></span>
	</div><clear></clear>
	<div class="fileName po"><a target="_blank" href="<?=u.detail('files_1577206823','full_name','full_name',$_form_resp[0]['mission_icon'])?>"><?=detail('files_1577206823','original_name','full_name',$_form_resp[0]['mission_icon'])?></a></div>
	
	
	
</div>
</div><!--


	

--><div class="form_field  about_the_syndicate_8362_mission_title" data-legion-field-type="text">
<label for="for_field_mission_title"><?=l('Mission Title<>عنوان الرسالة');?></label>
<div class="input_area">
<input id="for_field_mission_title"  type="text" name="mission_title"   data-legion-module="about_the_syndicate_8362" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['mission_title']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  about_the_syndicate_8362_mission_content" data-legion-field-type="textarea">
<label for="for_field_mission_content"><?=l('Mission Content<>محتوى الرسالة');?></label>
<div class="input_area">
<textarea   placeholder="" data-max_count="0"  class="" name="mission_content"><?=$_form_resp[0]['mission_content'] ?></textarea>
</div>
</div><!--


	

--><div class="form_field  about_the_syndicate_8362_vision_icon" data-legion-field-type="file">
<label for="for_field_vision_icon"><?=l('Vision Icon<>أيقونة الرؤية');?></label>
<div class="input_area">
<div class="po pvp_chooser" data-filetype="photo" data-multi="false" onclick="pvp_core('about_the_syndicate_8362_vision_icon',false,false)"><img src="<?=u.($_form_resp[0]['vision_icon']=='' ? 'photo.png' : img($_form_resp[0]['vision_icon'],200,100));  ?>" /></div>
	<div class="in clearFiles po <?=$_form_resp[0]['vision_icon']=='' ? 'hidden':'' ?>" onclick="pvp_clear('about_the_syndicate_8362_vision_icon')"><i class="md-light">delete</i></div>
	
	<input type="hidden" name="vision_icon" value="<?=$_form_resp[0]['vision_icon']?>"/>
	
	<div class="count fileName"><?=l('Selected<>الملفات المُختارة')?> <span><?=$_form_resp[0]['vision_icon']=='' ? 0:count(explode(',',$_form_resp[0]['vision_icon'])) ?></span>
	</div><clear></clear>
	<div class="fileName po"><a target="_blank" href="<?=u.detail('files_1577206823','full_name','full_name',$_form_resp[0]['vision_icon'])?>"><?=detail('files_1577206823','original_name','full_name',$_form_resp[0]['vision_icon'])?></a></div>
	
	
	
</div>
</div><!--


	

--><div class="form_field  about_the_syndicate_8362_vision_title" data-legion-field-type="text">
<label for="for_field_vision_title"><?=l('Vision Title<>عنوان الرؤية');?></label>
<div class="input_area">
<input id="for_field_vision_title"  type="text" name="vision_title"   data-legion-module="about_the_syndicate_8362" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['vision_title']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  about_the_syndicate_8362_vision_content" data-legion-field-type="textarea">
<label for="for_field_vision_content"><?=l('Vision Content<>محتوى الرؤية');?></label>
<div class="input_area">
<textarea   placeholder="" data-max_count="0"  class="" name="vision_content"><?=$_form_resp[0]['vision_content'] ?></textarea>
</div>
</div><!--

-->
<!--inputs above -->
</form>
<?php } ?>