<?php
$_user = 'users_8400';

// تم تعديل الشرط هنا ليطابق دالة الـ Dashboard تماماً لمنع الـ Loop اللانهائي
if(isLogged(moduleID($_user))){
?>
<script>
window.location.href = "<?=urlp('dashboard')?>";
</script>
<?php
}else{
    $auth_visual_photo=c('join','photo');
    $noShare=true;
?>
<script src="https://www.google.com/recaptcha/api.js?render=6LetozAtAAAAAOAAm2-clVgEzDjlvTqo02qINfsf"></script>

<div id="login_wrap" class="auth_page">
    <div class="auth_layout">
        <aside class="auth_visual" <?=($auth_visual_photo!='' ? bg($auth_visual_photo) : '')?>>
            <div class="auth_visual_brand">
                <?php
                if(curr() == "ar"){
                    pic(c('ar_logo','photo'),1000,100,l($settings['site_name']),true,'auth_visual_logo','auth_visual_logo_picture');
                }else{
                    pic($settings['logo'],1000,100,l($settings['site_name']),true,'auth_visual_logo','auth_visual_logo_picture');
                }
                ?>
                <h3>
                    <?=l(
        'Palestinian Information Technology & Informatics Syndicate<>
        نقابة العلوم المعلوماتية التكنولوجية الفلسطينية'
    )?>
                </h3>

                <span>
                    <?=l(
        'Official Electronic Portal<>
        البوابة الإلكترونية الرسمية'
    )?>
                </span>

                <div class="auth_visual_content">
                    <h2>
                        <?=l(
            'Welcome to the Syndicate Portal<>
            مرحباً بكم في البوابة الإلكترونية للنقابة'
        )?>
                    </h2>

                    <p>
                        <?=l(
            'Manage membership applications and access digital services easily and securely.<>
            إدارة طلبات الانتساب والاستفادة من الخدمات الإلكترونية بسهولة وأمان'
        )?>
                    </p>
                </div>

                <div class="auth_skyline" aria-hidden="true">
                    <span></span><span></span><span></span><span></span><span></span><span></span>
                </div>
            </div>
        </aside>

        <section class="auth_panel">
            <div class="auth_card">
                <div class="auth_brand">
                    <div class="auth_logo_badge">
                        <i class="md-light">person</i>
                    </div>
                    <h1><?=l('Login<>تسجيل الدخول')?></h1>
                    <p><?=l('Enter your details to continue to your account<>أدخل بياناتك للمتابعة إلى حسابك')?></p>
                </div>

                <div id="auth_error" class="auth_alert" style="display:none">
                    <i class="md-light">error</i>
                    <span><?=l('The email address or password is incorrect.<>البريد الإلكتروني أو كلمة المرور غير صحيحة')?></span>
                </div>

                <form id="c_users_8400" autocomplete="off" action=""
                    onsubmit="handleRecaptchaSubmit(event, this); return false;" method="post"
                    enctype="multipart/form-data">
                    <input type="hidden" value="" name="e" />
                    <input type="hidden" name="module" value="users_8400" />
                    <input type="hidden" name="c_login" value="<?=rand()?>" />
                    <input type="hidden" name="lang" value="<?=curr()?>" />

                    <input type="hidden" name="recaptcha_response" id="recaptchaResponse" />

                    <div class="form_field users_8400_email_address">
                        <label for="for_field_email"><?=l('Email<>البريد الإلكتروني')?> <span
                                class="required_star">*</span></label>
                        <div class="input_area">
                            <i class="md-light auth_field_icon">mail</i>
                            <input id="for_field_email" required type="email" name="email_address"
                                placeholder="<?=l('Email<>البريد الإلكتروني')?>" value="" />
                        </div>
                    </div>

                    <div class="form_field users_8400_password">
                        <label for="for_field_password"><?=l('Password<>كلمة المرور')?> <span
                                class="required_star">*</span></label>
                        <div class="input_area">
                            <i class="md-light auth_field_icon">lock</i>
                            <button id="eye_icon" type="button" class="po" onclick="myFunction()"
                                aria-label="<?=l('Show password<>إظهار كلمة المرور')?>"><i
                                    class="material-icons">visibility_off</i></button>
                            <input id="for_field_password" required type="password" name="password"
                                placeholder="<?=l('Password<>كلمة المرور')?>" value="" />
                        </div>
                    </div>

                    <div class="auth_options">
                        <label class="auth_remember" for="auth_remember">
                            <input id="auth_remember" type="checkbox" name="remember" value="1" />
                            <span><?=l('Remember me<>تذكرني')?></span>
                        </label>
                        <button type="button" onclick="forgot()"
                            class="pointer forgot"><?=l('Forgot Password?<>نسيت كلمة المرور؟')?></button>
                    </div>

                    <input type="submit" value="<?=l('Login<>تسجيل الدخول')?>" class="b" />

                    <div class="auth_or"><span><?=l('or<>أو')?></span></div>

                    <a class="have_account" href="<?=url('pages_1478423482','single','signup')?>"
                        title="<?=l(detail('pages_1478423482','title','slug','signup'))?>">
                        <i class="md-light">person_add</i>
                        <span><?=l('No account? Create a new account<>ليس لديك حساب؟ إنشاء حساب جديد')?></span>
                    </a>
                </form>

                <div id="forget" style="display:none">
                    <form id="inner" autocomplete="off" action="" onsubmit="return submitter(this,'<?=urlPanel?>');"
                        method="post" enctype="multipart/form-data">
                        <input type="hidden" value="" name="e" />
                        <input type="hidden" value="true" name="c_forgot" />
                        <input type="hidden" name="module" value="users_8400" />
                        <input type="hidden" name="lang" value="<?=curr()?>" />

                        <div class="auth_forgot_head">
                            <h2><?=l('Password Recovery<>استعادة كلمة المرور')?></h2>
                            <p><?=l('Enter your email address and we will send you a new password.<>أدخل بريدك الإلكتروني وسنرسل لك كلمة مرور جديدة.')?>
                            </p>
                        </div>

                        <div class="form_field users_1627035922_email_address">
                            <label for="for_field_email_address"><?=l('Email Address<>البريد الإلكتروني')?></label>
                            <div class="input_area">
                                <i class="md-light auth_field_icon">mail</i>
                                <input id="for_field_email_address" required type="email" name="email_address"
                                    placeholder="<?=l('Email Address<>البريد الإلكتروني')?>" value="">
                            </div>
                        </div>

                        <input type="submit" class="btn" value="<?=l('Send New Password<>ارسال كلمة سرية جديدة')?>" />
                        <button type="button" class="auth_back_btn"
                            onclick="backToLogin()"><?=l('Back to Login<>العودة لتسجيل الدخول')?></button>
                    </form>
                </div>

                <div id="otp_verification" style="display:none">
                    <form id="otp_form" autocomplete="off" action="" onsubmit="return verifyOTP(this);" method="post">
                        <div class="auth_forgot_head">
                            <h2><?=l('Device Verification<>التحقق من الجهاز')?></h2>
                            <p><?=l('We noticed a login from a new device. Please enter the OTP sent to your email.<>لقد لاحظنا تسجيل دخول من جهاز جديد. يرجى إدخال رمز التحقق المرسل إلى بريدك الإلكتروني.')?>
                            </p>
                        </div>

                        <div class="form_field users_otp_field">
                            <label for="otp_input"><?=l('Verification Code<>رمز التحقق')?></label>
                            <div class="input_area">
                                <i class="md-light auth_field_icon">verified_user</i>
                                <input id="otp_input" required type="text" maxlength="6" name="otp_code"
                                    placeholder="******"
                                    style="text-align: center; font-size: 24px; letter-spacing: 8px;" />
                            </div>
                        </div>

                        <input type="submit" class="b" value="<?=l('Verify & Login<>تحقق وتسجيل الدخول')?>" />
                        <button type="button" class="auth_back_btn"
                            onclick="backToLoginFromOtp()"><?=l('Back<>العودة')?></button>
                    </form>
                </div>

                <div id="c_successLogin" class="hidden" style="display:none">
                    <?=l('Your signin was successful, you will be redericted to the home page<>تم تسجيل الدخول بنجاح، جاري تحويل الصفحة.. ')?>
                </div>

                <div id="pop_box" style="display:none">
                    <h2><?=l('You are suspended<>حسابك معلق')?></h2>
                    <i class="material_icons cancel po" onclick="closeForm()">cancel</i>
                </div>
            </div>
        </section>
    </div>
</div>




<style>
body:has(#login_wrap.auth_page) #page_top,
body:has(#login_wrap.auth_page) section>.p_content .mce,
body:has(#login_wrap.auth_page) .addthis_inline_share_toolbox,
body:has(#login_wrap.auth_page) .addthis_toolbox,
body:has(#login_wrap.auth_page) #share_box,
body:has(#login_wrap.auth_page) .sharethis-inline-share-buttons {
    display: none !important
}

body:has(#login_wrap.auth_page) section>.p_content.w1200 {
    width: 100% !important;
    max-width: none !important;
    padding: 0 !important
}

#login_wrap.auth_page {
    --teal: #075f61;
    --teal2: #0b6f72;
    --yellow: #f5df4d;
    --text: #203040;
    width: 100%;
    min-height: calc(100vh - 92px);
    padding: 28px 24px 18px;
    background: #f8fafc;
    direction: rtl;
    box-sizing: border-box;
    font-family: Tajawal, Cairo, Arial, sans-serif
}

#login_wrap.auth_page * {
    box-sizing: border-box
}

#login_wrap.auth_page .auth_layout {
    width: min(100%, 1480px);
    min-height: 760px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 44.5% 55.5%;
    direction: ltr;
    overflow: hidden;
    background: #fff;
    border-radius: 18px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, .08);
    border: 1px solid #e8eeee
}

#login_wrap.auth_page .auth_visual {
    position: relative;
    min-height: 760px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 70px 72px;
    color: #fff;
    background-color: var(--teal);
    background-size: cover;
    background-position: center;
    direction: rtl;
    overflow: hidden
}

#login_wrap.auth_page .auth_visual:before {
    content: "";
    position: absolute;
    inset: 0;
    background: linear-gradient(180deg, rgba(7, 95, 97, .72), rgba(5, 74, 76, .94)), linear-gradient(135deg, rgba(7, 95, 97, .82), rgba(4, 66, 68, .9))
}

