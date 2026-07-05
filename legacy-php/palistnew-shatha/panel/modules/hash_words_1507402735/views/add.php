<?php if(!privilege('hash_words_1507402735','add'))echo $noPermission;else{?>
<form id="hash_words_1507402735" autocomplete="off" action="" onsubmit="return submitter(this,'<?=isset($controllerURL)? $controllerURL:urlPanel?>');" method="post" enctype="multipart/form-data">
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="hash_words_1507402735"/> 
<input type="hidden" name="action" value="add"/>
<!--inputs below --> 
<!--
	

--><div class="form_field ontwo in hash_words_1507402735_hash" data-legion-field-type="text">
<label for="for_field_hash"><?=l('Hash<>المُؤشر');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_hash"  required type="text"  data-legion-module="hash_words_1507402735" name="hash" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field ontwo in hash_words_1507402735_php_variable" data-legion-field-type="text">
<label for="for_field_php_variable"><?=l('PHP Variable<>المتغير');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_php_variable"  required type="text"  data-legion-module="hash_words_1507402735" name="php_variable" placeholder="" value=""/>
</div>
</div><!--

-->
<!--inputs above -->
</form>
<?php } ?>