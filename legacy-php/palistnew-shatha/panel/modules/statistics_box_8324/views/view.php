<?php 
$id=check_get_id();
$_form_resp=db('statistics_box_8324','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('statistics_box_8324','view') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<div id="statistics_box_8324_view_<?=$id;?>" class="viewActionDiv" data-id="<?=$id;?>" data-module="statistics_box_8324"><!--

		--><div class="view_box  statistics_box_8324_view_title  ">
<div class="view_label view_label_title"><?=l('Title<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['title'])?></div>
</div><!--

		--><div class="view_box  statistics_box_8324_view_css  ">
<div class="view_label view_label_css"><?=l('Css<>')?></div>
<div class="viewValue  viewText mce "><?=l($_form_resp[0]['css'])?></div>
</div><!--

		--><div class="view_box  statistics_box_8324_view_ids  ">
<div class="view_label view_label_ids"><?=l('IDs<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['ids'])?></div>
</div><!--

		--><div class="view_box  statistics_box_8324_view_order_number  ">
<div class="view_label view_label_order_number"><?=l('Order Number<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['order_number'])?></div>
</div><!--

		--><div class="view_box  statistics_box_8324_view_shortname  ">
<div class="view_label view_label_shortname"><?=l('Shortname<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['shortname'])?></div>
</div><!--

		--><div class="view_box  statistics_box_8324_view_dashboard  ">
<div class="view_label view_label_dashboard"><?=l('Dashboard<>')?></div>
<div class="viewValue  checkboxView "><i><?=$_form_resp[0]['dashboard']?'done':'close'?></i></div>
</div><!--

--></div>
<?php } ?>