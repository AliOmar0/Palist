<?php
include 'header.php';

if(file_exists(cms_dir.'403.php')){
    include cms_dir.'403.php';
   
} else{?>

<div class="l_f48 l_mb150 l_mt150 l_center">
    <i class="l_gray_c l_mb30 l_dis_block l_f150">search_off</i>    
<?=l('Not Found<>صفحة غير موجودة')?>
</div>

<?php }

include 'footer.php';