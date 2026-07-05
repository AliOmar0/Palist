<?php 

$quickResp=db('quick_access_1563567918',"WHERE module_prefix='$module' AND action_of_module='$action' AND deleted='0'",NULL,'LIMIT 1','id,title_of_link');
					if(file_exists(modules_dir.'quick_access_1563567918/views/add.php') && privilege('quick_access_1563567918','add')){
?>
			<div class="below_bread_sub mid" id="add_quick_access"><i class="mid po <?php if($quickResp!=0 && $quickResp!=1)echo 'mainColorFontColor';?>">outlined_flag</i><span  class="mid po" onClick="toggle('add_quick_access_help')"><?=l('Add to Dashboard<>أضف للوحة الرئيسية')?></span>
				<div id="add_quick_access_help" class="hidden">
					<?=l('You can add this page to dashboard so you can quickly reach here<>تستطيع اضافة هذه الصفحة على اللوحة الرئيسية للوصول السريع')?>
				
<form  id="quick_access_1563567918" autocomplete="off" action="" onsubmit="return submitter(this,urlPanel);" method="post" enctype="multipart/form-data">
<input type="hidden" value="" name="noML"/>
<input type="hidden" value="" name="e"/>
<input type="hidden" value="" name="custom_link"/>
<input type="hidden" value="" name="icon"/>
<input type="hidden" name="module" value="quick_access_1563567918"/>
<?php																																	
	if($quickResp!=0 && $quickResp!=1){?>
		<input type="hidden" name="action" value="edit"/> 
	<input type="hidden" name="id" value="<?= $quickResp[0]['id'];?>"/> 

	<?php }else{
	?>
<input type="hidden" name="action" value="add"/> 
<?php }?>
	
<!--inputs below --> 
<input type="hidden" name="noAdditionalJSON" value="false"/>
<input  type="hidden" name="module_prefix" value="<?= $module;?>"/>
<input  type="hidden" name="action_of_module" value="<?= $action;?>"/>

<div class="form_field">
<div class="input_area">
	<input required type="text" name="title_of_link" placeholder="Title" value="<?php
	if($quickResp!=0 && $quickResp!=1)echo l($quickResp[0]['title_of_link']);
		else{																									   
	$module_details_quick=db('modules',"WHERE module_prefix='$module'",NULL,'LIMIT 1','id,module_name')[0];
	$tmp=db('module_actions',"WHERE type='$action' AND module_id='".$module_details_quick['id']."'",NULL,'LIMIT 1','title');
	echo $tmp==1?NULL:l($tmp[0]['title']).' '.l($module_details_quick['module_name']);	}			   
																																	  
	?>"/>
</div>
</div>

<!--inputs above -->
</form>
					
						<div id="" class="quick_btn bread_save   po" onClick="document.getElementById('quick_access_1563567918').onsubmit();"><i class="mid">done_all</i>Save</div>
				
					<?php if($quickResp!=0 && $quickResp!=1){?>
					<a onclick="showPop('!','Delete','Are you sure?','deleting','quick_access_1563567918', 'delete',<?= $quickResp[0]['id'];?>)" class="quick_btn bread_save  po " title="Delete"><i class="mid">delete</i> Delete</a>
					<?php }?>
					
				</div>
			</div>
				<?php }?>