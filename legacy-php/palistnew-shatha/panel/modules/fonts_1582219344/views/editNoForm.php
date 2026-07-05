<?php 
$id=check_get_id();
	$_form_resp=db('fonts_1582219344','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('fonts_1582219344','edit') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="fonts_1582219344"/> 
<input type="hidden" name="action" value="edit"/> 
<input type="hidden" name="id" value="<?=$id;?>"/> 

<!--inputs below -->
<!--
	

--><div class="form_field  fonts_1582219344_css_name" data-legion-field-type="text">
<label for="for_field_css_name"><?=l('CSS Name<>اسم الخط');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_css_name"  required type="text" name="css_name" data-legion-unique="true"  data-legion-module="fonts_1582219344" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['css_name']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  fonts_1582219344_file" data-legion-field-type="file">
<label for="for_field_file"><?=l('File<>الملف');?> <span class="required_star">*</span></label>
<div class="input_area">
<div class="po pvp_chooser" data-filetype="file" data-multi="false" onclick="pvp_core('fonts_1582219344_file',false,true)"><img src="<?=$_form_resp[0]['file']=='' ? u.'file.png' : fileIcon($_form_resp[0]['file']);  ?>" /></div>
	<div class="in clearFiles po <?=$_form_resp[0]['file']=='' ? 'h':'' ?>" onclick="pvp_clear('fonts_1582219344_file')"><i class="md-light">delete</i></div>
	
	<input type="hidden" name="file" value="<?=$_form_resp[0]['file']?>"/>
	
	<div class="count fileName"><?=l('Selected<>الملفات المُختارة')?> <span><?=$_form_resp[0]['file']=='' ? 0:count(explode(',',$_form_resp[0]['file'])) ?></span>
	</div><clear></clear>
	<div class="fileName po"><a target="_blank" href="<?=u.detail('files_1577206823','full_name','full_name',$_form_resp[0]['file'])?>"><?=detail('files_1577206823','original_name','full_name',$_form_resp[0]['file'])?></a></div>
	
	
	
</div>
</div><!--

-->
<!--inputs above -->
<?php } ?>