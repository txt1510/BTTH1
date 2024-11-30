<?php
include 'db.php';

if (isset($_GET['delete'])) {
    $id_to_delete = $_GET['delete'];
    $sql = "DELETE FROM questions WHERE id=$id_to_delete";
    if ($conn->query($sql) === TRUE) {
        echo "Câu hỏi đã được xóa thành công!<br>";
    } else {
        echo "Lỗi xóa câu hỏi: " . $conn->error . "<br>";
    }
}

// Lấy danh sách câu hỏi
$sql = "SELECT * FROM questions ORDER BY question_order";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Quản lý Câu Hỏi</title>
</head>
<body>
  <h1>Quản lý câu hỏi</h1>
  <table border="1">
    <tr>
      <th>ID</th>
      <th>Câu hỏi</th>
      <th>Option A</th>
      <th>Option B</th>
      <th>Option C</th>
      <th>Option D</th>
      <th>Answer</th>
      <th>Thao tác</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row['id'] . "</td>
                    <td>" . $row['question'] . "</td>
                    <td>" . $row['option_a'] . "</td>
                    <td>" . $row['option_b'] . "</td>
                    <td>" . $row['option_c'] . "</td>
                    <td>" . $row['option_d'] . "</td>
                    <td>" . $row['answer'] . "</td>
                    <td><a href='admin.php?delete=" . $row['id'] . "'>Xóa</a></td>
                  </tr>";
        }
    }
    ?>
  </table>
  <a href="insert_txt.php">Nhập câu hỏi từ file quiz.txt</a>
</body>
</html>

<?php
$conn->close();
?>
