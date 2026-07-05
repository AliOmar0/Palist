<?php 
$id=check_get_id();
$_form_resp=db('codes_8311','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('codes_8311','view') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<div id="codes_8311_view_<?=$id;?>" class="viewActionDiv" data-id="<?=$id;?>" data-module="codes_8311"><!--

		--><div class="view_box  codes_8311_view_title  ">
<div class="view_label view_label_title"><?=l('Title<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['title'])?></div>
</div><!--

		--><div class="view_box  codes_8311_view_dimension  ">
<div class="view_label view_label_dimension"><?=l('Dimension<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['dimension'])?></div>
</div><!--

		--><div class="view_box  codes_8311_view_value  ">
<div class="view_label view_label_value"><?=l('Value<>')?></div>
<div class="viewValue  viewText mce "><?=l($_form_resp[0]['value'])?></div>
</div><!--

		--><div class="view_box  codes_8311_view_color  ">
<div class="view_label view_label_color"><?=l('Color<>')?></div>
<div class="viewValue  colorView style="background:<?=$_form_resp[0]['color']?>""></div>
</div><!--

		--><div class="view_box  codes_8311_view_hash_origin  ">
<div class="view_label view_label_hash_origin"><?=l('Hash Origin<>')?></div>
<div class="viewValue  viewText mce "><?=l($_form_resp[0]['hash_origin'])?></div>
</div><!--

		--><div class="view_box  codes_8311_view_hash  ">
<div class="view_label view_label_hash"><?=l('Hash<>')?></div>
<div class="viewValue  viewText mce "><?=l($_form_resp[0]['hash'])?></div>
</div><!--

		--><div class="view_box  codes_8311_view_photo  ">
<div class="view_label view_label_photo"><?=l('Photo<>')?></div>
<div class="viewValue  "><?php if($_form_resp[0]['photo']!='')pic($_form_resp[0]['photo'],200,100)?></div>
</div><!--

--></div>
<?php } ?>