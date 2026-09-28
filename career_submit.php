<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);

$config = [
    'honeypot_field' => 'website',
    'time_threshold' => 3,
    'max_attempts' => 3,
    'max_file_size' => 5 * 1024 * 1024, // 5MB
    'allowed_types' => ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document']
];

function valid_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

function validate_phone($phone) {
    $clean = preg_replace('/[^0-9+]/', '', $phone);
    return (strlen(preg_replace('/[^0-9]/', '', $clean)) >= 8) ? $clean : false;
}

function track_attempts($ip) {
    $file = __DIR__ . '/career_attempts.json';
    $attempts = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
    $now = time();
    $attempts = array_filter($attempts, function($t) use ($now) { return $t > ($now - 3600); });
    $count = count(array_filter($attempts, function($t, $a_ip) use ($ip) { return $a_ip === $ip; }, ARRAY_FILTER_USE_BOTH));
    $attempts[$ip . '_' . $now] = $now;
    file_put_contents($file, json_encode($attempts));
    return $count;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = [];
    $ip = $_SERVER['REMOTE_ADDR'];

    if (!empty($_POST[$config['honeypot_field']])) {
        echo json_encode(['error' => ['fname_error' => 'Security block']]);
        exit;
    }

    if (isset($_POST['form_timestamp']) && (time() - (int)$_POST['form_timestamp']) < $config['time_threshold']) {
        echo json_encode(['error' => ['fname_error' => 'Submission too fast']]);
        exit;
    }

    if (track_attempts($ip) >= $config['max_attempts']) {
        echo json_encode(['error' => ['fname_error' => 'Too many attempts']]);
        exit;
    }

    $name = trim($_POST['fname']);
    if (empty($name)) $errors['fname_error'] = 'Name required';

    $email = trim($_POST['mail']);
    if (!valid_email($email)) $errors['mail_error'] = 'Invalid email';

    $phone = validate_phone($_POST['phone']);
    if (!$phone) $errors['phone_error'] = 'Invalid phone';

    $msg = trim($_POST['msg']);

    $attachment = null;
    if (isset($_FILES['resume']) && $_FILES['resume']['error'] === UPLOAD_ERR_OK) {
        if ($_FILES['resume']['size'] > $config['max_file_size']) {
            $errors['resume_error'] = 'File too large (max 5MB)';
        } elseif (!in_array($_FILES['resume']['type'], $config['allowed_types'])) {
            $errors['resume_error'] = 'Only PDF or Word documents allowed';
        } else {
            $attachment = $_FILES['resume'];
        }
    }

    if (empty($errors)) {
        $to = "info@aplegal.in";
        $subject = "Career Application from " . $name;
        $boundary = md5(time());

        $headers = "From: website_enquiry@aplegal.in\r\n";
        $headers .= "Reply-To: $email\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n";

        $message = "--$boundary\r\n";
        $message .= "Content-Type: text/html; charset=UTF-8\r\n";
        $message .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
        $message .= "<html><body>";
        $message .= "<h3>New Career Application</h3>";
        $message .= "<p><strong>Name:</strong> $name</p>";
        $message .= "<p><strong>Email:</strong> $email</p>";
        $message .= "<p><strong>Phone:</strong> $phone</p>";
        $message .= "<p><strong>Message:</strong><br>" . nl2br(htmlspecialchars($msg)) . "</p>";
        $message .= "</body></html>\r\n";

        if ($attachment) {
            $content = chunk_split(base64_encode(file_get_contents($attachment['tmp_name'])));
            $filename = $attachment['name'];
            $message .= "--$boundary\r\n";
            $message .= "Content-Type: application/octet-stream; name=\"$filename\"\r\n";
            $message .= "Content-Description: $filename\r\n";
            $message .= "Content-Disposition: attachment; filename=\"$filename\"; size=" . $attachment['size'] . ";\r\n";
            $message .= "Content-Transfer-Encoding: base64\r\n\r\n";
            $message .= $content . "\r\n";
        }
        $message .= "--$boundary--";

        if (mail($to, $subject, $message, $headers)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['error' => ['fname_error' => 'Server error']]);
        }
    } else {
        echo json_encode(['error' => $errors]);
    }
}
