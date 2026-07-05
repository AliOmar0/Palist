<?php 
$id=check_get_id();
$_form_resp=db('other_laws_8419','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('other_laws_8419','view') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<div id="other_laws_8419_view_<?=$id;?>" class="viewActionDiv" data-id="<?=$id;?>" data-module="other_laws_8419"><!--

		--><div class="view_box  other_laws_8419_view_title  ">
<div class="view_label view_label_title"><?=l('Title<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['title'])?></div>
</div><!--

		--><div class="view_box  other_laws_8419_view_summary  ">
<div class="view_label view_label_summary"><?=l('Summary<>')?></div>
<div class="viewValue  viewText mce "><?=l($_form_resp[0]['summary'])?></div>
</div><!--

		--><div class="view_box  other_laws_8419_view_content  ">
<div class="view_label view_label_content"><?=l('Content<>')?></div>
<div class="viewValue  viewText mce "><?=l($_form_resp[0]['content'])?></div>
</div><!--

--></div>
<?php } ?>