<?php require_once 'panel/core/config.php';
$noAOS=true;
$user_id=isset($_SESSION['user_id'])?$_SESSION['user_id']:NULL;



require 'legion_header.php';

// echo $noLangLink;
if(!isset($_GET['mobile'])){?>



<header>
	
	<div class="w1200">
		<div class="menu_right">
	

		<div class="menu_top_wrap">
				<div id="top_head" class="mid ">
							<div class="mid w35 header_signin">
									<?php if(!isLogged(mid($_user))){?>
								<a class="c_header_login mid" href="<?=urlp('signin')?>" title="<?=pn('signin')?>">
									<i class="mid">person</i>
									<span class="mid"><?=pn('signin')?></span>
								</a>
							
									<?php }else{
									?>
									
									<div id="client_header_area" class="mid">
										<div id="hello" class="mid po">
												<?php 
												$_m=$_user;
												$user=db($_m,"WHERE id='".$_SESSION['user_id']."'")[0];?>
													
												<h2 class="in"><?= l('Hello<>مرحبا').' '.l($user['username'])?></h2><!--
									--><i class="arrow_h in">expand_circle_down</i>
												<!-- <div id="profile_photo" class="mid">
													<?= pic(l($user['profile_photo']));?>
												</div> -->

								
										</div><!--
									--><div id="client_menu">

										<a class="c_header_client_menu_item mid" href="<?=urlp('dashboard')?>" title="<?=pn('dashboard')?>">
											<!-- <i class="mid">account_circle</i> -->
											<span class="mid"><?=pn('dashboard')?></span>
										</a>
										<a class="c_header_client_menu_item mid" href="<?=urlp('edit-profile')?>" title="<?=pn('edit-profile')?>">
											<!-- <i class="mid">account_circle</i> -->
											<span class="mid"><?=pn('edit-profile')?></span>
										</a>
										
										<a class="c_header_client_menu_item mid" href="<?=urlp('change-password')?>" title="<?=pn('change-password')?>">
											<!-- <i class="mid">password</i> -->
											<span class="mid"><?=pn('change-password')?></span>
										</a>

										<a class="c_header_client_menu_item mid" href="<?=urlPanel.'logout.php?location='.url?>" title="<?=l('Logout<>تسجيل خروج')?>">
											<!-- <i class="mid">logout</i> -->
											<span class="mid"><?=l('Logout<>تسجيل خروج')?></span>
										</a>
									
									</div>
			
								</div>
							
								<?php } ?>
							</div><!--
							
						--><div id="search" class="pointer mid w45">			
							<label class="pointer mid" for="search_field" onClick="toggle('search_field')"><i class="mid">search</i></label>
							
							<form id="search_box" class="mid" action="<?php echo url;?>search.php/<?php echo curr();?>" method="get">
								<input class="" name="search" id="search_field"  value="<?= isset($_GET['search'])?$_GET['search']:'';?>"  type="text" placeholder="<?= l('Search here..<>ابحث هنا..');?>"/>
								<input name="lang" type="hidden" value="<?php echo curr();?>"/>
							</form>
						</div><!--

						--><div class="lang_wrap  mid w10 header_box_top_left">
									<?php 
										for($i=0;$i<count($langArr);$i++){if(curr() != $langArr[$i]['prefix']){?>
											<a class="noselect mid  langa " href="<?=switch_link_lang($langArr[$i]['prefix'])?>" title="<?= $langArr[$i]['language_name'];?>"><?= l($langArr[$i]['language_name']);?></a>
								<?php 
									}}//for
									?>
							</div>
				
				</div>


			</div> <!--signup,search, and lang-->
		
	<div class="menu_bottom_wrap">
			
	
			<div id="mob_menu_btn" onclick="toggle('menuCont','toggler_menu')">
								<i class="mob_icon mid">menu</i><span class="mid"></span>
					</div>
			<a  href="<?= url.curr()?>" title="<?= l($settings['site_name'])?>" class="logo_menu_box w30 mid">
			<?php if(curr() == "ar"){ 
								pic(c('ar_logo','photo'),1000,100,l($settings['site_name']),true,'logo_menu_ar','mid');

				}else{
					pic($settings['logo'],1000,100,l($settings['site_name']),true,'logo_menu','mid');

				}?>
			
			</a><!--
			--><div id="menuCont" class="toggler_menu w70 mid">
			<ul class="real_main_ul  mid">
										<!--<?php
										//	if(isLogged($_m_id))$ied=7;
										//		else 
													$ied=14;
											
										$resp=db('menu_items_1564508835','WHERE menu_key='.$ied.' AND deleted=0 AND sub_of=0','ORDER BY order_num ASC');
										if($resp==0)  echo 'error';
										else if($resp==1) echo 'No Data';
										else { for($i=0;$i<count($resp);$i++){?>
										--><li class="noselect menu_items_box in">
											<a class="head" data-id="<?=$resp[$i]['id']?>"  target="<?= $resp[$i]['open_new_window']==0 ? '_self':'_blank';?>" <?php if(linker($resp[$i])!='#'){?> href="<?= linker($resp[$i]);?>" <?php }?> title="<?= l(menuTitle($resp[$i]));?>">
												<?= l(menuTitle($resp[$i]));?>
											</a>
												
												<?php
																	#second level
													$respa=db('menu_items_1564508835','WHERE deleted=0 AND sub_of='.$resp[$i]['id'],'ORDER BY order_num ASC');
																if($respa!=0 && $respa!=1){?>
									<div class="new_sub">
									<ul class="menu_btns mid w60">
												<?php for($k=0;$k<count($respa);$k++){
											if($k%2==0 && $k!=0)echo '<clear></clear>';
											?>	
															<li class="noselect sub_li_btn in">
													<a class="sub_menu_item_btn" target="<?= $respa[$k]['open_new_window']==0 ? '_self':'_blank';?>" <?php if(linker($respa[$k])!='#'){?> href="<?= linker($respa[$k]);?>" <?php }?>  title="<?= l(menuTitle($respa[$k]));?>">
														<?= l(menuTitle($respa[$k]));?>
													</a>
																
													
																		<?php 
																					#3rd level
													$respan=db('menu_items_1564508835','WHERE  deleted=0 AND sub_of='.$respa[$k]['id'],'ORDER BY order_num ASC');
																if($respan!=0 && $respan!=1){?>
									<ul class="tri_sub_menu">
												<?php for($kn=0;$kn<count($respan);$kn++){?>
															<li>
													<a class="tri_sub_menu_item" target="<?= $respan[$kn]['open_new_window']==0 ? '_self':'_blank';?>" <?php if(linker($respan[$kn])!='#'){?> href="<?= linker($respan[$kn]);?>" <?php }?>  title="<?= l(menuTitle($respan[$kn]));?>">
														<?= l(menuTitle($respan[$kn]));?>
													</a>
												</li>
												<?php }?>
												
												</ul>
												<?php }
												?>
																
																
																
												</li>
												<?php }?>
												
												</ul>

										</div><!--menu_btns-->
												<?php }
												?>
									
												</li><!--


							<?php 
								}//for
							}//else
							unset($resp);?>
							-->
				</ul>
		
		</div>

		</div>


	</div>


	</div>
			 
			 
			 
		
		
		</div>
	
	<?php if(isset($is_home)){?>
				<style>

/* 					
	#site_name {
		color:white;
	} */

					a.head{
						/* color:white; */
					}
					#mob_menu_btn{
						color:white;
					}
			
					.langa{
						/* color:white !important; */
						border-right: 1px solid black !important;
					}

						
					.langa:last-child{
					border-right: unset !important;
					}


	</style>
			


<script>
	$(document).scroll(function() {
  var y = $(this).scrollTop();
  if (y > 1) {
    //    $('header').css('background','#0f0e0ed6');
    // $('.all_menu_content').css('color','white');
	//   $('#logo_menu').css('filter','brightness(100)');


//	   $('.all_menu_content').css('background','black');
//    $('#search i').css('color','black');
	  
//	  $('.logo_menu_box').css('visibility','visible');
  } else {
	// $('#logo_menu').css('filter','unset');
    // $('header').css('background','none');
//	    $('.all_menu_content').css('background','none');
	   $('.all_menu_content').css('color','black');
//    $('#search i').css('color','black');

//	  	  $('.logo_menu_box').css('visibility','hidden');
  }
});
		
		
		</script>
		
	
	<?php }?>
	</header>
<?php }else{?>

<?php }?>
	<main>
			
	 <?php if(!isset($is_home) && !g('mobile')){?>
				<mh></mh>
			  <?php }?>

	