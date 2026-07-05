<?php 
$is_home = true; 
require 'header.php'; 
?>

<section class="syndicate_hero_premium">
    <div class="hero_grid_overlay"></div>
    <div class="hero_glow_left"></div>
    <div class="hero_glow_right"></div>

    <div class="w1200 hero_container">

        <div class="hero_stats_side_fixed">
            <div class="stats_inner_box_fixed">
                <div class="stats_header_title_fixed"><?=l('The Syndicate in Numbers<>النقابة بالأرقام')?></div>

                <div class="stats_quad_grid_fixed">
                    <div class="stat_quad_card_fixed">
                        <h2>+5,200</h2>
                        <p><?=l('Member & Associate<>عضو ومنتسب')?></p>
                    </div>
                    <div class="stat_quad_card_fixed">
                        <h2>+120</h2>
                        <p><?=l('Partner Company<>شركة شريكة')?></p>
                    </div>
                    <div class="stat_quad_card_fixed">
                        <h2>16</h2>
                        <p><?=l('Governorate<>محافظة')?></p>
                    </div>
                    <div class="stat_quad_card_fixed">
                        <h2>+350</h2>
                        <p><?=l('Annual Training Hours<>ساعة تدريب سنوياً')?></p>
                    </div>
                </div>

                <a href="#"
                    class="stats_benefits_link_fixed"><?=l('Why Join? Discover the benefits ←<>لماذا الانضمام؟ اكتشف المزايا ←')?></a>
            </div>
        </div>

        <div class="hero_text_side_fixed">
            <div class="syndicate_badge_fixed">
                <span class="badge_pulse_dot_fixed"></span>
                <span
                    class="badge_txt_fixed"><?=l('The Official Gateway of the Palestinian Syndicate for Information Technology Sciences<>البوابة الرسمية لنقابة العلوم المعلوماتية التكنولوجية الفلسطينية')?></span>
            </div>

            <h1 class="hero_main_title_fixed">
                <?=l('Palestinian Information Technology Syndicate – The Voice of the Profession and incubator for the Digital Future.<>نقابة المعلوماتية التكنولوجية الفلسطينية – صوت المهنة وحاضنة المستقبل الرقمي.')?>
            </h1>

            <p class="hero_sub_desc_fixed">
                <?=l('The national syndicate that gathers, supports, and develops technology and informatics experts towards a leading digital future.<>النقابة الوطنية التي تجمع، تدعم، وتطور خبراء التكنولوجيا والمعلوماتية نحو مستقبل رقمي رائد.')?>
            </p>

            <div class="hero_cta_buttons_fixed">
                <a href="<?=urlp('signin');?>" class="btn_cta_yellow_fixed">
                    <i class="mid">arrow_backward</i>
                    <span><?=l('Submit Your Membership Application<>قدّم طلب عضويتك')?></span>
                </a>
                <a href="<?=url('about_the_syndicate_8362')?>" class="btn_cta_outline_fixed">
                    <?=l('Get to Know the Syndicate<>تعرّف على النقابة')?>
                </a>
            </div>

            <div class="hero_trust_badges_fixed">
                <span><i class="mid">verified</i> <?=l('Officially Licensed<>مرخصة رسمياً')?></span>
                <span><i class="mid">health_and_safety</i>
                    <?=l('Health Insurance for Members<>تأمين صحي للأعضاء')?></span>
                <span><i class="mid">model_training</i>
                    <?=l('Training & Development Programs<>برامج تدريب وتطوير')?></span>
            </div>
        </div>

    </div>
</section>

