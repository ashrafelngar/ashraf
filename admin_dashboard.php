<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['approve'])) {
        $stmt = $conn->prepare("UPDATE ads SET status = 'approved' WHERE id = ?");
        $stmt->execute([$_POST['ad_id']]);
    } elseif (isset($_POST['reject'])) {
        $stmt = $conn->prepare("UPDATE ads SET status = 'rejected' WHERE id = ?");
        $stmt->execute([$_POST['ad_id']]);
    }
}

$query = $conn->query("SELECT * FROM ads WHERE status = 'pending'");
$ads = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>إدارة الإعلانات</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>
    <h1>إدارة الإعلانات</h1>
    <div class="ads-container">
        <?php foreach ($ads as $ad): ?>
            <div class="ad">
                <h2><?php echo htmlspecialchars($ad['title']); ?></h2>
                <p><?php echo htmlspecialchars($ad['content']); ?></p>
                <form method="POST">
                    <input type="hidden" name="ad_id" value="<?php echo $ad['id']; ?>">
                    <button type="submit" name="approve">قبول</button>
                    <button type="submit" name="reject">رفض</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>