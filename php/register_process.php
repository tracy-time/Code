<?php
session_start();

// Kết nối đến cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "yahoo_form";

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Kiểm tra xem form đã được gửi hay chưa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Nhận dữ liệu từ Form 1
    $fullname = $_POST['fullname'];
    $gender = $_POST['gender'];
    $birthdate = $_POST['birthdate'];
    $country = $_POST['country'];
    $email = $_POST['email'];
    $postalcode = $_POST['postalcode'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Mã hóa mật khẩu
    $security_question = $_POST['security_question'];
    $security_answer = $_POST['security_answer'];

    // Thêm dữ liệu vào bảng users
    $sql = "INSERT INTO users (fullname, gender, birthdate, country, email, postalcode, password, security_question, security_answer) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssss", $fullname, $gender, $birthdate, $country, $email, $postalcode, $password, $security_question, $security_answer);

    if ($stmt->execute()) {
        // Chuyển hướng đến form2.php sau khi đăng ký thành công
        header("Location: /New/php/yahooform2.php");
        exit();
    } else {
        echo "Lỗi: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

