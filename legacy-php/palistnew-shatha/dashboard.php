<?php
$_user = 'users_8400';

if (isLogged(moduleID($_user))) {
    $user_id   = intval($_SESSION['user_id']);
    $user_data = db($_user, "WHERE !deleted AND id = " . $user_id, NULL);
    $u_info    = isset($user_data[0]) ? $user_data[0] : [];

    $profile_name = !empty($u_info['username'])
        ? $u_info['username']
        : (!empty($u_info['name']) ? $u_info['name'] : (!empty($u_info['full_name']) ? $u_info['full_name'] : ''));
    $profile_email = !empty($u_info['email_address'])
        ? $u_info['email_address']
        : (!empty($u_info['email']) ? $u_info['email'] : '');

    $current_username = $profile_name !== ''
        ? htmlspecialchars($profile_name, ENT_QUOTES, 'UTF-8')
        : l('Member<>عضو');
    $current_email = $profile_email !== ''
        ? htmlspecialchars($profile_email, ENT_QUOTES, 'UTF-8')
        : null;

    $resp_j = db('joining_request_form_8371', "WHERE !deleted AND user = " . $user_id, NULL);
    $has_membership = (
        is_array($resp_j) &&
        isset($resp_j[0]) &&
        intval($resp_j[0]['active']) === 1 &&
        intval($resp_j[0]['submitted']) === 1
    );
    $has_request = is_array($resp_j) && isset($resp_j[0]) && intval($resp_j[0]['submitted']) === 1;

    $plain_name = $profile_name !== '' ? trim($profile_name) : l('Member<>عضو');
    $initials   = function_exists('mb_substr')
        ? mb_strtoupper(mb_substr($plain_name, 0, 1, 'UTF-8'), 'UTF-8')
        : strtoupper(substr($plain_name, 0, 1));

    $profile_image = '';
    if (!empty($u_info['image'])) {
        $profile_image = $u_info['image'];
    } elseif (!empty($u_info['profile_photo'])) {
        $profile_image = $u_info['profile_photo'];
        if (!filter_var($profile_image, FILTER_VALIDATE_URL)) {
            if (strpos($profile_image, 'uploads/') === 0 && defined('url')) {
                $profile_image = url . $profile_image;
            } elseif (defined('u')) {
                $profile_image = u . ltrim($profile_image, '/');
            } elseif (defined('url')) {
                $profile_image = url . 'uploads/' . ltrim($profile_image, '/');
            }
        }
    }
    $profile_image = htmlspecialchars($profile_image, ENT_QUOTES, 'UTF-8');
?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
.pita-dashboard,
.pita-dashboard * {
    box-sizing: border-box;
}

/* التعديل هنا: إضافة clear لضمان فصل اللوحة تماماً عن هيدر الموقع الأساسي */
.pita-dashboard {
    direction: rtl;
    min-height: 320px;
    padding: 34px 16px 86px;
    background: #f8f8f9;
    color: #2d3748;
    font-family: 'Cairo', sans-serif;
    clear: both;
    /* تمنع تداخل الـ Float من العناصر العلوية للموقع */
    display: inline-block;
    /* تضمن احتواء كامل العناصر الداخلية */
    width: 100%;
}

.pita-dashboard a {
    text-decoration: none;
}

.pita-shell {
    width: min(1115px, 100%);
    margin: 0 auto;
    display: flex;
    flex-direction: column;
    clear: both;
}

/* التعديل هنا: إعطاء الهيدر خاصية الـ block والـ clear بشكل صارم */
.pita-header {
    width: 100% !important;
    margin-bottom: 32px;
    text-align: right;
    clear: both !important;
    display: block !important;
    position: relative;
    /* تضمن ظهوره في مكانه الطبيعي */
}

.pita-title {
    margin: 0 0 7px;
    color: #2c2f35;
    font-size: 26px;
    font-weight: 800;
    line-height: 1.3;
}

.pita-subtitle {
    margin: 0;
    color: #738195;
    font-size: 13px;
    font-weight: 500;
    line-height: 1.8;
}

.pita-grid {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 18px;
    clear: both;
    width: 100%;
}

.pita-card {
    min-height: 126px;
    padding: 20px 20px 18px;
    border: 1px solid #d8dde4;
    border-radius: 6px;
    background: #ffffff;
    box-shadow: 0 2px 5px rgba(15, 23, 42, 0.06);
}

.pita-profile-card {
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.pita-profile-top {
    display: flex;
    align-items: center;
    justify-content: flex-start;
    gap: 10px;
    margin-bottom: 8px;
}

.pita-avatar,
.pita-avatar-initials {
    width: 42px;
    height: 42px;
    border-radius: 50%;
    flex: 0 0 auto;
}

.pita-avatar {
    object-fit: cover;
    border: 1px solid #e2e8f0;
}

.pita-avatar-initials {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: #e8f0ef;
    color: #004846;
    font-size: 16px;
    font-weight: 800;
}

.pita-profile-text {
    min-width: 0;
    text-align: right;
}

.pita-profile-name {
    color: #1f2933;
    font-size: 13px;
    font-weight: 800;
    line-height: 1.4;
}

.pita-profile-role {
    color: #64748b;
    font-size: 10px;
    font-weight: 700;
    line-height: 1.5;
}

.pita-profile-email {
    margin: 0 0 10px;
    color: #64748b;
    font-size: 11px;
    font-weight: 500;
    line-height: 1.5;
    text-align: center;
    word-break: break-word;
}

.pita-edit-link {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    width: 100%;
    height: 25px;
    border: 1px solid #d6dbe1;
    border-radius: 3px;
    background: #ffffff;
    color: #2d3748;
    font-size: 11px;
    font-weight: 600;
}

.pita-edit-link:hover {
    border-color: #004846;
    color: #004846;
}

.pita-card-heading {
    display: flex;
    align-items: center;
    justify-content: flex-start;
    gap: 8px;
    margin-bottom: 12px;
    color: #1f2933;
    font-size: 13px;
    font-weight: 800;
}

.pita-card-heading i {
    color: #8a8800;
    font-size: 14px;
}

.pita-status-text {
    margin: 0 0 12px;
    color: #64748b;
    font-size: 12px;
    font-weight: 500;
    line-height: 1.7;
    text-align: center;
}

.pita-membership-card {
    text-align: center;
}

.pita-apply-link {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    height: 29px;
    padding: 0 13px;
    border-radius: 2px;
    background: #004846;
    color: #ffffff;
    font-size: 11px;
    font-weight: 800;
}

.pita-apply-link:hover {
    background: #003331;
    color: #ffffff;
}

.pita-resource-card {
    text-align: right;
}

.pita-resource-list {
    display: grid;
    gap: 4px;
    margin: 0;
    padding: 0;
    list-style: none;
}

.pita-resource-list a {
    color: #64748b;
    font-size: 12px;
    font-weight: 500;
    line-height: 1.7;
}

.pita-resource-list a:hover {
    color: #004846;
}

@media (max-width: 900px) {
    .pita-grid {
        grid-template-columns: 1fr;
    }

    .pita-dashboard {
        padding: 28px 16px 60px;
    }
}
</style>

<div class="pita-dashboard">
    <div class="pita-shell">
        <header class="pita-header" role="banner">
            <h1 class="pita-title"><?= l('Welcome<>مرحباً') ?> <?= $current_username ?></h1>
            <p class="pita-subtitle">
                <?= l('This is your dashboard at the Palestinian Information Technology Association.<>هذه لوحة التحكم الخاصة بك في نقابة العلوم المعلوماتية التكنولوجية الفلسطينية.') ?>
            </p>
        </header>

        <main class="pita-grid">
            <article class="pita-card pita-profile-card">
                <div class="pita-profile-top">
                    <?php if ($profile_image): ?>
                    <img class="pita-avatar" src="<?= $profile_image ?>" alt="<?= $current_username ?>">
                    <?php else: ?>
                    <div class="pita-avatar-initials" aria-hidden="true">
                        <?= htmlspecialchars($initials, ENT_QUOTES, 'UTF-8') ?></div>
                    <?php endif; ?>

                    <div class="pita-profile-text">
                        <div class="pita-profile-name"><?= $current_username ?></div>
                        <div class="pita-profile-role"><?= l('Role: member<>الدور: عضو') ?></div>
                    </div>
                </div>

                <p class="pita-profile-email">
                    <?= $current_email ? $current_email : l('No email address<>لا يوجد بريد إلكتروني') ?>
                </p>

                <a class="pita-edit-link" href="<?= url('pages_1478423482', 'single', 'edit-profile') ?>">
                    <?= l('Edit Profile<>تعديل الملف الشخصي') ?>
                    <i class="fa-regular fa-pen-to-square" aria-hidden="true"></i>
                </a>
            </article>

            <article class="pita-card pita-membership-card">
                <div class="pita-card-heading">
                    <?= l('Membership Status<>حالة العضوية') ?>
                    <i class="fa-regular fa-clock" aria-hidden="true"></i>
                </div>

                <p class="pita-status-text">
                    <?php if ($has_membership): ?>
                    <?= l('Your membership is active.<>عضويتك مفعلة.') ?>
                    <?php elseif ($has_request): ?>
                    <?= l('Your membership request is under review.<>طلب العضوية الخاص بك قيد المراجعة.') ?>
                    <?php else: ?>
                    <?= l('Not submitted yet.<>لم تقدم طلب عضوية بعد.') ?>
                    <?php endif; ?>
                </p>

                <a class="pita-apply-link" href="<?= urlp('joining-request-form') ?>">
                    <?= $has_request ? l('View Request<>عرض الطلب') : l('Apply for Membership<>تقديم طلب عضوية') ?>
                </a>
            </article>

            <article class="pita-card pita-resource-card">
                <div class="pita-card-heading">
                    <?= l('My Resources<>مواردي') ?>
                    <i class="fa-regular fa-file-lines" aria-hidden="true"></i>
                </div>

                <ul class="pita-resource-list">
                    <li><a href="<?= urlp('news') ?>"><?= l('Latest News<>آخر الأخبار') ?></a></li>
                    <li><a href="<?= urlp('events') ?>"><?= l('Upcoming Events<>الفعاليات القادمة') ?></a></li>
                    <li><a
                            href="<?= url('trainings_and_workshops_8419') ?>"><?= l('Training Programs<>البرامج التدريبية') ?></a>
                    </li>
                </ul>
            </article>
        </main>
    </div>
</div>

<?php
} else {
    goP();
}
?>


<?php
$_user='users_8400';


if(isLogged(moduleID($_user))){
	?>

<div class="l_grid2" id="dashboard_wrap">
    <a class="dashboard_item" href="<?=url('pages_1478423482','single','edit-profile')?>">
        <span class="midinline"><?=l('Edit profile<>تعديل معلومات الحساب')?></span>
        <i class="dashboard_item_icon">expand_circle_down</i>
    </a>


    <a class="dashboard_item" href="<?=url('pages_1478423482','single','change-password')?>"><span
            class="midinline"><?=l('Change Password<>تغيير كلمة المرور')?></span>
        <i class="dashboard_item_icon">expand_circle_down</i>
    </a>
    <?php
// $resp_u=db($_user,"WHERE !deleted and user=".$_SESSION['user_id'],NULL);
$resp_j=db('joining_request_form_8371',"WHERE !deleted and user=".$_SESSION['user_id'],NULL);

if($resp_j[0]['active']== 1 && $resp_j[0]['submitted']== 1){
?>
    <a class="dashboard_item" href="<?=urlp('joining-request-form')?>"> <i class=""></i>
        <span class="midinline"><?=l('Edit Membership Info.<>تعديل معلومات العضوية. ')?></span>
        <i class="dashboard_item_icon">expand_circle_down</i>
    </a>

    <?php
}else{
?>
    <a class="dashboard_item" href="<?=urlp('joining-request-form')?>"><i class=""></i>
        <span class="midinline"><?=l('Joining Request form<>طلب انتساب')?></span>
        <i class="dashboard_item_icon">expand_circle_down</i>
    </a>
    <?php } ?>
    <a class="dashboard_item" href="<?=urlPanel.'logout.php?location='.url?>" title="<?=l('Logout<>تسجيل خروج')?>">
        <span class="mid"><?=l('Logout<>تسجيل خروج')?></span>
        <i class="dashboard_item_icon">expand_circle_down</i>
    </a>

</div>

<div class="add_height"></div>

<?php
	
}else{
	goSign();
}