#login_wrap.auth_page .auth_visual:after {
    content: "";
    position: absolute;
    inset: 0;
    background-image: linear-gradient(rgba(245, 223, 77, .08) 1px, transparent 1px), linear-gradient(90deg, rgba(245, 223, 77, .08) 1px, transparent 1px);
    background-size: 44px 44px;
    opacity: .35
}

#login_wrap.auth_page .auth_visual_brand {
    position: absolute;
    z-index: 2;
    top: 66px;
    left: 0;
    right: 0;
    text-align: center;
    color: #fff
}

#login_wrap.auth_page .auth_visual_logo_picture {
    width: 132px;
    margin: 0 auto 18px;
    filter: brightness(0) invert(1)
}

#login_wrap.auth_page .auth_visual_logo_picture img {
    width: 100%;
    height: auto
}

#login_wrap.auth_page .auth_visual_brand h3 {
    margin: 0 0 4px;
    color: #fff;
    font-size: 24px;
    font-weight: 800;
    line-height: 1.35
}

#login_wrap.auth_page .auth_visual_brand span {
    color: rgba(255, 255, 255, .9);
    font-size: 18px;
    font-weight: 600
}

#login_wrap.auth_page .auth_visual_content {
    position: relative;
    z-index: 2;
    width: 100%;
    max-width: 430px;
    margin-top: 178px;
    text-align: center
}

