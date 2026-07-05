<?php require 'header.php'?>



<div id="">

<?php $_m='programs_and_training_8366';?>
<section id="programs_and_training_wrap" class="w1200">
<div class="line_box">
<div class="title_line mid"></div><!--
	-->   <h1 class="about_title mid"><?=mn($_m)?></h1>
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
    
    
    $no_of_records_per_page = 6;
    $offset = ($page-1) * $no_of_records_per_page; 
    $respa=db($_m,NULL,'ORDER BY date_created DESC',);
    if($respa==1) echo '<div class="no_data">'.l('No Data<>لا مُدخلات').'</div>';
    $counter=count($respa);
    $total_pages=ceil($counter/$no_of_records_per_page);
    $resp=db($_m,NULL,'ORDER BY date_created DESC','limit '.$offset.','.$no_of_records_per_page.'');

    if($resp==1) echo '<div class="no_data">'.l('No Data<>لا مُدخلات').'</div>';
         else { for($i=0;$i<count($resp);$i++){
            // echo $resp[$i]['id'];
            // echo "               ";
                ?> --><a class="programs_and_training_box in" title="<?=l($resp[$i]['title']) ?>" href="<?=url($_m,'single',$resp[$i]['id'])?>">
				<?php pic($resp[$i]['photo'],400,100,l($resp[$i]['title']),true,NULL,'programs_and_training_photo_picture');?>
				
				<div class="program_cont">
					<h2 class="programs_and_training_title"><?=l($resp[$i]['title']);?></h2>
				
					<div class="programs_btn">
							<h2 class="news_publish_date mid w50"><?=cleanDate($resp[$i]['publish_date']);?></h2><!--
						--><h2 id="more" class="mid w50"><?=l('More > <> المزيد >')?></h2>
					</div>
				</div>
				</a><!--
        <?php 
            }//for
        }//else
        unset($resp);
        $p_url=url($_m);
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


<?php require 'footer.php'?>