<section class="quick_services_section_fixed w1200">
    <div class="services_grid_fixed">
        <div class="service_card_fixed">
            <div class="service_icon_fixed icon_blue_bg"><i class="mid">person_add</i></div>
            <h3><?=l('Membership Registration<>تسجيل العضوية')?></h3>
            <p><?=l('Join the professionals network and benefit from multiple membership privileges.<>انضم إلى شبكة المحترفين واستفد من مزايا العضوية المتعددة.')?>
            </p>
            <a href="#" class="service_more_fixed"><?=l('Learn more ←<>المزيد ←')?></a>
        </div>
        <div class="service_card_fixed">
            <div class="service_icon_fixed icon_green_bg"><i class="mid">school</i></div>
            <h3><?=l('Training & Workshops<>التدريب وورش العمل')?></h3>
            <p><?=l('Specialized programs to develop your skills and keep up with modern tech.<>برامج متخصصة لتطوير مهاراتك ومواكبة أحدث التقنيات.')?>
            </p>
            <a href="#" class="service_more_fixed"><?=l('Learn more ←<>المزيد ←')?></a>
        </div>
        <div class="service_card_fixed">
            <div class="service_icon_fixed icon_orange_bg"><i class="mid">business_center</i></div>
            <h3><?=l('Employment Support Fund<>صندوق دعم التشغيل')?></h3>
            <p><?=l('Initiatives to enhance job opportunities and support entrepreneurial projects.<>مبادرات لتعزيز فرص العمل ودعم المشاريع الريادية.')?>
            </p>
            <a href="#" class="service_more_fixed"><?=l('Learn more ←<>المزيد ←')?></a>
        </div>
        <div class="service_card_fixed">
            <div class="service_icon_fixed icon_purple_bg"><i class="mid">gavel</i></div>
            <h3><?=l('Legal and Professional Support<>الدعم القانوني والمهني')?></h3>
            <p><?=l('Consultations and legal guidance to protect professional rights.<>استشارات وتوجيهات قانونية لحماية حقوقك المهنية.')?>
            </p>
            <a href="#" class="service_more_fixed"><?=l('Learn more ←<>المزيد ←')?></a>
        </div>
    </div>
</section>

<section id="news_wrap" class="major_section w1200">
    <?php $_m_news = 'news_8362'; ?>
    <div class="home_news_header_fixed">
        <a class="home_news_all_fixed" href="<?=url($_m_news)?>">
            <span><?=l('View All News<>عرض كل الأخبار')?></span>
            <i class="mid">arrow_back</i>
        </a>
        <h2 class="home_news_title_fixed">
            <?=l('Latest News & Announcements<>آخر الأخبار والإعلانات')?>
            <span class="title_bottom_bar"></span>
        </h2>
    </div>

    <div class="home_news_grid_fixed">
        <?php
        // جلب آخر 3 أخبار من قاعدة البيانات مرتبة بالأحدث
        $news_list = db($_m_news, NULL, 'ORDER BY publish_date DESC', "LIMIT 3");
        if($news_list != 1 && is_array($news_list)) { 
            for($i=0; $i<count($news_list); $i++){
        ?>
        <div class="news_card_v2_fixed">
            <div class="news_card_media_fixed">
                <span class="news_date_badge_fixed">
                    <?= !empty($news_list[$i]['publish_date']) ? date('j يونيو Y', strtotime($news_list[$i]['publish_date'])) : '7 يونيو 2026' ?>
                </span>
                <div class="news_card_img_fixed">
                    <?php if(!empty($news_list[$i]['photo'])) {
                        pic($news_list[$i]['photo'],400,260,l($news_list[$i]['title']),true,NULL,'news_photo_obj');
                    } else {
                        echo '<img src="assets/default_news.jpg" alt="News">';
                    } ?>
                </div>
            </div>
            <div class="news_card_body_fixed">
                <span
                    class="news_tag_fixed"><?= !empty($news_list[$i]['category']) ? strtoupper($news_list[$i]['category']) : 'PARTNERSHIPS' ?></span>
                <h3 class="news_title_fixed"><?=l($news_list[$i]['title']);?></h3>
                <a href="<?=url($_m_news,'single',$news_list[$i]['id'])?>"
                    class="news_link_fixed"><?=l('Read Details ←<>اقرأ التفاصيل ←')?></a>
            </div>
        </div>
        <?php 
            }
        } else {
            echo '<p class="no_data_msg">لا يوجد أخبار حالياً.</p>';
        }
        unset($news_list);
        ?>
    </div>
</section>

