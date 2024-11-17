<?php
// Kết nối đến cơ sở dữ liệu
require 'connect.php';

// Kiểm tra xem có tham số ID được truyền không
if(isset($_GET['id'])) {
    // Lấy ID từ tham số URL
    $id = $_GET['id'];

    // Nếu dữ liệu được gửi đi, cập nhật bản ghi tương ứng trong cơ sở dữ liệu
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $tenBaiHat = $_POST['ten_bai_hat'];
        $tenNgheSi = $_POST['ten_nghe_si'];
        $album = $_POST['album'];
        $namPhatHanh = $_POST['nam_phat_hanh'];
        $thoiLuong = $_POST['thoi_luong'];
        $ngonNgu = $_POST['ngon_ngu'];

        $sql = "UPDATE songs SET Tenbaihat='$tenBaiHat', Tennghesi='$tenNgheSi', Album='$album', Namphathanh='$namPhatHanh', Thoiluong='$thoiLuong', Ngonngu='$ngonNgu' WHERE SongID=$id";

        if ($conn->query($sql) === TRUE) {
            // Nếu cập nhật thành công, chuyển hướng trở lại trang danh mục bài hát
            header("Location: danhmuc.php");
            exit();
        } else {
            // Nếu có lỗi, hiển thị thông báo lỗi
            echo "Error updating record: " . $conn->error;
        }
    }

    // Truy vấn dữ liệu của bản ghi cần cập nhật
    $sql = "SELECT * FROM songs WHERE SongID=$id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Lấy dữ liệu từ bảng và hiển thị trong form để người dùng có thể chỉnh sửa
        $row = $result->fetch_assoc();
        $tenBaiHat = $row['Tenbaihat'];
        $tenNgheSi = $row['Tennghesi'];
        $album = $row['Album'];
        $namPhatHanh = $row['Namphathanh'];
        $thoiLuong = $row['Thoiluong'];
        $ngonNgu = $row['Ngonngu'];
    } else {
        echo "Không tìm thấy bản ghi.";
        exit();
    }

} else {
    // Nếu không có ID được truyền, hiển thị thông báo lỗi
    echo "ID không được cung cấp.";
    exit();
}

// Đóng kết nối
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa thông tin bài hát</title>
    <!-- Gắn CSS trực tiếp trong phần head -->
    <style>
        .edit-song-form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .edit-song-form input[type="text"],
        .edit-song-form input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .edit-song-form input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }

        .edit-song-form input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <!-- Form để người dùng có thể cập nhật thông tin -->
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $id; ?>" class="edit-song-form">
        Tên bài hát: <input type="text" name="ten_bai_hat" value="<?php echo $tenBaiHat;?>"><br>
        Tên nghệ sĩ: <input type="text" name="ten_nghe_si" value="<?php echo $tenNgheSi;?>"><br>
        Album: <input type="text" name="album" value="<?php echo $album;?>"><br>
        Năm phát hành: <input type="text" name="nam_phat_hanh" value="<?php echo $namPhatHanh;?>"><br>
        Thời lượng: <input type="text" name="thoi_luong" value="<?php echo $thoiLuong;?>"><br>
        Ngôn ngữ: <input type="text" name="ngon_ngu" value="<?php echo $ngonNgu;?>"><br>
        <input type="submit" value="Cập nhật">
    </form>
</body>
</html>


