<?php
// Init
error_reporting(NULL);
ob_start();
session_start();
header('Content-Type: application/json');
include($_SERVER['DOCUMENT_ROOT']."/inc/main.php");

// Check token
if ((!isset($_GET['token'])) || ($_SESSION['token'] != $_GET['token'])) {
    header('location: /login/');
    exit();
}

// Check user
if ($_SESSION['user'] != 'admin') {
    exit;
}

if (!empty($_GET['user'])) {
    $user=$_GET['user'];
}

// DNS domain
if ((!empty($_GET['domain'])) && (empty($_GET['record_id'])))  {
    $v_username = escapeshellarg($user);
    $v_domain = escapeshellarg($_GET['domain']);
    exec (VESTA_CMD."v-unsuspend-dns-domain ".$v_username." ".$v_domain, $output, $return_var);
    if ($return_var != 0) {
        $error = implode('<br>', $output);
        if (empty($error)) $error = __('Error: vesta did not return any output.');
        $_SESSION['error_msg'] = $error;
    }
    unset($output);
}

// DNS record
if ((!empty($_GET['domain'])) && (!empty($_GET['record_id'])))  {
    $v_username = escapeshellarg($user);
    $v_domain = escapeshellarg($_GET['domain']);
    $v_record_id = escapeshellarg($_GET['record_id']);
    exec (VESTA_CMD."v-unsuspend-dns-record ".$v_username." ".$v_domain." ".$v_record_id, $output, $return_var);
    if ($return_var != 0) {
        $error = implode('<br>', $output);
        if (empty($error)) $error = __('Error: vesta did not return any output.');
        $_SESSION['error_msg'] = $error;
    }
    unset($output);
}

echo json_encode(array('error' => $_SESSION['error_msg']));
unset($_SESSION['error_msg']);
