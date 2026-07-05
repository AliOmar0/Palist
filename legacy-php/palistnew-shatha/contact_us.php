

    <Section class="" id="contact_wrap">
        <div id="contact_form" class="w70 in">
			<div id="form_">
            <?php
            $passOnce=true;
            require modules_dir."contact_form_8363/views/add.php";
            ?>

        <input type="hidden" form="contact_form_8363" name="new_user" value="<?=rand()?>"/>
	
        <input class="send_icon po" type="submit" form="contact_form_8363" value="<?=l('> <> <')?>">

	</div>

		<div id="SuccessJoinededBox" style="display: none">
			         <?= l('Thank you for contacting us, we will get back to you as soon as possible.<>شكراً لتواصلك معنا، سنعود لك\ي بأقرب وقت.')?>
	 	</div>

		
        </div><!--
        --><div id="contact_info" class="w30 in">

		<h1 id="contact_title"><?=l('Contact Info<>معلومات التواصل')?></h1>
			<?php
			$resp=db('contact_info_8363')[0];
			?>
   
        <div class="c_d">
				<div class="c_i mid">
					<i>phone_enabled</i>
				</div><!--
				--><div class="c_info mid bidi">
					<a href="tel:<?=$resp['phone']?>"><?=$resp['phone']?></a>
				</div>
			</div>		
			
			<div class="c_d">
				<div class="c_i mid">
					<i>email</i>
				</div><!--
				--><div class="c_info mid bidi">
					<a href="mailto:<?=$resp['email']?>"><?=$resp['email']?></a>		
				</div>
			</div>
						
			<div class="c_d">
				<div class="c_i mid">
					<i>location_on</i>
				</div><!--
			--><div class="c_info mid">
					<?=l($resp['location']);?>
				</div>
			</div>

			<div class="c_d">
		<div id="social_links_wrap">
			<!--<?php
			$_m='social_links_8363';
			$resp=db($_m,NULL,NULL);
			if($resp==1) echo 'No Data';
			else { for($i=0;$i<count($resp);$i++){?>
			--><a class="social_links_box social in"  title="<?=l($resp[$i]['title']) ?>" href="<?=$resp[$i]['link']?>" target="_blank">
					<?=$resp[$i]['social_font']?>
				</a><!--
			<?php 
				}//for
			}//else
			unset($resp);?>
			-->
		</div>
		</div>
        <div>


    </section>  

	<script>
 function successConnected(){

$("#form_").hide();
$("#SuccessJoinededBox").show();
}
</script>

