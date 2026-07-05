<?php if(!privilege('internal_system_8367','add'))echo $noPermission;else{?>
<form id="internal_system_8367" autocomplete="off" action="" onsubmit="return submitter(this,'<?=isset($controllerURL)? $controllerURL:urlPanel?>');" method="post" enctype="multipart/form-data">
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="internal_system_8367"/> 
<input type="hidden" name="action" value="add"/>
<!--inputs below --> 
<!--
	

--><div class="form_field internal_system_8367_pdf_file" data-legion-field-type="file">
<label for="for_field_pdf_file"><?=l('Pdf File<>ملف البي دي اف');?></label>
<div class="input_area">
<div class="po pvp_chooser" data-filetype="file" data-multi="false" onclick="pvp_core('internal_system_8367_pdf_file',false,true)"><img src="<?=u?>file.png"></div>
	<div class="in clearFiles po hidden" onclick="pvp_clear('internal_system_8367_pdf_file')"><i class="md-light">delete</i></div>
	<input type="hidden" name="pdf_file"/>
	<div class="count fileName in"><?=l('Selected<>الملفات المُختارة')?> <span>0</span></div>
	
</div>
</div><!--

-->
<!--inputs above -->
</form>
<?php } ?>