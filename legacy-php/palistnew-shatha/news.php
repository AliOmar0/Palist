<?php 
require 'header.php';?>


<?php $_m='news_8362';?>
<link rel="stylesheet" type="text/css" href="<?=fres?>css/section_redesign.css<?php clearCache()?>" media="all" />
<div class="prx prx-news">
    <div class="prx-hero">
        <div class="w1200 prx-hero-inner">
            <nav class="prx-bc"><a href="<?=url.curr()?>"><?=l('Home<>الرئيسية')?></a><i>/</i><span><?=mn($_m)?></span>
            </nav>
            <h1 class="prx-hero-title"><?=mn($_m)?></h1>
            <span class="prx-hero-bar"></span>
            <p class="prx-hero-sub">
                <?=l('The latest news and updates from the syndicate.<>آخر الأخبار والمستجدات من النقابة.')?></p>
        </div>
    </div>




    <section id="latest_news_wrap" class="major_section w1200">
        <div class="line_box">
            <div class="title_line mid"></div>
            <!--
<<<<<<< HEAD
	-->
            <h1 class="about_title mid"><a title="<?=mn($_m)?>"
                    href="<?=url($_m)?>"><?=l("Latest News<>أخر الأخبار ")?></a></h1>
            =======
            --><h1 class="about_title mid"><a title="<?=mn($_m)?>"
                    href="<?=url($_m)?>"><?=l("Latest News<>أخر الأخبار ")?></a></h1>
            >>>>>>> origin/Ali
        </div>
        <!--<?php
$resp=db($_m,NULL,'ORDER BY publish_date DESC',"limit 1");
if($resp==1) echo '<div class="no_data">'.l('No Data<>لا مُدخلات').'</div>';
else { for($i=0;$i<count($resp);$i++){?>
-->
        <div id="last_box"><?=l('Latest News<>أخر الأخبار')?></div>
        <!--
--><a class="news_box in" title="<?=l($resp[$i]['title']) ?>" href="<?=url($_m,'single',$resp[$i]['id'])?>">
            <?php pic($resp[$i]['photo'],400,100,l($resp[$i]['title']),true,NULL,'news_photo_picture');?>
            <black_s2></black_s2 />
            <div class="news_cont">
                <h2 class="news_title"><?=l($resp[$i]['title']);?></h2>
                <div class="news_summary el"><?=l($resp[$i]['summary']);?></div>
                <!-- <h2 class="news_publish_date"><?=$resp[$i]['publish_date']?></h2>
<h2 id="more" class="in"><?=l('More<>المزيد')?></h2> -->
            </div>
        </a>
        <!--
<?php 
}//for
}//else
unset($resp);?>
-->
    </section>












    <div class="w1200 box_news">
        <div class="about_title">
            <div class="line_box">
                <div class="title_line mid"></div>
                <!--
                -->
                <h2 class="mid" id="more_news_header"><?=l('More Syndicate News<> المزيد من اخبار النقابة')?></h2>
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
    $respa=db($_m,NULL,'ORDER BY publish_date DESC');
    if($respa==1) echo '<div class="no_data">'.l('No Data<>لا مُدخلات').'</div>';
    $counter=count($respa);
    $total_pages=ceil($counter/$no_of_records_per_page);
    $resp=db($_m,NULL,'ORDER BY publish_date DESC','limit '.$offset.','.$no_of_records_per_page.'');

    if($resp==1) echo '<div class="no_data">'.l('No Data<>لا مُدخلات').'</div>';
         else { for($i=0;$i<count($resp);$i++){
            // echo $resp[$i]['id'];
            // echo "               ";
    ?> -->
            <a class="other_news in" title="<?=l($resp[$i]['title']) ?>" href="<?=url($_m,'single',$resp[$i]['id'])?>">
                <div class="news_left  in">
                    <?php pic($resp[$i]['photo'],400,100,l($resp[$i]['title']),true,NULL,'other_news_photo_picture');?>
                </div>
                <!--
                -->
                <div class="news_right  in">
                    <h2 class="other_news_title el"><?=l($resp[$i]['title']);?></h2>
                    <!-- <h2 class="other_news_title el"><?=l($resp[$i]['id']);?></h2> -->

                    <div class=" news_info">
                        <h2 class="news_publish_date in w50"><?=l($resp[$i]['publish_date']);?></h2>
                        <!--
<<<<<<< HEAD
            						-->
                        <h2 id="more" class="in w50"><?=l('More ...<>  المزيد...')?></h2>
                        =======
                        --><h2 id="more" class="in w50"><?=l('More ...<>  المزيد...')?></h2>
                        >>>>>>> origin/Ali
                    </div>
                </div>
            </a>
            <!--
        <?php 
            }//for
        }//else
        unset($resp);
<<<<<<< HEAD
		
		// $p_url=url.'news/';
=======
                
                // $p_url=url.'news/';
>>>>>>> origin/Ali
        $p_url=url('news_8362') ;//url.'news/';
        $e_url="";//'/'.curr();
        // $page=$_GET['page'];
        // d($page);
<<<<<<< HEAD
		?>
=======
                ?>
>>>>>>> origin/Ali
        -->

        </div>
        <div class="pagination_box <?php if($total_pages <=1) echo "none";?>">
            <ul class="pagination in">


                <li class="in <?php if($_GET['page'] == 1) echo "none" ?>"><a
                        href="<?=$p_url.'?page=1'.$e_url?>"><?=l('First <> الاولى');?></a></li>

                <li class="<?php if($page <= 1){ echo 'disabled'; } ?>  in <?php if($_GET['page'] == 1) echo "none" ?>">
                    <a
                        href="<?php if($page == 1 || $page < 1){ echo $p_url.'?page=1'.$e_url; } else { echo $p_url."?page=".($page -1).$e_url; } ?>"><?=l('Prev <> السابق');?></a>
                </li>
                <ul class="in " id="pagination_list"><?php 
            for($page_numbers=1;$page_numbers<=$total_pages;$page_numbers++){?>
                    <li class="in  list <?php if($page_numbers==$_GET['page']) echo 'active'?>">
                        <a class="" href="<?php echo $p_url."?page=".($page_numbers).$e_url?>"><?= $page_numbers; ?></a>
                    </li>
                    <?php }?>
                </ul>
                <li
                    class="<?php if($page >= $total_pages){ echo 'disabled'; } ?>  in  <?php if($_GET['page'] == $total_pages) echo "none" ?>">
                    <a
                        href="<?php if($page >= $total_pages){ echo $p_url.'?page='.$total_pages.$e_url; } else { echo $p_url."?page=".($page + 1).$e_url; } ?>"><?=l('Next <> التالي');?></a>
                </li>

                <li class="in <?php if($_GET['page'] == $total_pages) echo "none" ?>"><a
                        href="<?php echo $p_url.'?page='.$total_pages.$e_url; ?>"><?=l('Last <> الاخيرة');?></a></li>
            </ul>

        </div>


        <script>

        </script>

        <?php include 'legion_share.php'?>
        <<<<<<< HEAD=======</div>
            <!--/.prx-->
            >>>>>>> origin/Ali


            <?php require 'footer.php';?>