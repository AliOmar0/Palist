<?php if($page_count>1){?>
<div id="pagination_wrap" class="mid">
<div class="pagination_label mid"><?=l('Pages<>الصفحات')?></div>
	
	<?php if($page_num>1){?>
	
		
	
	<a class="pagination_nav_btn mid" href="<?= getter('pager').'&page_num=1'?>"><i>skip_previous</i></a>
	
	<a class="pagination_nav_btn mid" href="<?= getter('pager').'&page_num='.($page_num-1)?>"><i>chevron_left</i></a>
	
	<?php }?>
	
	
<?php
	if($page_num<$page_count){?>
	<a class="pagination_nav_btn mid" href="<?= getter('pager').'&page_num='.($page_num+1)?>"><i>chevron_right</i></a>
	
		<a class="pagination_nav_btn mid" href="<?= getter('pager').'&page_num='.$page_count?>"><i>skip_next</i></a>
		<?php
	}
	?>
	
	
	
	<?php
	
	$manyPages=false;
	if($page_count>3){
		$manyPages=true;;
		$page_limit=3;
	}
	
	
if(!$manyPages){
for($i=1;$i<=$page_count;$i++){
//	if($page_count)
	
	
   if($i==$page_num){ // this is current page?>
      <a class="pagination_item active_pagination_item nopointer mid"><?= $i ?></a>
	<?php }// if 
	
   else { // show link to other page   ?>
       <a class="pagination_item  mid" href="<?= getter('pager').'&page_num='.$i?>"><?= $i ?></a>
   <?php }//else
	
		}//for
	}else{
	?>
		<span id="page_words" class="mid"><?= $page_num.' '.l('of<>من').' '.$page_count?></span>
		
	<form method="get" id="pager_form" class="mid">
				
				<?php 
				$keys=array_keys($_GET);
				for($i=0;$i<count($keys);$i++){
				if($keys[$i]=='page_num')continue;?>
					<input type="hidden" name="<?= $keys[$i];?>" value="<?= $_GET[$keys[$i]];?>"/>
				<?php }?>
				<input type="number" contenteditable="true" name="page_num" value="<?= $page_num?>"/>
				<input type="submit" class="hidden"/>
	</form>
	
	<div class="mid po" id="page_num_btn" onClick="document.getElementById('pager_form').submit()"><?=l('Go<>اذهب')?></div>
	
	<?php 
}
?>
</div>

<?php }?>