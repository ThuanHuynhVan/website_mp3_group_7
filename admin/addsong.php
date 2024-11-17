
<?php
require 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $artist = $_POST['artist'];
    $album = $_POST['album'];
    $release_year = $_POST['release_year'];
    $genre = $_POST['genre'];
    $duration = $_POST['duration'];
    $language = $_POST['language'];

    // Process the uploaded audio file
    $target_directory = "uploads/"; // Directory where the audio files will be stored
    $target_file = $target_directory . basename($_FILES["audio"]["name"]);
    move_uploaded_file($_FILES["audio"]["name"], $target_file);
    header("Location: danhmuc.php");

    // Insert new song into the database using prepared statements to prevent SQL injection
    $sql = "INSERT INTO songs (Tenbaihat, Tennghesi, Album, Namphathanh, Theloai, Thoiluong, Ngonngu, Audio_File) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssss", $title, $artist, $album, $release_year, $genre, $duration, $language, $target_file);

    if ($stmt->execute()) {
        // Redirect user to the song management page after successfully adding a new song
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Song</title>
    <link rel="stylesheet" href="addsong.css">
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f5f5f5;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.container {
    max-width: 500px;
    margin: 50px auto;
    background-color: #fff;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h2 {
    text-align: center;
    color: #333;
}

form {
    margin-top: 20px;
}

label {
    font-weight: bold;
    display: block;
    margin-bottom: 5px;
    color: #555;
}

input[type="text"],
input[type="file"] {
    width: calc(100% - 22px); /* Adjusted width */
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

input[type="submit"] {
    width: 100%;
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s; /* Added transition for hover effect */
}

input[type="submit"]:hover {
    background-color: #45a049;
}

input[type="submit"]:focus {
    outline: none; /* Remove default focus outline */
}

.container::after {
    content: "";
    display: table;
    clear: both;
}

    </style>
</head>
<body>
    <div class="container">
        <h2>Thêm bài hát mới</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
            <label for="title">Tên Bài Hát:</label><br>
            <input type="text" id="title" name="title" required><br>
            <label for="artist">Tên Nghệ Sĩ:</label><br>
            <input type="text" id="artist" name="artist" required><br>
            <label for="album">Album:</label><br>
            <input type="text" id="album" name="album"><br>
            <label for="release_year">Năm Phát Hành:</label><br>
            <input type="text" id="release_year" name="release_year"><br>
            <label for="genre">Thể Loại:</label><br>
            <input type="text" id="genre" name="genre"><br>
            <label for="duration">Thời Lượng:</label><br>
            <input type="text" id="duration" name="duration"><br>
            <label for="language">Ngôn Ngữ:</label><br>
            <input type="text" id="language" name="language"><br>
            <label for="audio">Audio File:</label><br>
            <input type="file" id="audio" name="audio" accept="audio/*" required><br>
            <!-- Add more input fields for other song details -->
            <input type="submit" value="Thêm">
        </form>
    </div>
</body>
</html>