<section class="events_reports_section_fixed w1200">
    <div class="events_reports_container_fixed">

        <div class="col_fixed col_events_fixed">
            <?php $_m_events = 'events_8362'; ?>
            <h2 class="col_title_fixed"><?=l('Upcoming Events<>الفعاليات القادمة')?></h2>
            <div class="timeline_container_fixed">

                <?php
                // جلب آخر 3 فعاليات قادمة من قاعدة البيانات
                $events_list = db($_m_events, NULL, 'ORDER BY event_date DESC', "LIMIT 3");
                if($events_list != 1 && is_array($events_list)) {
                    for($e=0; $e<count($events_list); $e++){
                ?>
                <div class="timeline_item_fixed">
                    <div class="timeline_dot_fixed"></div>
                    <div class="timeline_content_fixed">
                        <div class="meta_fixed">
                            <span><?= !empty($events_list[$e]['location']) ? l($events_list[$e]['location']) : 'فلسطين' ?></span>
                            &bull;
                            <span
                                class="date_f"><?= !empty($events_list[$e]['event_date']) ? date('M Y', strtotime($events_list[$e]['event_date'])) : '2026' ?></span>
                        </div>
                        <h3><?= l($events_list[$e]['title']) ?></h3>
                        <p><?= !empty($events_list[$e]['short_desc']) ? l($events_list[$e]['short_desc']) : 'اضغط على تفاصيل الفعالية لمعرفة المزيد عن الأجندة والمحاور.' ?>
                        </p>
                        <a href="<?=url($_m_events,'single',$events_list[$e]['id'])?>"
                            style="font-size:12px; color:#075f61; text-decoration:none; font-weight:bold; display:block; margin-top:8px;"><?=l('Event Details ←<>تفاصيل الفعالية ←')?></a>
                    </div>
                </div>
                <?php 
                    }
                } else {
                    echo '<p class="no_data_msg">لا يوجد فعاليات قادمة حالياً.</p>';
                }
                unset($events_list);
                ?>

            </div>
            <a href="<?=url($_m_events)?>"
                class="view_all_btn_bottom"><?=l('View Event Agenda<>عرض أجندة الفعاليات')?></a>
        </div>

        <div class="col_fixed col_reports_fixed">
            <?php $_m_reports = 'reports_8362'; ?>
            <h2 class="col_title_fixed"><?=l('Reports & Publications<>التقارير والإصدارات')?></h2>
            <div class="reports_grid_fixed">

                <?php
                // جلب آخر 4 تقارير مرفوعة من قاعدة البيانات
                $reports_list = db($_m_reports, NULL, 'ORDER BY id DESC', "LIMIT 4");
                if($reports_list != 1 && is_array($reports_list)) {
                    for($r=0; $r<count($reports_list); $r++){
                ?>
                <div class="report_row_fixed">
                    <div class="rep_left_side">
                        <a href="uploads/<?= $reports_list[$r]['file_name'] ?>" download class="rep_down"><i
                                class="mid">download</i></a>
                    </div>
                    <div class="rep_txt_fixed">
                        <h3><?= l($reports_list[$r]['title']) ?></h3>
                        <p><?= !empty($reports_list[$r]['date_created']) ? date('Y-m-d', strtotime($reports_list[$r]['date_created'])) : '' ?>
                            &bull; PDF</p>
                    </div>
                    <div class="rep_icon_fixed">
                        <i class="mid">description</i>
                    </div>
                </div>
                <?php 
                    }
                } else {
                    echo '<p class="no_data_msg">لا يوجد تقارير أو إصدارات حالياً.</p>';
                }
                unset($reports_list);
                ?>

            </div>
            <a href="<?=url($_m_reports)?>"
                class="view_all_btn_bottom outline_btn"><?=l('Browse All Publications<>تصفح جميع الإصدارات')?></a>
        </div>

    </div>
</section>

<div onclick="topFunction()" id="myBtn" class="scroll_top_badge">
    <i class="arrow_up_icon po">keyboard_arrow_up</i>
</div>

<style>
:root {
    --primary-teal-bg: #033c3e;
    --accent-yellow: #f5df4d;
    --text-dark: #1e293b;
    --text-muted: #64748b;
    --border-color: #e2e8f0;
}

