<?php 
$id=check_get_id();
$_form_resp=db('syndicate_goals_8364','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('syndicate_goals_8364','view') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<div id="syndicate_goals_8364_view_<?=$id;?>" class="viewActionDiv" data-id="<?=$id;?>" data-module="syndicate_goals_8364"><!--

		--><div class="view_box syndicate_goals_8364_view_title ">
<div class="view_label view_label_title"><?=l("Title<>")?></div>
<div class="viewValue  viewText mce "><?=l($_form_resp[0]['title'])?></div>
</div><!--

--></div>
<?php } ?>