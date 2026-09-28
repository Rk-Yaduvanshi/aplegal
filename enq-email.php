<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);

// Anti-spam configuration 
$config = [
    'honeypot_field' => 'website',
    'time_threshold' => 3,
    'max_attempts' => 3,
    'max_message_length' => 1000
];

function valid_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

function is_disposable_email($email) {
    $disposable_domains = [
        'tempmail.com', 'guerrillamail.com', 'mailinator.com', '10minutemail.com',
        'yopmail.com', 'throwawaymail.com', 'fakeinbox.com', 'trashmail.com'
    ];
    
    $domain = strtolower(substr(strrchr($email, "@"), 1));
    return in_array($domain, $disposable_domains);
}

function validate_phone($phone) {
    $clean_phone = preg_replace('/[^0-9+]/', '', $phone);
    $digits_only = preg_replace('/[^0-9]/', '', $clean_phone);
    
    if (strlen($digits_only) >= 8 && strlen($digits_only) <= 15) {
        return $clean_phone;
    }
    
    return false;
}

function track_attempts($ip) {
    $file_path = __DIR__ . '/submission_attempts.json';
    $attempts = [];
    
    if (file_exists($file_path)) {
        $attempts = json_decode(file_get_contents($file_path), true) ?: [];
    }
    
    $current_time = time();
    $hour_ago = $current_time - 3600;
    
    $attempts = array_filter($attempts, function($attempt) use ($hour_ago) {
        return $attempt > $hour_ago;
    });
    
    $ip_attempts = array_filter($attempts, function($time, $attempt_ip) use ($ip, $hour_ago) {
        return $attempt_ip === $ip && $time > $hour_ago;
    }, ARRAY_FILTER_USE_BOTH);
    
    $attempts[$ip] = $current_time;
    
    file_put_contents($file_path, json_encode($attempts));
    
    return count($ip_attempts);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = [];
    $ip = $_SERVER['REMOTE_ADDR'];
    
    // Honeypot trap - return error instead of fake success
    if (!empty(trim($_POST[$config['honeypot_field']]))) {
        error_log("Spam detected - honeypot triggered from IP: $ip");
        echo json_encode(['error' => ['name_error' => 'Submission blocked by security system']]);
        exit;
    }
    
    // Time-based validation - return error instead of fake success
    if (isset($_POST['form_timestamp']) && (time() - (int)$_POST['form_timestamp']) < $config['time_threshold']) {
        error_log("Spam detected - too fast submission from IP: $ip");
        echo json_encode(['error' => ['name_error' => 'Please take more time to fill the form']]);
        exit;
    }
    
    // Rate limiting
    $attempt_count = track_attempts($ip);
    if ($attempt_count >= $config['max_attempts']) {
        error_log("Rate limit exceeded from IP: $ip");
        echo json_encode(['error' => ['name_error' => 'Too many submission attempts. Please try again later.']]);
        exit;
    }

    // Validate name
    $name = trim($_POST['name']);
    if (empty($name)) {
        $errors['name_error'] = 'Name is required';
    } elseif (!preg_match("/^[A-Za-z\s\.\-']{2,50}$/", $name)) {
        $errors['name_error'] = 'Name should only contain letters, spaces, hyphens, and apostrophes (2-50 characters)';
    }

    // Validate phone
    $phone = trim($_POST['phone']);
    if (empty($phone)) {
        $errors['phone_error'] = 'Phone number is required';
    } else {
        $validated_phone = validate_phone($phone);
        if (!$validated_phone) {
            $errors['phone_error'] = 'Please enter a valid phone number (8-15 digits)';
        } else {
            $phone = $validated_phone;
        }
    }

    // Validate email
    $email = trim($_POST['email']);
    if (empty($email)) {
        $errors['email_error'] = 'Email is required';
    } elseif (!valid_email($email)) {
        $errors['email_error'] = 'Invalid email format';
    } elseif (is_disposable_email($email)) {
        $errors['email_error'] = 'Disposable email addresses are not allowed';
    }

    // Validate message
    $msg = trim($_POST['msg']);
    if (empty($msg)) {
        $errors['msg_error'] = 'Message is required';
    } elseif (strlen($msg) > $config['max_message_length']) {
        $errors['msg_error'] = 'Message is too long (max ' . $config['max_message_length'] . ' characters)';
    }

    // Check for excessive capitalization - return error instead of fake success
    if (empty($errors) && preg_match('/[A-Z]{5,}/', $name . $msg)) {
        error_log("Spam detected - excessive capitalization from IP: $ip");
        echo json_encode(['error' => ['name_error' => 'Please avoid excessive capitalization']]);
        exit;
    }

    if (empty($errors)) {
        // Prepare email body
        $Body = "
        <html>
        <head>
            <style type='text/css'>
                .TFtable { width: 100%; border-collapse: collapse; }
                .TFtable td { padding: 7px; border: #EAF2FA 1px solid; }
                .TFtable tr { background: #EAF2FA; }
                .TFtable tr:nth-child(odd) { background: #EAF2FA; }
                .TFtable tr:nth-child(even) { background: #FFFFFF; }
            </style>    
        </head>
        <body>
            <div style='background: #bad6f3; padding: 7px; text-transform: uppercase; text-align: center; border: #bad6f3 1px solid; font-family: Arial, Helvetica, sans-serif; font-weight: bold;'>
                <h3>Home Page Form From AP Legal</h3>
            </div>
            <table class='TFtable' style='width: 100%; border-collapse: collapse;'>
                <tr style='background: #EAF2FA;'>
                    <td style='padding: 7px; width: 30%; border: #bad6f3 2px solid; font-family: Arial, Helvetica, sans-serif; font-weight: bold;'>Name</td>
                    <td style='padding: 7px; background: #fff; border: #bad6f3 2px solid;'>" . htmlspecialchars($name) . "</td>
                </tr>
                <tr style='background: #EAF2FA'>
                    <td style='padding: 7px; width: 30%; border: #bad6f3 2px solid; font-family: Arial, Helvetica, sans-serif; font-weight: bold;'>Phone</td>
                    <td style='padding: 7px; background: #fff; border: #bad6f3 2px solid;'>" . htmlspecialchars($phone) . "</td>
                </tr>
                <tr style='background: #EAF2FA'>
                    <td style='padding: 7px; width: 30%; border: #bad6f3 2px solid; font-family: Arial, Helvetica, sans-serif; font-weight: bold;'>E-mail Address</td>
                    <td style='padding: 7px; background: #fff; border: #bad6f3 2px solid;'>" . htmlspecialchars($email) . "</td>
                </tr>
                <tr style='background: #EAF2FA'>
                    <td style='padding: 7px; width: 30%; border: #bad6f3 2px solid; font-family: Arial, Helvetica, sans-serif; font-weight: bold;'>Message</td>
                    <td style='padding: 7px; background: #fff; border: #bad6f3 2px solid;'>" . nl2br(htmlspecialchars($msg)) . "</td>
                </tr>
            </table>
        </body>
        </html>";

        // Prepare email headers
        $from = "website_enquiry@aplegal.in";  
        $to = 'info@aplegal.in';
        $subject = "Home Page Enquiry From " . htmlspecialchars($email);

        $headers = "From: $from\r\n";
        $headers .= "Reply-To: " . htmlspecialchars($email) . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";  
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        $headers .= "X-AntiSpam: True\r\n";
  
        if (mail($to, $subject, $Body, $headers)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['error' => ['name_error' => 'Mail server error. Please try again later.']]);
        }
    } else {
        echo json_encode(['error' => $errors]);
    }
}