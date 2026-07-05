</main>
<?php if(!isset($_GET['mobile'])){ ?>
<?php require 'web3.php' ?>

<link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">

<footer class="modern_site_footer">
    <div class="footer_inner_container w1200">

        <div class="footer_copyright_block">
            &copy; <?= date('Y');?> <?= l($settings['site_name']);?>
        </div>

        <div class="footer_provision_credit">
            <?php
            $url = $legion['provision']['logo_medium'];
            $img = u_dir.'provision.png';
            if(!file_exists($img)){
                if(!is_dir(u_dir)){
                    mkdir(u_dir,0775,true);
                }
                $logo = @file_get_contents($url);
                if($logo !== false){
                    file_put_contents($img, $logo);
                }
            }
            ?>

            <a href="<?= $legion['provision']['link'];?>" target="_blank" class="provision_link_wrapper"
                title="Design & Development by <?= $legion['provision']['name'];?>">
                <div class="provision_flex_content">
                    <?php if(get_lang_direction() == 'ltr'){ ?>
                    <span class="provision_label_text">
                        <span class="highlight_letter">d</span>esign & <span class="highlight_letter">d</span>evelopment
                    </span>
                    <?php } else { ?>
                    <span class="provision_label_text">تصميم وتطوير</span>
                    <?php } ?>

                    <div class="provision_logo_holder">
                        <img src="<?= uploads_link.img('provision_logo_web.png',140,100);?>"
                            alt="<?= $legion['provision']['name'];?>" />
                    </div>
                </div>
            </a>
        </div>

    </div>
</footer>
<?php }

require 'legion_footer.php'; ?>

<style>
/* تنسيق الفوتر المعاصر والمحمي من تداخل النصوص */
.modern_site_footer {
    background-color: #04292a;
    /* درجة زيتية داكنة جداً تمنح عمقاً وتزيد تباين النصوص */
    border-top: 1px solid rgba(255, 255, 255, 0.08);
    padding: 24px 0;
    color: #b0c4c5;
    font-family: 'Tajawal', sans-serif;
    position: relative;
    z-index: 10;
}

/* توزيع العناصر بشكل مرن ومتجاوب */
.footer_inner_container {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    box-sizing: border-box;
}

/* ضبط اتجاه مرن ديناميكي يعتمد على لغة الصفحة الأساسية */
[dir="rtl"] .footer_inner_container {
    flex-direction: row;
}

[dir="ltr"] .footer_inner_container {
    flex-direction: row-reverse;
}

/* نص حقوق النشر */
.footer_copyright_block {
    font-size: 14px;
    font-weight: 500;
    color: #e0ecee;
    /* لون أبيض ناعم واضح القراءة */
    letter-spacing: 0.3px;
}

/* رابط وكتلة شركة التطوير */
.provision_link_wrapper {
    text-decoration: none;
    color: inherit;
    transition: color 0.2s ease;
}

.provision_flex_content {
    display: flex;
    align-items: center;
    gap: 12px;
}

.provision_label_text {
    font-size: 13.5px;
    font-weight: 500;
    color: #9ab2b4;
}

/* إضاءة الحروف الأولى في الانجليزي باللون الذهبي */
.highlight_letter {
    color: #f5df4d;
    font-weight: 700;
}

/* حاوية الشعار لحمايته من التمدد العشوائي */
.provision_logo_holder {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 32px;
    opacity: 0.85;
    transition: opacity 0.2s ease, filter 0.2s ease;
    filter: brightness(0) invert(1);
    /* تحويل الشعار للون الأبيض ليتناسق تماماً مع المظهر المعتم */
}

.provision_logo_holder img {
    max-height: 100%;
    width: auto;
    object-fit: contain;
}

/* تأثيرات التمرير الذكية (Hover EFFECTS) */
.provision_link_wrapper:hover .provision_label_text {
    color: #ffffff;
}

.provision_link_wrapper:hover .provision_logo_holder {
    opacity: 1;
    filter: none;
    /* إرجاع الألوان الأصلية للشعار عند التمرير إن رغبتِ */
}

/* شاشات الموبايل والأجهزة اللوحية الصغيرة */
@media (max-width: 768px) {
    .footer_inner_container {
        flex-direction: column !important;
        /* تحويل التوزيع لرأسي متناسق منعاً للتداخل */
        text-align: center;
        gap: 16px;
        padding: 0 20px;
    }

    .provision_flex_content {
        flex-direction: column;
        gap: 8px;
    }
}
</style>