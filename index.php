<?php
include 'db.php';

$query = $conn->query("SELECT * FROM ads WHERE status = 'approved' ORDER BY created_at DESC");
$ads = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/styles.css">
    <link rel="stylesheet" href="assets/styles.css">
    <title>الإعلانات</title>
</head>
<body>
    <h1>صفحة الإعلانات</h1>
    <a href="create_ad.php">إنشاء إعلان جديد</a>
    <div class="ads-container">
        <?php foreach ($ads as $ad): ?>
            <div class="ad">
                <h2><?php echo htmlspecialchars($ad['title']); ?></h2>
                <p><?php echo htmlspecialchars($ad['content']); ?></p>
                <?php if ($ad['media_path']): ?>
                    <img src="assets/uploads/<?php echo $ad['media_path']; ?>" alt="Ad Media">
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>