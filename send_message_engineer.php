<?php
session_start();
require 'config.php';

if (!isset($_SESSION['engineer_id'])) {
    die("لم يتم تسجيل الدخول.");
}

if (!isset($_POST['user_id']) || empty($_POST['user_id'])) {
    die("رقم المستخدم مفقود.");
}

if (!isset($_POST['message']) || empty(trim($_POST['message']))) {
    die("الرسالة فارغة.");
}

$engineer_id = $_SESSION['engineer_id'];
$user_id = $_POST['user_id'];
$message = trim($_POST['message']);

$stmt = $conn->prepare("INSERT INTO chats (user_id, engineer_id, message, sent_by) VALUES (?, ?, ?, 'engineer')");
$stmt->bind_param("iis", $user_id, $engineer_id, $message);
$stmt->execute();

header("Location: chat_engineer.php");
exit;
?>