<?php if(!privilege('settings','editBackup'))echo $noPermission;else{?>

<!--	<a href="<?=urlPanel.'?module=settings&action=emptyBackups'?>" class="b mid" title="<?=l('Delete<>حذف')?>"><i class="mid">delete</i> <?=l('Delete All Backups<>حذف جميع النُسخ الاحتياطية')?></a>-->


<!-- <a  class="b in" target="_blank" href="<?= modules_url;?>settings/models/exportsysfiles.php"><?=l('Take Backup Now<>خُذ نسخة احتياطية الآن')?></a> -->


<div class="group"><?=l('Available Backup Files<>نُصخ احتياطية مُتاحة')?></div>
 <div class="clear-withborder"></div>


<form id="settings" onsubmit="return submitter(this,urlPanel);" method="post" enctype="multipart/form-data">
<input type="hidden" value="" name="e"/>
<input type="hidden" name="action" value="editBackup"/> 
<input type="hidden" name="module" value="settings"/> 

<input type="submit" class="btn main_color_bg" value="<?=l('Take Backup Now<>خُذ نسخة احتياطية الآن')?>"/>

</form>



<ul id="backuplist" class="main_color_border_left_bold">
	<?php
	if( file_exists ( backup_dir)){
	// list the contents
	foreach (scandir(backup_dir) as $file) {
		$extension = pathinfo($file, PATHINFO_EXTENSION);
		if ($extension == 'zip') {?>
	<li><a href="<?= backup_url.$file;?>" title="Download"><?= $file;?></a></li>
		<?php }
	}
		}
	else{?><div>You didnt take backups yet</div><?php }
	?>
</ul>


<!-- <div class="group">Product Info</div> -->
<!-- <div class="clear-withborder"></div> -->

<a class="b in"  target="_blank" href="<?= modules_url;?>settings/models/exportdb.php"><?=l('Export DB<>تصدير قاعدة البيانات')?></a>
<?php }?>