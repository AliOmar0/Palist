<?php require 'header.php';?>

<link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<?php $_m='events_8362';?>
<link rel="stylesheet" type="text/css" href="<?=fres?>css/section_redesign.css<?php clearCache()?>" media="all" />
<div class="prx prx-events">
    <div class="prx-hero">
        <div class="w1200 prx-hero-inner">
            <nav class="prx-bc"><a href="<?=url.curr()?>"><?=l('Home<>الرئيسية')?></a><i>/</i><span><?=mn($_m)?></span>
            </nav>
            <h1 class="prx-hero-title"><?=mn($_m)?></h1>
            <span class="prx-hero-bar"></span>
            <p class="prx-hero-sub">
                <?=l('Syndicate events, activities and important dates.<>مناسبات النقابة وأنشطتها والمواعيد المهمة.')?>
            </p>
        </div>
    </div>

    <div id="back_col2">

        <section id="calender_wrap" class="major_section w1200">
            <div class="line_box">
                <div class="title_line mid"></div>
                <!--
<<<<<<< HEAD
	-->
                <h1 class="about_title mid"><?=mn($_m)?></h1>
            </div>


            <?php include 'calender.php'?>
            =======
            --><h1 class="about_title mid"><?=mn($_m)?></h1>
    </div>


    <?php include 'calender.php'?>
    >>>>>>> origin/Ali
    </section>

</div>

<section id="single_events_wrap" class="major_section w1200">
    <div class="line_box">
        <div class="title_line mid"></div>
        <!--
<<<<<<< HEAD
	-->
        <h1 class="about_title mid"><?=l('Upcoming Events<>المناسبات القادمة')?></h1>
    </div>
    <?php $_m='events_8362';?>
    <div class="l_grid2">
        <!--<?php
$resp=db($_m,"WHERE deleted=0 and event_date >= '".date('Y-m-d')."'",NULL);
if($resp==1) echo '<div class="no_data">'.l('No Data<>لا مُدخلات').'</div>';
	elseif($resp==0) echo '<div class="no_data">'.l('No Data<>لا مُدخلات').'</div>';