#login_wrap.auth_page .auth_visual h2 {
    margin: 0 0 14px;
    color: #fff;
    font-size: 42px;
    font-weight: 800;
    line-height: 1.35;
    text-shadow: 0 3px 12px rgba(0, 0, 0, .2)
}

#login_wrap.auth_page .auth_visual p {
    max-width: none;
    margin: 0 auto;
    color: #fff;
    font-size: 20px;
    line-height: 1.75
}

#login_wrap.auth_page .auth_panel {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 96px 62px 58px;
    background: #fff;
    direction: rtl
}

#login_wrap.auth_page .auth_card {
    position: relative;
    width: 100%;
    max-width: 680px;
    padding: 96px 48px 52px;
    background: #fff;
    border: 1px solid rgba(7, 95, 97, .12);
    border-radius: 18px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, .08)
}

#login_wrap.auth_page .auth_brand {
    margin-bottom: 30px;
    text-align: center
}

#login_wrap.auth_page .auth_logo_badge {
    width: 70px;
    height: 70px;
    margin: 0 auto 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(245, 223, 77, .16);
    border: 1px solid rgba(245, 223, 77, .55);
    border-radius: 50%;
    box-shadow: none;
    color: var(--teal)
}

#login_wrap.auth_page .auth_logo_badge i {
    font-size: 34px
}

