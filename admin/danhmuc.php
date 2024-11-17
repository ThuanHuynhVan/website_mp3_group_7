<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý bài hát</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1000px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .add-song-btn {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .add-song-btn:hover {
            background-color: #45a049;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: left;
            font-size: 14px;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
            color: #333;
            text-transform: uppercase;
        }

        .audio-control {
            text-align: center;
        }

        .audio-icon {
            width: 30px;
            height: auto;
            opacity: 0.7;
            transition: opacity 0.3s ease;
        }

        .audio-icon:hover {
            opacity: 1;
            cursor: pointer;
        }

        .edit-delete-btns a {
            margin-right: 10px;
            text-decoration: none;
            color: #555;
            transition: color 0.3s ease;
        }

        .edit-delete-btns a:hover {
            color: #f00;
        }

        .edit-delete-btns {
            text-align: right;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Quản lý bài hát</h2>
    <div style="text-align: center; margin-bottom: 20px;">
        <a href="addsong.php" class="add-song-btn">Thêm bài hát</a>
    </div>
    <div class="music-list">
        <table>
            <thead>
            <tr>
                <th>STT</th>
                <th>Tên bài hát</th>
                <th>Tên Nghệ sĩ</th>
                <th>Album</th>
                <th>Năm phát hành</th>
                <th>Thời lượng</th>
                <th>Ngôn Ngữ</th>
                <th>Audio</th>
                <th>Thao tác</th>
            </tr>
            </thead>
            <tbody>
            <?php
            // Kết nối đến cơ sở dữ liệu
            require 'connect.php';

            // Truy vấn dữ liệu từ bảng danh mục bài hát
            $sql = "SELECT * FROM songs";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["SongID"] . "</td>";
                    echo "<td>" . $row["Tenbaihat"] . "</td>";
                    echo "<td>" . $row["Tennghesi"] . "</td>";
                    echo "<td>" . $row["Album"] . "</td>";
                    echo "<td>" . $row["Namphathanh"] . "</td>";
                    echo "<td>" . $row["Thoiluong"] . "</td>";
                    echo "<td>" . $row["Ngonngu"] . "</td>";
                    echo "<td class='audio-control'>";
                    echo "<audio controls>";
                    echo "<source src='" . $row["Audio_File"] . "' type='audio/mpeg'>";
                    echo "Trình duyệt của bạn không hỗ trợ phát âm thanh.";
                    echo "</audio>";
                    echo "</td>";
                    echo "<td class='edit-delete-btns'>";
                    echo "<a href='edit_song.php?id=" . $row["SongID"] . "'>Sửa</a>";
                    echo "<a href='delete_song.php?id=" . $row["SongID"] . "'>Xóa</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='9'>Không có bài hát nào.</td></tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    function playAudio(audioFile) {
        var audio = new Audio(audioFile);
        audio.play();
    }
</script>

</body>
</html>

