<link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>


<<<<<<< HEAD <?php
=======
	 <?php
>>>>>>> origin/Ali

			$tmp=db('home_videos_8429');
			if($tmp==0)  echo 'error';
						else if($tmp!=1) {
							//d($tmp);
							$x=count($tmp);
							//d($x);//4
							$rand=$tmp[rand(0,$x - 1)];
						//	d($rand['id'])
						   // $tmp=1;
							//$tmp=db('home_videos_8429',"WHERE !deleted AND id='".$rand."'",NULL,"LIMIT 1");
							//d($tmp); 


						//	d($tmp[0]['id']);
						//	$keys = array_keys( $tmp );
						//	d( "The keys array: ");
  
						//	d($keys);
							?> <<<<<<< HEAD <div class="play_wrap">
    <video class="home_background_video" autoplay muted loop playsinline>
        <source src="<?=u.$rand['video']?>" type="video/mp4">
    </video>

    <!-- <div class="video_cover" onClick="playVideo(this)"> -->
    <!-- <i>play_circle_outline</i> -->
    <!-- </div> -->

    </div>

    <?php			//}
=======
			<div class="play_wrap">
				 <video   autoplay muted loop playsinline>
						 <source src="<?=u.$rand['video']?>" href="<?=u.$rand['video']?>" type="video/mp4">
    </video>
    <!-- <div class="video_cover" onClick="playVideo(this)"> -->
    <!-- <i>play_circle_outline</i> -->
    <!-- </div> -->

    </div>

    <?php			//}
>>>>>>> origin/Ali


//
			//$respa=db('home_slider_8362');
			// $i=1?>
    <<<<<<< HEAD <?php 
=======
	 			  <?php 
>>>>>>> origin/Ali
				 // if($respa[$i]['video']!=''){
				//	if($respa==0)  echo 'error';
					//else if($respa==1) echo 'No Data';
				//	else {
				//	?> <<<<<<< HEAD <?php include 'hero_split.php'; return; ?> <?php /* old home_swiper removed */ ?> <div
        class="home_swiper swiper-container">

        <div class="swiper-wrapper"><?php
=======
	
			
			 
		<?php }else{?>
            <div class="home_swiper">

                <div class="swiper-wrapper"><?php
>>>>>>> origin/Ali
						$resp=db('home_slider_8362');
						if($resp==0)  echo 'error';
						else if($resp==1) echo 'No Data';
						else {
			for($i=0;$i<count($resp);$i++){?>
                    <<<<<<< HEAD <div class="swiper-slide">
                        <?php if(l($resp[$i]['link'])!=''){?>
                        <a href="<?= l($resp[$i]['link'])?>" title="<?= l($resp[$i]['title'])?>" class="slide in"
                            <?=bg($resp[$i]['photo'])?>>
                            <?php }else{?>
                            <div class="slide in slobe" title="<?= l($resp[$i]['title'])?>" <?=bg($resp[$i]['photo'])?>>
                                <?php }?>
                                <div class="slide_box">

                                    <div class="parent">
                                        <div class="child">
                                            <?php if(l($resp[$i]['title'])!=''){?>
                                            <h2 class="slider_title3"><?=l($resp[$i]['title']);?></h2>
                                            <?php }?>

                                            <?php if(l($resp[$i]['subtitle'])!=''){?>
                                            <p><?= l($resp[$i]['subtitle'])?></p>
                                            <?php }?>

                                            <?php if(l($resp[$i]['button_name'])!=''){?>
                                            <div class="slider_btn"><?=l($resp[$i]['button_name'])?></div>
                                            <?php }?>
                                        </div>
                                    </div>
                                </div>
                                <?php if(l($resp[$i]['link'])!=''){?>
                        </a>
                        <?php }else{?>
                </div>
                <?php }?>
            </div>
            <?php }?>


            <?php 
				}//for
			}//else
			unset($resp);?>
        </div>
        =======
        <div class="swiper-slide">
            <<?php if(l($resp[$i]['link'])!=''){?>a <?php }else{echo'div class="slobe"';}?>
                <?php if(l($resp[$i]['link'])!=''){?> href="<?= l($resp[$i]['link'])?>" <?php }?>
                title="<?= l($resp[$i]['title'])?>" class="slide in" <?=bg($resp[$i]['photo'])?>>
                <div class="slide_box">
                    <div class="parent">
                        <div class="child">
                            <?php if(l($resp[$i]['title'])!=''){?>
                            <h2 class="slider_title3"><?=l($resp[$i]['title']);?></h2>

                            <?php }?>

                            <?php if(l($resp[$i]['subtitle'])!=''){?>
                            <p><?= l($resp[$i]['subtitle'])?></p>
                            <?php }?>

                            <?php if(l($resp[$i]['button_name'])!=''){?>
                            <div class="slider_btn"><?=l($resp[$i]['button_name'])?></div>
                            <?php }?>
                        </div>
                    </div>
                </div>
            </<?php if(l($resp[$i]['link'])!=''){?>a <?php }else{echo'div';}?>>
            <?php }?>

            <!--				<blacki></blacki>-->
        </div>

        <?php 
				}//for
			}//else
			unset($resp);?>
        </div>
        >>>>>>> origin/Ali

        <!--
  <div class="swiper-button-prev"></div>
  <div class="swiper-button-next"></div>
