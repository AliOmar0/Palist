<?php
$_user = 'users_8400';

if (isLogged(moduleID($_user))) {
    $ep_success = '';
    $ep_error = '';
    $user_id = intval($_SESSION['user_id']);

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ep_action'])) {
        $date_modified_value = date('Y-m-d H:i:s');

        if ($_POST['ep_action'] === 'profile') {
            $username = isset($_POST['username']) ? trim($_POST['username']) : '';
            $full_name = isset($_POST['full_name']) ? trim($_POST['full_name']) : '';

            if ($username === '') {
                $ep_error = l('Please enter your first name.<>يرجى إدخال الاسم الأول.');
            } else {
                $profile_sql = '';

                if (
                    isset($_FILES['profile_photo']['name'][0]) &&
                    $_FILES['profile_photo']['name'][0] !== '' &&
                    isset($_FILES['profile_photo']['tmp_name'][0])
                ) {
                    $file_error = intval($_FILES['profile_photo']['error'][0]);
                    $file_size = intval($_FILES['profile_photo']['size'][0]);
                    $file_name = $_FILES['profile_photo']['name'][0];
                    $file_tmp = $_FILES['profile_photo']['tmp_name'][0];
                    $extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
                    $allowed_extensions = ['jpg', 'jpeg', 'png', 'webp'];
                    $max_upload = isset($settings['max_upload_size']) ? intval($settings['max_upload_size']) : 5242880;

                    if ($file_error !== UPLOAD_ERR_OK) {
                        $ep_error = l('Photo upload failed.<>تعذر رفع الصورة.');
                    } elseif ($file_size > $max_upload) {
                        $ep_error = l('Photo size is too large.<>حجم الصورة كبير جدًا.');
                    } elseif (!in_array($extension, $allowed_extensions, true)) {
                        $ep_error = l('Please upload a JPG, PNG, or WEBP image.<>يرجى رفع صورة بصيغة JPG أو PNG أو WEBP.');
                    } else {
                        $new_file_name = 'avatar_' . $user_id . '_' . time() . '_' . rand(1000, 9999) . '.' . $extension;
                        if (move_uploaded_file($file_tmp, target_dir . $new_file_name)) {
                            $profile_sql = ", profile_photo='" . mysqli_real_escape_string($conn, $new_file_name) . "'";
                        } else {
                            $ep_error = l('Photo upload failed.<>تعذر رفع الصورة.');
                        }
                    }
                }

                if ($ep_error === '') {
                    $username_sql = mysqli_real_escape_string($conn, $username);
                    $full_name_sql = mysqli_real_escape_string($conn, $full_name);
                    $date_sql = mysqli_real_escape_string($conn, $date_modified_value);

                    $updated = mysqli_query(
                        $conn,
                        "UPDATE users_8400
                         SET username='{$username_sql}', full_name='{$full_name_sql}', date_modified='{$date_sql}' {$profile_sql}
                         WHERE id='{$user_id}' AND !deleted
                         LIMIT 1"
                    );

                    if ($updated) {
                        $ep_success = l('Profile saved successfully.<>تم حفظ الملف الشخصي بنجاح.');
                    } else {
                        $ep_error = l('Profile could not be saved.<>تعذر حفظ الملف الشخصي.');
                    }
                }
            }
        }

        if ($_POST['ep_action'] === 'password') {
            $current_password = isset($_POST['current_password']) ? (string) $_POST['current_password'] : '';
            $new_password = isset($_POST['new_password']) ? (string) $_POST['new_password'] : '';

            $password_data = db($_user, "WHERE !deleted and id=" . $user_id, NULL, 'LIMIT 1', 'password');
            $stored_password = isset($password_data[0]['password']) ? $password_data[0]['password'] : '';
            $current_ok = password_verify($current_password, $stored_password);

            if (!$current_ok && $stored_password !== '' && hash_equals($stored_password, $current_password)) {
                $current_ok = true;
            }

            if ($current_password === '' || $new_password === '') {
                $ep_error = l('Please fill all password fields.<>يرجى تعبئة حقول كلمة المرور.');
            } elseif (!$current_ok) {
                $ep_error = l('Current password is incorrect.<>كلمة المرور الحالية غير صحيحة.');
            } elseif (strlen($new_password) < 7 || !preg_match('/[0-9]/', $new_password)) {
                $ep_error = l('New password must be at least 7 characters and include a number.<>يجب أن تكون كلمة المرور الجديدة 7 أحرف على الأقل وتحتوي على رقم.');
            } else {
                $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
                $password_sql = mysqli_real_escape_string($conn, $password_hash);
                $date_sql = mysqli_real_escape_string($conn, $date_modified_value);

                $updated = mysqli_query(
                    $conn,
                    "UPDATE users_8400
                     SET password='{$password_sql}', date_modified='{$date_sql}'
                     WHERE id='{$user_id}' AND !deleted
                     LIMIT 1"
                );

                if ($updated) {
                    $ep_success = l('Password updated successfully.<>تم تحديث كلمة المرور بنجاح.');
                } else {
                    $ep_error = l('Password could not be updated.<>تعذر تحديث كلمة المرور.');
                }
            }
        }
    }

    $user_data = db($_user, "WHERE !deleted and id=" . intval($_SESSION['user_id']), NULL);
    $u_info = isset($user_data[0]) ? $user_data[0] : [];

    $first_name = '';
    if (!empty($u_info['username'])) {
        $first_name = $u_info['username'];
    } elseif (!empty($u_info['name'])) {
        $first_name = $u_info['name'];
    } elseif (!empty($u_info['full_name'])) {
        $first_name = $u_info['full_name'];
    }

    $last_name = !empty($u_info['full_name']) ? $u_info['full_name'] : (!empty($u_info['last_name']) ? $u_info['last_name'] : '');
    $email = '';
    if (!empty($u_info['email'])) {
        $email = $u_info['email'];
    } elseif (!empty($u_info['email_address'])) {
        $email = $u_info['email_address'];
    }

    $image = '';
    if (!empty($u_info['image'])) {
        $image = $u_info['image'];
    } elseif (!empty($u_info['profile_photo'])) {
        $image = $u_info['profile_photo'];
        if (!filter_var($image, FILTER_VALIDATE_URL)) {
            if (strpos($image, 'uploads/') === 0 && defined('url')) {
                $image = url . $image;
            } elseif (defined('u')) {
                $image = u . ltrim($image, '/');
            } elseif (defined('url')) {
                $image = url . 'uploads/' . ltrim($image, '/');
            }
        }
    }

    $safe_first_name = htmlspecialchars($first_name, ENT_QUOTES, 'UTF-8');
    $safe_last_name  = htmlspecialchars($last_name, ENT_QUOTES, 'UTF-8');
    $safe_email      = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
    $safe_image      = htmlspecialchars($image, ENT_QUOTES, 'UTF-8');
    $initial         = $first_name !== ''
        ? (function_exists('mb_substr') ? mb_strtoupper(mb_substr($first_name, 0, 1, 'UTF-8'), 'UTF-8') : strtoupper(substr($first_name, 0, 1)))
        : 'U';
