<?php 
$id=check_get_id();
$_form_resp=db('pis_offices_8363','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('pis_offices_8363','view') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<div id="pis_offices_8363_view_<?=$id;?>" class="viewActionDiv" data-id="<?=$id;?>" data-module="pis_offices_8363"><!--

		--><div class="view_box  pis_offices_8363_view_title  ">
<div class="view_label view_label_title"><?=l('Title<>اسم المحافظة')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['title'])?></div>
</div><!--

		--><div class="view_box  pis_offices_8363_view_location  location_field ">
<div class="view_label view_label_location"><?=l('Location<>الموقع')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['location'])?></div>
</div><!--

--></div>
<?php } ?>