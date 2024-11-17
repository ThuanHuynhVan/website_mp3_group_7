<!-- <?php
    require 'connect.php';
    if(isset($_POST['submit'])){
        $user = $_POST['username']; // Sửa thành 'username'
        $pass = $_POST['password'];
    
        if(!empty($user) && !empty($pass)){
            // echo "<pre"; // Dòng này có vẻ không cần thiết, bạn có thể xóa nó đi
            // print_r($_POST); // Tương tự, dòng này cũng có vẻ không cần thiết
    
            // Sửa dấu ngoặc đơn ('') thành dấu backtick (`) cho tên cột trong câu SQL
            $sql = "SELECT * FROM users WHERE username='$user' AND pass='$pass'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                // Đăng nhập thành công
                echo "Đăng nhập thành công!";
                header("Location: admin.php");
                exit(); // Đảm bảo không có mã PHP nào thực hiện sau khi chuyển hướng
            } else {
                // Đăng nhập thất bại
                echo "Tên người dùng hoặc mật khẩu không đúng!";
            }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="login-container">
    <h2>Đăng nhập</h2>
    <form action="" method="POST">
        <div class="form-group">
            <label for="username">Tên đăng nhập:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Mật khẩu:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit" name="submit">Đăng nhập</button>
    </form>
    <p>Chưa có tài khoản? <a href="register.php">Đăng ký ngay</a></p>
</div>

</body>
</html> -->
