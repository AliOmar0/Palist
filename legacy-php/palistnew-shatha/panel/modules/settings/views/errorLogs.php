<?php if(!privilege('settings','errorLogs'))echo $noPermission;else{
	$logs=array();
	$new_folder_path= new RecursiveDirectoryIterator(error_log_path);
	foreach(new RecursiveIteratorIterator($new_folder_path) as $file)
	{
		if(strpos($file,'error_log') || strpos($file,'error.log')){
			$d=date ("d-m-Y H:i:s", filemtime($file));
			$logs[]=array(
			'dir'=>str_replace(root,'',$file),
			'date'=>$d,
			'elapse'=>elapse($d)
			);
		}//if
	}//for
	?>

	<table class="filling">
		<thead>
			<tr>
				<th>DIR</th>
				<th>Last Modified</th>
				<th>Elapse</th>
				<th>Size</th>
				<th>Options</th>
			</tr>
		</thead>
		<tbody>
	<?php

	for($i=0;$i<count($logs);$i++){?>
	<tr class="<?=isset($_GET['dir']) && $_GET['dir']==$logs[$i]['dir']?'l_anim_pulse':NULL?>">
		<td><?=$logs[$i]['dir']?></td>
		<td><?=$logs[$i]['date'];?></td>
		<td><?=$logs[$i]['elapse'];?></td>
		<?php $__size=filesize(root.$logs[$i]['dir']);?>
		<td class="<?=$__size>0?'l_lava':NULL?>"><?php	
		echo mb($__size,($__size>1000000?'M':'K'),1).' '.($__size>1000000?'MB':'KB')?>
		</td>
		<td>
			<i class="in po nos" onclick="href('<?=urlPanel.'?module=settings&action=errorLogs&dir='.$logs[$i]['dir']?>')">visibility</i>
			<i class="in po nos" onclick="sub({'error_log_handle':'mop','dir':'<?=$logs[$i]['dir']?>'})">remove</i>
			<i class="in po nos" onclick="sub({'error_log_handle':'del','dir':'<?=$logs[$i]['dir']?>'})">delete</i>
		</td>
	</tr>

	<?php }?>
		</tbody>
	</table>
	<clear></clear>

	<?php if(!g('dir')){?>
		<div class="l_btn mid " onclick="sub({'error_log_handle':'mopAllErrors'})"><i class="mid l_mr5">remove</i><?=l('Mop All Logs<>مسح جميع الأخطاء')?></div>
	<?php }?>

	<?php if(g('dir') && file_exists(root.$_GET['dir'])){?>
		<div id="log_view_dir">
			<div onclick="sub({'error_log_handle':'mop','dir':'<?=$_GET['dir']?>'})" class="l_btn mid l_mr5"><i class="l_mr5">remove</i>Mop</div>
			<div class="l_btn mid " onclick="sub({'error_log_handle':'mopAllErrors'})"><i class="mid l_mr5">remove</i><?=l('Mop All Logs<>مسح جميع الأخطاء')?></div>
			<span class="mid"><?=$_GET['dir'];?></span>
		</div>

		<div class="log_view_content"><?php print_r(file_get_contents(root.$_GET['dir']));?></div>

		<div id="log_view_dir">
			<div onclick="sub({'error_log_handle':'mop','dir':'<?=$_GET['dir']?>'})" class="l_btn mid l_mr5"><i class="l_mr5">remove</i>Mop</div>
			<div class="l_btn mid " onclick="sub({'error_log_handle':'mopAllErrors'})"><i class="mid l_mr5">remove</i><?=l('Mop All Logs<>مسح جميع الأخطاء')?></div>
			<span class="mid"><?=$_GET['dir'];?></span>
		</div>

		<script>
			$(function(){
				<?php if(isset($_GET['dir']) && file_exists(root.$_GET['dir'])){?>
				scrollPanel('end');
				<?php }?>
			});
		</script>
	<?php }
}