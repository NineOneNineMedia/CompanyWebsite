<?php
if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];

    $email_from = 'noreply@nineonenine.com';
    $email_subject = 'New Form Submission';
    $email_body = 'Name: $name.\n' .
        'Email: $email.\n' .
        'Subject: $subject.\n' .
        'Message: $message.\n';

    $toEmail = "mxnunley1@gmail.com";
    $mailHeaders = "From: " . $name . "<" . $email . ">\r\n";

    $secretKey = '6LdlP9wUAAAAAMgMuXqAAAuB_45xsL38jzkmj_bx';
    $responseKey = $_POST['g-recaptcha-response'];
    $UserIP = $_SERVER['REMOTE_ADDR'];
    $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$UserIP";

    $response = file_get_contents($url);
    $response = json_decode($response);

    if ($response->success) {
        mail($toEmail, $email_subject, $email_body, $mailHeaders);
        echo "Message Sent Successfully";
    } else {
        echo "Invalid Captcha, Please Try Again";
    }
}
