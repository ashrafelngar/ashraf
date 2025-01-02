<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $userId = 1; // استخدم رقم المستخدم الحالي (تحديث لاحقًا)

    $mediaPath = '';
    if ($_FILES['media']['name']) {
        $mediaPath = time() . "_" . $_FILES['media']['name'];
        move_uploaded_file($_FILES['media']['tmp_name'], "assets/uploads/" . $mediaPath);
    }

    $stmt = $conn->prepare("INSERT INTO ads (user_id, title, content, media_path) VALUES (?, ?, ?, ?)");
    $stmt->execute([$userId, $title, $content, $mediaPath]);
    echo "تم إرسال إعلانك للمراجعة!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إنشاء إعلان</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>
    <h1>إنشاء إعلان جديد</h1>
    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="title" placeholder="عنوان الإعلان" required>
        <textarea name="content" placeholder="وصف الإعلان" required></textarea>
        <input type="file" name="media">
        <button type="submit">إرسال الإعلان</button>
    </form>
</body>
</html>