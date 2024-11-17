<?php
require 'connect.php';

if(isset($_POST['dangky'])){
    $user = $_POST['username']; // Sửa thành 'username'
    $pass = $_POST['password'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];

    if(!empty($user) && !empty($pass) && !empty($email) && !empty($address) && !empty($gender)){
        
        // Kiểm tra tên đăng nhập đã tồn tại hay không
        $checkUsernameQuery = "SELECT * FROM users WHERE username = '$user'";
        $checkUsernameResult = $conn->query($checkUsernameQuery);
        
        // Kiểm tra email đã tồn tại hay không
        $checkEmailQuery = "SELECT * FROM users WHERE email = '$email'";
        $checkEmailResult = $conn->query($checkEmailQuery);
        
        if ($checkUsernameResult->num_rows > 0) {
            echo "<script>alert('Tên đăng nhập đã tồn tại. Vui lòng chọn tên đăng nhập khác.');</script>";
        } elseif ($checkEmailResult->num_rows > 0) {
            echo "<script>alert('Email đã được sử dụng. Vui lòng chọn email khác.');</script>";
        } else {
            // Nếu không có trùng lặp, thêm người dùng mới vào cơ sở dữ liệu
            $sql = "INSERT INTO users (`username`, `pass`, `email`, `diachi`, `gender`) VALUES ('$user', '$pass', '$email', '$address', '$gender')";
            
            if($conn->query($sql) === TRUE){
                header("Location: dangnhap.php");
                exit(); // Đảm bảo không có mã PHP nào thực hiện sau khi chuyển hướng
            } else {
                echo "Lỗi: " . $sql . "<br>" . $conn->error;
            }
        }
    } else {
        echo "Bạn cần nhập đầy đủ thông tin";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>Đăng Ký</title>
  <link rel="stylesheet" href="./assets/css/dangky.css">
  <link rel="stylesheet" href="./assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
  <!-- Font Roboto -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet" />
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Roboto', sans-serif;
      background-color: #f0f0f0;
    }

    .container {
      width: 100%;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .login {
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .login_container {
      text-align: center;
    }

    .login_container img {
      max-width: 100px;
      margin-bottom: 20px;
    }
    .login_container h5{
      color: black;
    }
    h1 {
      color: blue;
      margin-bottom: 20px;
    }

    form {
      margin-top: 20px;
    }

    form h5 {
      margin-top: 10px;
      margin-bottom: 5px;
      color: #333;
    }

    input[type="text"],
    input[type="password"],
    input[type="email"],
    select {
      width: calc(100% - 22px);
      padding: 10px;
      border-radius: 5px;
      border: 1px solid #ccc;
      box-sizing: border-box;
    }

    select {
      appearance: none;
    }

    button {
      width: 100%;
      padding: 10px;
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    button:hover {
      background-color: #0056b3;
    }

    .social-container {
      margin-top: 20px;
    }

    .social-container a {
      display: inline-block;
      margin-right: 10px;
      color: #333;
      font-size: 24px;
      text-decoration: none;
      transition: color 0.3s ease;
    }

    .social-container a:hover {
      color: #007bff;
    }
  </style>
</head>

<body>

  <div class="container">
    <div class="login">
      <div class="login_container">
        <img src="./assets/img/sidebar-icon/logo/logo.svg" alt="">
        <h1>Đăng Ký</h1>
        <form method="POST">
          <h5>Tên đăng nhập</h5>
          <input type="text" id="username" name="username" required>
          <h5>Mật khẩu</h5>
          <input type="password" id="password" name="password" required>
          <h5>Email</h5>
          <input type="email" id="email" name="email" required>
          <h5>Địa chỉ</h5>
          <input type="text" id="address" name="address" required>
          <h5>Giới tính</h5>
          <select id="gender" name="gender" required>
            <option value="Nam">Nam</option>
            <option value="Nữ">Nữ</option>
          </select>
          <div>
            <button type="submit" name="dangky">Đăng ký</button>
          </div>
        </form>
        <div class="social-container">
          <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
          <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
          <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
