<?php
$footer_contact=db('contact_info_8363','WHERE deleted=0',NULL,'LIMIT 1');
$footer_contact=($footer_contact!=0 && $footer_contact!=1) ? $footer_contact[0] : array('phone'=>'','email'=>'','location'=>'');
$footer_quick_links=array(
	array('title'=>'Members Directory<>&#1583;&#1604;&#1610;&#1604; &#1575;&#1604;&#1571;&#1593;&#1590;&#1575;&#1569;','href'=>'about_us.php','icon'=>'groups'),
	array('title'=>'Forms and Registrations<>&#1575;&#1604;&#1606;&#1605;&#1575;&#1584;&#1580; &#1608;&#1575;&#1604;&#1578;&#1587;&#1580;&#1610;&#1604;&#1575;&#1578;','href'=>'join_us.php','icon'=>'edit_note'),
	array('title'=>'Membership Terms<>&#1588;&#1585;&#1608;&#1591; &#1575;&#1604;&#1593;&#1590;&#1608;&#1610;&#1577;','href'=>'page.php','icon'=>'info'),
	array('title'=>'Regulations and Laws<>&#1575;&#1604;&#1571;&#1606;&#1592;&#1605;&#1577; &#1608;&#1575;&#1604;&#1602;&#1608;&#1575;&#1606;&#1610;&#1606;','href'=>'law.php','icon'=>'balance')
);
?>
<div id="back_col" class="footer_shell">
    <div id="web2">
        <section class="footer_quick">
            <div class="w1200">
                <h2 class="footer_quick_title">
                    <?=l('Quick Access<>&#1608;&#1589;&#1608;&#1604; &#1587;&#1585;&#1610;&#1593;')?></h2>
                <div class="footer_quick_grid">
                    <?php foreach($footer_quick_links as $quick_link){?>
                    <a class="footer_quick_card" href="<?=$quick_link['href']?>" title="<?=l($quick_link['title'])?>">
                        <i class="md-light"><?=$quick_link['icon']?></i>
                        <span><?=l($quick_link['title'])?></span>
                    </a>
                    <?php }?>
                </div>
            </div>
        </section>

        <section id="footer" class="site_footer">
            <div class="w1200 footer_main_grid">
                <div id="foot_about" class="site_footer_about footer_col">
                    <?php if(curr() == "ar"){
						pic(c('ar_logo','photo'),1000,100,l($settings['site_name']),true,'logo_menu','mid');
					}else{
						pic($settings['logo'],1000,100,l($settings['site_name']),true,'logo_menu','mid');
					}?>
                    <p><?=cl('footer','text')?></p>
                    <div id="social_links_wrap" class="site_footer_social">
                        <!--<?php
						$_m='social_links_8363';
						$resp=db($_m,NULL,NULL);
						if($resp==1) echo 'No Data';
						else { for($i=0;$i<count($resp);$i++){
							$social_title=strtolower(strip_tags(l($resp[$i]['title'])));
							$social_link=strtolower($resp[$i]['link']);
							if(strpos($social_title,'instagram')!==false || strpos($social_title,'instgram')!==false || strpos($social_title,'youtube')!==false || strpos($social_link,'instagram')!==false || strpos($social_link,'instgram')!==false || strpos($social_link,'youtube')!==false || strpos($social_link,'youtu.be')!==false) continue;
							?>
						--><a class="social_links_box social in" title="<?=l($resp[$i]['title']) ?>"
                            aria-label="<?=l($resp[$i]['title']) ?>" href="<?=$resp[$i]['link']?>" target="_blank"
                            rel="noopener noreferrer">
                            <?=$resp[$i]['social_font']?>
                        </a>
                        <!--
						<?php
							}//for
						}//else
						unset($resp);?>
						-->
                    </div>
                </div>

                <div id="footer_content" class="site_footer_links footer_col">
                    <h3 class="footer_head">
                        <?=l('Quick Links<>&#1585;&#1608;&#1575;&#1576;&#1591; &#1587;&#1585;&#1610;&#1593;&#1577;')?>
                    </h3>
                    <ul class="footer_ul">
                        <!--<?php
						$resp=db('menu_items_1564508835','WHERE menu_key=15 AND deleted=0 AND sub_of=0','ORDER BY order_num ASC');
						if($resp==0)  echo 'error';
						else if($resp==1) echo 'No Data';
						else { for($i=0;$i<count($resp);$i++){?>
						-->
                        <li class="noselect menu_items_box">
                            <a class="foot_a" target="<?= $resp[$i]['open_new_window']==0 ? '_self':'_blank';?>"
                                <?php if($resp[$i]['open_new_window']!=0){?> rel="noopener noreferrer" <?php }?>
                                <?php if(linker($resp[$i])!='noLink'){?> href="<?= linker($resp[$i]);?>" <?php }?>
                                title="<?= l(menuTitle($resp[$i]));?>">
                                <?= l(menuTitle($resp[$i]));?>
                            </a>
                        </li>
                        <!--
						<?php
							}//for
						}//else
						unset($resp);?>
						-->
                    </ul>
                </div>

                <div class="site_footer_contact footer_col">
                    <h3 class="footer_head">
                        <?=l('Contact Information<>&#1605;&#1593;&#1604;&#1608;&#1605;&#1575;&#1578; &#1575;&#1604;&#1578;&#1608;&#1575;&#1589;&#1604;')?>
                    </h3>
                    <ul class="footer_contact_list">
                        <?php if($footer_contact['location']!=''){?><li><i
                                class="md-light">location_on</i><span><?=l($footer_contact['location'])?></span></li>
                        <?php }?>
                        <?php if($footer_contact['phone']!=''){?><li><i class="md-light">phone</i><a
                                href="tel:<?=preg_replace('/[^0-9+]/','',$footer_contact['phone'])?>"><?=l($footer_contact['phone'])?></a>
                        </li><?php }?>
                        <?php if($footer_contact['email']!=''){?><li><i class="md-light">mail</i><a
                                href="mailto:<?=$footer_contact['email']?>"><?=l($footer_contact['email'])?></a></li>
                        <?php }?>
                    </ul>
                </div>

                <div class="site_footer_newsletter footer_col">
                    <h3 class="footer_head">
                        <?=l('Newsletter<>&#1575;&#1604;&#1606;&#1588;&#1585;&#1577; &#1575;&#1604;&#1576;&#1585;&#1610;&#1583;&#1610;&#1577;')?>
                    </h3>
                    <p><?=l('Subscribe to receive the latest news and professional events<>&#1575;&#1588;&#1578;&#1585;&#1603; &#1604;&#1610;&#1589;&#1604;&#1603; &#1571;&#1581;&#1583;&#1579; &#1575;&#1604;&#1571;&#1582;&#1576;&#1575;&#1585; &#1608;&#1575;&#1604;&#1601;&#1593;&#1575;&#1604;&#1610;&#1575;&#1578; &#1575;&#1604;&#1605;&#1607;&#1606;&#1610;&#1577;')?>
                    </p>
                    <form class="footer_subscribe" action="contact_us.php" method="get">
                        <input type="email" name="email"
                            placeholder="<?=l('Email address<>&#1575;&#1604;&#1576;&#1585;&#1610;&#1583; &#1575;&#1604;&#1573;&#1604;&#1603;&#1578;&#1585;&#1608;&#1606;&#1610;')?>" />
                        <button type="submit"><?=l('Subscribe<>&#1575;&#1588;&#1578;&#1585;&#1575;&#1603;')?></button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>