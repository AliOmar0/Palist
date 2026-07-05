<?php 
$id=check_get_id();
$_form_resp=db('meepo_1646265283','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('meepo_1646265283','view') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<div id="meepo_1646265283_view_<?=$id;?>" class="viewActionDiv" data-id="<?=$id;?>" data-module="meepo_1646265283"><!--

		--><div class="view_box  meepo_1646265283_view_title  ">
<div class="view_label view_label_title"><?=l('Title<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['title'])?></div>
</div><!--

		--><div class="view_box  meepo_1646265283_view_html  ">
<div class="view_label view_label_html"><?=l('HTML<>')?></div>
<div class="viewValue  viewText mce "><?=l($_form_resp[0]['html'])?></div>
</div><!--

--></div>
<?php } ?>