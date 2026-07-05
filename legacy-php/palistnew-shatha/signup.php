<?php
if(logged(mid($_user)) ){
    ?>
<script>
window.location.href = "<?=urlp('dashboard')?>";
</script>
<?php
}else{
    $auth_visual_photo = c('join','photo');
    $noShare = true;
    $registration_success = false;
    $error_msg = "";

    // التحقق من إرسال النموذج ومعالجة البيانات وقاعدة البيانات
    if(isset($_POST['submit_signup']) || isset($_POST['c_signup']) || $_SERVER['REQUEST_METHOD'] == 'POST'){
        
        // 1. تجهيز البيانات القادمة من الحقول للحفظ في قاعدة البيانات
        $full_name_ar   = isset($_POST['full_name_ar']) ? trim(strip_tags($_POST['full_name_ar'])) : '';
        $full_name_en   = isset($_POST['full_name_en']) ? trim(strip_tags($_POST['full_name_en'])) : '';
        $username        = isset($_POST['username']) ? trim(strip_tags($_POST['username'])) : '';
        $email_address  = isset($_POST['email_address']) ? trim(strip_tags($_POST['email_address'])) : '';
        $password       = isset($_POST['password']) ? $_POST['password'] : '';
        $confirm_pass   = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';
        $id_number      = isset($_POST['id_number']) ? trim(strip_tags($_POST['id_number'])) : '';
        $phone_number   = isset($_POST['phone_number']) ? trim(strip_tags($_POST['phone_number'])) : '';
        $major          = isset($_POST['major']) ? trim(strip_tags($_POST['major'])) : '';
        $date_of_birth  = isset($_POST['date_of_birth']) ? trim(strip_tags($_POST['date_of_birth'])) : '';
        $province       = isset($_POST['province']) ? trim(strip_tags($_POST['province'])) : '';
        $gender         = isset($_POST['gender']) ? trim(strip_tags($_POST['gender'])) : '';
        $employment_status = isset($_POST['employment_status']) ? trim(strip_tags($_POST['employment_status'])) : '';
        
        // حقول العمل الاختيارية
        $organisation   = isset($_POST['organisation']) ? trim(strip_tags($_POST['organisation'])) : '';
        $business_type  = isset($_POST['business_type']) ? trim(strip_tags($_POST['business_type'])) : '';
        $work_nature    = isset($_POST['work_nature']) ? trim(strip_tags($_POST['work_nature'])) : '';

        // fallback from hidden clone fields if browser autofill used hidden names
        if($full_name_ar === '' && isset($_POST['name'])){
            $full_name_ar = trim(strip_tags($_POST['name']));
        }
        if($email_address === '' && isset($_POST['email'])){
            $email_address = trim(strip_tags($_POST['email']));
        }

        // التحقق من الحقول المطلوبة قبل الحفظ
        $missingFields = [];
        $required = [
            'الاسم الكامل (بالعربية)' => $full_name_ar,
            'اسم المستخدم' => $username,
            'البريد الإلكتروني' => $email_address,
            'كلمة المرور' => $password,
            'تأكيد كلمة المرور' => $confirm_pass,
            'رقم الهوية' => $id_number,
            'رقم الهاتف' => $phone_number,
            'التخصص الأكاديمي' => $major,
            'تاريخ الميلاد' => $date_of_birth,
            'المحافظة' => $province,
            'الجنس' => $gender,
            'الحالة المهنية' => $employment_status,
        ];
        foreach($required as $label => $value){
            if(trim($value) === ''){
                $missingFields[] = $label;
            }
        }

        // تحويل القيم النصية إلى معّرفات رقمية لتتوافق مع نوع الحقول int(11) في الجدول
        function resolveOptionId($module, $value){
            global $conn;
            if(trim($value)==='') return 0;
            $value = trim($value);
            $escapedValue = escape($value);

            $moduleEscaped = mysqli_real_escape_string($conn, $module);
            $result = mysqli_query($conn, "SHOW COLUMNS FROM `$moduleEscaped` LIKE 'title_en'");
            $titleEnExists = ($result && mysqli_num_rows($result) > 0);

            $where = "title='".$escapedValue."'";
            if($titleEnExists){
                $where .= " OR title_en='".$escapedValue."'";
            }
            $resp = db($module, "WHERE $where", NULL, 'LIMIT 1', 'id');
            if($resp!=0 && $resp!=1 && isset($resp[0]['id'])) return $resp[0]['id'];

            $where = "title LIKE '%".$escapedValue."%'";
            if($titleEnExists){
                $where .= " OR title_en LIKE '%".$escapedValue."%'";
            }
            $resp = db($module, "WHERE $where", NULL, 'LIMIT 1', 'id');
            if($resp!=0 && $resp!=1 && isset($resp[0]['id'])) return $resp[0]['id'];

            return 0;
        }

        $province_id = (int)resolveOptionId('provinces_8371', $province);
        $gender_id = (int)resolveOptionId('gender_8371', $gender);
        $employment_status_id = (int)resolveOptionId('employment_status_8368', $employment_status);
        $business_type_id = (int)resolveOptionId('business_type_8368', $business_type);

        // إجراء فحص التكرار
        $check_email = db('users_8400', "WHERE email_address='".escape($email_address)."' AND !deleted");
        $check_user  = db('users_8400', "WHERE username='".escape($username)."' AND !deleted");
        
        $clean_id_num = (int)$id_number;
        $check_id    = db('users_8400', "WHERE id_number='$clean_id_num' AND !deleted");

        // التحقق الإضافي من صحة رقم الهاتف (يجب أن يحتوي على أرقام فقط وبطول منطقي)
        if(!empty($phone_number) && !preg_match('/^[0-9+]{9,15}$/', $phone_number)){
            $missingFields[] = "رقم الهاتف غير صحيح (يرجى إدخال أرقام فقط بدون مسافات)";
        }

        if(!empty($missingFields)){
            $error_msg = "⚠️ يرجى تصحيح أو تعبئة الحقول التالية:<br>• " . implode('<br>• ', $missingFields);
        } elseif($password !== $confirm_pass) {
            $error_msg = "⚠️ كلمتا المرور غير متطابقتين!";
        } elseif(is_array($check_email) && count($check_email) > 0 && $check_email != 0) {
            $error_msg = "⚠️ البريد الإلكتروني مسجل مسبقاً!";
        } elseif(is_array($check_user) && count($check_user) > 0 && $check_user != 0) {
            $error_msg = "⚠️ اسم المستخدم مسجل مسبقاً!";
        } elseif(is_array($check_id) && count($check_id) > 0 && $check_id != 0) {
            $error_msg = "⚠️ رقم الهوية مسجل مسبقاً!";
        } else {

            // --- منطق رفع الصور (الملفات) بشكل آمن مخصص للنظام ---
            $profile_photo_path = "";
            $id_photo_path = "";
            $upload_dir = "uploads/users/"; // تأكدي من وجود هذا المجلد على السيرفر ومنحه صلاحيات الكتابة للكود

            if(!is_dir($upload_dir)){
                @mkdir($upload_dir, 0755, true);
            }

            // 1. رفع الصورة الشخصية
            if(isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] == 0){
                $ext = strtolower(pathinfo($_FILES['profile_photo']['name'], PATHINFO_EXTENSION));
                if(in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])){
                    $profile_photo_name = "avatar_" . time() . "_" . rand(1000, 9999) . "." . $ext;
                    if(move_uploaded_file($_FILES['profile_photo']['tmp_name'], $upload_dir . $profile_photo_name)){
                        $profile_photo_path = $upload_dir . $profile_photo_name;
                    }
                }
            }

            // 2. رفع صورة الهوية
            if(isset($_FILES['id_photo']) && $_FILES['id_photo']['error'] == 0){
                $ext = strtolower(pathinfo($_FILES['id_photo']['name'], PATHINFO_EXTENSION));
                if(in_array($ext, ['jpg', 'jpeg', 'png', 'pdf'])){ // يقبل PDF أيضاً للهويات
                    $id_photo_name = "id_" . time() . "_" . rand(1000, 9999) . "." . $ext;
                    if(move_uploaded_file($_FILES['id_photo']['tmp_name'], $upload_dir . $id_photo_name)){
                        $id_photo_path = $upload_dir . $id_photo_name;
                    }
                }
            }
            // -----------------------------------------------------

            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            global $conn;
            $date_created = date('Y-m-d H:i:s');

            $sql = "INSERT INTO users_8400 (
                        username, password, email_address, phone_number, major, profile_photo, id_photo, active, 
                        full_name, full_name_en, date_of_birth, province, id_number, gender, 
                        employment_status, organisation, business_type, work_nature, 
                        deleted, restricted, admin_add_id, date_created
                    ) VALUES (
                        '".escape($username)."', 
                        '".escape($hashed_password)."', 
                        '".escape($email_address)."', 
                        '".escape($phone_number)."', 
                        '".escape($major)."', 
                        '".escape($profile_photo_path)."', 
                        '".escape($id_photo_path)."', 
                        0, 
                        '".escape($full_name_ar)."', 
                        '".escape($full_name_en)."', 
                        '".escape($date_of_birth)."', 
                        $province_id, 
                        $clean_id_num, 
                        $gender_id, 
                        $employment_status_id, 
                        '".escape($organisation)."', 
                        $business_type_id, 
                        '".escape($work_nature)."', 
                        0, 
                        0, 
                        0, 
                        '".escape($date_created)."'
                    )";

            if(mysqli_query($conn, $sql)){
                $new_user_id = mysqli_insert_id($conn);
                $registration_success = true;

                $admin_email = "shathadaseh612@gmail.com";
                $admin_subject = "=?UTF-8?B?".base64_encode("طلب انتساب جديد في الانتظار")."?=";
                $panel_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . ($_SERVER['HTTP_HOST'] ?? 'localhost') . '/panel/';
                $admin_message = "
                <html>
                <head><title>طلب انتساب جديد</title></head>
                <body style='direction: rtl; text-align: right; font-family: Arial, sans-serif;'>
                    <h2>مرحباً أدمن، هناك طلب انتساب جديد بانتظار المراجعة:</h2>
                    <hr>
                    <p><b>الاسم الكامل (عربي):</b> $full_name_ar</p>
                    <p><b>اسم المستخدم:</b> $username</p>
                    <p><b>رقم الهاتف:</b> $phone_number</p>
                    <p><b>التخصص:</b> $major</p>
                    <p><b>البريد الإلكتروني:</b> $email_address</p>
                    <p><b>رقم الهوية:</b> $id_number</p>
                    <p><b>المحافظة:</b> $province</p>
                    <hr>
                    <p>يرجى الدخول إلى لوحة التحكم للمراجعة والقبول والاطلاع على المرفقات:</p>
                    <p><a href='$panel_url'>$panel_url</a></p>
                </body>
                </html>
                ";
                $admin_headers = "MIME-Version: 1.0" . "\r\n";
                $admin_headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
                $fromDomain = preg_replace('/:[0-9]+$/', '', $host);
                $admin_headers .= "From: البوابة الإلكترونية <no-reply@" . $fromDomain . ">" . "\r\n";
                $admin_headers .= "Reply-To: no-reply@" . $fromDomain . "\r\n";
                
                @mail($admin_email, $admin_subject, $admin_message, $admin_headers);

                $module_id = db('modules', "WHERE module_prefix='users_8400'", NULL, 'LIMIT 1', 'id');
                $action_id = 0;
                if($module_id!=0 && $module_id!=1){
                    $module_id = $module_id[0]['id'];
                    $action = db('module_actions', "WHERE module_id='$module_id' AND type='add'", NULL, 'LIMIT 1', 'id');
                    if($action!=0 && $action!=1){
                        $action_id = $action[0]['id'];
                    }
                }
                $admins = db('admins', "WHERE deleted=0", NULL, NULL, 'id');
                if($admins!=0 && $admins!=1 && $action_id>0){
                    foreach($admins as $admin){
                        $custom_title = "طلب انتساب جديد من: $full_name_ar";
                        mysqli_query($conn, "INSERT INTO web_notifications_1644647708 (user,user_module,module_id,action_id,related_id,custom_title,custom_link,seen,admin_add_id,date_created) VALUES ('".escape($admin['id'])."','".escape(mid('admins'))."','$module_id','$action_id','$new_user_id','".escape($custom_title)."','',0,0,'".escape($date_created)."')");
                    }
                }

            } else {
                $error_msg = "⚠️ حدث خطأ أثناء إنشاء الحساب، يرجى المحاولة مرة أخرى.";
                error_log("[Signup] MySQL error: " . mysqli_error($conn) . " | SQL: " . $sql);
            }
        }
    }
}
?>
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
                <h3><?=l('Palestinian Information Technology & Informatics Syndicate<>نقابة العلوم المعلوماتية التكنولوجية الفلسطينية')?>
                </h3>
                <span><?=l('Official Electronic Portal<>البوابة الإلكترونية الرسمية')?></span>
                <div class="auth_visual_content">
                    <h2><?=l('Welcome to the Syndicate Portal<>مرحباً بكم في البوابة الإلكترونية للنقابة')?></h2>
                    <p><?=l('Manage membership applications and access digital services easily and securely.<>إدارة طلبات الانتساب والاستفادة من الخدمات الإلكترونية بسهولة وأمان')?>
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
                    <div class="auth_logo_badge"><i class="md-light">person_add</i></div>
                    <h1><?=l('Create Account<>إنشاء حساب جديد')?></h1>
                    <p><?=l('Enter your details to create your new account<>أدخل البيانات المطلوبة لإنشاء حسابكم الإلكتروني وتدقيق طلب انتسابكم')?>
                    </p>
                </div>

                <div id="form_<?=$_user?>" class="<?= $registration_success ? 'hidden' : '' ?>">
                    <form id="c_signup_form" autocomplete="off" action="<?=$_SERVER['REQUEST_URI']?>" method="post"
                        enctype="multipart/form-data">
                        <div class="signup_dynamic_fields">

                            <div class="form-group">
                                <label><?=l('Full Name (Arabic)<>الاسم الكامل (بالعربية)')?></label>
                                <input type="text" name="full_name_ar" required data-label="الاسم الكامل (بالعربية)"
                                    placeholder="الاسم الرباعي كما في الهوية" />
                                <input type="hidden" name="name" class="dynamic_clone_name" />
                            </div>

                            <div class="form-group">
                                <label><?=l('Full Name (English)<>الاسم الكامل (بالإنجليزية)')?></label>
                                <input type="text" name="full_name_en" placeholder="Full name as in passport" />
                            </div>

                            <div class="form-group">
                                <label><?=l('Username<>اسم المستخدم')?></label>
                                <input type="text" name="username" required data-label="اسم المستخدم"
                                    placeholder="username123" />
                            </div>

                            <div class="form-group">
                                <label><?=l('Email Address<>البريد الإلكتروني')?></label>
                                <input type="email" name="email_address" required data-label="البريد الإلكتروني"
                                    placeholder="example@domain.com" />
                                <input type="hidden" name="email" class="dynamic_clone_email" />
                            </div>

                            <!-- حقل رقم الهاتف المحسن والمظبوط للتحقق من المدخلات بشكل سليم -->
                            <div class="form-group">
                                <label><?=l('Phone Number<>رقم الهاتف / الجوال')?></label>
                                <input type="tel" name="phone_number" required data-label="رقم الهاتف"
                                    placeholder="059XXXXXXX " pattern="[0-9+]{9,15}"
                                    title="يرجى إدخال أرقام صحيحة فقط بدون فراغات" />
                            </div>

                            <div class="form-group">
                                <label><?=l('Academic Major<>التخصص الأكاديمي')?></label>
                                <input type="text" name="major" required data-label="التخصص الإكاديمي"
                                    placeholder="مثال: هندسة برمجيات، علم حاسوب" />
                            </div>

                            <div class="form-group joining_request_form_8371_password">
                                <label><?=l('Password<>كلمة المرور')?></label>
                                <input type="password" id="for_field_password" name="password" required
                                    data-label="كلمة المرور" placeholder="••••••••" />
                            </div>

                            <div class="form-group joining_request_form_8371_confirm_password">
                                <label><?=l('Confirm Password<>تأكيد كلمة المرور')?></label>
                                <input type="password" id="for_field_confirm_password" name="confirm_password" required
                                    data-label="تأكيد كلمة المرور" placeholder="••••••••" />
                            </div>

                            <div class="form-group">
                                <label><?=l('ID Number<>رقم الهوية')?></label>
                                <input type="text" name="id_number" required data-label="رقم الهوية"
                                    placeholder="000000000" />
                            </div>

                            <div class="form-group">
                                <label><?=l('Date of Birth<>تاريخ الميلاد')?></label>
                                <input type="date" name="date_of_birth" required data-label="تاريخ الميلاد" />
                            </div>

                            <div class="form-group">
                                <label><?=l('Province<>المحافظة')?></label>
                                <select name="province" required data-label="المحافظة">
                                    <option value="">اختر المحافظة...</option>
                                    <option value="القدس">القدس</option>
                                    <option value="رام الله">رام الله</option>
                                    <option value="الخليل">الخليل</option>
                                    <option value="نابلس">نابلس</option>
                                    <option value="جنين">جنين</option>
                                    <option value="طولكرم">طولكرم</option>
                                    <option value="قلقيلية">قلقيلية</option>
                                    <option value="سلفيت">سلفيت</option>
                                    <option value="أريحا">أريحا</option>
                                    <option value="بيت لحم">بيت لحم</option>
                                    <option value="طوباس">طوباس</option>
                                    <option value="غزة">غزة</option>
                                    <option value="others">others</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label><?=l('Gender<>الجنس')?></label>
                                <select name="gender" required data-label="الجنس">
                                    <option value="">اختر الجنس...</option>
                                    <option value="ذكر">ذكر</option>
                                    <option value="أنثى">أنثى</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label><?=l('Employment Status<>الحالة المهنية')?></label>
                                <select id="for_field_employment_status" name="employment_status" required
                                    data-label="الحالة المهنية">
                                    <option value="خريج / يبحث عن عمل">خريج / يبحث عن عمل</option>
                                    <option value="طالب">طالب</option>
                                    <option value="موظف / يعمل">موظف / يعمل</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label><?=l('Profile Photo<>الصورة الشخصية')?></label>
                                <input type="file" name="profile_photo" accept="image/*" />
                            </div>

                            <!-- حقل رفع صورة الهوية المضاف الجديد ليتناسب مع عمود id_photo الموضح في الملف {03C9FEA1-DFF3-4297-B8CF-81B92149EAEE}.png -->
                            <div class="form-group">
                                <label><?=l('ID Photo<>صورة الهوية الشخصية (مرفق)')?></label>
                                <input type="file" name="id_photo" accept="image/*,application/pdf" required
                                    data-label="صورة الهوية" />
                            </div>

                            <div class="form-group users_8400_organisation full-width style_work_fields">
                                <label><?=l('Institution / Company Name<>اسم المؤسسة / الشركة')?></label>
                                <input type="text" name="organisation" placeholder="مكان العمل الحالي" />
                            </div>

                            <div class="form-group users_8400_business_type style_work_fields">
                                <label><?=l('Business Type<>نوع قطاع العمل')?></label>
                                <select name="business_type">
                                    <option value="قطاع حكومي">قطاع حكومي</option>
                                    <option value="قطاع خاص">قطاع خاص</option>
                                    <option value="مؤسسة غير ربحية / أهلية">مؤسسة غير ربحية / أهلية</option>
                                    <option value="عمل حر (Freelancer)">عمل حر (Freelancer)</option>
                                </select>
                            </div>

                            <div class="form-group users_8400_work_nature style_work_fields">
                                <label><?=l('Work Nature<>طبيعة العمل')?></label>
                                <input type="text" name="work_nature" placeholder="مثال: مطور برمجيات، مهندس شبكات" />
                            </div>
                        </div>

                        <div id="c_error_tracker" class="hidden error-box"></div>
                        <?php if($error_msg != ""): ?>
                        <div class="error-box"><?=$error_msg?></div>
                        <?php endif; ?>

                        <input type="hidden" name="c_signup" value="<?= rand()?>" />
                        <input type="hidden" name="active" value="0" />
                        <input type="hidden" name="deleted" value="0" />
                        <input type="hidden" name="restricted" value="0" />

                        <input type="submit" name="submit_signup" value="<?= l('Create Account<>إنشاء حساب')?>"
                            class="b" style="margin-top: 20px;" />

                        <div class="auth_or"><span><?=l('or<>أو')?></span></div>

                        <a class="have_account" href="<?= url('pages_1478423482','single','signin')?>"
                            title="<?= l(detail('pages_1478423482','title','slug','login'))?>">
                            <i class="md-light">login</i>
                            <span><?= l('Already have an account? Sign In<>لديك حساب بالفعل؟ تسجيل الدخول')?></span>
                        </a>
                    </form>
                </div>

                <a id="eye_icon_signup" class="po <?= $registration_success ? 'hidden' : '' ?>"
                    onclick="myFunction()"><i>visibility_off</i></a>
                <a id="eye_icon_confirm_signup" class="po <?= $registration_success ? 'hidden' : '' ?>"
                    onclick="showConfirmPassword()"> <i>visibility_off</i></a>

                <div id="c_successSignup" class="<?= $registration_success ? '' : 'hidden' ?>">
                    <i class="md-light"
                        style="font-size: 24px; vertical-align: middle; margin-left: 8px;">check_circle</i>
                    <span><?= l('Your request has been submitted successfully! We will review your account and notify you via email once approved.<>تم تقديم طلبكم بنجاح. يجري مراجعة البيانات من قبل إدارة النقابة، وسيتم إشعاركم عبر البريد الإلكتروني فور تفعيل الحساب لتتمكنوا من تسجيل الدخول.')?></span>
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
    grid-template-columns: 42% 58%;
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
    align-items: flex-start;
    justify-content: center;
    padding: 66px 50px;
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
    z-index: 1;
    background: linear-gradient(180deg, rgba(7, 95, 97, .72), rgba(5, 74, 76, .94)), linear-gradient(135deg, rgba(7, 95, 97, .82), rgba(4, 66, 68, .9))
}

