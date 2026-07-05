<?php 
$id=check_get_id();
$_form_resp=db('social_links_8363','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('social_links_8363','view') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<div id="social_links_8363_view_<?=$id;?>" class="viewActionDiv" data-id="<?=$id;?>" data-module="social_links_8363"><!--

		--><div class="view_box social_links_8363_view_title  ontwo in">
<div class="view_label view_label_title"><?=l("Title<>")?></div>
<div class="viewValue  "><?=l($_form_resp[0]['title'])?></div>
</div><!--

		--><div class="view_box social_links_8363_view_link  ontwo in">
<div class="view_label view_label_link"><?="Link"?></div>
<div class="viewValue  "><a href="<?=$_form_resp[0]['link'] ?>" target="_blank"><i>link</i></a></div>
</div><!--

		--><div class="view_box social_links_8363_view_social_font  ontwo in">
<div class="view_label view_label_social_font"><?="Social Font"?></div>
<div class="viewValue  "><?=l($_form_resp[0]['social_font'])?></div>
</div><!--

--></div>
<?php } ?>