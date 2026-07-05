<?php 
$id=check_get_id();
$_form_resp=db('seo_custom_852526','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('seo_custom_852526','view') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<div id="seo_custom_852526_view_<?=$id;?>" class="viewActionDiv" data-id="<?=$id;?>" data-module="seo_custom_852526"><!--

		--><div class="view_box view_group seo_custom_852526_view_Basic  ">
<div class="view_label view_label_Basic"><?=l('<>أساسي')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['Basic'])?></div>
</div><clear></clear><!--

		--><div class="view_box  seo_custom_852526_view_module_id  onfour in ">
<div class="view_label view_label_module_id"><?=l('Module ID<>')?></div>
<div class="viewValue  "><?php 
$addition_where=NULL;
$sub_resp=db('modules',"WHERE deleted=0  AND id='".$_form_resp[0]['module_id']."'  $addition_where",NULL,'LIMIT 1');
					echo select_echo('seo_custom_852526','module_id',$sub_resp[0],true);
                        ?></div>
</div><!--

		--><div class="view_box  seo_custom_852526_view_related_id  onfour in ">
<div class="view_label view_label_related_id"><?=l('Related ID<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['related_id'])?></div>
</div><clear></clear><!--

		--><div class="view_box view_group seo_custom_852526_view_Custom SEO  ">
<div class="view_label view_label_Custom SEO"><?=l('<>تخصيص لمحركات البحث')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['Custom SEO'])?></div>
</div><clear></clear><!--

		--><div class="view_box  seo_custom_852526_view_title  takeThree in ">
<div class="view_label view_label_title"><?=l('Title<>العنوان')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['title'])?></div>
</div><!--

		--><div class="view_box  seo_custom_852526_view_default_language  onfour in ">
<div class="view_label view_label_default_language"><?=l('Default Language<>')?></div>
<div class="viewValue  "><?php 
$addition_where=NULL;
$sub_resp=db('languages_1557157519',"WHERE deleted=0  AND id='".$_form_resp[0]['default_language']."'  $addition_where",NULL,'LIMIT 1');
					echo select_echo('seo_custom_852526','default_language',$sub_resp[0],true);
                        ?></div>
</div><!--

		--><div class="view_box  seo_custom_852526_view_description  ">
<div class="view_label view_label_description"><?=l('Description<>')?></div>
<div class="viewValue  viewText mce "><?=l($_form_resp[0]['description'])?></div>
</div><!--

		--><div class="view_box view_group seo_custom_852526_view_Basic  ">
<div class="view_label view_label_Basic"><?=l('<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['Basic'])?></div>
</div><clear></clear><!--

		--><div class="view_box view_group seo_custom_852526_view_Advanced  ">
<div class="view_label view_label_Advanced"><?=l('<>متقدم')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['Advanced'])?></div>
</div><clear></clear><!--

		--><div class="view_box  seo_custom_852526_view_meta  ontwo in ">
<div class="view_label view_label_meta"><?=l('Meta<>')?></div>
<div class="viewValue  viewText mce "><?=l($_form_resp[0]['meta'])?></div>
</div><!--

		--><div class="view_box  seo_custom_852526_view_type  onfour in ">
<div class="view_label view_label_type"><?=l('Type<>النوع')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['type'])?></div>
</div><!--

		--><div class="view_box  seo_custom_852526_view_photo  onfour in ">
<div class="view_label view_label_photo"><?=l('Photo<>')?></div>
<div class="viewValue  "><?php if($_form_resp[0]['photo']!='')pic($_form_resp[0]['photo'],200,100)?></div>
</div><!--

		--><div class="view_box view_group seo_custom_852526_view_Advanced  ">
<div class="view_label view_label_Advanced"><?=l('<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['Advanced'])?></div>
</div><clear></clear><!--

--></div>
<?php } ?>