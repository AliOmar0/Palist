<?php
if (!function_exists('home_excerpt')) {
    function home_excerpt($text, $fallback = '') {
        $text = trim(strip_tags(l($text)));
        if ($text == '') {
            $text = $fallback;
        }
        if (function_exists('mb_strlen') && mb_strlen($text, 'UTF-8') > 150) {
            return mb_substr($text, 0, 150, 'UTF-8') . '...';
        }
        if (!function_exists('mb_strlen') && strlen($text) > 150) {
            return substr($text, 0, 150) . '...';
        }
        return $text;
    }
}

if (!function_exists('home_month_name')) {
    function home_month_name($date) {
        $months = [
            '01' => 'يناير', '02' => 'فبراير', '03' => 'مارس', '04' => 'أبريل',
            '05' => 'مايو', '06' => 'يونيو', '07' => 'يوليو', '08' => 'أغسطس',
            '09' => 'سبتمبر', '10' => 'أكتوبر', '11' => 'نوفمبر', '12' => 'ديسمبر',
        ];
        $ts = strtotime($date);
        if (!$ts) { return ''; }
        return curr() == 'ar' ? $months[date('m', $ts)] : date('F', $ts);
    }
}

if (!function_exists('home_day_name')) {
    function home_day_name($date) {
        $days = [
            'Saturday' => 'السبت', 'Sunday' => 'الأحد', 'Monday' => 'الإثنين',
            'Tuesday' => 'الثلاثاء', 'Wednesday' => 'الأربعاء',
            'Thursday' => 'الخميس', 'Friday' => 'الجمعة',
        ];
        $ts = strtotime($date);
        if (!$ts) { return ''; }
        $day = date('l', $ts);
        return curr() == 'ar' ? $days[$day] : $day;
    }
}

$news_module = 'advertisements_8362';
$events_module = 'events_8362';
$reports_module = 'publications_8367';

$news_items = db($news_module, NULL, 'ORDER BY date_created DESC', 'LIMIT 3');
$events_items = db($events_module, "WHERE deleted=0 AND event_date >= '" . date('Y-m-d') . "'", 'ORDER BY event_date ASC', 'LIMIT 3');
$reports_items = db($reports_module, NULL, 'ORDER BY publish_date DESC', 'LIMIT 3');
?>

<section class="home_feed_section w1200" aria-label="<?= l('Latest news and announcements<>آخر الأخبار والإعلانات') ?>">
    <div class="home_section_head">
        <a class="home_section_more" href="<?= url($news_module) ?>">
            <span><?= l('View all news<>عرض كل الأخبار') ?></span>
            <i class="mid">arrow_forward</i>
        </a>
        <h2>
            <?= l('Latest news and announcements<>آخر الأخبار والإعلانات') ?>
            <span></span>
        </h2>
    </div>

    <div class="home_news_cards_feed">
        <?php if ($news_items == 1 || $news_items == 0 || empty($news_items)) { ?>
        <div class="home_empty"><?= l('No Data<>لا توجد مدخلات حالية') ?></div>
        <?php } else { 
            foreach ($news_items as $item) {
                $date = isset($item['date_created']) ? $item['date_created'] : date('Y-m-d');
        ?>
        <a class="home_news_feed_item" href="<?= url($news_module, 'single', $item['id']) ?>"
            title="<?= l($item['title']) ?>">
            <div class="home_news_media_feed">
                <div class="home_date_badge_feed">
                    <?= date('d', strtotime($date)) . ' ' . home_month_name($date) . ' ' . date('Y', strtotime($date)) ?>
                </div>
                <?php pic($item['photo'], 700, 450, l($item['title']), true, NULL, 'home_news_picture_img'); ?>
            </div>
            <div class="home_news_body_feed">
                <span class="home_news_type_tag"><?= l('Important announcement<>إعلان هام') ?></span>
                <h3><?= l($item['title']) ?></h3>
                <p><?= home_excerpt(isset($item['content']) ? $item['content'] : '', l('The syndicate announces an update for technology professionals in Palestine.<>تعلن النقابة عن تحديث يهم المختصين في قطاع تكنولوجيا المعلومات في فلسطين.')) ?>
                </p>
                <strong class="read_more_feed_btn">
                    <span><?= l('Read details<>اقرأ التفاصيل') ?></span>
                    <i class="mid">arrow_forward</i>
                </strong>
            </div>
        </a>
        <?php 
            }
        } 
        ?>
    </div>
</section>

