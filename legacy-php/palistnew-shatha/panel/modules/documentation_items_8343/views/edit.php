<?php 
$original_edit_id=$id=check_get_id();
	$_form_resp=db('documentation_items_8343','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('documentation_items_8343','edit') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{
require_once cms_dir.'plugins/tinymce/backendTinyCall.php';?>
<form id="documentation_items_8343" autocomplete="off" action="" onsubmit="return submitter(this,'<?=isset($controllerURL)? $controllerURL:urlPanel?>');" method="post" enctype="multipart/form-data">
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="documentation_items_8343"/> 
<input type="hidden" name="action" value="edit"/> 
<input type="hidden" name="id" value="<?=$id;?>"/> 

<!--inputs below -->
<!--
	

--><div class="form_field  documentation_items_8343_title" data-legion-field-type="text">
<label for="for_field_title"><?=l('Title<>');?></label>
<div class="input_area">
<input id="for_field_title"  type="text" name="title"   data-legion-module="documentation_items_8343" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['title']) ?>"/>
</div>
</div><!--


	

--><div class="form_field  documentation_items_8343_documentation" data-legion-field-type="select">
<label for="for_field_documentation"><?=l('Documentation<>');?></label>
<div class="input_area">

<select  id="for_field_documentation" class="l_mc l_white_c" name="documentation">
<?php 
$addition_where=NULL;
	
$_form_sub_resp=db('documentations_8343',"WHERE deleted=0    $addition_where",NULL);
			if($_form_sub_resp==0){?><option value="0" selected><?=l('Error<>خطأ')?></option><?php } 
			else if($_form_sub_resp==1){?><option value="0" selected><?=l('Choose<>اختر');?></option><?php } 
				 else { ?>
                 <option value="0" <?=(0==$_form_resp[0]['documentation']?'selected':'')?>><?=l('Choose<>اختر');?></option>
				<?php
					$echoFields='title';
					$x=explode(',',$echoFields);
					if($_form_sub_resp!=1){
						for($j=0;$j<count($_form_sub_resp);$j++){?>
						<option <?=($_form_sub_resp[$j]['id']==$_form_resp[0]['documentation'] ? 'selected' : ''); ?> class="l_mc l_white_c" value="<?=$_form_sub_resp[$j]['id']?>"><?php 
							for($e=0;$e<count($x);$e++){
								if($x[$e]=='-')echo ' -';
								else {
									if($e!=0)echo ' ';
									echo l($_form_sub_resp[$j][$x[$e]]); 
								}
							}
						?></option>
						
				<?php 
						}//for
					}
				}//else 
				unset($_form_sub_resp);
				?>
			</select>
			
</div>
</div><!--


	

--><div class="form_field  documentation_items_8343_content" data-legion-field-type="textarea">
<label for="for_field_content"><?=l('Content<>');?></label>
<div class="input_area">
<textarea   placeholder="" data-max_count="0"  class="" name="content"><?=$_form_resp[0]['content'] ?></textarea>
</div>
</div><!--


	

--><div class="form_field  documentation_items_8343_additional_content" data-legion-field-type="textarea">
<label for="for_field_additional_content"><?=l('Additional Content<>');?>
<div class="help">
	<i>help_outline</i>
	<span><?=l('such as API response')?></span>
</div>
</label>
<div class="input_area">
<textarea   placeholder="" data-max_count="0"  class="" name="additional_content"><?=$_form_resp[0]['additional_content'] ?></textarea>
</div>
</div><!--


	

--><div class="form_field  documentation_items_8343_order_number" data-legion-field-type="number">
<label for="for_field_order_number"><?=l('Order Number<>');?></label>
<div class="input_area">
<input id="for_field_order_number"  type="number" name="order_number"   data-legion-module="documentation_items_8343" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['order_number']) ?>"/>
</div>
</div><!--

-->
<!--inputs above -->
</form>
<?php } ?>