<?php
session_start();

// Kết nối cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "yahoo_form";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Kiểm tra xem id của người dùng đã được truyền qua GET chưa
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Truy vấn dữ liệu người dùng theo id
    $sql = "SELECT fullname, gender, birthdate, country, postalcode, email, security_question, security_answer FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Kiểm tra nếu có dữ liệu người dùng
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $fullname = $user['fullname'];
        $gender = $user['gender'];
        $birthdate = $user['birthdate'];
        $country = $user['country'];
        $postalcode = $user['postalcode'];
        $email = $user['email'];
        $security_question = $user['security_question'];
        $security_answer = $user['security_answer'];
    } else {
        echo "Không tìm thấy người dùng.";
        exit();
    }

    $stmt->close();
} else {
    echo "Không có ID người dùng được chỉ định.";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chỉnh sửa người dùng</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
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
        select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        /* Button cập nhật */
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
        <h2>Chỉnh sửa người dùng</h2>
        <form method="post" action="http://localhost/NEW/php/update_users.php">
            <input type="hidden" name="id" value="<?php echo $id; ?>">

            <label>Họ tên:</label>
            <input type="text" name="fullname" value="<?php echo htmlspecialchars($fullname); ?>" required><br>

            <label>Giới tính:</label>
            <select name="gender" required>
                <option value="male" <?php if ($gender == 'male') echo 'selected'; ?>>Nam</option>
                <option value="female" <?php if ($gender == 'female') echo 'selected'; ?>>Nữ</option>
            </select><br>

            <label>Ngày sinh:</label>
            <input type="date" name="birthdate" value="<?php echo $birthdate; ?>" required><br>

            <label>Quốc gia:</label>
            <input type="text" name="country" value="<?php echo htmlspecialchars($country); ?>" required><br>

            <label>Mã bưu chính:</label>
            <input type="text" name="postalcode" value="<?php echo htmlspecialchars($postalcode); ?>"><br>

            <label>Email:</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required><br>

            <label>Câu Hỏi Bảo Mật:</label>
            <select type="security_question" name="security_question">
                <option value="Chọn Một Mục"><?php if ($security_question == 'Chọn Một Mục') echo 'selected'; ?>Chọn Một Mục</option>
                <option value="Động vật yêu thích"><?php if ($security_question == 'Động vật yêu thích') echo 'selected'; ?>Động vật yêu thích</option>
                <option value="Loài thực vật yêu thích"><?php if ($security_question == 'Loài thực vật yêu thích') echo 'selected'; ?>Loài thực vật yêu thích</option>
                <option value="Người bạn yêu thích"><?php if ($security_question == 'Người bạn thích') echo 'selected'; ?>Người bạn yêu thích</option>
                <option value="Cảnh vật thiên nhiên bạn thích"><?php if ($security_question == 'Cảnh vật thiên nhiên yêu thích') echo 'selected'; ?>Cảnh vật thiên nhiên bạn thích</option>
            </select>

            <label>Câu trả lời bảo mật:</label>
            <input type="text" name="security_answer" value="<?php echo htmlspecialchars($security_answer); ?>"><br>

            <button type="submit">Cập nhật</button>
        </form>
    </div>
</body>
</html>
