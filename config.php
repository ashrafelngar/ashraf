<?php
$servername = "localhost"; // اسم الخادم
$username = "root";       // اسم المستخدم (افتراضي في XAMPP)
$password = "";           // كلمة المرور (افتراضي فارغ في XAMPP)
$dbname = "ashraf_chat";  // اسم قاعدة البيانات

// إنشاء اتصال بقاعدة البيانات
$conn = new mysqli($servername, $username, $password, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("فشل الاتصال بقاعدة البيانات: " . $conn->connect_error);
}
?>