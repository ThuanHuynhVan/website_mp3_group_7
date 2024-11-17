<?php
// Kết nối đến cơ sở dữ liệu
require 'connect.php';

// Truy vấn dữ liệu từ bảng tài khoản
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

// Kiểm tra vai trò của người dùng
$is_admin = true; // Giả sử người dùng là admin
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WMusic</title>
    <link rel="icon" href="./assets/img/sidebar-icon/logo/logo.svg" type="image/gif" sizes="16x16">
    <!-- reset css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <!-- css grid để kết hợp chia khung và responsive -->
    <link rel="stylesheet" href="./assets/css/grid.css">
    <!-- css mấy cái chung ban đầu -->
    <link rel="stylesheet" href="./assets/css/base.css">
    <!-- css chính -->
    <link rel="stylesheet" href="admin.css">
    <!-- css để responsive trên các thiết bị -->
    <link rel="stylesheet" href="./assets/css/responsive.css">
    <!-- nếu trình duyệt IE < 9 thì comment dưới sẽ thành code chạy dc, code scrip dước có chức năng để chạy dc media-query để responsive trên trình chuyệt thấp IE < 9 -->
    <!--[if lt IE 9]>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.1/respond.js"></script>
    <![endif]-->
    <!-- dùng google font roboto -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <!-- icon fontawesome -->
    <link rel="stylesheet" href="./assets/fonts/fontawesome-free-5.15.3-web/css/all.min.css">
    <link rel="stylesheet" href="./font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="admin.css">
</head>

<body>
    <div class="boxcenter">
        <div class="row mb header">
            <img src="./img/icon-home/logo.svg" alt="">
        </div>
        <div class="row mb menu">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="showContent('trangchu')">Trang chủ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="showContent('danhmuc')">Danh mục</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="showContent('quanly')">Quản lý tài khoản</a>
                </li>
            </ul>
        </div>
        <div class="content" id="content">
            <h2>Trang chủ</h2>
            <p>Chào mừng bạn đến với trang quản lý!</p>
        </div>
    </div>

    <script>
        function showContent(category) {
            var content = document.getElementById('content');
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    content.innerHTML = this.responseText;
                }
            };
            xhr.open("GET", category + ".php", true);
            xhr.send();
        }
    </script>
</body>

</html>
