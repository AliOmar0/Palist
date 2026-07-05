<?php require 'header.php';?>



<div id="event" class="w1200">

<div class="single_news_title"><?= l($post['title'])?></div>	


	<div class="event_photo in"><?php pic(l($post['photo']))?></div>	
 <div class="events_and_conferences_events_description mce in">

	<?= l($post['content'])?>
	<div><?= l($post['event_date'])?></div>	
	</div>	   
</div>


<?php include 'legion_share.php'?>


<?php require 'footer.php';?>