?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
.ep-page,
.ep-page * {
    box-sizing: border-box;
}

/* التعديل هنا: إضافة التصفية الأساسية للصفحة كاملة من تأثيرات القالب */
.ep-page {
    direction: rtl;
    min-height: 100vh;
    padding: 28px 16px 42px;
    background: #f7f7f8;
    color: #1f2933;
    font-family: 'Cairo', sans-serif;
    clear: both !important;
    display: inline-block;
    width: 100%;
}

.ep-shell {
    width: min(680px, 100%);
    margin: 0 auto;
    display: flex;
    flex-direction: column;
    clear: both;
}

/* التعديل هنا: فرض الاستقرار ومنع التداخل على حاوية العنوان */
.ep-header {
    margin-bottom: 18px;
    text-align: center;
    clear: both !important;
    display: block !important;
    width: 100% !important;
    position: relative;
}

.ep-back-top {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    margin-bottom: 3px;
    color: #a98700;
    font-size: 11px;
    font-weight: 700;
    line-height: 1.2;
    text-decoration: none;
}

.ep-title {
    margin: 0;
    color: #1f2933;
    font-size: 30px;
    font-weight: 800;
    line-height: 1.25;
}

.ep-subtitle {
    margin: 5px 0 0;
    color: #6b7280;
    font-size: 13px;
    font-weight: 500;
}

