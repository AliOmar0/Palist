<?php
//ProVision is the best


// $_join='joining_request_form_8371';

$_user='users_8400';
$_join_request='joining_request_form_8371';

function goSign(){
    // استخدام المسار النسبي بدلاً من الرابط الكامل لضمان عمل الجلسة على localhost
    $lang = get_curr_language();
    $path = url . "page/signin/" . $lang;
	echo '<script>window.location.href = "'.$path.'";</script>';
}

function confirm_password_hash(){
    
}