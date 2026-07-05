<?php 
$id=check_get_id();
$_form_resp=db('hash_words_1507402735','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('hash_words_1507402735','view') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<div id="hash_words_1507402735_view_<?=$id;?>" class="viewActionDiv" data-id="<?=$id;?>" data-module="hash_words_1507402735"><!--

		--><div class="view_box  hash_words_1507402735_view_hash  ontwo in ">
<div class="view_label view_label_hash"><?=l('Hash<>المُؤشر')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['hash'])?></div>
</div><!--

		--><div class="view_box  hash_words_1507402735_view_php_variable  ontwo in ">
<div class="view_label view_label_php_variable"><?=l('PHP Variable<>المتغير')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['php_variable'])?></div>
</div><!--

--></div>
<?php } ?>