#login_wrap.auth_page .auth_brand h1 {
    margin: 0;
    color: var(--teal);
    font-size: 32px;
    font-weight: 800;
    line-height: 1.35
}

#login_wrap.auth_page .auth_brand h1:after {
    content: "";
    display: block;
    width: 64px;
    height: 3px;
    margin: 12px auto 0;
    background: var(--yellow);
    border-radius: 4px
}

#login_wrap.auth_page .auth_brand p {
    margin: 8px 0 0;
    color: #64737a;
    font-size: 17px;
    line-height: 1.8
}

#login_wrap.auth_page .auth_alert {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 16px;
    padding: 12px 14px;
    color: #8a1f1f;
    background: #fff2f2;
    border: 1px solid #f1b6b6;
    border-radius: 10px;
    font-size: 13px;
    font-weight: 700
}

#login_wrap.auth_page .form_field {
    width: 100%;
    margin: 0 0 26px;
    display: block
}

#login_wrap.auth_page .form_field>label {
    position: absolute;
    width: 1px;
    height: 1px;
    overflow: hidden;
    clip: rect(0 0 0 0)
}

#login_wrap.auth_page .input_area {
    position: relative
}

#login_wrap.auth_page input[type=email],
#login_wrap.auth_page input[type=password],
#login_wrap.auth_page input[type=text] {
    width: 100%;
    height: 52px;
    padding: 0 56px 0 58px;
    color: var(--text);
    background: #fff;
    border: 1px solid #c9d6d6;
    border-radius: 12px;
    box-shadow: 0 1px 2px rgba(7, 95, 97, .05);
    font-size: 16px
}

#login_wrap.auth_page input::placeholder {
    color: #7d8b92
}

#login_wrap.auth_page input:focus {
    border-color: var(--teal);
    box-shadow: 0 0 0 4px rgba(7, 95, 97, .12);
    outline: none
}

#login_wrap.auth_page .auth_field_icon {
    position: absolute;
    top: 50%;
    right: 18px;
    transform: translateY(-50%);
    color: var(--teal);
    font-size: 24px;
    z-index: 1
}

#login_wrap.auth_page #eye_icon {
    position: absolute;
    top: 50%;
    left: 18px;
    transform: translateY(-50%);
    width: 34px;
    height: 34px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--teal);
    background: transparent;
    border: 0;
    cursor: pointer;
    z-index: 2
}

#login_wrap.auth_page .auth_options {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 14px;
    margin: -4px 0 26px;
    width: 100%
}

#login_wrap.auth_page .auth_remember {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    margin: 0;
    color: var(--text);
    font-size: 15px;
    font-weight: 600;
    cursor: pointer
}

#login_wrap.auth_page .auth_remember input {
    width: 24px;
    height: 24px;
    accent-color: var(--teal)
}

#login_wrap.auth_page .auth_robot_check {
    display: flex;
    align-items: center;
    gap: 12px;
    width: 100%;
    min-height: 58px;
    margin: -10px 0 22px;
    padding: 12px 16px;
    border: 1px solid #d8e4e4;
    border-radius: 12px;
    background: #f8fbfb;
    color: var(--text);
    font-size: 15px;
    font-weight: 800;
    cursor: pointer;
    user-select: none
}

#login_wrap.auth_page .auth_robot_check input {
    position: absolute;
    opacity: 0;
    pointer-events: none
}

#login_wrap.auth_page .auth_robot_box {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 28px;
    height: 28px;
    border: 2px solid #b8c8c8;
    border-radius: 6px;
    background: #fff;
    color: transparent;
    flex: 0 0 auto;
    transition: .2s
}

#login_wrap.auth_page .auth_robot_box i {
    font-size: 20px
}

#login_wrap.auth_page .auth_robot_check input:checked+.auth_robot_box {
    border-color: var(--teal);
    background: var(--teal);
    color: #fff
}

