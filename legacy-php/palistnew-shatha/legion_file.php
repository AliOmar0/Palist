<?php

if($_key==NULL)$_key='file';
if($post[$_key]==NULL)$post=$resp[$i];


	if($post[$_key]!=NULL){
	?>
		
	<div class="in attach full_attach">
		
		<?php if($_head==true){?>
		<div id="attach_head">
			<?= l('Attachments<>مرفقات');?>
		</div>
		
		<clear></clear>
		<?php }
		
		$info=db('files_1577206823',"WHERE full_name='".$post[$_key]."'",NULL,'LIMIT 1')[0];
		// d($info);
		?>
		
		<a target="_blank" href="<?php echo ($info['protected_file']?d:u).$info['full_name']?>" title="<?= $info['original_name'];?>">
			<div class="attach_icon mid">
				<img src="<?= fileIcon($info['full_name'])?>" alt="<?= l('File Icon<>ايقونة الملف')?>"/>
			</div>
			<span class="mid"><?=$info['original_name'];?></span>
				</a>
	</div>
<?php }?>