<?php
// Kết nối đến cơ sở dữ liệu
require 'connect.php';

// Kiểm tra xem có dữ liệu id tài khoản được gửi không
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Thực hiện truy vấn để lấy thông tin tài khoản có id tương ứng
    $sql = "SELECT * FROM users WHERE id = '$id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Dữ liệu được tìm thấy
        $row = $result->fetch_assoc();
        $username = $row['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác nhận xóa tài khoản</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 50%;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        p {
            text-align: center;
            font-size: 18px;
            margin-bottom: 20px;
        }
        .btn-container {
            text-align: center;
        }
        .btn {
            padding: 10px 20px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            text-decoration: none;
        }
        .btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Xác nhận xóa tài khoản</h2>
        <p>Bạn có chắc chắn muốn xóa tài khoản của người dùng: <?php echo $username; ?> không?</p>
        <div class="btn-container">
            <a href="delete_account.php?id=<?php echo $id; ?>" class="btn">Xác nhận xóa</a>
            <a href="admin.php" class="btn">Hủy</a>
        </div>
    </div>
</body>
</html>

<?php
    } else {
        echo "Không tìm thấy tài khoản có id = $id";
    }
} else {
    echo "ID tài khoản không được cung cấp";
}
?>
