<?php if (!empty($settings['fav_dark'])) { ?>
<script>
$(function() {
    if (!window.matchMedia) return;

    var current = $('head > link[rel="shortcut icon"][media]');
    $.each(current, function(i, icon) {
        var match = window.matchMedia(icon.media);

        function swap() {
            if (match.matches) {
                current.remove();
                current = $(icon).appendTo('head');
            }
        }

        // استخدام الطريقة الحديثة والمستقرة مع دعم التوافق الرجعي
        if (match.addEventListener) {
            match.addEventListener('change', swap);
        } else if (match.addListener) {
            match.addListener(swap);
        }
        swap();
    });
});
</script>
<?php } ?>