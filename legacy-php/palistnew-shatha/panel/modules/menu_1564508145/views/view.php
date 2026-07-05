<?php 
$id=check_get_id();
$_form_resp=db('menu_1564508145','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('menu_1564508145','view') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<div id="menu_1564508145_view_<?=$id;?>" class="viewActionDiv" data-id="<?=$id;?>" data-module="menu_1564508145"><!--

		--><div class="view_box  menu_1564508145_view_title  ">
<div class="view_label view_label_title"><?=l('Title<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['title'])?></div>
</div><!--

--></div>
<?php } ?>