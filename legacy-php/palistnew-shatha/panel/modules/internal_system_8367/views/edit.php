<?php 
$original_edit_id=$id=check_get_id();
	$_form_resp=db('internal_system_8367','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('internal_system_8367','edit') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<form id="internal_system_8367" autocomplete="off" action="" onsubmit="return submitter(this,'<?=isset($controllerURL)? $controllerURL:urlPanel?>');" method="post" enctype="multipart/form-data">
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="internal_system_8367"/> 
<input type="hidden" name="action" value="edit"/> 
<input type="hidden" name="id" value="<?=$id;?>"/> 

<!--inputs below -->
<!--
	

--><div class="form_field  internal_system_8367_pdf_file" data-legion-field-type="file">
<label for="for_field_pdf_file"><?=l('Pdf File<>ملف البي دي اف');?></label>
<div class="input_area">
<div class="po pvp_chooser" data-filetype="file" data-multi="false" onclick="pvp_core('internal_system_8367_pdf_file',false,true)"><img src="<?=$_form_resp[0]['pdf_file']=='' ? u.'file.png' : fileIcon($_form_resp[0]['pdf_file']);  ?>" /></div>
	<div class="in clearFiles po <?=$_form_resp[0]['pdf_file']=='' ? 'hidden':'' ?>" onclick="pvp_clear('internal_system_8367_pdf_file')"><i class="md-light">delete</i></div>
	
	<input type="hidden" name="pdf_file" value="<?=$_form_resp[0]['pdf_file']?>"/>
	
	<div class="count fileName"><?=l('Selected<>الملفات المُختارة')?> <span><?=$_form_resp[0]['pdf_file']=='' ? 0:count(explode(',',$_form_resp[0]['pdf_file'])) ?></span>
	</div><clear></clear>
	<div class="fileName po"><a target="_blank" href="<?=u.detail('files_1577206823','full_name','full_name',$_form_resp[0]['pdf_file'])?>"><?=detail('files_1577206823','original_name','full_name',$_form_resp[0]['pdf_file'])?></a></div>
	
	
	
</div>
</div><!--

-->
<!--inputs above -->
</form>
<?php } ?>