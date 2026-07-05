<?php require 'header.php';?>


<div id="">

<?php $_m='photos_8366';?>
<div id="photos_wrap" class="w1200">
<h1 id="events_header"><?=mn($_m)?></h1>
    <section class="pintrest">
    <!--<?php
    $resp=db($_m,'where deleted=0 and album_category='.$indicator,NULL);
    if($resp==1) echo '<div class="no_data">'.l('No Data<>لا مُدخلات').'</div>';
    else { for($i=0;$i<count($resp);$i++){?>


     --><img class="photos_box pintresta in"  src="<?= uploads_link.img($resp[$i]['photo'],500,100);?>" data-fancybox="gallery" href="<?= uploads_link.img($resp[$i]['photo'],1500,100);?>" style="width:100%" class="pointer"><!--




    <?php 
    }//for
    }//else
    unset($resp);?>
    -->
    </section>

</div>



</div>

<?php include 'legion_share.php'?>


<?php require 'footer.php';?>