#login_wrap.auth_page .auth_robot_check input:focus+.auth_robot_box {
    box-shadow: 0 0 0 3px rgba(7, 95, 97, .16)
}

#login_wrap.auth_page .auth_robot_text {
    line-height: 1.5
}

#login_wrap.auth_page .forgot,
#login_wrap.auth_page .auth_back_btn {
    border: 0;
    background: transparent;
    color: var(--teal);
    font-size: 15px;
    font-weight: 800;
    cursor: pointer;
    padding: 0
}

#login_wrap.auth_page input[type=submit].b,
#login_wrap.auth_page input[type=submit].btn {
    width: 100%;
    height: 60px;
    margin: 0;
    color: var(--teal);
    background: var(--yellow);
    border: 0;
    border-radius: 12px;
    font-size: 20px;
    font-weight: 900;
    cursor: pointer;
    box-shadow: 0 8px 18px rgba(245, 223, 77, .35);
    transition: .3s
}

#login_wrap.auth_page input[type=submit].b:hover,
#login_wrap.auth_page input[type=submit].btn:hover {
    background: #fff6a6;
    transform: translateY(-2px)
}

#login_wrap.auth_page .auth_or {
    position: relative;
    margin: 34px 0 28px;
    text-align: center;
    color: #64737a;
    font-size: 16px;
    font-weight: 700
}

#login_wrap.auth_page .auth_or:before {
    content: "";
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    height: 1px;
    background: #dce7e7
}

#login_wrap.auth_page .auth_or span {
    position: relative;
    z-index: 1;
    display: inline-block;
    padding: 0 20px;
    background: #fff
}

#login_wrap.auth_page .have_account {
    height: 58px;
    margin-top: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 14px;
    color: var(--teal);
    background: #fff;
    border: 1px solid #9ab7b8;
    border-radius: 12px;
    font-size: 17px;
    font-weight: 800;
    text-decoration: none
}

#login_wrap.auth_page .have_account i {
    color: var(--teal);
    font-size: 28px
}

#login_wrap.auth_page .auth_forgot_head {
    text-align: center;
    margin-bottom: 22px
}

#login_wrap.auth_page .auth_forgot_head h2 {
    margin: 0;
    color: var(--teal);
    font-size: 24px;
    font-weight: 800
}

#login_wrap.auth_page .auth_forgot_head p {
    color: #64737a;
    font-size: 14px;
    line-height: 1.8
}

#login_wrap.auth_page .auth_back_btn {
    display: block;
    width: 100%;
    margin-top: 16px;
    text-align: center
}

#login_wrap.auth_page #c_successLogin,
#login_wrap.auth_page #pop_box {
    margin-top: 14px;
    padding: 14px;
    border-radius: 10px;
    text-align: center
}

#login_wrap.auth_page #c_successLogin {
    background: rgba(7, 95, 97, .08);
    color: var(--teal)
}

#login_wrap.auth_page #pop_box {
    background: #fff2f2;
    color: #8a1f1f;
    border: 1px solid #f1b6b6
}

@media(max-width:1100px) {
    #login_wrap.auth_page .auth_layout {
        grid-template-columns: 1fr;
        width: 90%
    }

    #login_wrap.auth_page .auth_visual {
        min-height: 360px;
        padding: 42px 28px
    }

    #login_wrap.auth_page .auth_visual_brand {
        top: 36px
    }

    #login_wrap.auth_page .auth_visual_logo_picture {
        width: 94px
    }

    #login_wrap.auth_page .auth_visual_content {
        margin-top: 118px
    }

    #login_wrap.auth_page .auth_visual h2 {
        font-size: 30px
    }

    #login_wrap.auth_page .auth_visual p {
        font-size: 16px
    }

    #login_wrap.auth_page .auth_panel {
        padding: 42px 24px
    }
}

