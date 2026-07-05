<?php 
$original_edit_id=$id=check_get_id();
	$_form_resp=db('home_videos_8429','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('home_videos_8429','edit') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<form id="home_videos_8429" autocomplete="off" action="" onsubmit="return submitter(this,'<?=isset($controllerURL)? $controllerURL:urlPanel?>');" method="post" enctype="multipart/form-data">
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="home_videos_8429"/> 
<input type="hidden" name="action" value="edit"/> 
<input type="hidden" name="id" value="<?=$id;?>"/> 

<!--inputs below -->
<!--
	

--><div class="form_field  home_videos_8429_video" data-legion-field-type="file">
<label for="for_field_video"><?=l('Video<>');?></label>
<div class="input_area">
<div class="po pvp_chooser" data-filetype="file" data-multi="false" onclick="pvp_core('home_videos_8429_video',false,true)"><img src="<?=$_form_resp[0]['video']=='' ? u.'file.png' : fileIcon($_form_resp[0]['video']);  ?>" /></div>
	<div class="in clearFiles po <?=$_form_resp[0]['video']=='' ? 'hidden':'' ?>" onclick="pvp_clear('home_videos_8429_video')"><i class="md-light">delete</i></div>
	
	<input type="hidden" name="video" value="<?=$_form_resp[0]['video']?>"/>
	
	<div class="count fileName"><?=l('Selected<>الملفات المُختارة')?> <span><?=$_form_resp[0]['video']=='' ? 0:count(explode(',',$_form_resp[0]['video'])) ?></span>
	</div><clear></clear>
	<div class="fileName po"><a target="_blank" href="<?=u.detail('files_1577206823','full_name','full_name',$_form_resp[0]['video'])?>"><?=detail('files_1577206823','original_name','full_name',$_form_resp[0]['video'])?></a></div>
	
	
	
</div>
</div><!--


	

--><div class="form_field  home_videos_8429_title" data-legion-field-type="text">
<label for="for_field_title"><?=l('Title<>');?></label>
<div class="input_area">
<input id="for_field_title"  type="text" name="title"   data-legion-module="home_videos_8429" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['title']) ?>"/>
</div>
</div><!--

-->
<!--inputs above -->
</form>
<?php } ?>