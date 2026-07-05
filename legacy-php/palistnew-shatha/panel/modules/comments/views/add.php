<?php if(!privilege('comments','add'))echo $noPermission;else{?>
<form id="comments" autocomplete="off" action="" onsubmit="return submitter(this,'<?=isset($controllerURL)? $controllerURL:urlPanel?>');" method="post" enctype="multipart/form-data">
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="comments"/> 
<input type="hidden" name="action" value="add"/>
<!--inputs below --> 
<!--
	

--><div class="form_field comments_module_prefix" data-legion-field-type="select">
<label for="for_field_module_prefix"><?=l('Module Prefix<>');?></label>
<div class="input_area">
<select  id="for_field_module_prefix" class="l_mc l_white_c" name="module_prefix">
<?php 
$addition_where=NULL;

$_form_resp=db('modules',"WHERE deleted=0   $addition_where",NULL,NULL);
			if($_form_resp==0){?><option value="0" selected><?=l('Error<>خطأ')?></option> <?php } 
			else if($_form_resp==1){?><option value="0" selected><?=l('Choose<>اختر');?></option><?php } 
				else {?>
                    <option value="0"><?=l('Choose<>اختر');?></option>
					<?php 
					$echoFields='module_name';
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


	

--><div class="form_field comments_related_id" data-legion-field-type="number">
<label for="for_field_related_id"><?=l('Related ID<>');?></label>
<div class="input_area">
<input id="for_field_related_id"  type="number"  data-legion-module="comments" name="related_id" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field comments_commenter_module" data-legion-field-type="select">
<label for="for_field_commenter_module"><?=l('Commenter Module<>');?></label>
<div class="input_area">
<select  id="for_field_commenter_module" class="l_mc l_white_c" name="commenter_module">
<?php 
$addition_where=NULL;

$_form_resp=db('modules',"WHERE deleted=0   $addition_where",NULL,NULL);
			if($_form_resp==0){?><option value="0" selected><?=l('Error<>خطأ')?></option> <?php } 
			else if($_form_resp==1){?><option value="0" selected><?=l('Choose<>اختر');?></option><?php } 
				else {?>
                    <option value="0"><?=l('Choose<>اختر');?></option>
					<?php 
					$echoFields='module_name';
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


	

--><div class="form_field comments_commenter_id" data-legion-field-type="number">
<label for="for_field_commenter_id"><?=l('Commenter ID<>');?></label>
<div class="input_area">
<input id="for_field_commenter_id"  type="number"  data-legion-module="comments" name="commenter_id" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field comments_comment" data-legion-field-type="textarea">
<label for="for_field_comment"><?=l('Comment<>');?> <span class="required_star">*</span></label>
<div class="input_area">
<textarea  required  placeholder="" data-max_count="500" class="mceNoEditor " name="comment"></textarea>
</div>
</div><!--

--><div class="big_group_wrap comments_additionalinfo"><div class="big_group"><?=l('Additional Info<>')?></div></div><!--
	

--><div class="form_field comments_remark" data-legion-field-type="text">
<label for="for_field_remark"><?=l('Remark<>');?>
<div class="help">
	<i>help_outline</i>
	<span><?=l('This is used for any comment that needs to be differentiated')?></span>
</div>
</label>
<div class="input_area">
<input id="for_field_remark"  type="text"  data-legion-module="comments" name="remark" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field comments_files" data-legion-field-type="file">
<label for="for_field_files"><?=l('Files<>');?></label>
<div class="input_area">

			<img class="po" onclick="browseFile(this)" src="<?=u.'files.png';  ?>"/> 
			
			<?php $rand_id="files_".rand();?>
			
			<input id="input_<?=$rand_id?>"   type="file" class="h" name="files[]" multiple  legionType="file" onchange="loadFile(event,this,'<?=$rand_id?>')"/>

<div><label></label><div class="in" id="<?=$rand_id?>">
	 
</div></div> 
	<label></label><div id="clear-input_<?=$rand_id?>" class="h clearFiles po" onClick="clearFiles('files','<?=$rand_id?>')"><i class="md-light">delete</i></div>

			
</div>
</div><!--

-->
<!--inputs above -->
</form>
<?php } ?>