<?php 
$id=check_get_id();
$_form_resp=db('photos_8366','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('photos_8366','view') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<div id="photos_8366_view_<?=$id;?>" class="viewActionDiv" data-id="<?=$id;?>" data-module="photos_8366"><!--

		--><div class="view_box photos_8366_view_photo ">
<div class="view_label view_label_photo"><?="Photo"?></div>
<div class="viewValue  "><?php pic($_form_resp[0]['photo'],200,100)?></div>
</div><!--

		--><div class="view_box photos_8366_view_album_category ">
<div class="view_label view_label_album_category"><?="Album Category"?></div>
<div class="viewValue  "><?php 
$addition_where=NULL;
$sub_resp=db('photos_library__8366',"WHERE deleted=0  AND id='".$_form_resp[0]['album_category']."'  $addition_where",NULL,'LIMIT 1');
                    $echoFields='title';
                    $x=explode(',',$echoFields);
                    for($e=0;$e<count($x);$e++){
                        if($x[$e]=='-')echo ' -';
                        else {
                            if($e!=0)echo ' ';
                            echo l($sub_resp[0][$x[$e]]); 
                        }
                        }
                        ?></div>
</div><!--

--></div>
<?php } ?>