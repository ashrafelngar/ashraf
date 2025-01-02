<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    die("لم يتم تسجيل الدخول.");
}

$user_id = $_SESSION['user_id'];
$message = isset($_POST['message']) ? trim($_POST['message']) : '';
$attachment = '';

if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] == UPLOAD_ERR_OK) {
    $upload_dir = 'uploads/';
    $attachment = basename($_FILES['attachment']['name']);
    $upload_file = $upload_dir . $attachment;

    if (!move_uploaded_file($_FILES['attachment']['tmp_name'], $upload_file)) {
        die("فشل رفع الملف.");
    }
}

$stmt = $conn->prepare("INSERT INTO chats (user_id, engineer_id, message, attachment, sent_by) VALUES (?, ?, ?, ?, 'user')");
$engineer_id = 1; // افتراضي
$stmt->bind_param("iiss", $user_id, $engineer_id, $message, $attachment);
$stmt->execute();

header("Location: chat_user.php");
exit;
?>