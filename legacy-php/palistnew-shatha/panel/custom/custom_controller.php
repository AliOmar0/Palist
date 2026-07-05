<?php

function getOrSetDeviceId() {
    $cookieName = 'device_fingerprint';
    if (isset($_COOKIE[$cookieName])) {
        return $_COOKIE[$cookieName];
    }

    $deviceId = bin2hex(random_bytes(32));
    $cookieOptions = [
        'expires' => time() + (365 * 24 * 60 * 60),
        'path' => '/',
        'domain' => '',
        'secure' => (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'),
        'httponly' => true,
        'samesite' => 'Lax',
    ];

    setcookie($cookieName, $deviceId, $cookieOptions);
    return $deviceId;
}

function isDeviceTrusted($user_id, $device_id) {
    global $conn;

    $check = mysqli_query($conn, "SHOW TABLES LIKE 'user_trusted_devices'");
    if (mysqli_num_rows($check) == 0) {
        mysqli_query($conn, "CREATE TABLE user_trusted_devices (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT,
            device_id VARCHAR(255),
            date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )");
        return false;
    }

    $device_id_esc = escape($device_id);
    return gc('user_trusted_devices', "WHERE user_id='$user_id' AND device_id='$device_id_esc'") > 0;
}

if (i('c_editProfile')) {
    if (!logged(mid($_user))) j();
    co($_user, $_SESSION['user_id']);
    $_POST['id'] = $_SESSION['user_id'];
    unset($_POST['password']);
    r($_user, 'edit');
    json(true, 2);
}

elseif (i('j_editProfile')) {
    co($_join_request, $_POST['id']);
    if ($_POST['submitted'] == 1 || $_POST['active'] == 1) {
        $user = db($_user, "WHERE id='" . $_SESSION['user_id'] . "'")[0];
        $username = $user['username'];
        require mailer;
    }
    r($_join_request, 'edit');
    json(true, 123, NULL, NULL);
}

elseif (i('new_request')) {
    $fmi = 10;
    if (!logged(mid($_user))) j();
    $_POST['internal'] = true;
    $_POST['user'] = $_SESSION['user_id'];
    $_POST['active'] = 0;
    $_POST['submitted'] = 1;
    r($_join_request, 'add');
    $username = $_POST['user'];
    $email_address = $_POST['email_address'];
    require mailer;
    json(true, 123, NULL, NULL, array('js' => 'successjoin'));
}

elseif (i('module') && $_POST['module'] == 'contact_form_8363' && $_POST['action'] == 'add' && isset($_POST['new_user'])) {
    $_POST['internal'] = true;
    require modules_dir . 'contact_form_8363/models/add.php';
    require mailer;
    json(true, 1, NULL, NULL, array('js' => 'successConnected'));
}

elseif (i('module') && $_POST['module'] == 'join_us_8367' && $_POST['action'] == 'add' && isset($_POST['user'])) {
    $_POST['internal'] = true;
    require modules_dir . 'join_us_8367/models/add.php';
    json(true, 1, NULL, NULL, array('js' => 'successJoined'));
}

elseif (i('module') && $_POST['module'] == 'joining_request_form_8371' && $_POST['action'] == 'edit' && isset($_POST['id'])) {
    $id = e('id');
    $resp = db('joining_request_form_8371', "WHERE id='$id' AND deleted='0'", NULL);
    if (isset($_POST['active']) && $resp[0]['active'] == '0') {
        $fmi = 4;
        $useremail = $resp[0]['email_address'];
        include mailer;
    }
}

elseif (i('action') && $_POST['action'] == 'verify_device_otp') {
    if (!isset($_SESSION['auth_otp'])) {
        json(false, 3, NULL, l('Session expired or invalid request<>انتهت الجلسة أو الطلب غير صالح'));
    }

    $otp = isset($_POST['otp_code']) ? trim(escape($_POST['otp_code'])) : trim(e('otp'));
    $email = trim(escape($_POST['email_address']));

    if ($otp == $_SESSION['auth_otp']['code'] && time() < $_SESSION['auth_otp']['expires']) {
        if ($email != '' && $email !== $_SESSION['auth_otp']['email']) {
            json(false, 3, NULL, l('Identity mismatch<>هوية المستخدم غير متطابقة'));
            exit();
        }

        $user_id = $_SESSION['auth_otp']['user_id'];
        $device_id = $_SESSION['auth_otp']['device_id'];

        if (!isDeviceTrusted($user_id, $device_id)) {
            mysqli_query($conn, "INSERT INTO user_trusted_devices (user_id, device_id) VALUES ('$user_id', '$device_id')");
        }

        logUserIn($user_id, mid($_user));
        session_regenerate_id(true);
        unset($_SESSION['auth_otp']);
        json(true, 1, NULL, NULL, array('url' => urlp('dashboard'), 'status' => 'otp_correct'));
        exit();
    }

    json(false, 3, NULL, l('Incorrect or expired verification code<>رمز التحقق غير صحيح أو انتهت صلاحيته'));
    exit();
}

elseif (i('c_login')) {
    if (empty($_POST['recaptcha_response'])) {
        json(false, 4, NULL, l('Please confirm that you are not a robot.<>يرجى تأكيد أنك لست برنامج روبوت.'));
    }

    $email = escape($_POST['email_address']);
    $resp = db($_user, "WHERE email_address='$email' AND deleted='0'", NULL, NULL);

    if ($resp == 0) json(false, 3);
    else if ($resp == 1) json(false, 73);
    else if ($resp[0]['active'] == '0') json(false, 49, NULL, NULL, array('js' => 'popError'));
    else if (!password_verify($_POST['password'], $resp[0]['password'])) json(false, 121);

    $current_device_id = getOrSetDeviceId();
    if (!isDeviceTrusted($resp[0]['id'], $current_device_id)) {
        $otp_code = rand(100000, 999999);
        $_SESSION['auth_otp'] = [
            'code' => $otp_code,
            'user_id' => $resp[0]['id'],
            'device_id' => $current_device_id,
            'expires' => time() + 600,
            'email' => $resp[0]['email_address'],
        ];

        $user_email = $resp[0]['email_address'];
        m("TESTING OTP: User: $user_email | Code: $otp_code");

        $subject = l('Login Verification Code<>رمز تحقق الدخول');
        $message = l('Hello, Your verification code is: <>مرحبا، رمز التحقق الخاص بك هو: ') . $otp_code;
        @mail($user_email, '=?UTF-8?B?' . base64_encode($subject) . '?=', $message, 'Content-Type: text/plain; charset=UTF-8');

        json(true, 1, NULL, NULL, array('status' => 'requires_otp', 'requires_otp' => true, 'js' => 'successLogin'));
        exit();
    }

    logUserIn($resp[0]['id'], mid($_user));
    session_regenerate_id(true);
    json(true, 1, NULL, NULL, array('url' => urlp('dashboard'), 'js' => 'redirect'));
    exit();
}

elseif (i('c_signup')) {
    $_POST['internal'] = true;
    $_POST['active'] = 0;
    $username = $_POST['username'];
    $email = $_POST['email_address'];
    require modules_dir . $_user . '/models/add.php';
    require mailer;
    json(true, 1, NULL, NULL, array('js' => 'successSignup'));
}

elseif (i('c_changePassword')) {
    if (!logged(mid($_user))) j();

    $this_module = $_user;
    $user_id = $_SESSION['user_id'];
    $old = escape($_POST['old']);
    $new = escape($_POST['new']);
    $confirm = escape($_POST['confirm']);
    $resp = db($this_module, "WHERE id='$user_id' AND deleted='0'", NULL, 'LIMIT 1', 'password');
    if ($resp == 0) json(false, 3);
    else if ($resp == 1) json(false, 3);

    if (!password_verify($old, $resp[0]['password'])) json(false, 73);
    if ($new != $confirm) json(false, 74);
    if ($new == $old) json(false, 75);
    checkPassword($new);

    $password = password_hash($new, PASSWORD_DEFAULT);
    if (!mysqli_query($conn, "UPDATE $this_module SET password='$password' WHERE id='$user_id' LIMIT 1")) json(false, 3);
    if (!mysqli_query($conn, "DELETE FROM tokens WHERE user_id='$user_id' AND module_prefix='$this_module'")) json(false, 3);

    json(true, 2, NULL, NULL, array('js' => 'c_success'));
}

elseif (i('c_forgot')) {
    $module = 'users_8400';
    $_POST['action'] = 'edit';
    $resp = db('users_8400', "WHERE email_address='" . e('email_address') . "'");
    $website_name = 'PIS';
    if ($resp != 1) {
        $fmi = 8;
        $unhashed_password = 'pis' . rand(11111311, 9999999999);
        $hashed = password_hash($unhashed_password, PASSWORD_DEFAULT);
        $id = $resp[0]['id'];
        mysqli_query($conn, "UPDATE users_8400 SET password='$hashed' WHERE id=$id LIMIT 1");
        $email_address = l($resp[0]['email_address']);
        $full_name = $resp[0]['full_name'];

        require mailer;
        json(true, 122, NULL, NULL, array('js' => 'c_forgot_func'));
    } else {
        json(false, 81);
    }
}

elseif (i('module') && $_POST['module'] == 'users_8400' && $_POST['action'] == 'edit' && isset($_POST['id'])) {
    $id = e('id');
    $resp = db('users_8400', "WHERE id='$id' AND deleted='0'", NULL);
    if (isset($_POST['active']) && $resp[0]['active'] == '0') {
        $fmi = 9;
        $useremail = $resp[0]['email_address'];
        include mailer;
    }
}
