<?php 
$id=check_get_id();
$_form_resp=db('internal_system_8367','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('internal_system_8367','view') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<div id="internal_system_8367_view_<?=$id;?>" class="viewActionDiv" data-id="<?=$id;?>" data-module="internal_system_8367"><!--

		--><div class="view_box internal_system_8367_view_pdf_file ">
<div class="view_label view_label_pdf_file"><?="Pdf File"?></div>
<div class="viewValue  "><?php pic($_form_resp[0]['pdf_file'],200,100)?></div>
</div><!--

--></div>
<?php } ?>