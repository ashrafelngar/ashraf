<?php
include 'db.php';

$userId = 1; // استخدم رقم المستخدم الحالي (تحديث لاحقًا)
$query = $conn->prepare("SELECT * FROM ads WHERE user_id = ?");
$query->execute([$userId]);
$ads = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="assets/styles.css">
<head>
    <meta charset="UTF-8">
    <title>إدارة إعلاناتي</title>
</head>
<body>
    <h1>إعلاناتي</h1>
    <div class="ads-container">
        <?php foreach ($ads as $ad): ?>
            <div class="ad">
                <h2><?php echo htmlspecialchars($ad['title']); ?></h2>
                <p><?php echo htmlspecialchars($ad['content']); ?></p>
                <p>الحالة: <?php echo htmlspecialchars($ad['status']); ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>