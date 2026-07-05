<?php require 'header.php';?>

<?php $_m='video_gallery_8367';?>
<link rel="stylesheet" type="text/css" href="<?=fres?>css/section_redesign.css<?php clearCache()?>" media="all" />
<div class="prx prx-videos">
    <div class="prx-hero">
        <div class="w1200 prx-hero-inner">
            <nav class="prx-bc"><a href="<?=url.curr()?>"><?=l('Home<>الرئيسية')?></a><i>/</i><span><?=mn($_m)?></span>
            </nav>
            <h1 class="prx-hero-title"><?=mn($_m)?></h1>
            <span class="prx-hero-bar"></span>
            <p class="prx-hero-sub">
                <?=l('Video gallery of the syndicate events and coverage.<>مكتبة فيديو لفعاليات النقابة وتغطياتها.')?>
            </p>
        </div>
    </div>
    <div id="">
        <div id="calender_wrap" class="major_section w1200">
            <div class="line_box">
                <div class="title_line mid"></div>
                <!--
<<<<<<< HEAD
	-->
                <h1 class="about_title mid"><?=mn($_m)?></h1>
                =======
                --><h1 class="about_title mid"><?=mn($_m)?></h1>
                >>>>>>> origin/Ali
            </div>
            <section id="photos_library_wrap" class="major_section ">



                <div id="more_news_left" class="l_grid2">

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
                ?> --><a class="video_gallery_box in" title="<?=l($resp[$i]['title']) ?>"
                        href="<?=url($_m,'single',$resp[$i]['id'])?>">
                        <!---->
                        <div class="video_gallery_youtube_link"><?= yt($resp[$i]);?></div>
                        <div class="video_gallery_title"><?=l($resp[$i]['title']);?></div>

                    </a>
                    <!--
        <?php 
            }//for
        }//else
        unset($resp);
        $p_url=url($_m);
        // $e_url='/'.curr();
        ?>
        -->

                </div>
                <div class="pagination_box <?php if($total_pages <=1) echo "none";?>">
                    <ul class="pagination in">


                        <li class="in <?php if($_GET['page'] == 1) echo "none" ?>"><a
                                href="<?=$p_url.'?page=1'?>"><?=l('First <> الاولى');?></a></li>

                        <li
                            class="<?php if($page <= 1){ echo 'disabled'; } ?>  in <?php if($_GET['page'] == 1) echo "none" ?>">
                            <a
                                href="<?php if($page == 1 || $page < 1){ echo $p_url.'?page=1'; } else { echo $p_url."?page=".($page -1); } ?>"><?=l('Prev <> السابق');?></a>
                        </li>
                        <ul class="in " id="pagination_list"><?php 
            for($page_numbers=1;$page_numbers<=$total_pages;$page_numbers++){?>
                            <li class="in  list <?php if($page_numbers==$_GET['page']) echo 'active'?>">
                                <a class=""
                                    href="<?php echo $p_url."?page=".($page_numbers)?>"><?= $page_numbers; ?></a>
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
            </section>
        </div>

    </div>


    <?php include 'legion_share.php'?>
    <<<<<<< HEAD=======</div>
        <!--/.prx-->
        >>>>>>> origin/Ali




        <?php require 'footer.php';?>