else { for($i=0;$i<count($resp);$i++){?>
--><a class="upcoming_events_box in" title="<?=l($resp[$i]['title']) ?>" href="<?=url($_m,'single',$resp[$i]['id'])?>">
            <?php pic($resp[$i]['photo'],400,100,l($resp[$i]['title']),true,NULL,'events_photo_picture4');?>
            <div class="program_cont">
                <h2 class="events_title4 el"><?=l($resp[$i]['title']);?></h2>

                <div class="d_m_box">
                    <h2 class="news_publish_date4 mid w50"><?=l($resp[$i]['event_date']);?></h2>
                    <!--
			-->
                    <h2 id="more" class="mid w50"><?=l('More <>المزيد')?></h2>
                </div>
            </div>
            =======
            --><h1 class="about_title mid"><?=l('Upcoming Events<>المناسبات القادمة')?></h1>
    </div>
    <?php $_m='events_8362';?>
    <div class="l_grid2">
        <!--<?php
$resp=db($_m,"WHERE deleted=0 and event_date >= '".date('Y-m-d')."'",NULL);
if($resp==1) echo '<div class="no_data">'.l('No Data<>لا مُدخلات').'</div>';
        elseif($resp==0) echo '<div class="no_data">'.l('No Data<>لا مُدخلات').'</div>';
else { for($i=0;$i<count($resp);$i++){?>
--><a class="upcoming_events_box in" title="<?=l($resp[$i]['title']) ?>" href="<?=url($_m,'single',$resp[$i]['id'])?>">
            <?php pic($resp[$i]['photo'],400,100,l($resp[$i]['title']),true,NULL,'events_photo_picture4');?>
            <div class="program_cont">
                <h2 class="events_title4 el"><?=l($resp[$i]['title']);?></h2>

                <div class="d_m_box">
                    <h2 class="news_publish_date4 mid w50"><?=l($resp[$i]['event_date']);?></h2>
                    <!--
                        -->
                    <h2 id="more" class="mid w50"><?=l('More <>المزيد')?></h2>
                </div>
            </div>
            >>>>>>> origin/Ali

        </a>
        <!--
<?php 
    }//for
}//else
unset($resp);?>
-->
        <<<<<<< HEAD </div>

            =======
    </div>

    >>>>>>> origin/Ali



</section>
<<<<<<< HEAD=======>>>>>>> origin/Ali


    <div id="back_col2">
        <?php $_m='events_8362';?>

        <section id="past_events_wrap" class="major_section w1200">
            <<<<<<< HEAD <div class="line_box">
                <div class="title_line mid"></div>
                <!--
	-->
                <h1 class="about_title mid"><?=l('Past Events<>المناسبات الماضية')?></h1>
    </div>
    <div class="past_events_wrap_scro l_grid2">
        =======
        <div class="line_box">
            <div class="title_line mid"></div>
            <!--
        -->
            <h1 class="about_title mid"><?=l('Past Events<>المناسبات الماضية')?></h1>
        </div>
        <div class="past_events_wrap_scro l_grid2">
            >>>>>>> origin/Ali
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
    $respa=db($_m,"WHERE deleted=0 and event_date < '".date('Y-m-d')."'");
    if($respa==1) echo '<div class="no_data">'.l('No Data<>لا مُدخلات').'</div>';
    $counter=count($respa);
    $total_pages=ceil($counter/$no_of_records_per_page);
<<<<<<< HEAD
	$resp=db($_m,"WHERE deleted=0 and event_date < '".date('Y-m-d')."'",NULL,'limit '.$offset.','.$no_of_records_per_page.'');
=======
        $resp=db($_m,"WHERE deleted=0 and event_date < '".date('Y-m-d')."'",NULL,'limit '.$offset.','.$no_of_records_per_page.'');
>>>>>>> origin/Ali


    if($resp==1) echo '<div class="no_data">'.l('No Data<>لا مُدخلات').'</div>';
    elseif($resp==0) echo '<div class="no_data">'.l('No Data<>لا مُدخلات').'</div>';
         else { for($i=0;$i<count($resp);$i++){
            // echo $resp[$i]['id'];
            // echo "               ";
                ?>
<<<<<<< HEAD
				--><a class="past_events_box in" title="<?=l($resp[$i]['title']) ?>" href="<?=url($_m,'single',$resp[$i]['id'])?>">
                <div class="w45 mid">
                    <?php pic($resp[$i]['photo'],400,100,l($resp[$i]['title']),true,NULL,'events_photo_picture3');?>

                </div>
                <!--
		-->
                <div class="w55 mid">
                    <div class="single_event_contetnt">
                        <h2 class="events_title3"><?=l($resp[$i]['title']);?></h2>
                        <div class="d_m_box">
                            <h2 class="news_publish_date3 mid w50"><?=l($resp[$i]['event_date']);?></h2>
                            <!--
				-->
                            <h2 id="more" class="mid w50"><?=l('More <>المزيد')?></h2>
                        </div>
                    </div>
                </div>
                =======
                --><a class="past_events_box in" title="<?=l($resp[$i]['title']) ?>"
                    href="<?=url($_m,'single',$resp[$i]['id'])?>">
                    <div class="w45 mid">
                        <?php pic($resp[$i]['photo'],400,100,l($resp[$i]['title']),true,NULL,'events_photo_picture3');?>

                    </div>
                    <!--
                -->
                    <div class="w55 mid">
                        <div class="single_event_contetnt">
                            <h2 class="events_title3"><?=l($resp[$i]['title']);?></h2>
                            <div class="d_m_box">
                                <h2 class="news_publish_date3 mid w50"><?=l($resp[$i]['event_date']);?></h2>
                                <!--
                                -->
                                <h2 id="more" class="mid w50"><?=l('More <>المزيد')?></h2>
                            </div>
                        </div>
                    </div>
                    >>>>>>> origin/Ali
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
        </section>

    </div>




    <?php include 'legion_share.php'?>
    <<<<<<< HEAD=======</div>
        <!--/.prx-->
        >>>>>>> origin/Ali


        <?php require 'footer.php';?>