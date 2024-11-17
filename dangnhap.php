<?php
    require 'connect.php';
    if(isset($_POST['submit'])){
      $user = $_POST['username'];
      $pass = $_POST['password'];
  
      if(!empty($user) && !empty($pass)){
          $sql = "SELECT * FROM users WHERE username='$user' AND pass='$pass'";
          $result = $conn->query($sql);
  
          if ($result->num_rows > 0) {
              // Kiểm tra xem tài khoản có phải là admin không
              $row = $result->fetch_assoc();
              if ($row['role'] == 'admin') { // Giả sử 'role' là cột chứa vai trò của người dùng
                  // Đăng nhập thành công và là admin
                  echo "Đăng nhập thành công!";
                  header("Location: admin/admin.php"); // Chuyển hướng đến trang admin
                  exit();
              } else {
                  // Đăng nhập thành công nhưng không phải là admin
                  echo "Bạn không có quyền truy cập vào trang admin.";
                  header("Location: index.php"); // Chuyển hướng đến trang index.php
                  exit();
              }
          } else {
              // Đăng nhập thất bại
              echo "Tên người dùng hoặc mật khẩu không đúng!";
          }
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
  <title>Đăng Nhập</title>
  <link rel="stylesheet" href="./assets/css/dangnhap.css">
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
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .login {
      background-color: #fff;
      padding: 40px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      width: 400px;
      text-align: center;
    }

    .login_container img {
      max-width: 100px;
      margin-bottom: 20px;
    }

    h1 {
      color: #333;
      margin-bottom: 20px;
    }

    form {
      margin-top: 20px;
    }

    form h5 {
      margin-top: 10px;
      margin-bottom: 5px;
      color: #333;
      text-align: left;
    }

    input[type="text"],
    input[type="password"],
    input[type="email"],
    select {
      width: 100%;
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

    p {
      margin-top: 20px;
      color: #333;
    }

    p a {
      color: #007bff;
      text-decoration: none;
    }

    p a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
<!-- from login -->
<div class="container">
<div class="login">
  <div class="login_container">
    <img src="./assets/img/sidebar-icon/logo/logo.svg" alt="Logo">
    <h1>Đăng Nhập</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
      <h5 style="color: black;">Tên đăng nhập</h5>
      <input type="text" id="username" name="username" required>
      <h5 style="color: black;">Mật khẩu</h5>
      <input type="password" id="password" name="password" required>
      <button type="submit" name="submit">Đăng nhập</button>
    </form>
    
    <div class="social-container">
      <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
      <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
      <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
    </div>
    <p>Chưa có tài khoản? <a href="dangky.php">Đăng ký ngay</a></p>
  </div>
</div>
</div>
</body>
</html>
