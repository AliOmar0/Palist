<?php require 'header.php';

// echo curr();
// $cur=explode(url,'/');
// echo $_SERVER['REQUEST_URI'];
// echo "**** s ";
// echo $cur[count($cur)-1];
?>

<!-- <div class="separate_padding"></div> -->
<div id="members_page">

<section id="about_the_syndicate_wrap" class="major_section w1200">
		<?php $_m='about_the_syndicate_8362';$i=0;?>
		<!--<?php
		$resp=db($_m,NULL,NULL);
		if($resp==1) echo '<div class="no_data">'.l('No Data<>لا مُدخلات').'</div>';
		else { for($i=0;$i<count($resp);$i++){?>
		--><div class="about_the_syndicate_box2" title="<?=l($resp[$i]['title'])?>">
		<div class=" about_us_left">
		<div class="line_box">
		<div class="title_line mid"></div><!--
		--><h2 class="about_title mid"><?=l($resp[$i]['title']);?></h2>
		</div>
			<div class="about_the_syndicate_summary2"><?=l($resp[$i]['summary']);?></div>
		</div><!--
		--><div class="about_right">
		<?php pic($resp[$i]['photo_in_single'],1000,800,l($resp[$i]['title']),true,NULL,'about_the_syndicate_photo_in_single_picture');?>


			<div style="text-align:center">
					<div class="a_box mission_box in">		
					<?php pic($resp[$i]['mission_icon'],400,100,l($resp[$i]['title']),true,NULL,'about_us_mission_icon_picture about_us_icon');?>
					<h2 class="about_us_misson_title about_us_box_title"><?=l($resp[$i]['mission_title']);?></h2>
					<div class="about_us_misson_content about_us_box_content"><?=l($resp[$i]['mission_content']);?></div>
					</div><!--
					--><div class="a_box vission_box in">  
							<?php pic($resp[$i]['vision_icon'],400,100,l($resp[$i]['title']),true,NULL,'about_us_vision_icon_picture about_us_icon');?>
							<h2 class="about_us_vision_title about_us_box_title"><?=l($resp[$i]['vision_title']);?></h2>
							<div class="about_us_vision_content about_us_box_content"><?=l($resp[$i]['vision_content']);?></div>
					   </div>
			</div>

		</div>
		</div><!-- 
		<?php 
		}//for
		}//else
		unset($resp);?>
		-->
</section>


	
<div id="syndicate_goals_wrap" >
	<section  class="w1200" class="major_section ">
		<?php $_m='syndicate_goals_8364';?>
		<div class="line_box">
		<div class="title_line mid"></div><!--
		--><h1 class="about_title mid"><a title="<?=mn($_m)?>"><?=mn($_m)?></a></h1>
		</div>
	<!--<?php


	$resp=db($_m,NULL,NULL);
	if($resp==1) echo '<div class="no_data">'.l('No Data<>لا مُدخلات').'</div>';
	else { for($i=0;$i<count($resp);$i++){?>
	--><div class="syndicate_goals_box in" title="<?=l($resp[$i]['title'])?>">
		<div class="circle_points in"></div><!--
	--><div class="syndicate_goals_title in"><?=l($resp[$i]['title']);?></div>
	</div><!--
	<?php 
	}//for
	}//else
	unset($resp);
	

	?>
	-->
	</section>

</div>



<section id="members_wrap" class="major_section w1200">
<?php $_m='members_8364';?>
<div class="line_box">
		<div class="title_line mid"></div><!--
		--><h1 class="about_title mid"><a title="<?=mn($_m)?>"><?=mn($_m)?></a></h1>
</div>
<div class="">

<div id="more_news_left" class="l_grid3">

