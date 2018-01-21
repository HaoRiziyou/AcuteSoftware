<?php
header('Content-type: application/json');

require_once __DIR__ . '/includes/recaptcha/autoload.php';

// register or find API Keys: https://www.google.com/recaptcha/admin
$secret = '6Lciyz8UAAAAAA1J17LeTFSDJ4-QYiutHURnwQ2i';

if (isset($_POST['g-recaptcha-response'])) {
    $recaptcha = new \ReCaptcha\ReCaptcha($secret);
    // identify IP
    $resp = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);

    $var = var_export($_POST, true);

    // right identify
    if ($resp->isSuccess()) echo json_encode(array('success' => true));
}
