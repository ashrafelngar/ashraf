<!DOCTYPE html>
<html>
<head>
    <title>الدردشة</title>
</head>
<body>
    <h1>مرحبا بالمستخدم</h1>
    <form method="post" action="send_message.php" enctype="multipart/form-data">
        <textarea name="message" placeholder="اكتب رسالتك هنا"></textarea>
        <input type="file" name="attachment" accept="image/,video/">
        <button type="submit">إرسال</button>
    </form>

    <!-- عرض الرسائل -->
    <h2>الرسائل السابقة:</h2>
    <?php
    session_start();
    require 'config.php';

    $user_id = $_SESSION['user_id'];
    $stmt = $conn->prepare("SELECT message, attachment, sent_by FROM chats WHERE user_id = ? ORDER BY created_at DESC");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        echo "<p><strong>{$row['sent_by']}:</strong> {$row['message']}</p>";
        if (!empty($row['attachment'])) {
            echo "<p><a href='uploads/{$row['attachment']}' target='_blank'>مشاهدة الملف المرفق</a></p>";
        }
    }
    ?>
</body>
</html>



<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f9f9f9;
        margin: 0;
        padding: 0;
    }

    #chat-box {
        max-width: 600px;
        margin: 20px auto;
        background: #fff;
        padding: 15px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        overflow-y: scroll;
        max-height: 400px;
    }

    #chat-box p {
        margin: 10px 0;
    }

    form {
        max-width: 600px;
        margin: 20px auto;
        display: flex;
        flex-direction: column;
    }

    textarea {
        width: 100%;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
        margin-bottom: 10px;
        font-size: 14px;
    }

    button {
        padding: 10px;
        background-color: #28a745;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
    }

    button:hover {
        background-color: #218838;
    }
</style>