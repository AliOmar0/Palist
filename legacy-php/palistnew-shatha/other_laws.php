<?php require 'header.php';?>





<?php $_m='other_laws_8419';?>
<link rel="stylesheet" type="text/css" href="<?=fres?>css/section_redesign.css<?php clearCache()?>" media="all" />
<div class="prx prx-laws">
    <div class="prx-hero">
        <div class="w1200 prx-hero-inner">
            <nav class="prx-bc"><a href="<?=url.curr()?>"><?=l('Home<>الرئيسية')?></a><i>/</i><span><?=mn($_m)?></span>
            </nav>
            <h1 class="prx-hero-title"><?=mn($_m)?></h1>
            <span class="prx-hero-bar"></span>
            <p class="prx-hero-sub">
                <?=l('Laws, regulations and legal documents of the syndicate.<>القوانين والأنظمة والوثائق القانونية الخاصة بالنقابة.')?>
            </p>
        </div>
    </div>
    <div id="other_laws_wrap" class="major_section w1200">
        <div class="line_box">
            <div class="title_line mid"></div>
            <!--
                -->
            <h2 class="about_title mid"><?=mn($_m)?></h2>
        </div>
        <ol type="1" style="list-style: square;">
            <!--<?php 
    
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
            $resp=db($_m,NULL,"ORDER BY date_created DESC",'limit '.$offset.','.$no_of_records_per_page.'');

            if($resp==1) echo '<div class="no_data">'.l('No Data<>لا مُدخلات').'</div>';
                else { for($i=0;$i<count($resp);$i++){
                    // echo $resp[$i]['id'];
                    // echo "               ";
            ?> -->
            <li class="other_laws_box ">
                <!-- <h2 class="other_laws_title"><?=l($resp[$i]['title']);?></h2> -->

                <div class="other_laws_content "><?=l($resp[$i]['summary']);?></div>
                <!--
                --><a class="other_laws_link"
                    href="<?=url($_m,'single',$resp[$i]['id'])?>"><?=l('Click here <> انقر هنا');?></a>

            </li>
            <!--
                <?php 
                    }//for
                }//else
                unset($resp);
                $p_url=url($_m);
                // $e_url='/'.curr();

                ?>
                -->
        </ol>
    </div>
    <div class="pagination_box <?php if($total_pages <=1) echo "none";?>">
        <ul class="pagination in">


            <li class="in <?php if($_GET['page'] == 1) echo "none" ?>"><a
                    href="<?=$p_url.'?page=1'?>"><?=l('First <> الاولى');?></a></li>

            <li class="<?php if($page <= 1){ echo 'disabled'; } ?>  in <?php if($_GET['page'] == 1) echo "none" ?>">
                <a
                    href="<?php if($page == 1 || $page < 1){ echo $p_url.'?page=1'; } else { echo $p_url."?page=".($page -1); } ?>"><?=l('Prev <> السابق');?></a>
            </li>
            <ul class="in " id="pagination_list"><?php 
            for($page_numbers=1;$page_numbers<=$total_pages;$page_numbers++){?>
                <li class="in  list <?php if($page_numbers==$_GET['page']) echo 'active'?>">
                    <a class="" href="<?php echo $p_url."?page=".($page_numbers)?>"><?= $page_numbers; ?></a>
                </li>
                <?php }?>
            </ul>
            <li
                class="<?php if($page >= $total_pages){ echo 'disabled'; } ?>  in  <?php if($_GET['page'] == $total_pages) echo "none" ?>">
                <a
                    href="<?php if($page >= $total_pages){ echo $p_url.'?page='.$total_pages; } else { echo $p_url."?page=".($page + 1); } ?>"><?=l('Next <> التالي');?></a>
            </li>

            <li class="in <?php if($_GET['page'] == $total_pages) echo "none" ?>"><a
                    href="<?php echo $p_url.'?page='.$total_pages; ?>"><?=l('Last <> الاخيرة');?></a></li>
        </ul>

    </div>


    <?php include 'legion_share.php'?>
    <<<<<<< HEAD=======</div>
        <!--/.prx-->
        >>>>>>> origin/Ali


        <?php require 'footer.php';?>