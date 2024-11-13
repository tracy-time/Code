<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chào Mừng</title>
</head>
<body>
    <h2>Chào mừng bạn đến với trang của chúng tôi!</h2>

    <?php
        // Kiểm tra xem dữ liệu có được gửi qua POST không
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Lấy dữ liệu từ form
            $username = htmlspecialchars($_POST["username"]);
            $email = htmlspecialchars($_POST["email"]);

            // Hiển thị dữ liệu
            echo "<p>Xin chào, $username!</p>";
            echo "<p>Email của bạn là: $email</p>";

        } else {
            echo "<p>Không có dữ liệu để hiển thị.</p>";
        }
    ?>
</body>
</html>

