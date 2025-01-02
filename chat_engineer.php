<?php
session_start();
require 'config.php';

// التحقق من تسجيل الدخول
if (!isset($_SESSION['engineer_id'])) {
    header("Location: engineer_login.php");
    exit;
}

$engineer_id = $_SESSION['engineer_id'];

// جلب الرسائل مع العملاء
$stmt = $conn->prepare("SELECT chats.*, users.name AS user_name FROM chats 
                        JOIN users ON chats.user_id = users.id 
                        WHERE chats.engineer_id = ? ORDER BY chats.created_at DESC");
$stmt->bind_param("i", $engineer_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>صفحة الرسائل</title>
</head>
<body>
    <h1>مرحبا، مهندس!</h1>
    <h2>الرسائل مع العملاء</h2>

    <div>
        <?php while ($row = $result->fetch_assoc()): ?>
            <div>
                <strong><?php echo $row['user_name']; ?>:</strong>
                <p><?php echo $row['message']; ?></p>
                <?php if (!empty($row['attachment'])): ?>
                    <a href="uploads/<?php echo $row['attachment']; ?>" target="_blank">مشاهدة المرفق</a>
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>