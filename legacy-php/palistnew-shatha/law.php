<?php require 'header.php';?>


<section id="laws" class="laws w1200">

    <div class="laws_box in" >
        <h2 class="laws_title"><?=l($post['title']);?></h2>
        <p class="laws_content mce"><?=l($post['content']);?></p>
        <time><?=$post['date_created']?></time>
    </div>
</section>
<?php require 'footer.php';?>