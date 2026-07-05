
<?php 
require 'header.php';?>


<?php $_m='advertisements_8362';?>


<div class="w1200 box_news">
<div class="about_title">
        <div class="line_box">
            <div class="title_line mid"></div><!--
                --> <h2 class="mid" id="more_news_header"><?=l("The Syndicate's Announcements<>اعلانات النقابة")?></h2>
        

        </div>
    </div> 
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
    $respa=db($_m,NULL,'ORDER BY date_created DESC');
    if($respa==1) echo '<div class="no_data">'.l('No Data<>لا مُدخلات').'</div>';
    $counter=count($respa);
    $total_pages=ceil($counter/$no_of_records_per_page);
    $resp=db($_m,NULL,'ORDER BY date_created DESC','limit '.$offset.','.$no_of_records_per_page.'');

    if($resp==1) echo '<div class="no_data">'.l('No Data<>لا مُدخلات').'</div>';
         else { for($i=0;$i<count($resp);$i++){
            // echo $resp[$i]['id'];
            // echo "               ";
    ?> -->
         <div class="advertisements_box in" title="<?=l($resp[$i]['title']) ?>" >
				<?php pic($resp[$i]['photo'],400,100,l($resp[$i]['title']),true,NULL,'advertisements_photo_picture');?>
				<h2 class="advertisements_title"><?=l($resp[$i]['title']);?></h2>
				<div class="more_btn_adv">
						<a href="<?=url($_m,'single',$resp[$i]['id'])?>" class="in"><?=l('More > <>المزيد >')?></a>
					</div>

			</div><!--
        <?php 
            }//for
        }//else
        unset($resp);
		
		// $p_url=url.'news/';
        $p_url=url('advertisements_8362') ;//url.'news/';
        $e_url="";
		?>
        -->
    
</div>
<div class="pagination_box <?php if($total_pages <=1) echo "none";?>">
        <ul class="pagination in">
        
           
            <li class="in <?php if($_GET['page'] == 1) echo "none" ?>"><a href="<?=$p_url.'?page=1'.$e_url?>"><?=l('First <> الاولى');?></a></li>
            
            <li class="<?php if($page <= 1){ echo 'disabled'; } ?>  in <?php if($_GET['page'] == 1) echo "none" ?>">
                <a href="<?php if($page == 1 || $page < 1){ echo $p_url.'?page=1'.$e_url; } else { echo $p_url."?page=".($page -1).$e_url; } ?>"><?=l('Prev <> السابق');?></a>
            </li>
            <ul class="in " id="pagination_list"><?php 
            for($page_numbers=1;$page_numbers<=$total_pages;$page_numbers++){?> 
                <li class="in  list <?php if($page_numbers==$_GET['page']) echo 'active'?>"> 
                    <a class="" href="<?php echo $p_url."?page=".($page_numbers).$e_url?>" ><?= $page_numbers; ?></a>
                </li>  
                <?php }?>
            </ul>
            <li class="<?php if($page >= $total_pages){ echo 'disabled'; } ?>  in  <?php if($_GET['page'] == $total_pages) echo "none" ?>">
                <a href="<?php if($page >= $total_pages){ echo $p_url.'?page='.$total_pages.$e_url; } else { echo $p_url."?page=".($page + 1).$e_url; } ?>"><?=l('Next <> التالي');?></a>
            </li>
            
            <li class="in <?php if($_GET['page'] == $total_pages) echo "none" ?>"><a href="<?php echo $p_url.'?page='.$total_pages.$e_url; ?>"><?=l('Last <> الاخيرة');?></a></li>
        </ul>

        </div>


        <script>
           
</script>

<?php include 'legion_share.php'?>


<?php require 'footer.php';?>