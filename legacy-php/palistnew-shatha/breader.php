
<?php
$sub=NULL;

	$resp=db('menu_items_1564508835','WHERE menu_key=12 AND deleted=0 AND sub_of=0','ORDER BY order_num ASC');

				for($i=0;$i<count($resp);$i++){
					if(linker($resp[$i])==url.ltrim(str_replace(cms_folder,'',$uri),'/')){
						$main=$resp[$i];
						break;
					}
					
					$respa=db('menu_items_1564508835','WHERE deleted=0 AND sub_of='.$resp[$i]['id'],'ORDER BY order_num ASC');
					
					if($respa!=1){
						
					for($k=0;$k<count($respa);$k++){
						if(linker($respa[$k])==url.ltrim(str_replace(cms_folder,'',$uri),'/')){
							$sub=$respa[$k];
							$main=$resp=db('menu_items_1564508835',"WHERE id='".$sub['sub_of']."'")[0];
							break 2;
							}
					}
					}
				
					
				}
		
			
	?>
	<?php if(isset($main) && $main!=NULL){?>
<div id="breader">
		<?php /*

			<a class="breader_item mid" href="<?= url?>" title="<?=l('Home<>الرئيسية');?>">
			<?=l('Home<>الرئيسية');?>
			 </a>
		<div class="breader_sep mid">></div>
		*/
										  
	 ?>

	
		<a class="breader_item mid"  target="<?= $main['open_new_window']==0 ? '_self':'_blank';?>" <?php if(linker($main)!='#'){?> href="<?= linker($main);?>" <?php }?> title="<?= l(menuTitle($main));?>">
		<?= l(menuTitle($main));?>
   		 </a>
<?php }?>


<?php if($sub!=NULL){?>	
	<div class="breader_sep mid">></div>
		<a class="breader_item mid"  target="<?= $sub['open_new_window']==0 ? '_self':'_blank';?>" <?php if(linker($sub)!='#'){?> href="<?= linker($sub);?>" <?php }?> title="<?= l(menuTitle($sub));?>">
		<?= l(menuTitle($sub));?>
   		 </a>
<?php }?>

		<?php if(isset($main) && $main!=NULL){?>
	
</div>

<?php }?>