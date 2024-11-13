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

// Xử lý xóa người dùng nếu có yêu cầu
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $delete_id);
    $stmt->execute();
    $stmt->close();
    echo "Xóa người dùng thành công.";
}

// Lấy danh sách người dùng từ cơ sở dữ liệu
$sql = "SELECT * FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý người dùng</title>
    <link rel="stylesheet" href="yahoo2.css">
</head>
<body>
    <h2>
        <img src="./yahoo-messenger-logo-5783CAD8CA-seeklogo.com.png" alt="Logo" class="logo">
        Danh sách người dùng</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Họ tên</th>
            <th>Giới tính</th>
            <th>Ngày sinh</th>
            <th>Quốc gia</th>
            <th>Mã bưu chính</th>
            <th>email</th>
            <th>Câu hỏi bảo mật</th>
            <th>Câu trả lời bảo mật</th>
            <th>Chức năng</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['fullname']; ?></td>
                <td><?php echo $row['gender']; ?></td>
                <td><?php echo $row['birthdate']; ?></td>
                <td><?php echo $row['country']; ?></td>
                <td><?php echo $row['postalcode']; ?></td>
                <td><?php echo $row['email'];?></td>
                <td><?php echo htmlspecialchars($row['security_question']);?></td>
                <td><?php echo $row['security_answer'];?></td>
                <td class= "action">
                    <a href="/New/php/edit_users.php?id=<?php echo $row['id']; ?>">Sửa</a> |
                    <a href="/New/php/yahooform2.php?delete_id=<?php echo $row['id']; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa người dùng này?');">Xóa</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
    <a href="add_user.php">Thêm người dùng mới</a>
</body>
</html>

<?php
// Đóng kết nối
$conn->close();
?>
