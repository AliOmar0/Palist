<?php require 'header.php';?>

<?php $_m='internal_system_8367';?>
<link rel="stylesheet" type="text/css" href="<?=fres?>css/section_redesign.css<?php clearCache()?>" media="all" />
<div class="prx prx-system">
    <div class="prx-hero">
        <div class="w1200 prx-hero-inner">
            <nav class="prx-bc"><a
                    href="<?=url.curr()?>"><?=l('Home<>الرئيسية')?></a><i>/</i><span><?=l('Internal System<>النظام الداخلي')?></span>
            </nav>
            <h1 class="prx-hero-title"><?=l('The internal system of the syndicate<>النظام الداخلي للنقابة')?></h1>
            <span class="prx-hero-bar"></span>
        </div>
    </div>
    <div id="">
        <section id="internal_system_wrap" class="major_section w1200">

            <!--<?php
    $resp=db($_m,NULL,NULL);
    if($resp==1) echo '<div class="no_data">'.l('No Data<>لا مُدخلات').'</div>';
    else { for($i=0;$i<count($resp);$i++){?>
    -->
            <div class="internal_system_box in" title="<?=l($resp[$i]['title']) ?>"
                href="<?=url($_m,'single',$resp[$i]['id'])?>">

                <iframe src="<?=u.$resp[$i]['pdf_file']?>" class="pdf_file" frameborder="0"></iframe>
                <div id="pdf_butn_wrap">
                    <a class="pdf_buttons in" title="<?=l($resp[$i]['title'])?>" href="<?=u.$resp[$i]['pdf_file']?>"
                        download><?=l('Download<>تحميل')?></a>


                    <!-- <a class="pdf_buttons in" target="_blank" href="<?=u.$resp[$i]['pdf_file']?>"  title="<?=l($resp[$i]['title'])?>" ><?=l('Read<>قراءة')?><a> -->
                </div>

            </div>
            <!--
    <?php 
    }//for
    }//else
    unset($resp);?>
    -->
        </section>

    </div>
    <<<<<<< HEAD=======</div>
        <!--/.prx-->
        >>>>>>> origin/Ali

        <?php require 'footer.php';?>