.ep-card {
    margin-bottom: 18px;
    padding: 24px 22px;
    border: 1px solid #cfd6dd;
    border-radius: 6px;
    background: #ffffff;
    box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04);
    clear: both;
}

.ep-alert {
    margin: 0 0 16px;
    padding: 11px 14px;
    border-radius: 4px;
    font-size: 12px;
    font-weight: 700;
    line-height: 1.6;
    text-align: right;
    clear: both;
}

.ep-alert-success {
    border: 1px solid #b7dfd7;
    background: #eefaf7;
    color: #006b68;
}

.ep-alert-error {
    border: 1px solid #fecaca;
    background: #fff1f1;
    color: #b42318;
}

.ep-card-title {
    margin: 0 0 18px;
    color: #1f2933;
    font-size: 15px;
    font-weight: 800;
    line-height: 1.4;
    text-align: right;
}

.ep-photo-row {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 18px;
    min-height: 84px;
}

.ep-avatar-wrap {
    position: relative;
    width: 82px;
    height: 82px;
    flex: 0 0 auto;
}

.ep-avatar,
.ep-avatar-initial {
    width: 82px;
    height: 82px;
    border-radius: 50%;
    border: 1px solid #e5e7eb;
}

.ep-avatar {
    display: block;
    object-fit: cover;
}

.ep-avatar-initial {
    display: flex;
    align-items: center;
    justify-content: center;
    background: #e9f0ef;
    color: #004846;
    font-size: 28px;
    font-weight: 800;
}

.ep-camera {
    position: absolute;
    right: -7px;
    bottom: 4px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 30px;
    height: 30px;
    border: 2px solid #ffffff;
    border-radius: 50%;
    background: #004846;
    color: #ffffff;
    font-size: 12px;
}

.ep-upload-area {
    min-width: 225px;
    text-align: right;
}

.ep-file-line {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 10px;
}

.ep-required {
    color: #e11d48;
    font-size: 16px;
    font-weight: 800;
}

.ep-file-label {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    height: 34px;
    padding: 0 14px;
    border: 1px solid #cfd6dd;
    border-radius: 3px;
    background: #ffffff;
    color: #1f2933;
    font-size: 12px;
    font-weight: 600;
    cursor: pointer;
}

.ep-file-input {
    position: absolute;
    width: 1px;
    height: 1px;
    overflow: hidden;
    opacity: 0;
}

.ep-file-note {
    margin-top: 6px;
    color: #7a8794;
    font-size: 10px;
    line-height: 1.6;
}

.ep-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
}

.ep-field {
    margin-bottom: 16px;
}

.ep-field-full {
    grid-column: 1 / -1;
}

.ep-label {
    display: block;
    margin-bottom: 7px;
    color: #1f2933;
    font-size: 12px;
    font-weight: 700;
    text-align: right;
}

.ep-input {
    width: 100%;
    height: 36px;
    padding: 7px 10px;
    border: 1px solid #cfd6dd;
    border-radius: 3px;
    background: #ffffff;
    color: #1f2933;
    font-family: 'Cairo', sans-serif;
    font-size: 12px;
    font-weight: 500;
    outline: none;
}

.ep-input:focus {
    border-color: #004846;
    box-shadow: 0 0 0 2px rgba(0, 72, 70, 0.08);
}

.ep-input[readonly],
.ep-input:disabled {
    background: #f5f6f7;
    color: #9aa3ad;
}