@media(max-width:640px) {
    #login_wrap.auth_page {
        padding: 18px 0
    }

    #login_wrap.auth_page .auth_layout {
        width: 90%;
        display: block;
        border-radius: 14px
    }

    #login_wrap.auth_page .auth_visual {
        display: none
    }

    #login_wrap.auth_page .auth_panel {
        padding: 24px 0;
        background: #f8fafc
    }

    #login_wrap.auth_page .auth_card {
        width: 100%;
        padding: 32px 18px;
        border-radius: 14px
    }

    #login_wrap.auth_page .auth_logo_badge {
        width: 62px;
        height: 62px
    }

    #login_wrap.auth_page .auth_brand h1 {
        font-size: 27px
    }

    #login_wrap.auth_page .auth_options {
        flex-direction: row;
        align-items: center
    }
}
</style>

<script>
function handleRecaptchaSubmit(event, form) {
    event.preventDefault(); // منع الإرسال الفوري للنموذج

    grecaptcha.ready(function() {
        grecaptcha.execute('6LetozAtAAAAAOAAm2-clVgEzDjlvTqo02qINfsf', {
            action: 'login'
        }).then(function(token) {
            // تعيين قيمة التوكين في الحقل المخفي
            document.getElementById('recaptchaResponse').value = token;

            // استدعاء دالة النظام الأساسية submitter مع مسار اللوحة المعتمد لديكِ
            submitter(form, '<?=urlPanel?>');
        });
    });
}
var pendingEmail = '';

function successLogin(data, params) {
    $('#auth_error').hide();

    // إذا كان الرد يتطلب رمز التحقق، نقوم بتبديل الواجهة فقط
    if (params && params.requires_otp) {
        pendingEmail = $('#for_field_email').val();
        $('#c_users_8400').hide();
        $('#otp_verification').fadeIn();
        return; // نتوقف هنا ولا نقوم بالتحويل للدشبرد
    }

    hide('c_users_8400');
    $('#c_successLogin').removeClass('hidden').show();

    // تحديد الرابط الافتراضي في البداية
    var target = "<?=urlp('dashboard')?>";

    // التحقق من وجود رابط مخصص قادم من السيرفر
    if (params && params.url && params.url !== "undefined") {
        target = params.url;
    } else if (data && typeof data === 'string' && data !== "undefined") {
        target = data;
    } else if (data && data.url && data.url !== "undefined") {
        target = data.url;
    }

    if (target && target !== "" && target !== "undefined") {
        window.location.href = target;
    }
}

function popError() {
    $('#auth_error').show();
    $('#pop_box').show();
}

function closeForm() {
    $('#pop_box').hide();
}

function forgot() {
    $('#auth_error').hide();
    $('#c_users_8400').hide();
    $('#forget').show();
}

function backToLogin() {
    $('#forget').hide();
    $('#c_users_8400').show();
}

function backToLoginFromOtp() {
    $('#otp_verification').hide();
    $('#c_users_8400').show();
}

function verifyOTP(form) {
    var otpVal = $('#otp_input').val();
    var targetUrl = '<?php echo isset($controllerURL) ? $controllerURL : urlPanel; ?>' + 'controller.php';

    $.post(targetUrl, {
        action: 'verify_device_otp',
        otp_code: otpVal,
        email_address: pendingEmail,
        module: 'users_8400'
    }, function(response) {
        if (response && response.response === true && response.code === 1 && response.extra && response.extra
            .status === 'otp_correct') {
            $('#otp_verification').hide();
            $('#c_successLogin').removeClass('hidden').show();
            window.location.href = "<?=urlp('dashboard')?>";
        } else {
            if (response.custom_error_desc) {
                alert(response.custom_error_desc);
            } else {
                alert(response.message ||
                    '<?=l('Invalid or expired verification code!<>رمز التحقق غير صحيح أو انتهت صلاحيته!')?>'
                );
            }
        }
    }, 'json');

    return false;
}

function c_forgot_func(data, params) {
    $('#forget').hide();
    var msg_txt =
        "<?=l('A new password has been sent to your email<>تم إرسال كلمة سر جديدة إلى بريدك الإلكتروني')?>";
    if (typeof messenger === "function") {
        messenger(msg_txt, 5000);
    } else {
        alert(msg_txt);
    }
    backToLogin();
}

// دالة إظهار وإخفاء كلمة المرور المحدثة
function myFunction() {
    var x = document.getElementById("for_field_password");
    if (x.type === "password") {
        x.type = "text";
        $('#eye_icon i').text('visibility');
    } else {
        x.type = "password";
        $('#eye_icon i').text('visibility_off');
    }
}
</script>
<?php } ?>