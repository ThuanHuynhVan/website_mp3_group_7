<?php
// Kết nối đến cơ sở dữ liệu
require 'connect.php';

// Kiểm tra xem có tham số ID được truyền không
if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // Xóa bản ghi từ bảng songs có ID tương ứng
    $sql = "DELETE FROM songs WHERE SongID = $id";

    if ($conn->query($sql) === TRUE) {
        // Nếu xóa thành công, chuyển hướng trở lại trang danh mục bài hát và hiển thị alert
        echo '<script>alert("Xóa thành công."); window.location.href = "danhmuc.php";</script>';
        exit();
    } else {
        // Nếu có lỗi, hiển thị thông báo lỗi
        echo "Error deleting record: " . $conn->error;
    }
} else {
    // Nếu không có ID được truyền, hiển thị thông báo lỗi
    echo "ID không được cung cấp.";
}

// Đóng kết nối
$conn->close();
?>
