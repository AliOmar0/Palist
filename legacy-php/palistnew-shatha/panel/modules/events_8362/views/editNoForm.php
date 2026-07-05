<?php 
$id=check_get_id();
	$_form_resp=db('events_8362','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('events_8362','edit') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{
require_once cms_dir.'plugins/tinymce/backendTinyCall.php';?>
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="events_8362"/> 
<input type="hidden" name="action" value="edit"/> 
<input type="hidden" name="id" value="<?=$id;?>"/> 

<!--inputs below -->
<!--
	

--><div class="form_field  events_8362_title" data-legion-field-type="text">
<label for="for_field_title"><?=l('Title<>العنوان');?></label>
<div class="input_area">
<input id="for_field_title"  type="text" name="title"   data-legion-module="events_8362" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['title']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  events_8362_event_date" data-legion-field-type="date">
<label for="for_field_event_date"><?=l('Event Date<>تاريخ المناسبة');?></label>
<div class="input_area">
<input id="for_field_event_date"  type="date" name="event_date"   data-legion-module="events_8362" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['event_date']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  events_8362_events_description" data-legion-field-type="textarea">
<label for="for_field_events_description"><?=l('Events Description<>وصف المناسبة');?></label>
<div class="input_area">
<textarea   placeholder="" data-max_count="0"  class="" name="events_description"><?=$_form_resp[0]['events_description'] ?></textarea>
</div>
</div><!--


	

--><div class="form_field  events_8362_photo" data-legion-field-type="file">
<label for="for_field_photo"><?=l('Photo<>صورة');?></label>
<div class="input_area">
<div class="po pvp_chooser" data-filetype="photo" data-multi="false" onclick="pvp_core('events_8362_photo',false,false)"><img src="<?=u.($_form_resp[0]['photo']=='' ? 'photo.png' : img($_form_resp[0]['photo'],200,100));  ?>" /></div>
	<div class="in clearFiles po <?=$_form_resp[0]['photo']=='' ? 'hidden':'' ?>" onclick="pvp_clear('events_8362_photo')"><i class="md-light">delete</i></div>
	
	<input type="hidden" name="photo" value="<?=$_form_resp[0]['photo']?>"/>
	
	<div class="count fileName"><?=l('Selected<>الملفات المُختارة')?> <span><?=$_form_resp[0]['photo']=='' ? 0:count(explode(',',$_form_resp[0]['photo'])) ?></span>
	</div><clear></clear>
	<div class="fileName po"><a target="_blank" href="<?=u.detail('files_1577206823','full_name','full_name',$_form_resp[0]['photo'])?>"><?=detail('files_1577206823','original_name','full_name',$_form_resp[0]['photo'])?></a></div>
	
	
	
</div>
</div><!--

-->
<!--inputs above -->
<?php } ?>