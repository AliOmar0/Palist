<div id="bread">
	<div id="module_title" class="mid">
		<i class="mid"><?= $m['info']['main_icon'];?></i><!--
		--><span class="mid"><?= l($m['info']['module_name'])?></span>
	</div><!--

	--><div id="curr_view" class="mid"><span class="mid"><?=isset($actionDetails['title'])?l($actionDetails['title']):NULL;?></span></div><!--

--><div id="bread_actions" class="mid nos">
		<?php if(!isset($noSave)){?>
		<div id="bread_save" class="bread_save bread_btn po mid" onClick="$('.cluster_wrap input').attr('disabled','disabled');document.getElementById('<?= $module;?>').onsubmit();$('.cluster_wrap input').removeAttr('disabled');"><i>done</i><?= l('Save<>حفظ');?><span class="shortcut_in_button">ctrl + s</span></div>
	
		
		<?php if($action=='add'){?>
		<div id="bread_save_new" class="bread_save bread_btn po mid" onClick="andNew();document.getElementById('<?= $module;?>').onsubmit();"><i>done_all</i><?= l('Save & New<>حفظ واضف جديد');?><span class="shortcut_in_button">ctrl + d</span></div>
			<?php }
		}?>
	</div>
	
	<?php if(privilege($module,'delete') && $action=='edit'){?>
	<a onClick="showPop('!','Delete','Are you sure?','deleting','<?= $module;?>','delete', <?= check_get_id();?>)" class="bread_btn bread_del po mid" title="Delete"><i class="md-light">delete</i></a>
	<?php }
	// d($module);
	// if(super()){
		if($action=='add')
			echo '<div class="expected_new_id mid">'.l('Expected Next ID<>المُعرّف المتوقع').': <div class="in l_grass_c po" onclick="c()">'.dbs("SHOW TABLE STATUS WHERE name='$module'")[0]['Auto_increment'].'</div></div>';
		elseif($action=='edit' || $action=='view'){
			?>
			<div class="expected_new_id mid"><?=l('ID<>المُعرّف')?>: <div class="in l_grass_c po" onclick="c()"><?=$_GET['id']?></div></div>
			
			<?php 
			$___next_entry=ow($module,"id>".eg('id'));
			$___prev_entry=ow($module,"id<".eg('id'));
			if($___prev_entry!=1 || $___next_entry!=1 )echo '<div class="mid">';
			if($___prev_entry!=1){?>
				<a class="l_btn l_btn_small mid" href="<?=purl($module,$action,$___prev_entry['id'])?>"><?=l('Previous<>السابق')?></a>
			<?php }
			if($___next_entry!=1){?>
				<a class="l_btn l_btn_small mid" href="<?=purl($module,$action,$___next_entry['id'])?>"><?=l('Next<>اللاحق')?></a>
			
			<?php }
			if($___prev_entry!=1 || $___next_entry!=1 )echo '</div>';
		 }
	// }
	
	include core_dir.'modules/below_bread.php';
	if(!isset($_GET['viewMod']))include_once core_dir.'preBread.php';
	?>
</div>

<script>
function andNew(){
	var input = document.createElement("input");
	input.setAttribute("type", "hidden");
	input.setAttribute("name", "andNew");
	input.setAttribute("value", "1");
	document.getElementById("<?= $module;?>").appendChild(input);
}

window.addEventListener("load", function(){
	wk=document.querySelector('.working_area');
	wk=wk.querySelector('input:not([type="hidden"])');
	if(wk!=undefined && wk!=null)
		wk.focus();
}, false);
	
</script>