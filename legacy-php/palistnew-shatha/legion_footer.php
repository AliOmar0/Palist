<?= connection('fb_app_analytics'); ?>
<?= connection('fb_pixel'); ?>

<div class="hidden_assets" style="display: none;">
    <script src="<?= pres ?>js/submitter.js?v=<?php clearCache(); ?>" defer></script>
    <script src="<?= pres ?>js/functions.js?v=<?php clearCache(); ?>" defer></script>
    <script src="<?= pres ?>js/responser.js?v=<?php clearCache(); ?>" defer></script>

    <link rel="stylesheet" href="<?= fres ?>css/fancybox.css?v=<?php clearCache(); ?>" media="none"
        onload="this.media='all';">
    <script src="<?= fres ?>js/fancybox.js?v=<?php clearCache(); ?>" defer></script>

    <script src="<?= fres ?>js/aos.js?v=<?php clearCache(); ?>" defer></script>
    <script>
    // استخدام الحدث الأصلي للمتصفح لضمان جهوزية عناصر DOM قبل تشغيل الأنميشن
    document.addEventListener("DOMContentLoaded", function() {
        if (typeof AOS !== 'undefined') {
            AOS.init({
                easing: 'ease-out-back',
                duration: 1000,
                once: true // التشغيل مرة واحدة أثناء التمرير لأسفل لضمان أداء خفيف وسريع على الجوال
            });
        }
    });
    </script>

</div>

<?php if (!isset($_GET['mobile'])) { ?>
<?php if (!isset($noFacebook) && connection('facebook_page_id') != NULL) { ?>

<div id="fb-root"></div>
<script>
window.fbAsyncInit = function() {
    FB.init({
        xfbml: true,
        version: 'v6.0'
    });
};

(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s);
    js.id = id;
    js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

// تحديث طريقة مراقبة الـ DOM بطريقة حديثة متوافقة مع إصدارات jQuery المعاصرة وبديلة لـ bind الملغاة
$(document).ready(function() {
    $(document).on("DOMSubtreeModified", "#fb-root", function() {
        $('iframe').attr('title', 'facebook');
    });
});
</script>

<div class="fb-customerchat" attribution="setup_tool" theme_color="<?= connection('facebook_chat_color') ?>"
    page_id="<?= connection('facebook_page_id') ?>" greeting_dialog_display="hide">
</div>
<?php } ?>
<?php } ?>

<?= connection('sharethis'); ?>
<?= connection('footer_js'); ?>

<?php require panel_dir.'sharedFooter.php' ?>
</body>

</html>