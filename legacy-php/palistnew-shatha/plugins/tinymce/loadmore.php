<?php
include_once'../../panel/core/config.php';
if(!logged()) die('you are not signed in');


#defaults

$deleted=0;
$offset=0;
$search=NULL;
$multi=false;
$allowedFiles=false;

if(isset($_GET['deleted']) && $_GET['deleted']!='')$deleted=1;
if(isset($_GET['offset']) && $_GET['offset']!='')$offset=escape($_GET['offset']);
if(isset($_GET['search']) && $_GET['search']!='')$search=" AND (original_name LIKE '%".escape($_GET['search'])."%')";
if(isset($_GET['multi']) && $_GET['multi']!='false')$multi=true;
if(isset($_GET['allowedFiles']) && $_GET['allowedFiles']!='false')$allowedFiles=true;

		 
$files=array();
if($_GET['files']!='' && $multi){
	$files=explode(',',$_GET['files']);
}

if($allowedFiles)$type=NULL;else $type=" AND type='photo'";


$thereIsMore=false;

$resp=db('files_1577206823',"WHERE protected_file=0 AND  deleted='$deleted' $search $type",NULL,"LIMIT $offset,45");
if($resp!=1 && db('files_1577206823',"WHERE protected_file=0 AND id<'".end($resp)['id']."' AND deleted='$deleted' $search $type ",NULL,'LIMIT 1')!=1)$thereIsMore=true;

if($resp==1 && $offset>0){?><script>$(function(){result_foot(<?=json_encode($thereIsMore)?>,false);})</script><?php }
else if($resp==1 && $offset==0){?><script>$(function(){result_foot(<?=json_encode($thereIsMore)?>,true);})</script><?php }
else { ?>
<script>$(function(){result_foot(<?=json_encode($thereIsMore)?>,false);})</script>
<?php
	$admin_mod_id=mid('admins');
for($i=0;$i<count($resp);$i++){
	$file_name=$resp[$i]['name'].'.'.$resp[$i]['extension'];
	if($resp[$i]['type']=='file'){
		$url=uploads_link.$file_name;
		
		$img=img($file_name,200,100);

		if($img=='corrupted.webp' || $img=='corrupted.png'){
			$thumbnail_url=fileIcon($file_name);
		}else{
			$thumbnail_url=uploads_link.img($file_name,200,100);
		}
	}
	else {
		
		$url=uploads_link.img($file_name,1200,100);
		$img=img($file_name,200,100);
		if($img=='corrupted.webp' || $img=='corrupted.png'){
			$thumbnail_url=fileIcon($file_name);
		}else{
			$thumbnail_url=uploads_link.img($file_name,200,100);
		}
		$img=uploads_link.$img;
		

	}
	
	
?>
<div class="files_box in po stack" id="insert_<?= $resp[$i]['name']?>" onclick="
	<?php if($multi){?>
	selectFile('<?= $url?>','<?= $resp[$i]['original_name'];?>','<?= $file_name?>','<?= $thumbnail_url?>','<?= $resp[$i]['name']?>') <?php }else{?>
	insert('<?= $url?>','<?= $resp[$i]['original_name'];?>','<?= $file_name?>','<?= $thumbnail_url?>')
	<?php }?>
	">
	
	<img src="<?= $thumbnail_url?>"/>

	<div class="file_title"><?= $resp[$i]['original_name'];?>
		<?php if($resp[$i]['credit']!=''){?>
		<div class="pexels_credit_info">
			<?=$resp[$i]['credit']?><?=$resp[$i]['source_name']==''?'':' - '.$resp[$i]['source_name']?>
		</div>
		<?php }?>
	 </div>
	
	<div class="file_box_info" <?php if($resp[$i]['average_color']!=''){?>style="background:<?=$resp[$i]['average_color']?>"<?php }?></div>
	<div class="par">
		<div class="ch">
			<div class="file_box_info_row">
				<i class="mid">attach_file</i>
				<div class="file_box_info_value mid"><?=$resp[$i]['full_name']?></div>
			</div>
			
			<div class="file_box_info_row">
				<i class="mid">calendar_today</i>
				<div class="file_box_info_value mid"><?=cleanDate($resp[$i]['date_created'])?></div>
			</div>
						
			<?php if($resp[$i]['width']!=NULL){?>
			<div class="file_box_info_row">
				<i class="mid">fullscreen</i>
				<div class="file_box_info_value mid"><?=$resp[$i]['width'].'X'.$resp[$i]['height']?> Pixels</div>
			</div>
			<?php }?>
			
			<?php if($resp[$i]['width']!=NULL){?>
			<div class="file_box_info_row">
				<i class="mid">fitness_center</i>
				<div class="file_box_info_value mid"><?php
											   if($resp[$i]['size']<1)
												  echo round($resp[$i]['size']*1024).' KB';
											   else
												   echo round($resp[$i]['size'],1).' MB';
					?></div>
			</div>
			<?php }?>
			
			<?php if($resp[$i]['uploader_module_prefix']!=0){?>
			<div class="file_box_info_row">
				<i class="mid">person</i>
				<div class="file_box_info_value mid">
					<?=mn(dim($resp[$i]['uploader_module_prefix']))?>
					<?php if($resp[$i]['uploader_module_prefix']==$admin_mod_id && $resp[$i]['uploader_user_id']!=0){
						echo ' - '.o('admins',$resp[$i]['uploader_user_id'],'id','username')[0]['username'];
					}?>
				</div>
			</div>
			<?php }?>
			
			
			<div class="file_box_info_row" onClick="popMedia('<?=$url?>','<?=$resp[$i]['type']?>');event.stopPropagation();">
				<div class="sbtn in"><?=l('View<>عرض')?></div>
				
			</div>
			
			
			</div>
		</div>
		</div>
	
	<?php if(in_array($resp[$i]['name'],$files)){?>
	<div class="itemSign" onclick="removeItem('<?= $resp[$i]['name']?>')"><img src="<?= pres?>/imgs/checked.png"></div>
	<?php }?>
    </div>
<?php 
    }//for
}//else
unset($resp);?>