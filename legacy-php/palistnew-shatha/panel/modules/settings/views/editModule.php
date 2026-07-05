<?php if(!privilege('settings','editModule'))echo $noPermission;else{?>

<div class="module_page_title">Sort Installed Modules
	<div class="toggle pointer" onClick="toggleArrow('sort_modules_cont',this);"><i >arrow_drop_down</i></div>
</div>

<div id="sort_modules_cont" class="hidden modules_cont">
<form action="" onsubmit="return submitter(this,urlPanel);" method="post" enctype="multipart/form-data">
<input type="hidden" value="" name="e"/>
<input type="hidden" name="action" value="sort_modules"/> 
<input type="hidden" name="module" value="settings"/> 
<ol class="sortable" id="sortable_div">
<?php 
	$resp=db('modules',NULL,"ORDER BY order_by",NULL,'id,module_name,module_prefix,version,restricted,core,external_access,commerce');
			if($resp==0)  echo 'error';
			else if($resp==1) echo 'No Data';
			else { for($i=0;$i<count($resp);$i++){?>
<li class="module_item move noselect"><div><input class="displayNone" type="number" name="sort_module[]" value="<?php echo $resp[$i]['id']?>"/>
	<?php if($resp[$i]['core']==1){?><div class="core_indicator_block mid"><?php echo l('Core<>اساسي');?></div><?php } ?>
	<?php if($resp[$i]['commerce']==1){?><div class="commerce_indicator_block mid"><?php echo l('Commerce<>تجاري');?></div><?php } ?>
	<?php echo l($resp[$i]['module_name']);?></div><i >gamepad</i></li>
				<?php }//for
			}//else
			?>
</ol>
<input type="submit" class="btn main_color_bg" value="Save"/>		
</form>
</div>
<clear></clear>




<div class="module_page_title">Restricted Modules
	<div class="toggle pointer" onClick="toggleArrow('restricted_cont',this);"><i >arrow_drop_down</i></div>
</div>
<div id="restricted_cont" class="hidden modules_cont">
<?php
	for($i=0;$i<count($resp);$i++){
	if($resp[$i]['restricted']){
	?>
<div class="module_box">
<a onClick="showPop('!','Empty <?php echo $resp[$i]['module_prefix'] ?> Table','Are you sure? Damage will occur','Erasing','empty_table','','\'<?php echo $resp[$i]['module_prefix'] ?>\'');" class="module_option empty_module pointer mid" title="Empty this Table"><i >rounded_corner</i>Empty</a><!--

--><a onClick="showPop('!','Unrestrict <?php echo l($resp[$i]['module_name']) ?> module','Are you sure?','Unrestricting','toggle_restrict','','\'<?php echo $resp[$i]['module_prefix'] ?>\'');" class="module_option pointer unrestrict_module  mid" title="Restrict this module"><i >lock_open</i>Unrestrict</a><!--

--><a onclick="return submitter(null,urlPanel,'deactivating',{ 'action' : 'deactivate_module','module' : 'settings','module_folder':'<?php echo $resp[$i]['module_prefix'];?>','e':''},'post',false);" class="module_option pointer delete_module  mid"><i >delete_forever</i>Delete</a>

	<div class="module_version mid"><span>V.</span><?php echo $resp[$i]['version'];?></div>
	<div class="module_name mid">
		<?php if($resp[$i]['core']==1){?><div class="core_indicator_block mid"><?php echo l('Core<>اساسي');?></div><?php } ?>
		<?php if($resp[$i]['commerce']==1){?><div class="commerce_indicator_block mid"><?php echo l('Commerce<>تجاري');?></div><?php } ?>
		<?php echo l($resp[$i]['module_name']);?></div>
	<div class="module_prefix mid"><?php echo $resp[$i]['module_prefix'];?></div>
</div>
<?php }//if
}//for
 ?> 
</div>



<div class="module_page_title">Installed Modules
	<div class="toggle pointer" onClick="toggleArrow('installed_cont',this);return submitter(null,urlPanel,'switching',{ 'action' : 'unfoldInstalled','module' : 'settings','module_folder':'','e':''},'post',false);"><i ><?php echo $settings['unfoldInstalled']==0 ? 'arrow_drop_down':'arrow_drop_up';?></i></div>
</div>
<div id="installed_cont" class="modules_cont <?php if($settings['unfoldInstalled']==0)echo 'hidden';?>">
<?php
	for($i=0;$i<count($resp);$i++){
	if(!$resp[$i]['restricted']){
	?>
<div class="module_box">
<a onClick="showPop('!','Empty <?php echo $resp[$i]['module_prefix'] ?> Table','Are you sure? Damage will occur','Erasing','empty_table','','\'<?php echo $resp[$i]['module_prefix'] ?>\'');" class="module_option empty_module pointer mid" title="Empty this Table"><i >rounded_corner</i>Empty</a><!--

--><a onClick="showPop('!','Restrict <?php echo l($resp[$i]['module_name']); ?> module','Are you sure?','Restricting','toggle_restrict','','\'<?php echo $resp[$i]['module_prefix'] ?>\'');" class="module_option pointer unrestrict_module  mid" title="Restrict this module"><i >lock</i>Restrict</a><!--

--><a onclick="return submitter(null,urlPanel,'deactivating',{ 'action' : 'deactivate_module','module' : 'settings','module_folder':'<?php echo $resp[$i]['module_prefix'];?>','e':''},'post',false);" class="module_option pointer delete_module  mid"><i >delete_forever</i>Delete</a><!--

--><a onClick="showPop('!','Toggle External Access <?php echo l($resp[$i]['module_name']); ?> module','Are you sure?','Toggling','toggle_external_access','','\'<?php echo $resp[$i]['module_prefix'] ?>\'');" class="module_option pointer <?php if($resp[$i]['external_access']==1)echo 'external_module_on blink';else echo 'external_module_off'; ?>  mid" title="<?php if($resp[$i]['external_access']==1)echo 'Revoke';else echo 'Allow'; ?> External Access this module"><i >device_hub</i><?php if($resp[$i]['external_access']==1)echo 'Revoke';else echo 'Allow'; ?> External Access</a>

	<div class="module_version mid"><span>V.</span><?php echo $resp[$i]['version'];?></div>
	<div class="module_name mid">
		<?php if($resp[$i]['core']==1){?><div class="core_indicator_block mid"><?php echo l('Core<>اساسي');?></div><?php } ?>
		<?php if($resp[$i]['commerce']==1){?><div class="commerce_indicator_block mid"><?php echo l('Commerce<>تجاري');?></div><?php } ?>
		<?php echo l($resp[$i]['module_name']);?></div>
	<div class="module_prefix mid"><?php echo $resp[$i]['module_prefix'];?></div>
	<div class="module_id mid">ID <?=$resp[$i]['id']?></div>
</div>
<?php }//if
}//for
 ?> 
</div>


<?php
$legionAPI=docurl('https://legioncms.com/api/1.0/',array('api'=>'modules','website_link'=>cms_url,'legion_version'=>version),true);
?>


<div class="module_page_title">Updates</div>
<div id="update_cont" class="modules_cont">
	<?php
		for($i=0;$i<count($resp);$i++){
			if($resp[$i]['restricted'])continue;
			if(!isset($legionAPI['data']['modules'][$resp[$i]['module_prefix']]))continue;
			if($resp[$i]['version']!=$legionAPI['data']['modules'][$resp[$i]['module_prefix']]['version']){?>
				
	<div class="module_box">
		 <a onclick="return submitter(null,urlPanel,'updating',{ 'module':'settings', 'action' : 'update_module','legion_zip_folder' : '<?php echo $legionAPI['data']['legion_module_dir']; ?>','module_folder':'<?php echo $resp[$i]['module_prefix'];?>','e':''},'post',false);" class="module_option pointer update_module  mid"><i >swap_horiz</i>Update</a>

	<div class="module_version mid new_version modernG"><span>V.</span><?php echo $legionAPI['data']['modules'][$resp[$i]['module_prefix']]['version'];?></div>
	<div class="module_version mid"><span>V.</span><?php echo $resp[$i]['version'];?></div>
	<div class="module_name mid">
		<?php if($resp[$i]['core']==1){?><div class="core_indicator_block mid"><?php echo l('Core<>اساسي');?></div><?php } ?>
		<?php if($resp[$i]['commerce']==1){?><div class="commerce_indicator_block mid"><?php echo l('Commerce<>تجاري');?></div><?php } ?>
		<?php echo l($resp[$i]['module_name']);?></div>
	<div class="module_prefix mid"><?php echo $resp[$i]['module_prefix'];?></div>
	
 </div>
			<?php }
		}
	?>
</div>


<div class="module_page_title"><?=l('Modules Not Installed for<>برمجيات غير نازلة لـ')?> <?php echo l($settings['site_name']);?></div>
<div id="update_cont" class="modules_cont">
	<?php
	if(is_array($legionAPI['data']['modules'])){
	$legion_unassociative_array= array_values($legionAPI['data']['modules']);
		for($i=0;$i<count($legion_unassociative_array);$i++){
			if(!$legion_unassociative_array[$i]['this_website'])continue;
			if(db('modules',"WHERE module_prefix='".$legion_unassociative_array[$i]['module_zip']."'",NULL,"LIMIT 1","id")==1){?>
				
	<div class="module_box">
		<?php $module_on_legion=$legion_unassociative_array[$i]['legion_version'].'.'.$legion_unassociative_array[$i]['legion_build'];?>
		<?php if($module_on_legion>=version){?>
		 <a onclick="return submitter(null,urlPanel,'updating',{ 'module':'settings', 'action' : 'activate_module','legion_zip_folder' : '<?php echo $legionAPI['data']['legion_module_dir']; ?>','module_folder':'<?php echo $legion_unassociative_array[$i]['module_zip'];?>','e':''},'post',false);" class="module_option pointer install_module  mid"><i >get_app</i><?=l('Install<>نزّل')?></a>
		
		
		 <a onclick="return submitter(null,urlPanel,'updating',{ 'module':'settings', 'action' : 'activate_module','legion_zip_folder' : '<?php echo $legionAPI['data']['legion_module_dir']; ?>','module_folder':'<?php echo $legion_unassociative_array[$i]['module_zip'];?>','e':'','and_go':true},'post',false);" class="module_option pointer install_module_and_go  mid"><i >get_app</i><?=l('Install & Go<>نزل واذهب')?></a>
		
		

	<div class="module_version mid new_version modernG"><span>V.</span><?php echo $legion_unassociative_array[$i]['version'];?></div>
		 <?php }else{?>
		<div class="module_option  cant_install_module  mid"><i >warning</i>Install</div>
		<?php }?>
		
	<div class="module_version mid legion_version"><span>Legion </span><?= $module_on_legion;?></div>
	<div class="module_name mid">
		<?php if(isset($legion_unassociative_array[$i]['core']) && $legion_unassociative_array[$i]['core']==1){?><div class="core_indicator_block mid"><?php echo l('Core<>اساسي');?></div><?php } ?>
		<?php if(isset($resp[$i]['commerce']) && $resp[$i]['commerce']==1){?><div class="commerce_indicator_block mid"><?= l('Commerce<>تجاري');?></div><?php } ?>
		<?php echo l($legion_unassociative_array[$i]['module_name']);?></div>
	<div class="module_prefix mid"><?php echo $legion_unassociative_array[$i]['module_zip'];?></div>

 </div>
			<?php }
		}
		}
	?>
</div>



<div class="module_page_title">Other Modules</div>
<div id="update_cont" class="modules_cont">
	<?php
	if(is_array($legionAPI['data']['modules'])){
	$legion_unassociative_array= array_values($legionAPI['data']['modules']);

		for($i=0;$i<count($legion_unassociative_array);$i++){
			if($legion_unassociative_array[$i]['this_website'])continue;
			if(db('modules',"WHERE module_prefix='".$legion_unassociative_array[$i]['module_zip']."'",NULL,"LIMIT 1","id")==1){?>
				
	<div class="module_box">
		<?php $module_on_legion=$legion_unassociative_array[$i]['legion_version'].'.'.$legion_unassociative_array[$i]['legion_build'];?>
		
		<?php if($module_on_legion>=version){?>
		 <a onclick="return submitter(null,urlPanel,'updating',{ 'module':'settings', 'action' : 'activate_module','legion_zip_folder' : '<?php echo $legionAPI['data']['legion_module_dir']; ?>','module_folder':'<?php echo $legion_unassociative_array[$i]['module_zip'];?>','e':''},'post',false);" class="module_option pointer install_module  mid"><i >get_app</i>Install</a>
			 <?php }else{?>
		<div class="module_option  cant_install_module  mid"><i >warning</i>Install</div>
		<?php }?>

	<div class="module_version mid new_version modernG"><span>V.</span><?php echo $legion_unassociative_array[$i]['version'];?></div>
		
		
	<div class="module_version mid legion_version"><span>Legion </span><?php echo $module_on_legion;?></div>

	<div class="module_name mid">
		<?php if(isset($legion_unassociative_array[$i]['core']) && $legion_unassociative_array[$i]['core']==1){?><div class="core_indicator_block mid"><?php echo l('Core<>اساسي');?></div><?php } ?>
		<?php if(isset($resp[$i]) && $resp[$i]['commerce']==1){?><div class="commerce_indicator_block mid"><?php echo l('Commerce<>تجاري');?></div><?php } ?>
		<?php echo l($legion_unassociative_array[$i]['module_name']);?></div>
	<div class="module_prefix mid"><?php echo $legion_unassociative_array[$i]['module_zip'];?></div>

 </div>
			<?php }
		}
	}
	?>
</div>

<?php } ?>