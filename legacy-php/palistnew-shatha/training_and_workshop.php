<?php require 'header.php';?>



<div id="event" class="w1200">

<div class="single_news_title"><?= l($post['title'])?></div>	


	<div class="event_photo in"><?php pic($post['photo'])?></div>	
 <div class="events_and_conferences_events_description mce ">

	<?= l($post['content'])?>
	<div><?= l($post['publish_date'])?></div>	
	</div>	   
</div>



<?php require 'footer.php';?>