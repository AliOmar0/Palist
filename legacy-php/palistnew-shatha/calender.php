<script src="<?= fres?>js/calendar.js<?php clearCache();?>"></script>
<link rel="stylesheet" type="text/css" href="<?= fres?>css/calendarTheme.css<?php clearCache();?>"/>
			
<div id="caleandar"></div>



	<script>
			
		var events = [
				  <?php
	 
$resp=db($_m);	
//if($resp==1)json(true,-1);
$res=array();
for($i=0;$i<count($resp);$i++){
	if($resp==1)continue;
			?>
	{'Date': new Date("<?php echo str_replace('-','/',cleanDate($resp[$i]['event_date']));?>"), 'Title': "<?= htmlspecialchars(l($resp[$i]['title']));?>", 'Link': '<?= url($_m,'single',$resp[$i]['id']);?>'},


   
   <?php }

	  ?>
			
];
		
		var settings = {
  			 Color:'#A4A242',
			LinkColor:'#5B2D6D',
             DateTimeShow: true,
  
};
		
		
		var element = document.getElementById('caleandar');
		caleandar(element, events, settings);
		
				

			</script>