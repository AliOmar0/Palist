<?php require 'header.php';?>

<div id="back_col_join">
    <div class="w1200">
    <h1 id="join_header"><?=l('Share your resume<>شاركنا سيرتك الذاتية')?></h1>

    <section class="join_form_wrap">
        <?php 
        $passOnce=true;
        require modules_dir."join_us_8367/views/add.php";
        ?>
        

        <input type="hidden" form="join_us_8367" name="user" value="<?=rand()?>"/>
        <input class="send_btn po" type="submit" form="join_us_8367" value="<?=l('Send<>ارسال')?>"/>
    </section>
</div>

<div id="SuccessJoinededBox" style="display: none">
			         <?= l('Thank you for contacting us, we will get back to you as soon as possible.<>شكراً لتواصلك معنا، سنعود لك\ي بأقرب وقت.')?>
	 	</div>
</div>  
<m50></m50>

<script>
 function successJoined(){

$(".join_form_wrap").hide();4
$("#SuccessJoinededBox").show();
}
</script>


<?php require 'footer.php';?>