-->
        <!--  <div class="swiper-scrollbar"></div>-->
        </div>
        <style>
        .home_swiper {
            <<<<<<< HEAD width: 100vw;
            height: 100vh;
        }

        .slide,
        .slobe {
            height: 100%;
            width: 100%;
            display: block;
        }

        .slide_box {
            width: 100%;
            height: 100%;
        }
        </style>
        <script>
        function playVideo(elem) {

            $(elem).hide();
            $(elem).parent().find('video').get(0).play();
            home_swiper.autoplay.stop();


        }

        const home_swiper = new Swiper('.home_swiper', {
            observer: true,
            observeParents: true,

            // Optional parameters
            direction: 'horizontal',
            loop: true,
            pauseOnMouseEnter: false,
            autoplay: {
                delay: 4000,
            },



            // If we need pagination
            pagination: {
                el: '.swiper-pagination',
            },

            // Navigation arrows
            //  navigation: {
            //    nextEl: '.swiper-button-next',
            //    prevEl: '.swiper-button-prev',
            //  },

            // And if we need scrollbar
            //  scrollbar: {
            //    el: '.swiper-scrollbar',
            //  },
        });



        /// to stop video player when slide changes
        home_swiper.on('slideChange', function() {
            // Avoid pausing/rewinding the currently playing hero/background video.
            // Only pause videos that are not in the active slide.
            var activeIndex = home_swiper.activeIndex;
            var sliderVideos = $(".swiper-slide video");

            sliderVideos.each(function() {
                var $slide = $(this).closest('.swiper-slide');
                var slideIndex = $slide.index();

                if (slideIndex !== activeIndex) {
                    var video = this;
                    video.pause();
                }
            });
        }); ===
        === =
        width: 100 vw;
        height: 100 vh;
        }
        .slide, .slobe {
            height: 100 % ;
            width: 100 % ;
            display: block;
        }

        .slide_box {
            width: 100 % ;
            height: 100 % ;
        }

        <
        /style> <
        script >
            function playVideo(elem) {

                $(elem).hide();
                $(elem).parent().find('video').get(0).play();
                home_swiper.autoplay.stop();


            }

        const home_swiper = new Swiper('.home_swiper', {
            // Optional parameters
            direction: 'horizontal',
            loop: true,
            pauseOnMouseEnter: false,
            autoplay: {
                delay: 4000,
            },



            // If we need pagination
            pagination: {
                el: '.swiper-pagination',
            },

            // Navigation arrows
            //  navigation: {
            //    nextEl: '.swiper-button-next',
            //    prevEl: '.swiper-button-prev',
            //  },

            // And if we need scrollbar
            //  scrollbar: {
            //    el: '.swiper-scrollbar',
            //  },
        });



        /// to stop video player when slide changes
        home_swiper.on('slideChange', function() {
                var sliderVideos = $(".swiper-slide video");
                sliderVideos.each(function(index) {
                    this.currentTime = 0;
                    this.pause();
                });

            })




            >>>
            >>> > origin / Ali
        </script>