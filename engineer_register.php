<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("INSERT INTO engineers (email, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $email, $password);
    if ($stmt->execute()) {
        echo "تم إنشاء الحساب بنجاح. <a href='engineer_login.php'>تسجيل الدخول</a>";
    } else {
        echo "حدث خطأ أثناء إنشاء الحساب.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>إنشاء حساب مهندس</title>
</head>
<body>
    <form method="post" action="">
        <input type="email" name="email" placeholder="البريد الإلكتروني" required>
        <input type="password" name="password" placeholder="كلمة المرور" required>
        <button type="submit">إنشاء الحساب</button>
    </form>
</body>
</html>