.ep-hint {
    display: block;
    margin-top: 7px;
    color: #64748b;
    font-size: 10px;
    line-height: 1.7;
    text-align: right;
}

.ep-card-actions {
    display: flex;
    justify-content: flex-start;
    margin-top: 6px;
}

.ep-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    min-width: 78px;
    height: 32px;
    padding: 0 13px;
    border: 0;
    border-radius: 2px;
    background: #004846;
    color: #ffffff;
    font-family: 'Cairo', sans-serif;
    font-size: 12px;
    font-weight: 800;
    line-height: 1;
    cursor: pointer;
    text-decoration: none;
}

.ep-btn:hover {
    background: #003331;
    color: #ffffff;
}

.ep-password-copy {
    margin: -8px 0 18px;
    color: #64748b;
    font-size: 12px;
    line-height: 1.7;
    text-align: right;
}

.ep-footer-link {
    display: block;
    margin-top: 10px;
    color: #006b68;
    font-size: 12px;
    font-weight: 600;
    text-align: center;
    text-decoration: none;
}

.ep-footer-link:hover {
    text-decoration: underline;
}

@media (max-width: 640px) {
    .ep-title {
        font-size: 24px;
    }

    .ep-card {
        padding: 20px 16px;
    }

    .ep-photo-row,
    .ep-file-line {
        justify-content: center;
    }

    .ep-photo-row {
        flex-direction: column-reverse;
        gap: 14px;
    }

    .ep-upload-area {
        min-width: 0;
        width: 100%;
        text-align: center;
    }

    .ep-grid {
        grid-template-columns: 1fr;
    }

    .ep-card-actions {
        justify-content: stretch;
    }

    .ep-btn {
        width: 100%;
    }
}
</style>

