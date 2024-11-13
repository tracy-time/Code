<?php

session_start();
// Thông tin kết nối
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "yahoo_form";

// Kết nối đến CSDL
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Kiểm tra xem form đã được gửi hay chưa

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $security_question = $_POST['security_question']; // Lấy giá trị từ thẻ select
    $id = $_POST['id'];
    $fullname = $_POST['fullname'];
    $gender = $_POST['gender'];
    $birthdate = $_POST['birthdate'];
    $country = $_POST['country'];
    $postalcode = $_POST['postalcode'];
    $email = $_POST['email'];
    $security_answer = $_POST['security_answer'];

    // Tạo câu truy vấn để cập nhật thông tin người dùng
    $sql = "UPDATE users SET fullname = ?, gender = ?, birthdate = ?, country = ?, postalcode = ?, email = ?, security_question= ?, security_answer=? WHERE id = ?";

    // Chuẩn bị và thực thi câu truy vấn
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssi", $fullname, $gender, $birthdate, $country, $postalcode, $email, $security_question, $security_answer, $id);

    if ($stmt->execute()) {
        echo "Cập nhật thông tin thành công!";
        header("Location: /New/php/yahooform2.php"); // Quay về Form 2
        exit(); // Dừng chương trình
    } else {
        echo "Lỗi khi cập nhật thông tin: " . $conn->error;
    }

    // Đóng statement và kết nối
    $stmt->close();
} else {
    echo "Không tìm thấy ID người dùng để cập nhật.";
}

$conn->close();
?>
