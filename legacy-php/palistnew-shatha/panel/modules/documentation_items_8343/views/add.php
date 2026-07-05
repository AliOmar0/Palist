<?php if(!privilege('documentation_items_8343','add'))echo $noPermission;else{
require_once cms_dir.'plugins/tinymce/backendTinyCall.php';?>
<form id="documentation_items_8343" autocomplete="off" action="" onsubmit="return submitter(this,'<?=isset($controllerURL)? $controllerURL:urlPanel?>');" method="post" enctype="multipart/form-data">
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="documentation_items_8343"/> 
<input type="hidden" name="action" value="add"/>
<!--inputs below --> 
<!--
	

--><div class="form_field documentation_items_8343_title" data-legion-field-type="text">
<label for="for_field_title"><?=l('Title<>');?></label>
<div class="input_area">
<input id="for_field_title"  type="text"  data-legion-module="documentation_items_8343" name="title" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field documentation_items_8343_documentation" data-legion-field-type="select">
<label for="for_field_documentation"><?=l('Documentation<>');?></label>
<div class="input_area">
<select  id="for_field_documentation" class="l_mc l_white_c" name="documentation">
<?php 
$addition_where=NULL;

$_form_resp=db('documentations_8343',"WHERE deleted=0   $addition_where",NULL,NULL);
			if($_form_resp==0){?><option value="0" selected><?=l('Error<>خطأ')?></option> <?php } 
			else if($_form_resp==1){?><option value="0" selected><?=l('Choose<>اختر');?></option><?php } 
				else {?>
                    <option value="0"><?=l('Choose<>اختر');?></option>
					<?php 
					$echoFields='title';
                    $x=explode(',',$echoFields);
					if($_form_resp!=1){
						for($_i=0;$_i<count($_form_resp);$_i++){?>
						<option value="<?=$_form_resp[$_i]['id']?>"><?php
						for($e=0;$e<count($x);$e++){
							if($x[$e]=='-')echo ' -';
							else {
								if($e!=0)echo ' ';
								echo l($_form_resp[$_i][$x[$e]]); 
							}
						 }
						 ?></option>
						
						<?php 
							}//for
						}
					}//else
					unset($_form_resp);
					?>
			</select>
			
</div>
</div><!--


	

--><div class="form_field documentation_items_8343_content" data-legion-field-type="textarea">
<label for="for_field_content"><?=l('Content<>');?></label>
<div class="input_area">
<textarea   placeholder="" data-max_count="0" class="" name="content"></textarea>
</div>
</div><!--


	

--><div class="form_field documentation_items_8343_additional_content" data-legion-field-type="textarea">
<label for="for_field_additional_content"><?=l('Additional Content<>');?>
<div class="help">
	<i>help_outline</i>
	<span><?=l('such as API response')?></span>
</div>
</label>
<div class="input_area">
<textarea   placeholder="" data-max_count="0" class="" name="additional_content"></textarea>
</div>
</div><!--


	

--><div class="form_field documentation_items_8343_order_number" data-legion-field-type="number">
<label for="for_field_order_number"><?=l('Order Number<>');?></label>
<div class="input_area">
<input id="for_field_order_number"  type="number"  data-legion-module="documentation_items_8343" name="order_number" placeholder="" value=""/>
</div>
</div><!--

-->
<!--inputs above -->
</form>
<?php } ?>