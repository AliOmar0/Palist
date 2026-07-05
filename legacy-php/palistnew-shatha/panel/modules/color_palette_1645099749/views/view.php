<?php 
$id=check_get_id();
$_form_resp=db('color_palette_1645099749','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('color_palette_1645099749','view') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<div id="color_palette_1645099749_view_<?=$id;?>" class="viewActionDiv" data-id="<?=$id;?>" data-module="color_palette_1645099749"><!--

		--><div class="view_box  color_palette_1645099749_view_name  ">
<div class="view_label view_label_name"><?=l('Name<>الاسم')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['name'])?></div>
</div><!--

		--><div class="view_box  color_palette_1645099749_view_color  ">
<div class="view_label view_label_color"><?=l('Color<>اللون')?></div>
<div class="viewValue  colorView style="background:<?=$_form_resp[0]['color']?>""></div>
</div><!--

--></div>
<?php } ?>