<?php session_start();  ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yahoo Đăng ký</title>
    <link rel="stylesheet" href="yahoo.css">
</head>
<body>
    <div class="container">
        <h1> 
            <img src="./php/logo-yahoo-india-450x450-2022.png" alt="Logo" class="logo">
            Chào Bạn!</h1>
        <p>Chúng tôi sẽ giúp bạn lập tài khoản Yahoo! theo ba bước rất đơn giản!</p>
        <form action="http://localhost/NEW/php/register_process.php" method="POST">
            <h2>1. Hãy cho chúng tôi biết về bản thân bạn...</h2>
            <label for="fullname">Tên của tôi:</label>
            <input type="text" id="fullname" name="fullname" placeholder="Tên họ" required>

            <label for="gender">Giới tính:</label>
            <select id="gender" name="gender">
                <option value="">Chọn Một Mục</option>
                <option value="male">Nam</option>
                <option value="female">Nữ</option>
            </select>

            <label for="birthdate">Ngày Tháng Năm Sinh:</label>
            <input type="date" id="birthdate" name="birthdate" placeholder="Ngày / Tháng / Năm" required>

            <label for="country">Tôi sống tại:</label>
            <input type="text" id="country" name="country" placeholder="Quốc gia" required>

            <label for="postalcode">Mã Bưu Chính:</label>
            <input type="text" id="postalcode" name="postalcode">

            <h2>2. Chọn ID và mật khẩu</h2>
            <label for="email">Yahoo! ID và Email:</label>
            <input type="email" id="email" name="email" placeholder="example@yahoo.com.vn" required>

            <label for="password">Mật Khẩu:</label>
            <input type="password" id="password" name="password" required>

            <label for="repassword">Đánh Lại Mật Khẩu:</label>
            <input type="password" id="repassword" name="repassword" required>

            <h2>3. Để đề phòng trường hợp quên ID hoặc mật khẩu...</h2>
            <label for="security_question">Câu Hỏi Bảo Mật:</label>
            <select id="security_question" name="security_question">
                <option value="#!">Chọn Một Mục</option>
                <option value="Động vật yêu thích">Động vật yêu thích</option>
                <option value="Loài thực vật yêu thích">Loài thực vật yêu thích</option>
                <option value="Người bạn yêu thích">Người bạn yêu thích</option>
                <option value="Cảnh vật thiên nhiên bạn thích">Cảnh vật thiên nhiên bạn thích</option>
            </select>

            <label for="security_answer">Câu Trả Lời của Bạn:</label>
            <input type="text" id="security_answer" name="security_answer" required>

            <button type="submit">Đăng ký</button>
        </form>
    </div>
</body>
</html>
