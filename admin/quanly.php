<?php
// Kết nối đến cơ sở dữ liệu
require 'connect.php';

// Truy vấn dữ liệu từ bảng tài khoản
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

// Kiểm tra vai trò của người dùng
$is_admin = true; // Giả sử người dùng là admin
?>
<body>
<h2>Xem danh sách tài khoản</h2>
<div class="account-list">
    <table>
        <thead>
            <tr>
                <th>STT</th>
                <th>USER</th>
                <th>PASS</th>
                <th>EMAIL</th>
                <th>ĐỊA CHỈ</th>
                <th>GIỚI TÍNH</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                // Duyệt qua các dòng dữ liệu và hiển thị chúng
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["username"] . "</td>";
                    echo "<td>" . $row["pass"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["diachi"] . "</td>";
                    echo "<td>" . $row["gender"] . "</td>";
                    echo "<td>" . $row["role"] . "</td>";
                    echo "<td>";
                    echo "<form action='suatk.php' method='POST' style='display: inline;'>";
                        echo "<input type='hidden' name='id' value='" . $row["id"] . "'>";
                        echo "<button type='submit' class='edit'>Sửa</button>";
                        echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>Không có tài khoản nào.</td></tr>";
            }
            ?>
        </tbody>
        
    </table>
    <?php
    if ($is_admin) {
        // Đường dẫn tới trang đăng ký
        $register_page = "register.php";
        echo "<button onclick='window.location.href=\"$register_page\";'>Thêm mới</button>";
    }
    ?>
</div>
</body>
