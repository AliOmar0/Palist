<?php 
$id=check_get_id();
$_form_resp=db('high_school_country_8371','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('high_school_country_8371','view') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<div id="high_school_country_8371_view_<?=$id;?>" class="viewActionDiv" data-id="<?=$id;?>" data-module="high_school_country_8371"><!--

		--><div class="view_box high_school_country_8371_view_title ">
<div class="view_label view_label_title"><?=l("Title<>العنوان")?></div>
<div class="viewValue  "><?=l($_form_resp[0]['title'])?></div>
</div><!--

--></div>
<?php } ?>