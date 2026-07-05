<?php require 'header.php';
	$search=escape($_GET['search']);
?>
<mhx></mhx>
<?php if(isset($post['photo']) && $post['photo']!=''){?>
<div class="page_top_bg" <?=bg($post['photo'],2000)?>></div>
<?php }?>

	<div id="page_top"  data-aos="fade-left">
		<div  class="w1200">
			<h1 class="sec_head sec_normal"><?= l('Search:<>البحث:')?> <?= $search?></h1>
		</div>
	</div>

<section>
	
	<div class="w1200">


		<?php $_m='news_8362'?>
		<div   class="search_section">
	<div class="search_title"><?=mn($_m)?></div>
	<?php
	$resp=db($_m,"WHERE title LIKE '%$search%' OR content LIKE '%$search%'");
			if($resp==0)  echo 'error';
			else if($resp==1) echo '<div class="no_res">'.l('No Data<>لا يوجد نتائج').'</div>';
			else { for($i=0;$i<count($resp);$i++){
				?>
		<a href="<?=url($_m,'single',$resp[$i]['id']);?>" title="<?=l($resp[$i]['title']);?>"><?="[".($i+1)."] ".sl($resp[$i]['title']);?></a>
<?php
			}
				 }
	?>
	</div>
		

	
<div class="clear"></div>
	<?php include 'legion_share.php';?>
		
	</div>
</section>



<?php 
require 'footer.php'?> 