#login_wrap.auth_page .auth_visual:after {
    content: "";
    position: absolute;
    inset: 0;
    z-index: 1;
    background-image: linear-gradient(rgba(245, 223, 77, .08) 1px, transparent 1px), linear-gradient(90deg, rgba(245, 223, 77, .08) 1px, transparent 1px);
    background-size: 44px 44px;
    opacity: .35
}

#login_wrap.auth_page .auth_visual_brand {
    position: relative;
    z-index: 5;
    width: 100%;
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
    font-size: 22px;
    font-weight: 800;
    line-height: 1.4
}

#login_wrap.auth_page .auth_visual_brand span {
    color: rgba(255, 255, 255, .9);
    font-size: 17px;
    font-weight: 600;
    display: block;
    margin-bottom: 40px;
}

#login_wrap.auth_page .auth_visual_content {
    position: relative;
    z-index: 5;
    width: 100%;
    max-width: 430px;
    margin: 0 auto;
    text-align: center
}

#login_wrap.auth_page .auth_visual h2 {
    margin: 0 0 14px;
    color: #fff;
    font-size: 36px;
    font-weight: 800;
    line-height: 1.35;
    text-shadow: 0 3px 12px rgba(0, 0, 0, .2)
}

#login_wrap.auth_page .auth_visual p {
    max-width: none;
    margin: 0 auto;
    color: #fff;
    font-size: 18px;
    line-height: 1.75
}

