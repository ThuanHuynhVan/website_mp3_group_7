<?php
require 'connect.php';

if(isset($_POST['dangky'])){
    $user = $_POST['username']; // Sửa thành 'username'
    $pass = $_POST['password'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    $role = $_POST['role'];

    if(!empty($user) && !empty($pass)&& !empty($email)&& !empty($address)&& !empty($gender)&& !empty($role)){
        // echo "<pre"; // Dòng này có vẻ không cần thiết, bạn có thể xóa nó đi
        // print_r($_POST); // Tương tự, dòng này cũng có vẻ không cần thiết

        // Sửa dấu ngoặc đơn ('') thành dấu backtick (`) cho tên cột trong câu SQL
        $sql = "INSERT INTO users (`username`, `pass`, `email`, `diachi`, `gender`, `role`) VALUES ('$user', '$pass', '$email', '$address', '$gender', '$role')";
        
        if($conn->query($sql) === TRUE){
            // echo "Đăng ký thành công";
            header("Location: admin.php");
            exit(); // Đảm bảo không có mã PHP nào thực hiện sau khi chuyển hướng
        } else{
            echo "Lỗi: " . $sql . "<br>" . $conn->error;
        }
    } else{
        echo "Bạn cần nhập đầy đủ thông tin";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="register-container">
    <h2>Đăng ký</h2>
    <form action="" method="POST">
        <div class="form-group">
            <label for="username">Tên đăng nhập:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Mật khẩu:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="address">Địa chỉ:</label>
            <input type="text" id="address" name="address" required>
        </div>
        <div class="form-group">
            <label for="gender">Giới tính:</label>
            <select id="gender" name="gender" required>
                <option value="Nam">Nam</option>
                <option value="Nữ">Nữ</option>
            </select>
        </div>
        <div class="form-group">
            <label for="gender">Quyền Tài Khoản:</label>
            <select id="gender" name="role" required>
                <option value="admin">admin</option>
                <option value="user">user</option>
            </select>
        </div>
        <button type="submit" name="dangky" style=" margin-bottom: 20px">Thêm Tài Khoản</button>
    </form>

    <button onclick="window.location.href='admin.php'">Trang Chủ</button>
</div>

</body>
</html>
