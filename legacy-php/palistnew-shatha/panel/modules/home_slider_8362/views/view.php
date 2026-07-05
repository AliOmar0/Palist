<?php 
$id=check_get_id();
$_form_resp=db('home_slider_8362','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('home_slider_8362','view') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<div id="home_slider_8362_view_<?=$id;?>" class="viewActionDiv" data-id="<?=$id;?>" data-module="home_slider_8362"><!--

		--><div class="view_box  home_slider_8362_view_title  ">
<div class="view_label view_label_title"><?=l('Title<>العنوان')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['title'])?></div>
</div><!--

		--><div class="view_box  home_slider_8362_view_subtitle  ">
<div class="view_label view_label_subtitle"><?=l('Subtitle<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['subtitle'])?></div>
</div><!--

		--><div class="view_box  home_slider_8362_view_photo  ">
<div class="view_label view_label_photo"><?=l('Photo<>الصورة')?></div>
<div class="viewValue  "><?php if($_form_resp[0]['photo']!='')pic($_form_resp[0]['photo'],200,100)?></div>
</div><!--

		--><div class="view_box  home_slider_8362_view_video  ">
<div class="view_label view_label_video"><?=l('Video<>')?></div>
<div class="viewValue  ">
							<?php
							$tmp=$resp;
							$i=0;
							$resp=[['files'=>$_form_resp[0]['video']]];
							include cms_dir.'legion_files.php';
							$resp=$tmp;
							?>
							</div>
</div><!--

		--><div class="view_box  home_slider_8362_view_link  ">
<div class="view_label view_label_link"><?=l('Link<>الرابط')?></div>
<div class="viewValue  "><a href="<?=$_form_resp[0]['link'] ?>" target="_blank"><i>link</i></a></div>
</div><!--

		--><div class="view_box  home_slider_8362_view_order_number  ">
<div class="view_label view_label_order_number"><?=l('Order Number<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['order_number'])?></div>
</div><!--

--></div>
<?php } ?>