#login_wrap.auth_page .auth_panel {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 40px 50px;
    background: #fff;
    direction: rtl
}

#login_wrap.auth_page .auth_card {
    position: relative;
    width: 100%;
    max-width: 820px;
    padding: 40px;
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
    font-size: 16px;
    line-height: 1.8
}

.signup_dynamic_fields {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px 16px;
    text-align: right;
    width: 100%;
}

.signup_dynamic_fields .form-group {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    width: 100%;
    position: relative;
    /* لضمان ضبط العناصر الداخلية الحرة */
}

.signup_dynamic_fields label {
    display: block !important;
    width: 100%;
    margin-bottom: 8px;
    font-weight: 700 !important;
    color: var(--text) !important;
    font-size: 14px !important;
    text-align: right !important;
}

.signup_dynamic_fields input[type=text],
.signup_dynamic_fields input[type=password],
.signup_dynamic_fields input[type=email],
.signup_dynamic_fields input[type=date],
.signup_dynamic_fields input[type=tel],
.signup_dynamic_fields select {
    width: 100% !important;
    height: 50px !important;
    padding: 0 16px !important;
    color: #203040 !important;
    background-color: #fff !important;
    border: 1px solid #c9d6d6 !important;
    border-radius: 12px !important;
    font-size: 15px !important;
    transition: all 0.3s ease !important;
}