<section class="home_reports_events">
    <div class="home_reports_events_inner w1200">

        <div class="home_reports_col">
            <div class="home_section_head compact">
                <h2>
                    <?= l('Reports and publications<>التقارير والإصدارات الرقمية') ?>
                    <span></span>
                </h2>
            </div>

            <div class="home_reports_list">
                <?php if ($reports_items == 1 || $reports_items == 0 || empty($reports_items)) { ?>
                <div class="home_empty"><?= l('No Data<>لا توجد مدخلات حالية') ?></div>
                <?php } else { 
                    foreach ($reports_items as $item) {
                        $report_link = (isset($item['link']) && trim($item['link']) != '') ? $item['link'] : url($reports_module, 'single', $item['id']);
                        $report_date = isset($item['publish_date']) ? $item['publish_date'] : '';
                ?>
                <a class="home_report_item_card" href="<?= $report_link ?>"
                    target="<?= (isset($item['link']) && trim($item['link']) != '') ? '_blank' : '_self' ?>">
                    <i class="download_icon md-light">file_download</i>
                    <div class="report_card_info">
                        <h3><?= l($item['title']) ?></h3>
                        <span><?= $report_date != '' ? date('Y', strtotime($report_date)) : date('Y') ?> • <b>PDF
                                Document</b></span>
                    </div>
                    <i class="file_icon md-light">description</i>
                </a>
                <?php 
                    }
                } 
                ?>
            </div>

            <a class="home_outline_btn_feed"
                href="<?= url($reports_module) ?>"><?= l('Browse archive<>تصفح أرشيف المطبوعات') ?></a>
        </div>

        <div class="home_events_col">
            <div class="home_section_head compact">
                <h2>
                    <?= l('Upcoming events<>الفعاليات والنشاطات القادمة') ?>
                    <span></span>
                </h2>
            </div>

            <div class="home_timeline_feed">
                <?php if ($events_items == 1 || $events_items == 0 || empty($events_items)) { ?>
                <div class="home_empty"><?= l('No Data<>لا توجد فعاليات قادمة') ?></div>
                <?php } else { 
                    foreach ($events_items as $item) {
                        $event_date = isset($item['event_date']) ? $item['event_date'] : date('Y-m-d');
                ?>
                <a class="home_event_timeline_item" href="<?= url($events_module, 'single', $item['id']) ?>">
                    <div class="home_event_dot_badge"><?= date('d', strtotime($event_date)) ?></div>
                    <div class="home_event_timeline_card">
                        <div class="home_event_meta_feed">
                            <strong><?= home_month_name($event_date) ?>
                                <?= date('Y', strtotime($event_date)) ?></strong>
                            <span class="event_day_badge"><?= home_day_name($event_date) ?></span>
                        </div>
                        <h3><?= l($item['title']) ?></h3>
                        <p><?= home_excerpt(isset($item['content']) ? $item['content'] : '', l('A professional event for the technology and information sector.<>فعالية مهنية مخصصة لقطاع التكنولوجيا والمعلومات.')) ?>
                        </p>
                    </div>
                </a>
                <?php 
                    }
                } 
                ?>
            </div>

            <a class="home_outline_btn_feed"
                href="<?= url($events_module) ?>"><?= l('View event calendar<>عرض رزنامة الفعاليات') ?></a>
        </div>

    </div>
</section>

<style>
/* تهيئة وتنسيق ترويسة الأقسام */
.home_section_head {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
    border-bottom: 2px solid #e8eeee;
    padding-bottom: 14px;
}

.home_section_head h2 {
    font-size: 26px;
    color: var(--dark);
    font-weight: 800;
    margin: 0;
    position: relative;
}

.home_section_head h2 span {
    position: absolute;
    bottom: -16px;
    right: 0;
    width: 80px;
    height: 3px;
    background: var(--teal);
    border-radius: 2px;
}

.home_section_more {
    display: flex;
    align-items: center;
    gap: 8px;
    color: var(--teal);
    text-decoration: none;
    font-weight: bold;
    font-size: 15px;
    transition: transform 0.2s;
}

.home_section_more:hover {
    transform: translateX(-4px);
}

.home_news_cards_feed {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
    margin-bottom: 50px;
}

.home_news_feed_item {
    background: #fff;
    border: 1px solid #e8eeee;
    border-radius: 16px;
    overflow: hidden;
    text-decoration: none;
    color: inherit;
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.03);
    transition: transform 0.3s, box-shadow 0.3s;
    display: flex;
    flex-direction: column;
}

.home_news_feed_item:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 30px rgba(7, 95, 97, 0.08);
}

.home_news_media_feed {
    position: relative;
    height: 200px;
    background: #f1f5f5;
    overflow: hidden;
}

.home_news_picture_img {
    width: 100%;
    height: 100%;
}

.home_news_picture_img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.home_date_badge_feed {
    position: absolute;
    top: 14px;
    right: 14px;
    background: rgba(7, 95, 97, 0.9);
    color: #fff;
    padding: 6px 12px;
    border-radius: 30px;
    font-size: 12px;
    font-weight: bold;
    z-index: 2;
}

