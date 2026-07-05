<?php 
$id=check_get_id();
	$_form_resp=db('home_slider_8362','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('home_slider_8362','edit') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="home_slider_8362"/> 
<input type="hidden" name="action" value="edit"/> 
<input type="hidden" name="id" value="<?=$id;?>"/> 

<!--inputs below -->
<!--
	

--><div class="form_field  home_slider_8362_title" data-legion-field-type="text">
<label for="for_field_title"><?=l('Title<>العنوان');?></label>
<div class="input_area">
<input id="for_field_title"  type="text" name="title"   data-legion-module="home_slider_8362" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['title']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  home_slider_8362_subtitle" data-legion-field-type="text">
<label for="for_field_subtitle"><?=l('Subtitle<>');?></label>
<div class="input_area">
<input id="for_field_subtitle"  type="text" name="subtitle"   data-legion-module="home_slider_8362" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['subtitle']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  home_slider_8362_photo" data-legion-field-type="file">
<label for="for_field_photo"><?=l('Photo<>الصورة');?></label>
<div class="input_area">
<div class="po pvp_chooser" data-filetype="photo" data-multi="false" onclick="pvp_core('home_slider_8362_photo',false,false)"><img src="<?=u.($_form_resp[0]['photo']=='' ? 'photo.png' : img($_form_resp[0]['photo'],200,100));  ?>" /></div>
	<div class="in clearFiles po <?=$_form_resp[0]['photo']=='' ? 'hidden':'' ?>" onclick="pvp_clear('home_slider_8362_photo')"><i class="md-light">delete</i></div>
	
	<input type="hidden" name="photo" value="<?=$_form_resp[0]['photo']?>"/>
	
	<div class="count fileName"><?=l('Selected<>الملفات المُختارة')?> <span><?=$_form_resp[0]['photo']=='' ? 0:count(explode(',',$_form_resp[0]['photo'])) ?></span>
	</div><clear></clear>
	<div class="fileName po"><a target="_blank" href="<?=u.detail('files_1577206823','full_name','full_name',$_form_resp[0]['photo'])?>"><?=detail('files_1577206823','original_name','full_name',$_form_resp[0]['photo'])?></a></div>
	
	
	
</div>
</div><!--


	

--><div class="form_field  home_slider_8362_video" data-legion-field-type="file">
<label for="for_field_video"><?=l('Video<>');?></label>
<div class="input_area">
<div class="po pvp_chooser" data-filetype="file" data-multi="false" onclick="pvp_core('home_slider_8362_video',false,true)"><img src="<?=$_form_resp[0]['video']=='' ? u.'file.png' : fileIcon($_form_resp[0]['video']);  ?>" /></div>
	<div class="in clearFiles po <?=$_form_resp[0]['video']=='' ? 'hidden':'' ?>" onclick="pvp_clear('home_slider_8362_video')"><i class="md-light">delete</i></div>
	
	<input type="hidden" name="video" value="<?=$_form_resp[0]['video']?>"/>
	
	<div class="count fileName"><?=l('Selected<>الملفات المُختارة')?> <span><?=$_form_resp[0]['video']=='' ? 0:count(explode(',',$_form_resp[0]['video'])) ?></span>
	</div><clear></clear>
	<div class="fileName po"><a target="_blank" href="<?=u.detail('files_1577206823','full_name','full_name',$_form_resp[0]['video'])?>"><?=detail('files_1577206823','original_name','full_name',$_form_resp[0]['video'])?></a></div>
	
	
	
</div>
</div><!--


	

--><div class="form_field  home_slider_8362_link" data-legion-field-type="url">
<label for="for_field_link"><?=l('Link<>الرابط');?></label>
<div class="input_area">
<input id="for_field_link"  type="url" name="link"   data-legion-module="home_slider_8362" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['link']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  home_slider_8362_order_number" data-legion-field-type="number">
<label for="for_field_order_number"><?=l('Order Number<>');?></label>
<div class="input_area">
<input id="for_field_order_number"  type="number" name="order_number"   data-legion-module="home_slider_8362" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['order_number']) ?>"/>
</div>
</div><!--

-->
<!--inputs above -->
<?php } ?>