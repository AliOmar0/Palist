<div id="below_bread" class="nos">
	<?php if($module!='quick_access_1563567918')include 'quickAdder.php';
		if(isset($bread_sub_items) && !empty($bread_sub_items)){for($j=0;$j<count($bread_sub_items);$j++){?>
				<a class="below_bread_sub mid" title="<?=l($bread_sub_items[$j]['title']).'" href="'.urlPanel.'?module='.$module.'&action='.$bread_sub_items[$j]['type'];?>">
					 <i class="mid"><?= $bread_sub_items[$j]['icon'];?></i><span  class="mid"><?= l($bread_sub_items[$j]['title']);?></span></a>
				<?php }
		}?>
	
	<?php if(super()){?>
		<a class="below_bread_sub mid po" onclick="return submitter(null,urlPanel,'<?=l('Updating<>جاري التحديث')?>',{ 'module':'settings', 'action' : 'update_module','legion_zip_folder' : 'https://legioncms.com/tools/generated_modules_zip/','module_folder':'<?=$module?>','e':''},'post',false);"><i class="mid">swap_horiz</i><span class="mid"><?=l('Update<>تحديث')?></span></a>
	
		<a class="below_bread_sub mid <?=$module=='settings'?'hidden':''?>" target="_blank" href="<?=$legion['website_link'].'/modular/'.version.'/'?>tweak.php?module_prefix=<?=$module?>&module_version=<?=one('modules',mid($module))[0]['version']?>"><i class="mid">build</i><span class="mid"><?=l('Tweak<>تعديل')?></span></a>
	
		<div class="below_bread_sub mid po"  onclick="c('<?=mid($module)?>')"><i class="mid">view_module</i><span class="mid"><?=l('Module ID<>معرّف البرمجية')?> <?=mid($module)?></span></div>
	
	
		<div class="below_bread_sub mid"><i class="mid">view_module</i><span class="mid"><?=l('Version<>الإصدار')?> <?=one('modules',mid($module))[0]['version']?></span></div>
	
	
		<div class="below_bread_sub mid po" onclick="c('<?=$module?>')"><i class="mid">view_module</i><span class="mid"><?=$module?></span></div>
	
	<?php }?>
	</div>