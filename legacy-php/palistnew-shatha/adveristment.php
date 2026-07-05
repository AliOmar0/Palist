<?php require 'header.php';?>


<div id="event" class="w1200">
	<div class="event_photo in"><?php pic(l($post['photo']))?></div>	

 <div class="events_and_conferences_events_description mce in">
    <div><?=l($post['title'])?></div>
	<?= l($post['content'])?>
	<div><?= l($post['publish_date'])?></div>	
	</div>	   
</div>



<?php require 'footer.php';?>