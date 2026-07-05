<?php 
$id=check_get_id();
	$_form_resp=db('hash_words_1507402735','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('hash_words_1507402735','edit') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="hash_words_1507402735"/> 
<input type="hidden" name="action" value="edit"/> 
<input type="hidden" name="id" value="<?=$id;?>"/> 

<!--inputs below -->
<!--
	

--><div class="form_field ontwo in  hash_words_1507402735_hash" data-legion-field-type="text">
<label for="for_field_hash"><?=l('Hash<>المُؤشر');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_hash"  required type="text" name="hash"   data-legion-module="hash_words_1507402735" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['hash']) ?>"/>
</div>
</div><!--


	

--><div class="form_field ontwo in  hash_words_1507402735_php_variable" data-legion-field-type="text">
<label for="for_field_php_variable"><?=l('PHP Variable<>المتغير');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_php_variable"  required type="text" name="php_variable"   data-legion-module="hash_words_1507402735" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['php_variable']) ?>"/>
</div>
</div><!--

-->
<!--inputs above -->
<?php } ?>