body {
    background-color: #ffffff;
    margin: 0;
    font-family: system-ui, -apple-system, sans-serif;
    color: var(--text-dark);
}

.no_data_msg {
    font-size: 13px;
    color: var(--text-muted);
    text-align: center;
    padding: 20px;
}

/* تنسيق قسم الـ Hero والشبكة التقنية خلفه */
.syndicate_hero_premium {
    position: relative;
    background-color: var(--primary-teal-bg);
    padding: 100px 0 150px;
    color: #ffffff;
    overflow: hidden;
    direction: rtl;
}

.hero_grid_overlay {
    position: absolute;
    inset: 0;
    background-image:
        linear-gradient(rgba(255, 255, 255, 0.04) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255, 255, 255, 0.04) 1px, transparent 1px);
    background-size: 28px 28px;
    z-index: 1;
    pointer-events: none;
}

.hero_glow_left {
    position: absolute;
    bottom: -15%;
    left: -10%;
    width: 450px;
    height: 450px;
    background: radial-gradient(circle, rgba(39, 174, 96, 0.15) 0%, transparent 70%);
    z-index: 1;
}

.hero_glow_right {
    position: absolute;
    top: -10%;
    right: -5%;
    width: 400px;
    height: 400px;
    background: radial-gradient(circle, rgba(245, 223, 77, 0.06) 0%, transparent 70%);
    z-index: 1;
}

.hero_container {
    position: relative;
    z-index: 5;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 40px;
}

.hero_text_side_fixed {
    flex: 1;
    max-width: 55%;
    text-align: right;
}

.hero_stats_side_fixed {
    flex: 1;
    max-width: 42%;
}

.syndicate_badge_fixed {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(255, 255, 255, 0.06);
    border: 1px solid rgba(255, 255, 255, 0.1);
    padding: 6px 14px;
    border-radius: 20px;
    margin-bottom: 25px;
}

.badge_pulse_dot_fixed {
    width: 7px;
    height: 7px;
    background-color: var(--accent-yellow);
    border-radius: 50%;
}

.badge_txt_fixed {
    font-size: 13px;
    color: rgba(255, 255, 255, 0.9);
}

.hero_main_title_fixed {
    font-size: 40px;
    font-weight: 800;
    line-height: 1.45;
    margin: 0 0 20px 0;
    color: #ffffff;
}

.hero_sub_desc_fixed {
    font-size: 15px;
    color: rgba(255, 255, 255, 0.75);
    line-height: 1.8;
    margin-bottom: 35px;
}

.hero_cta_buttons_fixed {
    display: flex;
    gap: 15px;
    margin-bottom: 40px;
}

.btn_cta_yellow_fixed {
    background-color: var(--accent-yellow);
    color: var(--primary-teal-bg);
    padding: 14px 28px;
    border-radius: 6px;
    font-weight: 700;
    font-size: 15px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.btn_cta_outline_fixed {
    border: 1px solid rgba(255, 255, 255, 0.3);
    color: #ffffff;
    padding: 14px 28px;
    border-radius: 6px;
    font-weight: 700;
    font-size: 15px;
    text-decoration: none;
}

.hero_trust_badges_fixed {
    display: flex;
    gap: 20px;
    font-size: 13px;
    color: rgba(255, 255, 255, 0.6);
}

.hero_trust_badges_fixed span {
    display: inline-flex;
    align-items: center;
    gap: 6px;
}

/* صندوق الإحصائيات الفخم */
.stats_inner_box_fixed {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.08);
    backdrop-filter: blur(8px);
    padding: 30px;
    border-radius: 12px;
}

.stats_header_title_fixed {
    font-size: 13px;
    color: var(--accent-yellow);
    font-weight: bold;
    margin-bottom: 20px;
}

.stats_quad_grid_fixed {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 15px;
}

.stat_quad_card_fixed {
    background: rgba(255, 255, 255, 0.02);
    border: 1px solid rgba(255, 255, 255, 0.06);
    padding: 22px 15px;
    border-radius: 8px;
    text-align: center;
}

