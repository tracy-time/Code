<?php
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

// Kiểm tra xem có id được truyền vào không
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Tạo câu truy vấn SQL để xóa người dùng
    $sql = "DELETE FROM users WHERE id = ?";

    // Chuẩn bị và thực thi câu truy vấn
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Xóa người dùng thành công!";
    } else {
        echo "Lỗi khi xóa người dùng: " . $conn->error;
    }

    // Đóng statement và kết nối
    $stmt->close();
} else {
    echo "Không tìm thấy ID người dùng để xóa.";
}

$conn->close();
?>