.signup_dynamic_fields input[type=file] {
    padding: 10px 12px !important;
    background: #f1f5f5 !important;
    border: 1px dashed #9ab7b8 !important;
    border-radius: 12px !important;
    width: 100% !important;
    height: 50px !important;
    cursor: pointer;
}

.signup_dynamic_fields input:focus,
.signup_dynamic_fields select:focus {
    border-color: var(--teal) !important;
    box-shadow: 0 0 0 4px rgba(7, 95, 97, .12) !important;
    outline: none !important;
}

/* تعديل عرض حقول العمل الاختيارية لتكون متناسقة ومتراصة بشكل كامل */
.signup_dynamic_fields .full-width {
    grid-column: span 2 !important;
}

.joining_request_form_8371_password,
.joining_request_form_8371_confirm_password {
    position: relative !important;
}

/* إصلاح مكان الأيقونة لتكون ثابتة ومستقرة داخل الـ Input */
#login_wrap.auth_page #eye_icon_signup,
#login_wrap.auth_page #eye_icon_confirm_signup {
    position: absolute;
    left: 14px;
    top: 42px;
    /* تم تعديل الارتفاع ليتوافق مع الحقل بعد احتساب مساحة الـ Label */
    color: var(--teal);
    cursor: pointer;
    z-index: 10;
    display: flex;
    align-items: center;
    justify-content: center;
}

