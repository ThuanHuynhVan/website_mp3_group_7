<?php
// Kết nối đến cơ sở dữ liệu
require 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kiểm tra xem có dữ liệu id tài khoản được gửi không
    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        // Thực hiện truy vấn để lấy thông tin tài khoản có id tương ứng
        $sql = "SELECT * FROM users WHERE id = '$id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Dữ liệu được tìm thấy
            $row = $result->fetch_assoc();
            $username = $row['username'];
            $password = $row['pass'];
            $email = $row['email'];
            $address = $row['diachi'];
            $gender = $row['gender'];
            $role = $row['role'];

            // Kiểm tra nút "Cập nhật" đã được nhấn chưa
            if (isset($_POST['update'])) {
                // Lấy dữ liệu từ biểu mẫu chỉnh sửa
                $username = $_POST['username'];
                $password = $_POST['password'];
                $email = $_POST['email'];
                $address = $_POST['address'];
                $gender = $_POST['gender'];
                $role = $_POST['role'];

                // Cập nhật thông tin tài khoản vào cơ sở dữ liệu
                $update_sql = "UPDATE users SET username='$username', pass='$password', email='$email', diachi='$address', gender='$gender', role='$role' WHERE id='$id'";
                
                if ($conn->query($update_sql) === TRUE) {
                    // Nếu cập nhật thành công, chuyển hướng người dùng đến trang quản lý tài khoản
                    header("Location: admin.php");
                    exit();
                } else {
                    echo "Lỗi: " . $conn->error;
                }
            }

            // Hiển thị biểu mẫu chỉnh sửa
?>
            <form action="" method="POST" class="container">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div>
                    <label for="username">Tên đăng nhập:</label>
                    <input type="text" id="username" name="username" value="<?php echo $username; ?>" required>
                </div>
                <div>
                    <label for="password">Mật khẩu:</label>
                    <input type="password" id="password" name="password" value="<?php echo $password; ?>" required>
                </div>
                <div>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo $email; ?>" required>
                </div>
                <div>
                    <label for="address">Địa chỉ:</label>
                    <input type="text" id="address" name="address" value="<?php echo $address; ?>" required>
                </div>
                <div>
                    <label for="gender">Giới tính:</label>
                    <select id="gender" name="gender" required>
                        <option value="Nam" <?php if($gender == 'Nam') echo 'selected'; ?>>Nam</option>
                        <option value="Nữ" <?php if($gender == 'Nữ') echo 'selected'; ?>>Nữ</option>
                    </select>
                </div>
                <div>
                    <label for="role">Quyền tài khoản:</label>
                    <select id="role" name="role" required>
                        <option value="admin" <?php if($role == 'admin') echo 'selected'; ?>>Admin</option>
                        <option value="user" <?php if($role == 'user') echo 'selected'; ?>>User</option>
                    </select>
                </div>
                <button type="submit" name="update">Cập nhật</button>
                <button type="button" onclick="deleteUser(<?php echo $id; ?>)">Xóa</button>
            </form>
<?php
        } else {
            echo "Không tìm thấy tài khoản có id = $id";
        }
    } else {
        echo "ID tài khoản không được cung cấp";
    }
}
?>
<script>
    function deleteUser(userId) {
        if (confirm("Bạn có chắc chắn muốn xóa tài khoản này không?")) {
            // Chuyển hướng người dùng đến trang xác nhận xóa
            window.location.href = "delete_confirm.php?id=" + userId;
        }
    }
</script>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }

    .container {
        width: 50%;
        margin: 50px auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    form {
        display: grid;
        grid-gap: 10px;
    }

    label {
        font-weight: bold;
    }

    input[type="text"],
    input[type="password"],
    input[type="email"],
    select {
        width: calc(100% - 22px); /* Trừ đi khoảng cách padding và border */
        padding: 10px;
        margin: 5px 0;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 3px;
        outline: none; /* Loại bỏ viền màu xanh khi focus */
    }

    input[type="text"]:focus,
    input[type="password"]:focus,
    input[type="email"]:focus,
    select:focus {
        border-color: #4caf50; /* Màu viền khi focus */
    }

    button {
        background-color: #4caf50;
        color: #fff;
        padding: 10px 15px;
        border: none;
        border-radius: 3px;
        cursor: pointer;
    }

    button:hover {
        background-color: #45a049;
    }
</style>
