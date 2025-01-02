<?php
session_start();
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // التحقق من بيانات تسجيل الدخول
    $stmt = $conn->prepare("SELECT id FROM engineers WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $engineer = $result->fetch_assoc();
        $_SESSION['engineer_id'] = $engineer['id'];

        // إعادة التوجيه إلى صفحة الرسائل
        header("Location: chat_engineer.php");
        exit;
    } else {
        echo "بيانات تسجيل الدخول غير صحيحة.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>تسجيل دخول المهندس</title>
</head>
<body>
    <form method="post" action="">
        <input type="email" name="email" placeholder="البريد الإلكتروني" required>
        <input type="password" name="password" placeholder="كلمة المرور" required>
        <button type="submit">تسجيل الدخول</button>
    </form>
</body>
</html>