#login_wrap.auth_page #eye_icon_signup i,
#login_wrap.auth_page #eye_icon_confirm_signup i {
    font-size: 20px;
}

#login_wrap.auth_page input[type=submit].b {
    width: 100%;
    height: 60px;
    margin: 20px 0 0;
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

#login_wrap.auth_page input[type=submit].b:hover {
    background: #fff6a6;
    transform: translateY(-2px)
}

#login_wrap.auth_page .auth_or {
    position: relative;
    margin: 24px 0 20px;
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

#login_wrap.auth_page #c_successSignup {
    margin-top: 14px;
    padding: 20px;
    border-radius: 12px;
    text-align: center;
    background: rgba(7, 95, 97, .06);
    border: 1px solid rgba(7, 95, 97, .15);
    color: var(--teal);
    font-weight: 700;
    line-height: 1.6;
}

.error-box {
    margin-top: 20px;
    padding: 14px;
    background: #fdf2f2;
    border: 1px solid #f8b4b4;
    color: #9b1c1c;
    border-radius: 10px;
    font-weight: bold;
    text-align: right;
    font-size: 14px;
}

.hidden {
    display: none !important;
}

@media(max-width:1100px) {
    #login_wrap.auth_page .auth_layout {
        grid-template-columns: 1fr;
        width: 90%
    }

    #login_wrap.auth_page .auth_visual {
        display: none;
    }

    #login_wrap.auth_page .auth_panel {
        padding: 42px 24px
    }

    .signup_dynamic_fields {
        grid-template-columns: 1fr;
    }

    .signup_dynamic_fields .full-width {
        grid-column: span 1 !important;
    }

    #login_wrap.auth_page #eye_icon_signup,
    #login_wrap.auth_page #eye_icon_confirm_signup {
        top: 42px;
    }
}
</style>