.stat_quad_card_fixed h2 {
    font-size: 32px;
    font-weight: 800;
    color: #ffffff;
    margin: 0 0 6px 0;
}

.stat_quad_card_fixed p {
    font-size: 12px;
    color: rgba(255, 255, 255, 0.6);
    margin: 0;
}

.stats_benefits_link_fixed {
    display: block;
    text-align: center;
    margin-top: 20px;
    color: var(--accent-yellow);
    font-size: 13px;
    text-decoration: none;
}

/* الكروت الأربعة البيضاء */
.quick_services_section_fixed {
    margin-top: -60px;
    position: relative;
    z-index: 20;
    margin-bottom: 60px;
    direction: rtl;
}

.services_grid_fixed {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
}

.service_card_fixed {
    background: #ffffff;
    border-radius: 8px;
    padding: 35px 24px;
    text-align: center;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
    border: 1px solid #e2e8f0;
}

.service_icon_fixed {
    width: 48px;
    height: 48px;
    border-radius: 8px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 20px;
    font-size: 24px;
}

.icon_blue_bg {
    background: rgba(47, 128, 237, 0.08);
    color: #2f80ed;
}

.icon_green_bg {
    background: rgba(39, 174, 96, 0.08);
    color: #27ae60;
}

.icon_orange_bg {
    background: rgba(242, 153, 74, 0.08);
    color: #f2994a;
}

.icon_purple_bg {
    background: rgba(155, 81, 224, 0.08);
    color: #9b51e0;
}

.service_card_fixed h3 {
    font-size: 16px;
    font-weight: 700;
    margin: 0 0 12px 0;
    color: #0f172a;
}

.service_card_fixed p {
    font-size: 13px;
    color: var(--text-muted);
    line-height: 1.6;
    margin: 0 0 20px 0;
}

.service_more_fixed {
    font-size: 13px;
    color: var(--text-muted);
    text-decoration: none;
    font-weight: 600;
}

/* الأقسام الإخبارية المتقدمة */
.major_section {
    padding: 40px 0;
}

.home_news_header_fixed {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 2px solid #f1f5f9;
    padding-bottom: 12px;
    margin-bottom: 40px;
    direction: rtl;
}

.home_news_title_fixed {
    font-size: 24px;
    font-weight: 800;
    color: #0f172a;
    margin: 0;
    position: relative;
}

.title_bottom_bar {
    position: absolute;
    bottom: -14px;
    right: 0;
    width: 80px;
    height: 3px;
    background-color: #075f61;
}

.home_news_all_fixed {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    color: var(--text-muted);
    text-decoration: none;
    font-size: 14px;
    font-weight: 600;
}

.home_news_grid_fixed {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
    direction: rtl;
}

.news_card_v2_fixed {
    background: #ffffff;
    border-radius: 8px;
    overflow: hidden;
    border: 1px solid #e2e8f0;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.01);
}

.news_card_media_fixed {
    position: relative;
    height: 220px;
}

.news_date_badge_fixed {
    position: absolute;
    top: 15px;
    right: 15px;
    background: #ffffff;
    color: #0f172a;
    padding: 5px 10px;
    border-radius: 4px;
    font-size: 12px;
    font-weight: bold;
    z-index: 10;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
}

.news_card_img_fixed {
    height: 100%;
    width: 100%;
}

.news_card_img_fixed img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.news_card_body_fixed {
    padding: 24px;
}

.news_tag_fixed {
    font-size: 11px;
    color: #f2994a;
    font-weight: 700;
    text-transform: uppercase;
    display: block;
    margin-bottom: 10px;
}

.news_title_fixed {
    font-size: 16px;
    font-weight: 700;
    line-height: 1.6;
    margin: 0 0 20px 0;
    color: #0f172a;
}

.news_link_fixed {
    font-size: 13px;
    color: #075f61;
    text-decoration: none;
    font-weight: 700;
}

/* تنسيق متوازي للفعاليات والتقارير */
.events_reports_section_fixed {
    padding: 60px 0;
    direction: rtl;
}

.events_reports_container_fixed {
    display: flex;
    justify-content: space-between;
    gap: 50px;
}

