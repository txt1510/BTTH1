<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quizz_db";  

// Kết nối tới MySQL mà không chọn cơ sở dữ liệu ngay lập tức
$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Kiểm tra nếu cơ sở dữ liệu chưa tồn tại thì tạo nó
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    //echo "Cơ sở dữ liệu '$dbname' đã được tạo hoặc đã tồn tại.<br>";
} else {
    echo "Lỗi khi tạo cơ sở dữ liệu: " . $conn->error . "<br>";
}

// Sau khi tạo cơ sở dữ liệu, chọn cơ sở dữ liệu để làm việc
$conn->select_db($dbname);
?>