<script>
$('.<?=$_user?>_active').hide();

// الحفاظ على إلحاق أيقونات العين داخل حاويات كلمات المرور الخاصة بها بشكل صحيح
$('#eye_icon_signup').appendTo('.joining_request_form_8371_password');
$('#eye_icon_confirm_signup').appendTo('.joining_request_form_8371_confirm_password');

function myFunction() {
    var x = document.getElementById("for_field_password");
    if (x) {
        x.type = x.type === "password" ? "text" : "password";
        // تغيير شكل الأيقونة اختيارياً
        var icon = document.querySelector('#eye_icon_signup i');
        if (icon) icon.textContent = x.type === "password" ? "visibility_off" : "visibility";
    }
}

function showConfirmPassword() {
    var x = document.getElementById("for_field_confirm_password");
    if (x) {
        x.type = x.type === "password" ? "text" : "password";
        var icon = document.querySelector('#eye_icon_confirm_signup i');
        if (icon) icon.textContent = x.type === "password" ? "visibility_off" : "visibility";
    }
}

$('.style_work_fields').hide();

// معالجة ظهور واختفاء حقول جهة العمل بناءً على الحالة المهنية
$('#for_field_employment_status').on('change', function() {
    if ($(this).val() == 'موظف / يعمل') {
        $('.style_work_fields').slideDown(250);
    } else {
        $('.style_work_fields').slideUp(250);
    }
});