.col_fixed {
    flex: 1;
}

.col_title_fixed {
    font-size: 20px;
    font-weight: 800;
    color: #0f172a;
    margin-bottom: 30px;
    border-bottom: 2px solid #f1f5f9;
    padding-bottom: 12px;
}

/* تايم لاين الفعاليات */
.timeline_container_fixed {
    position: relative;
    border-right: 2px solid #e2e8f0;
    padding-right: 20px;
    margin-bottom: 30px;
}

.timeline_item_fixed {
    position: relative;
    margin-bottom: 25px;
}

.timeline_dot_fixed {
    position: absolute;
    top: 5px;
    right: -26px;
    width: 10px;
    height: 10px;
    background-color: #075f61;
    border-radius: 50%;
    border: 2px solid #ffffff;
}

.timeline_content_fixed {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    padding: 20px;
    border-radius: 8px;
}

.meta_fixed {
    font-size: 12px;
    color: var(--text-muted);
    margin-bottom: 8px;
}

.date_f {
    color: #075f61;
    font-weight: 700;
}

.timeline_content_fixed h3 {
    font-size: 15px;
    margin: 0 0 8px 0;
    color: #0f172a;
}

.timeline_content_fixed p {
    font-size: 13px;
    color: var(--text-muted);
    margin: 0;
    line-height: 1.6;
}

/* التقارير والتحميل */
.reports_grid_fixed {
    display: flex;
    flex-direction: column;
    gap: 15px;
    margin-bottom: 30px;
}

.report_row_fixed {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: #ffffff;
    border: 1px solid #e2e8f0;
    padding: 16px;
    border-radius: 8px;
    gap: 15px;
}

.rep_icon_fixed i {
    font-size: 26px;
    color: #075f61;
}

.rep_txt_fixed {
    flex: 1;
    text-align: right;
}

.rep_txt_fixed h3 {
    font-size: 14px;
    margin: 0 0 6px 0;
    color: #0f172a;
    line-height: 1.5;
}

.rep_txt_fixed p {
    font-size: 12px;
    color: var(--text-muted);
    margin: 0;
}

.rep_down {
    color: var(--text-muted);
    text-decoration: none;
    transition: color 0.2s;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.rep_down:hover {
    color: #075f61;
}

/* أزرار العرض السفلية للعمودين */
.view_all_btn_bottom {
    display: block;
    text-align: center;
    background-color: #075f61;
    color: #ffffff;
    padding: 12px;
    border-radius: 6px;
    font-size: 14px;
    font-weight: 700;
    text-decoration: none;
}

.outline_btn {
    background-color: transparent;
    border: 1px solid #e2e8f0;
    color: #0f172a;
}

.outline_btn:hover {
    background-color: #f8fafc;
}

/* زر الصعود */
.scroll_top_badge {
    position: fixed;
    bottom: 30px;
    left: 30px;
    z-index: 99;
    background-color: var(--primary-teal-bg);
    color: #fff;
    width: 46px;
    height: 46px;
    border-radius: 50%;
    display: none;
    align-items: center;
    justify-content: center;
    cursor: pointer;
}

/* الشاشات اللوحية والهواتف (Responsive) */
@media(max-width: 980px) {
    .hero_container {
        flex-direction: column-reverse;
    }

    .hero_text_side_fixed,
    .hero_stats_side_fixed {
        max-width: 100%;
        width: 100%;
    }

    .services_grid_fixed {
        grid-template-columns: repeat(2, 1fr);
    }

    .home_news_grid_fixed {
        grid-template-columns: 1fr;
    }

    .events_reports_container_fixed {
        flex-direction: column;
    }
}

@media(max-width: 480px) {
    .services_grid_fixed {
        grid-template-columns: 1fr;
    }

    .hero_main_title_fixed {
        font-size: 28px;
    }
}
</style>

<script>
let mybutton = document.getElementById("myBtn");

window.onscroll = function() {
    if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
        mybutton.style.display = "flex";
    } else {
        mybutton.style.display = "none";
    }
};

function topFunction() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}
</script>

<?php require 'footer.php'; ?>