.home_news_body_feed {
    padding: 20px;
    display: flex;
    flex-direction: column;
    flex-grow: 1;
}

.home_news_type_tag {
    font-size: 12px;
    color: #bfa100;
    font-weight: 800;
    margin-bottom: 8px;
    display: block;
}

.home_news_body_feed h3 {
    font-size: 17px;
    color: var(--dark);
    margin: 0 0 10px;
    font-weight: bold;
    line-height: 1.5;
}

.home_news_body_feed p {
    font-size: 14px;
    color: var(--muted);
    line-height: 1.6;
    margin: 0 0 16px;
}

.read_more_feed_btn {
    margin-top: auto;
    display: flex;
    align-items: center;
    gap: 6px;
    color: var(--teal);
    font-size: 14px;
}

.home_reports_events_inner {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 40px;
    padding: 20px 0 60px;
}

.home_section_head.compact {
    margin-bottom: 24px;
    border-bottom: 1px solid #e8eeee;
}

.home_section_head.compact h2 {
    font-size: 20px;
}


.home_reports_list {
    display: flex;
    flex-direction: column;
    gap: 14px;
    margin-bottom: 24px;
}

.home_report_item_card {
    display: flex;
    align-items: center;
    background: #fff;
    border: 1px solid #e8eeee;
    padding: 16px;
    border-radius: 12px;
    text-decoration: none;
    color: inherit;
    transition: background 0.2s, border-color 0.2s;
}

.home_report_item_card:hover {
    background: #fdfdfd;
    border-color: var(--teal);
}

.report_card_info {
    flex-grow: 1;
    padding: 0 14px;
    text-align: right;
}

.report_card_info h3 {
    margin: 0 0 4px;
    font-size: 15px;
    color: var(--dark);
    font-weight: bold;
}

.report_card_info span {
    font-size: 12px;
    color: var(--muted);
}

.download_icon {
    color: var(--teal);
    font-size: 24px;
}

.file_icon {
    color: #9ab7b8;
    font-size: 26px;
}


.home_timeline_feed {
    display: flex;
    flex-direction: column;
    gap: 20px;
    margin-bottom: 24px;
    position: relative;
    padding-right: 20px;
}

.home_timeline_feed::before {
    content: '';
    position: absolute;
    top: 10px;
    right: 36px;
    bottom: 10px;
    width: 2px;
    background: #e8eeee;
}

.home_event_timeline_item {
    display: flex;
    gap: 16px;
    text-decoration: none;
    color: inherit;
    position: relative;
    align-items: flex-start;
}

.home_event_dot_badge {
    width: 34px;
    height: 34px;
    border-radius: 50%;
    background: var(--teal);
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 900;
    font-size: 14px;
    z-index: 2;
    box-shadow: 0 0 0 6px #fff;
    flex-shrink: 0;
}

.home_event_timeline_card {
    background: #fff;
    border: 1px solid #e8eeee;
    border-radius: 12px;
    padding: 16px;
    flex-grow: 1;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.02);
}

.home_event_meta_feed {
    display: flex;
    justify-content: space-between;
    font-size: 12px;
    margin-bottom: 6px;
}

.home_event_meta_feed strong {
    color: var(--teal);
}

.event_day_badge {
    color: var(--muted);
    background: #f1f5f5;
    padding: 2px 8px;
    border-radius: 4px;
}

.home_event_timeline_card h3 {
    margin: 4px 0 8px;
    font-size: 15px;
    color: var(--dark);
    font-weight: bold;
}

.home_event_timeline_card p {
    margin: 0;
    font-size: 13px;
    color: var(--muted);
    line-height: 1.5;
}

/* الأزرار الهيكلية الموحدة للأسفل */
.home_outline_btn_feed {
    display: block;
    text-align: center;
    border: 1px solid var(--teal);
    color: var(--teal);
    padding: 12px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: bold;
    font-size: 14px;
    transition: all 0.2s;
}

.home_outline_btn_feed:hover {
    background: var(--teal);
    color: #fff;
}

.home_empty {
    grid-column: span 3;
    text-align: center;
    padding: 40px;
    color: var(--muted);
    background: #fff;
    border-radius: 12px;
    border: 1px dashed #c9d6d6;
}

/* متجاوب تماماً مع الشاشات المتنقلة والأجهزة الكفية */
@media (max-width: 980px) {
    .home_news_cards_feed {
        grid-template-columns: repeat(2, 1fr);
    }

    .home_reports_events_inner {
        grid-template-columns: 1fr;
        gap: 30px;
    }
}

@media (max-width: 600px) {
    .home_news_cards_feed {
        grid-template-columns: 1fr;
    }
}
</style>