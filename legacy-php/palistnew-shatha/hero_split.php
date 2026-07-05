<?php
/**
 * Hero Split Component
 * البوابة الرسمية لنقابة العلوم المعلوماتية التكنولوجية الفلسطينية
 * يتم استدعاؤه داخل صفحة home.php أو أي صفحة رئيسية أخرى
 */
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

<style>
:root {
    --primary-teal-bg: #033c3e;
    --accent-yellow: #f5df4d;
    --text-dark: #203040;
    --text-muted: #64737a;
}

/* هندسة وتصميم قسم الـ Hero */
.syndicate_hero_premium {
    position: relative;
    background-color: var(--primary-teal-bg);
    padding: 100px 0 140px;
    color: #ffffff;
    overflow: hidden;
    direction: rtl;
}

/* بناء شبكة الخطوط المتقاطعة الدقيقة خلف الكروت والنصوص */
.hero_grid_overlay {
    position: absolute;
    inset: 0;
    background-image:
        linear-gradient(rgba(255, 255, 255, 0.05) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255, 255, 255, 0.05) 1px, transparent 1px);
    background-size: 28px 28px;
    background-position: center top;
    pointer-events: none;
    z-index: 1;
}

/* توهج إضاءة جانبي خفيف مائل للأخضر الفسفوري التقني ليعطي أبعاد الصورة */
.hero_glow_left {
    position: absolute;
    bottom: -10%;
    left: -10%;
    width: 400px;
    height: 400px;
    background: radial-gradient(circle, rgba(39, 174, 96, 0.12) 0%, transparent 70%);
    z-index: 1;
    pointer-events: none;
}

.hero_glow_right {
    position: absolute;
    top: -10%;
    right: -10%;
    width: 400px;
    height: 400px;
    background: radial-gradient(circle, rgba(245, 223, 77, 0.05) 0%, transparent 70%);
    z-index: 1;
    pointer-events: none;
}

.hero_container {
    position: relative;
    z-index: 5;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 50px;
}

/* توزيع المحاذاة الجانبية الصحيحة */
.hero_text_side_fixed {
    flex: 1;
    max-width: 55%;
    text-align: right;
}

.hero_stats_side_fixed {
    flex: 1;
    max-width: 42%;
}

/* البادج العلوي الصغير */
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
    font-size: 12.5px;
    color: rgba(255, 255, 255, 0.9);
}

/* العناوين الأساسية وسماكتها العالية */
.hero_main_title_fixed {
    font-size: 38px;
    font-weight: 800;
    line-height: 1.5;
    margin: 0 0 20px 0;
    color: #ffffff;
    letter-spacing: -0.5px;
}

.hero_sub_desc_fixed {
    font-size: 15px;
    color: rgba(255, 255, 255, 0.75);
    line-height: 1.8;
    margin-bottom: 35px;
}

/* الأزرار التفاعلية وتنسيق الألوان الفاقعة */
.hero_cta_buttons_fixed {
    display: flex;
    gap: 15px;
    margin-bottom: 40px;
}

.btn_cta_yellow_fixed {
    background-color: var(--accent-yellow);
    color: var(--primary-teal-bg);
    padding: 12px 28px;
    border-radius: 5px;
    font-weight: 700;
    font-size: 15px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: 0.2s ease;
}

.btn_cta_yellow_fixed:hover {
    background-color: #ffffff;
}

.btn_cta_outline_fixed {
    border: 1px solid rgba(255, 255, 255, 0.3);
    color: #ffffff;
    padding: 12px 28px;
    border-radius: 5px;
    font-weight: 700;
    font-size: 15px;
    text-decoration: none;
    transition: 0.2s ease;
}

.btn_cta_outline_fixed:hover {
    background: rgba(255, 255, 255, 0.08);
}

.hero_trust_badges_fixed {
    display: flex;
    gap: 20px;
    font-size: 12.5px;
    color: rgba(255, 255, 255, 0.55);
}

.hero_trust_badges_fixed span {
    display: inline-flex;
    align-items: center;
    gap: 6px;
}

/* صندوق إحصائيات الأرقام المدمج على اليسار تماماً */
.stats_inner_box_fixed {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.07);
    padding: 26px;
    border-radius: 10px;
}

.stats_header_title_fixed {
    font-size: 13px;
    color: var(--accent-yellow);
    font-weight: bold;
    margin-bottom: 15px;
}

.stats_quad_grid_fixed {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 12px;
}

.stat_quad_card_fixed {
    background: rgba(255, 255, 255, 0.02);
    border: 1px solid rgba(255, 255, 255, 0.06);
    padding: 20px 10px;
    border-radius: 6px;
    text-align: center;
}

.stat_quad_card_fixed h2 {
    font-size: 28px;
    font-weight: 800;
    color: #ffffff;
    margin: 0 0 4px 0;
}

.stat_quad_card_fixed p {
    font-size: 12px;
    color: rgba(255, 255, 255, 0.6);
    margin: 0;
}

.stats_benefits_link_fixed {
    display: block;
    text-align: center;
    margin-top: 15px;
    color: var(--accent-yellow);
    font-size: 13px;
    text-decoration: none;
}

@media(max-width: 980px) {
    .hero_container {
        flex-direction: column-reverse;
    }

    .hero_text_side_fixed,
    .hero_stats_side_fixed {
        max-width: 100%;
        width: 100%;
    }

    .hero_main_title_fixed {
        font-size: 28px;
    }

    .hero_cta_buttons_fixed {
        flex-direction: column;
    }
}
</style>