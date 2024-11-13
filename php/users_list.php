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

// Lấy danh sách người dùng
$sql = "SELECT id, fullname, email FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Họ tên</th>
                <th>Email</th>
                <th>Hành động</th>
            </tr>";

    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["id"] . "</td>
                <td>" . $row["fullname"] . "</td>
                <td>" . $row["email"] . "</td>
                <td><a href='delete_user.php?id=" . $row["id"] . "' onclick=\"return confirm('Bạn có chắc chắn muốn xóa người dùng này?');\">Xóa</a></td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "Không có người dùng nào.";
}

$conn->close();
?>