$('input[name="full_name_ar"]').on('input', function() {
    $('.dynamic_clone_name').val($(this).val());
});
$('input[name="email_address"]').on('input', function() {
    $('.dynamic_clone_email').val($(this).val());
});

// التحقق من الحقول الفارغة عند الضغط على زر الإرسال
$('#c_signup_form').on('submit', function(e) {
    var hasError = false;
    var missingFields = [];

    $(this).find('input[required], select[required]').each(function() {
        if (!$(this).val() || $(this).val().trim() === "") {
            hasError = true;
            var labelText = $(this).attr('data-label') || "حقل مطلوب";
            missingFields.push(labelText);
            $(this).css('border-color', '#f8b4b4');
        } else {
            $(this).css('border-color', '#c9d6d6');
        }
    });

    if (hasError) {
        e.preventDefault();
        var errorHtml = "⚠️ يرجى تعبئة الحقول المطلوبة التالية أولاً: <br>• " + missingFields.join('<br>• ');
        $('#c_error_tracker').html(errorHtml).removeClass('hidden');

        $('html, body').animate({
            scrollTop: $("#c_error_tracker").offset().top - 150
        }, 500);
    } else {
        $('#c_error_tracker').addClass('hidden');
    }
});

<?php if($registration_success): ?>
window.location.href = "<?=urlp('dashboard')?>";
<?php endif; ?>
</script>