<div class="ep-page">
    <div class="ep-shell">
        <header class="ep-header">
            <a class="ep-back-top" href="<?= url('pages_1478423482', 'single', 'dashboard') ?>">
                <?= l('My Profile<>ملفي الشخصي') ?>
                <i class="fa-solid fa-arrow-left-long" aria-hidden="true"></i>
            </a>
            <h1 class="ep-title"><?= l('Edit Personal Information<>تعديل المعلومات الشخصية') ?></h1>
            <p class="ep-subtitle">
                <?= l('Update your data, avatar, and password.<>حدث بياناتك، صورتك الشخصية وكلمة المرور.') ?></p>
        </header>

        <?php if ($ep_success !== ''): ?>
        <div class="ep-alert ep-alert-success"><?= $ep_success ?></div>
        <?php endif; ?>

        <?php if ($ep_error !== ''): ?>
        <div class="ep-alert ep-alert-error"><?= $ep_error ?></div>
        <?php endif; ?>

        <form method="post" enctype="multipart/form-data" autocomplete="off">
            <input type="hidden" name="ep_action" value="profile">
            <section class="ep-card">
                <h2 class="ep-card-title"><?= l('Personal Photo<>الصورة الشخصية') ?></h2>
                <div class="ep-photo-row">
                    <div class="ep-upload-area">
                        <div class="ep-file-line">
                            <span class="ep-required">*</span>
                            <label class="ep-file-label" for="ep-profile-photo">
                                <i class="fa-regular fa-image" aria-hidden="true"></i>
                                <?= l('Upload a photo from your device<>اختر صورة من جهازك') ?>
                            </label>
                        </div>
                        <div class="ep-file-note"><?= l('PNG or JPG up to 5MB.<>PNG أو JPG حتى 5 ميغابايت.') ?></div>
                        <input class="ep-file-input" id="ep-profile-photo" type="file" name="profile_photo[]"
                            accept="image/png,image/jpeg,image/webp" onchange="previewAvatar(this)">
                    </div>

                    <div class="ep-avatar-wrap">
                        <?php if ($safe_image): ?>
                        <img class="ep-avatar" id="ep-avatar-img" src="<?= $safe_image ?>"
                            alt="<?= $safe_first_name ?>">
                        <?php else: ?>
                        <div class="ep-avatar-initial" id="ep-avatar-initial">
                            <?= htmlspecialchars($initial, ENT_QUOTES, 'UTF-8') ?></div>
                        <?php endif; ?>
                        <span class="ep-camera"><i class="fa-solid fa-camera" aria-hidden="true"></i></span>
                    </div>
                </div>
            </section>

            <section class="ep-card">
                <h2 class="ep-card-title"><?= l('Name<>الاسم') ?></h2>

                <div class="ep-grid">
                    <div class="ep-field">
                        <label class="ep-label" for="ep-first-name"><?= l('First Name<>الاسم الأول') ?></label>
                        <input class="ep-input" id="ep-first-name" type="text" name="username"
                            value="<?= $safe_first_name ?>" required>
                    </div>
                    <div class="ep-field">
                        <label class="ep-label" for="ep-last-name"><?= l('Last Name<>اسم العائلة') ?></label>
                        <input class="ep-input" id="ep-last-name" type="text" name="full_name"
                            value="<?= $safe_last_name ?>">
                    </div>
                    <div class="ep-field ep-field-full">
                        <label class="ep-label" for="ep-email"><?= l('Email<>البريد الإلكتروني') ?></label>
                        <input class="ep-input" id="ep-email" type="email" name="email" value="<?= $safe_email ?>"
                            readonly>
                        <span
                            class="ep-hint"><?= l('Email cannot be changed from this page.<>لا يمكن تغيير البريد الإلكتروني من هذه الصفحة.') ?></span>
                    </div>
                </div>

                <div class="ep-card-actions">
                    <button class="ep-btn" type="submit">
                        <?= l('Save<>حفظ') ?>
                        <i class="fa-regular fa-circle-check" aria-hidden="true"></i>
                    </button>
                </div>
            </section>
        </form>

        <form method="post" autocomplete="off">
            <input type="hidden" name="ep_action" value="password">
            <section class="ep-card">
                <h2 class="ep-card-title"><?= l('Password<>كلمة المرور') ?></h2>
                <p class="ep-password-copy"><?= l('Change your account password.<>غيّر كلمة المرور الخاصة بحسابك.') ?>
                </p>

                <div class="ep-grid">
                    <div class="ep-field">
                        <label class="ep-label"
                            for="ep-current-password"><?= l('Current Password<>كلمة المرور الحالية') ?></label>
                        <input class="ep-input" id="ep-current-password" type="password" name="current_password"
                            required>
                    </div>
                    <div class="ep-field">
                        <label class="ep-label"
                            for="ep-new-password"><?= l('New Password<>كلمة المرور الجديدة') ?></label>
                        <input class="ep-input" id="ep-new-password" type="password" name="new_password" required>
                    </div>
                </div>

                <div class="ep-card-actions">
                    <button class="ep-btn" type="submit">
                        <?= l('Update Password<>تحديث كلمة المرور') ?>
                    </button>
                </div>
            </section>
        </form>

        <a class="ep-footer-link" href="<?= url('pages_1478423482', 'single', 'dashboard') ?>">
            &larr; <?= l('Back to Dashboard<>العودة إلى لوحة التحكم') ?>
        </a>
    </div>
</div>

<script>
function previewAvatar(input) {
    if (!input.files || !input.files[0]) {
        return;
    }

    const reader = new FileReader();
    reader.onload = function(event) {
        const currentImage = document.getElementById('ep-avatar-img');
        const currentInitial = document.getElementById('ep-avatar-initial');

        if (currentImage) {
            currentImage.src = event.target.result;
            return;
        }

        if (currentInitial) {
            const image = document.createElement('img');
            image.className = 'ep-avatar';
            image.id = 'ep-avatar-img';
            image.src = event.target.result;
            image.alt = '<?= $safe_first_name ?>';
            currentInitial.replaceWith(image);
        }
    };
    reader.readAsDataURL(input.files[0]);
}
</script>

<?php
} else {
    goP();
}
?>