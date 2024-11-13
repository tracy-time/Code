<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "yahoo_form";

$conn = new mysqli($servername, $username, $password, $dbname);

// Kích hoạt chế độ hiển thị lỗi
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $gender = $_POST['gender'];
    $birthdate = $_POST['birthdate'];
    $country = $_POST['country'];
    $postalcode = $_POST['postalcode'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $security_question = $_POST['security_question'];
    $security_answer = $_POST['security_answer'];

    // Kiểm tra xem email đã tồn tại chưa
    $checkEmail = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $checkEmail->bind_param("s", $email);
    $checkEmail->execute();
    $checkEmail->store_result();

    if ($checkEmail->num_rows > 0) {
        echo "Email đã được sử dụng. Vui lòng chọn một email khác.";
        $checkEmail->close();
    } else {
        // Đóng checkEmail sau khi kiểm tra xong
        $checkEmail->close();

        // Thực hiện thêm dữ liệu
        $sql = "INSERT INTO users (fullname, gender, birthdate, country, postalcode, email, password, security_question, security_answer) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssssss", $fullname, $gender, $birthdate, $country, $postalcode, $email, $password, $security_question, $security_answer);

        if ($stmt->execute()) {
            echo "Thêm người dùng thành công!";
            header("Location: /New/php/yahooform2.php");
            exit();
        } else {
            echo "Lỗi khi thêm người dùng: " . $stmt->error;
        }

        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm người dùng</title>
    <style>
        /* Định dạng cho toàn bộ trang */
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
            display: flex;
            justify-content: center;
            align-items: center;
            height: auto;
            margin: 0;
        }

        /* Container cho form */
        .form-container {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: left;
        }

        /* Tiêu đề */
        .form-container h2 {
            color: #fff;
            background-color: #6001d3;
            padding: 10px;
            margin: 0 -30px 20px -30px;
            font-size: 20px;
            text-align: center;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        /* Định dạng label và input */
        label {
            display: block;
            margin-top: 10px;
            color: #333;
            font-weight: bold;
        }

        input[type="text"],
        input[type="date"],
        input[type="email"],
        input[type="password"],
        select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        /* Button thêm người dùng */
        button {
            background-color: #6001d3;
            color: white;
            font-size: 16px;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            margin-top: 15px;
        }

        button:hover {
            background-color: #4a019d;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Thêm người dùng mới</h2>
        <form method="post" action="add_user.php">
            <label>Họ tên:</label>
            <input type="text" name="fullname" required><br>

            <label>Giới tính:</label>
            <select name="gender" required>
                <option value="male">Nam</option>
                <option value="female">Nữ</option>
            </select><br>

            <label>Ngày sinh:</label>
            <input type="date" name="birthdate" required><br>

            <label>Quốc gia:</label>
            <input type="text" name="country" required><br>

            <label>Mã bưu chính:</label>
            <input type="text" name="postalcode"><br>

            <label>Email:</label>
            <input type="email" name="email" required><br>

            <label>Mật khẩu:</label>
            <input type="password" name="password" required><br>

            <label>Câu hỏi bảo mật:</label>
            <input type="text" name="security_question" required><br>

            <label>Câu trả lời bảo mật:</label>
            <input type="text" name="security_answer" required><br>

            <button type="submit">Thêm người dùng</button>
        </form>
    </div>
</body>
</html>

