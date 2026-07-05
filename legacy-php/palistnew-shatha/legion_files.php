<?php 
// echo "omer";
// $i=0;
if(isset($resp[$i]['files']))
	$resp[$i]['files']=explode('.',$resp[$i]['files'])[0];#!

// d($resp[$i]['files']);
if(isset($resp[$i]['files']) && $resp[$i]['files']!=NULL){
	$__files=fa($resp[$i]['files']);
	// echo 1;
	// d($__files);
}



if(isset($post['files']) && $post['files']!=NULL){			
	$__files=fa($post['files']);
	// echo 2;
}


if(isset($__files) && !empty($__files)){


?>

<div class="in attach">
	<div id="attach_head">
		<?= l('Attachments<>مرفقات');?>
	</div>
	<clear></clear>
	<?php foreach($__files as $file){?>
	<a target="_blank" href="<?=($file['protected_file']==0?u:d).$file['full_name']?>" title="<?=$file['original_name'];?>">
		<div class="attach_icon mid">
			<img src="<?=fileIcon($file['full_name'])?>" alt="<?=l('File Icon<>ايقونة الملف')?>"/>
		</div>
		<span class="mid"><?=str_replace('.'.$file['extension'],'',$file['original_name'])?></span>
	</a>
	<?php }?>
</div>
<?php
}
unset($__files);
unset($post['files']);

?>