<!--    <?php 
    
    if (isset($_GET['page']))
    {
        $page = $_GET['page'];
    } else {
        $page = 1;
		$_GET['page']=$page;
    }
    
    
    $no_of_records_per_page =12;
    $offset = ($page-1) * $no_of_records_per_page; 
    $respa=db($_m,NULL,'ORDER BY order_number ASC',);
    if($respa==1) echo '<div class="no_data">'.l('No Data<>لا مُدخلات').'</div>';
    $counter=count($respa);
    $total_pages=ceil($counter/$no_of_records_per_page);
    $resp=db($_m,NULL,'ORDER BY order_number ASC','limit '.$offset.','.$no_of_records_per_page.'');

    if($resp==1) echo '<div class="no_data">'.l('No Data<>لا مُدخلات').'</div>';
         else { for($i=0;$i<count($resp);$i++){
            // echo $resp[$i]['id'];
            // echo "               ";
                ?> --><div class="members_box  in" onclick="show_details(<?=$resp[$i]['id']?>)" title="<?=l($resp[$i]['title']) ?>">
				<?php pic($resp[$i]['photo'],400,100,l($resp[$i]['title']),true,NULL,'members_photo_picture');?>
				<div class="members_title_box">
				 <h2 class="members_name"><?=l($resp[$i]['name']);?></h2>
				 <h2 class="members_job_name"><?=l($resp[$i]['job_name']);?></h2>
				 <h2 class="members_job_name"><?=l($resp[$i]['summary']);?></h2>
			
				</div>
				   
				</div><!--
        <?php 
            }//for
        }//else
        unset($resp);
		unset($respa);
        $p_url=url('about_the_syndicate_8362');
        // $e_url='/'.curr();
        ?>
        -->
    
</div>
<div class="pagination_box <?php if($total_pages <=1) echo "none";?>">
        <ul class="pagination in">
        
           
            <li class="in <?php if($_GET['page'] == 1) echo "none" ?>"><a href="<?=$p_url.'?page=1'?>"><?=l('First <> الاولى');?></a></li>
            
            <li class="<?php if($page <= 1){ echo 'disabled'; } ?>  in <?php if($_GET['page'] == 1) echo "none" ?>">
                <a href="<?php if($page == 1 || $page < 1){ echo $p_url.'?page=1'; } else { echo $p_url."?page=".($page -1); } ?>"><?=l('Prev <> السابق');?></a>
            </li>
            <ul class="in " id="pagination_list"><?php 
            for($page_numbers=1;$page_numbers<=$total_pages;$page_numbers++){?> 
                <li class="in  list <?php if($page_numbers==$_GET['page']) echo 'active'?>"> 
                    <a class="" href="<?php echo $p_url."?page=".($page_numbers)?>" ><?= $page_numbers; ?></a>
                </li>  
                <?php }?>
            </ul>
            <li class="<?php if($page >= $total_pages){ echo 'disabled'; } ?>  in  <?php if($_GET['page'] == $total_pages) echo "none" ?>">
                <a href="<?php if($page >= $total_pages){ echo $p_url.'?page='.$total_pages; } else { echo $p_url."?page=".($page + 1); } ?>"><?=l('Next <> التالي');?></a>
            </li>
            
            <li class="in <?php if($_GET['page'] == $total_pages) echo "none" ?>"><a href="<?php echo $p_url.'?page='.$total_pages; ?>"><?=l('Last <> الاخيرة');?></a></li>
        </ul>

        </div>
</div>
</section>

</div>	

<div class="pop_wrap" style="display:none">
	<div class="pop_content">
	</div>

</div>


<?php
	$resp=db($_m,NULL,NULL);
 for($i=0;$i<count($resp);$i++){?>
<div id="person_<?=$resp[$i]['id']?>" class="members_box_pop in" title="<?=l($resp[$i]['title']) ?>" style="display:none">
<?php pic($resp[$i]['photo'],400,100,l($resp[$i]['title']),true,NULL,'members_photo_picture');?>
    <h2 class="members_name"><?=l($resp[$i]['name']);?></h2>
    <h2 class="members_job_name"><?=l($resp[$i]['job_name']);?></h2>
    <div class="members_content"><?=l($resp[$i]['summary']);?></div>
	<div class="members_btn"><a href="<?=url($_m,'single',$resp[$i]['id'])?>" class="members_more_btn"><?=l('More ...<>  المزيد...')?></a></div>
	<i class="material_icons cancel" onclick="closeForm()">cancel</i>
 </div>
<?php 
    }//for
?>




<script>
	function show_details(id){
		$('.members_box_pop').hide(50);
		$('#person_'+id).delay(50).show(50);		
		var element = document.getElementById("members_page");
        element.classList.add("mystyle");		
		$("#back_col").removeAttr("style");
		

	
}

	
function closeForm() {
	 $('.members_box_pop').hide();
	   var element = document.getElementById("members_page");
       element.classList.remove("mystyle");
	} 

	</script>

<!-- <script>
if(window.location.href="https://intel.ps/pis/about_us/#members_wrap"){
	console.log('shireen');
	$("#members_wrap").css("padding-top", "220px");
}
</script> -->

<?php require 'footer.php';?>f;