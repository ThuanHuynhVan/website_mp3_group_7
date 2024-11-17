<?php
// Kết nối đến cơ sở dữ liệu
require 'connect.php';

// Kiểm tra xem có dữ liệu id tài khoản được gửi không
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Thực hiện truy vấn để xóa tài khoản có id tương ứng
    $sql = "DELETE FROM users WHERE id = '$id'";
    
    if ($conn->query($sql) === TRUE) {
        // Nếu xóa thành công, chuyển hướng người dùng đến trang quản lý tài khoản
        header("Location: admin.php");
        exit();
    } else {
        echo "Lỗi: " . $conn->error;
    }
} else {
    echo "ID tài khoản không được cung cấp";
}
?>
