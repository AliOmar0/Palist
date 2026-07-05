<?php require 'header.php';
if(isset($post['photo']) && $post['photo']!='' && file_exists(target_dir.$post['photo'])){?>
<div class="page_top_bg" style="background-image:url(<?= uploads_link.img($post['photo'],1500,100)?>)"></div>
 
<?php }?>

<div id="page_top"  data-aos="fade-left">
	<div  class="w1200">
		<h1 class="sec_head sec_normal"><?= l($post['title'])?></h1>
	</div>
</div>


<section>
		
<div class="p_content w1200" data-aos="fade-up">
	<div class="mce"><?= fil(l($post['content']));?></div>
		 <?php
		if(isset($post['additional_file']) && $post['additional_file']!='' && file_exists(cms_dir.$post['additional_file'])){
			if($post['signin_required']!=0 && !isLogged($post['signin_required']))goP();
			else{
				if($post['with_share_functionality']=='0')$noShare=true;
				if($post['with_messenger']=='0')$noFacebook=true;
				include cms_dir.$post['additional_file'];
			}
		}
		?>
	</div>
	<clear></clear>
	<?php include 'legion_share.php';?>
</section>

<?php 
require 'footer.php'?> 